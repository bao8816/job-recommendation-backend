<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\UserAccount;
use App\Models\UserProfile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    private const TOKEN_PREFIX = 'Bearer ';

    //TODO: Change Request to SignUpRequest
    public function signUp(Request $request)
    {
        try {
            $username = $request->username;
            $password = $request->password;
            $password_confirmation = $request->password_confirmation;

            if ($password != $password_confirmation) {
                return $this->respondBadRequest('Password confirmation does not match');
            }

            if (UserAccount::where('username', $username)->exists()) {
                return $this->respondBadRequest('Username already exists');
            }

            $passwordSalt = $password . env('PASSWORD_SALT');
            $hashedPassword = Hash::make($passwordSalt);

            $userAccount = new UserAccount();
            $userAccount->username = $username;
            $userAccount->password = $hashedPassword;
            $userAccount->save();

            //Create profile
            $profile = new UserProfile();
            $profile->id = $userAccount->id;
            $profile->full_name = "Full Name";
            $profile->save();

            //Generate user token
            $tokenName = env('USER_AUTH_TOKEN');
            $token = $userAccount->createToken($tokenName, ['user']);

            return $this->respondCreated(
                [
                    'userAccount' => $userAccount,
                    'token' => self::TOKEN_PREFIX . $token->plainTextToken,
                ], 'Successfully signed up');
        }
        catch (Exception $exception) {
            return $this->respondWithError($exception->getMessage());
        }
    }

    public function signIn(Request $request)
    {
        try {
            $username = $request->username;
            $password = $request->password;
            $passwordSalt = $password . env('PASSWORD_SALT');

            if (!UserAccount::where('username', $username)->exists()) {
                return $this->respondBadRequest('Username does not exist');
            }

            $userAccount = UserAccount::where('username', $username)->first();

            if (!Hash::check($passwordSalt, $userAccount->password)) {
                return $this->respondBadRequest('Password is incorrect');
            }

            if ($userAccount->is_banned) {
                return $this->respondBadRequest('Your account has been banned');
            }

            if ($userAccount->locked_until !== null) {
                if (now() < $userAccount->locked_until) {
                    return $this->respondBadRequest('Your account has been locked until ' . $userAccount->locked_until);
                }
            }

            //Generate user token
            $tokenName = env('USER_AUTH_TOKEN');
            $token = $userAccount->createToken($tokenName, ['user']);

            return $this->respondWithData(
                [
                    'userAccount' => $userAccount,
                    'token' => self::TOKEN_PREFIX . $token->plainTextToken,
                ], 'Successfully signed in');
        }
        catch (Exception $exception) {
            return $this->respondWithError($exception->getMessage());
        }
    }
}
