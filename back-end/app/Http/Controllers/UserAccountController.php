<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAccountController extends ApiController
{
    public function updatePassword(Request $request): JsonResponse
    {
        try {
            $userAccount = UserAccount::where('id', $request->user_id)->first();

            if (!isset($userAccount)) {
                return $this->respondNotFound('User account not found');
            }

            if ($userAccount->password !== $request->old_password) {
                return $this->respondBadRequest('Old password is incorrect');
            }

            if ($request->new_password !== $request->confirm_password) {
                return $this->respondBadRequest('New password and password confirmation do not match');
            }

            $userAccount->password = $request->new_password;
            $userAccount->save();

            return $this->respondWithData(
                [
                    'userAccount' => $userAccount,
                ], 'Successfully updated user account password');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
