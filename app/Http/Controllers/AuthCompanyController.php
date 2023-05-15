<?php

namespace App\Http\Controllers;

use App\Models\CompanyAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthCompanyController extends ApiController
{
    private const TOKEN_PREFIX = 'Bearer ';

    public function signUp(Request $request)
    {
        try {
            $username = $request->username;
            $password = $request->password;
            $password_confirmation = $request->password_confirmation;
            $passwordSalt = $password . env('PASSWORD_SALT');

            if ($password != $password_confirmation) {
                return $this->respondBadRequest('Password confirmation does not match');
            }

            if (CompanyAccount::where('username', $username)->exists()) {
                return $this->respondBadRequest('Username already exists');
            }

            $hashedPassword = Hash::make($passwordSalt);

            $companyAccount = new CompanyAccount();
            $companyAccount->username = $username;
            $companyAccount->password = $hashedPassword;
            $companyAccount->save();

            // Generate company token
            $tokenName = env('COMPANY_AUTH_TOKEN');
            $token = $companyAccount->createToken($tokenName, ['company']);

            return $this->respondWithData(
                [
                    'companyAccount' => $companyAccount,
                    'token' => self::TOKEN_PREFIX . $token->plainTextToken,
                ], 'Successfully signed up');
        } catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function signIn(Request $request)
    {
        try {
            $username = $request->username;
            $password = $request->password;
            $passwordSalt = $password . env('PASSWORD_SALT');

            if (!CompanyAccount::where('username', $username)->exists()) {
                return $this->respondBadRequest('Username does not exist');
            }

            $companyAccount = CompanyAccount::where('username', $username)->first();

            if (!Hash::check($passwordSalt, $companyAccount->password)) {
                return $this->respondBadRequest('Password is incorrect');
            }

            //TODO: Uncomment this when we have email verification
//            if (!$companyAccount->is_verified) {
//                return $this->respondBadRequest('Account is not verified');
//            }

            if ($companyAccount->is_banned) {
                return $this->respondBadRequest('Account is banned');
            }

            if ($companyAccount->locked_until !== null) {
                if (now() < $companyAccount->locked_until) {
                    return $this->respondBadRequest('Account is locked until ' . $companyAccount->locked_until);
                }
            }

            // Generate company token
            $tokenName = env('COMPANY_AUTH_TOKEN');
            $token = $companyAccount->createToken($tokenName, ['company']);

            $companyAccount->last_login = now();

            return $this->respondWithData(
                [
                    'companyAccount' => $companyAccount,
                    'token' => self::TOKEN_PREFIX . $token->plainTextToken,
                ], 'Successfully signed in');
        } catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
