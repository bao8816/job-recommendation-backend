<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    public function getAllUsers(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->countPerPage;

            $users = UserProfile::paginate($count_per_page);

            if (count($users) === 0) {
                return $this->respondNotFound('No users found');
            }

            return $this->respondWithData(
                [
                    'users' => $users,
                ]
            , 'Successfully retrieved users');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserById(string $user_id): JsonResponse
    {
        try {
            $user = UserProfile::where('id', $user_id)->first();

            if (!isset($user)) {
                return $this->respondNotFound('User not found');
            }

            return $this->respondWithData(
                [
                    'user' => $user,
                ]
            , 'Successfully retrieved user');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateUserById(Request $request, string $user_id): JsonResponse
    {
        try {
            $user = UserProfile::where('id', $user_id)->first();

            if (!isset($user)) {
                return $this->respondNotFound('User not found');
            }

            //Check if logged in user is the same as the user to be updated
            if (auth()->user()->id != $user_id) {
                return $this->respondUnauthorized('You are not authorized to update this user');
            }

            $user->update($request->all());

            return $this->respondWithData(
                [
                    'user' => $user,
                ]
            , 'Successfully updated user');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
