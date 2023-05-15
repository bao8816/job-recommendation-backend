<?php

namespace App\Http\Controllers;

use App\Models\EmployerAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthEmployerController extends ApiController
{
    const TOKEN_PREFIX = 'Bearer ';

    public function signIn(Request $request)
    {
        try {
            $username = $request->username;
            $password = $request->password;
            $passwordSalt = $password . env('PASSWORD_SALT');

            if (!EmployerAccount::where('username', $username)->exists()) {
                return $this->respondBadRequest('Username does not exist');
            }

            $employerAccount = EmployerAccount::where('username', $username)->first();

            if (!Hash::check($passwordSalt, $employerAccount->password)) {
                return $this->respondBadRequest('Password is incorrect');
            }

            if ($employerAccount->is_banned) {
                return $this->respondBadRequest('Your account has been banned');
            }

            if ($employerAccount->locked_until !== null) {
                if (now() < $employerAccount->locked_until) {
                    return $this->respondBadRequest('Account is locked until ' . $employerAccount->locked_until);
                }
            }

            // Generate employer token
            $tokenName = env('EMPLOYER_AUTH_TOKEN');
            $token = $employerAccount->createToken($tokenName, ['employer']);

            $employerAccount->last_login = now();

            return $this->respondWithData(
                [
                    'employerAccount' => $employerAccount,
                    'token' => self::TOKEN_PREFIX . $token->plainTextToken,
                ], 'Successfully signed in');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
