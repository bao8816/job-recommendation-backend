<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\UserAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
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

            //Generate user token
            $tokenName = env('USER_AUTH_TOKEN');
            $token = $userAccount->createToken($tokenName, ['user']);

            return $this->respondCreated(
                [
                    'userAccount' => $userAccount,
                    'token' => $token->plainTextToken,
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

            //Generate user token
            $tokenName = env('USER_AUTH_TOKEN');
            $token = $userAccount->createToken($tokenName, ['user']);

            return $this->respondWithData(
                [
                    'userAccount' => $userAccount,
                    'token' => $token->plainTextToken,
                ], 'Successfully signed in');
        }
        catch (Exception $exception) {
            return $this->respondWithError($exception->getMessage());
        }
    }
}
