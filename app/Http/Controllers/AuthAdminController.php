<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAdminController extends ApiController
{
    private const TOKEN_PREFIX = 'Bearer ';

    public function signIn(Request $request)
    {
        try {
            $username = $request->username;
            $password = $request->password;
            $passwordSalt = $password . env('PASSWORD_SALT');

            if (!Admin::where('username', $username)->exists()) {
                return $this->respondBadRequest('Username does not exist');
            }

            $admin = Admin::where('username', $username)->first();

            if (!Hash::check($passwordSalt, $admin->password)) {
                return $this->respondBadRequest('Password is incorrect');
            }

            if ($admin->is_banned) {
                return $this->respondBadRequest('Your account is banned');
            }

            if ($admin->locked_until !== null) {
                if (now() < $admin->locked_until) {
                    return $this->respondBadRequest('Your account is locked until ' . $admin->locked_until);
                }
            }

            // Generate admin token
            $tokenName = env('ADMIN_AUTH_TOKEN');
            if ($admin->username == 'Admin') {
                $token = $admin->createToken($tokenName, ['admin']);
            }
            else {
                $token = $admin->createToken($tokenName, ['moderator']);
            }

            $admin->last_login = now();

            return $this->respondWithData(
                [
                    'admin' => $admin,
                    'token' => self::TOKEN_PREFIX . $token->plainTextToken,
                ], 'Successfully signed in');
        } catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
