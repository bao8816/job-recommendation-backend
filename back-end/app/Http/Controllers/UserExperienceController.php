<?php

namespace App\Http\Controllers;

use App\Models\UserExperience;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserExperienceController extends ApiController
{
    public function getAllUserExperiences(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userExperiences = UserExperience::paginate($count_per_page);

            if (count($userExperiences) === 0) {
                return $this->respondNotFound('No user experiences found');
            }

            return $this->respondWithData(
                [
                    'userExperiences' => $userExperiences,
                ]
                , 'Successfully retrieved user experiences');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserExperiencesByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userExperiences = UserExperience::where('user_id', $user_id)->paginate($count_per_page);

            if (count($userExperiences) === 0) {
                return $this->respondNotFound('No user experiences found');
            }

            return $this->respondWithData(
                [
                    'userExperiences' => $userExperiences,
                ]
                , 'Successfully retrieved user experiences');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserExperienceById(Request $request, string $id): JsonResponse
    {
        try {
            $userExperience = UserExperience::where('id', $id)->paginate(1);

            if (!isset($userExperience)) {
                return $this->respondNotFound('User experience not found');
            }

            return $this->respondWithData(
                [
                    'userExperience' => $userExperience,
                ]
                , 'Successfully retrieved user experience');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createUserExperience(Request $request): JsonResponse
    {
        try {
            $userExperience = new UserExperience();
            $userExperience->user_id = $request->user_id;
            $userExperience->description = $request->description;
            $userExperience->start = $request->start;
            $userExperience->end = $request->end;
            $userExperience->save();

            return $this->respondWithData(
                [
                    'userExperience' => $userExperience,
                ]
                , 'Successfully created user experience');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateUserExperience(Request $request, string $id): JsonResponse
    {
        try {
            $userExperience = UserExperience::where('id', $id)->first();

            if (!isset($userExperience)) {
                return $this->respondNotFound('User experience not found');
            }

            if ($userExperience->user_id !== $request->user()->id) {
                return $this->respondUnauthorized('You are not authorized to update this user experience');
            }

            $userExperience->description = $request->description;
            $userExperience->start = $request->start;
            $userExperience->end = $request->end;
            $userExperience->save();

            return $this->respondWithData(
                [
                    'userExperience' => $userExperience,
                ]
                , 'Successfully updated user experience');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteUserExperience(Request $request, string $id): JsonResponse
    {
        try {
            $userExperience = UserExperience::where('id', $id)->first();

            if (!isset($userExperience)) {
                return $this->respondNotFound('User experience not found');
            }

            if ($userExperience->user_id !== $request->user()->id) {
                return $this->respondUnauthorized('You are not authorized to delete this user experience');
            }

            $userExperience->delete();

            return $this->respondWithData(
                [
                    'userExperience' => $userExperience,
                ]
                , 'Successfully deleted user experience');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
