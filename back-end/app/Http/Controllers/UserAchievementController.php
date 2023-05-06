<?php

namespace App\Http\Controllers;

use App\Models\UserAchievement;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAchievementController extends ApiController
{
    public function getAllUserAchievements(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userAchievements = UserAchievement::paginate($count_per_page);

            if (count($userAchievements) === 0) {
                return $this->respondNotFound('No user achievements found');
            }

            return $this->respondWithData(
                [
                    'userAchievements' => $userAchievements,
                ]
                , 'Successfully retrieved user achievements');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserAchievementsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userAchievements = UserAchievement::where('user_id', $user_id)->paginate($count_per_page);

            if (count($userAchievements) === 0) {
                return $this->respondNotFound('No user achievements found');
            }

            return $this->respondWithData(
                [
                    'userAchievements' => $userAchievements,
                ]
                , 'Successfully retrieved user achievements');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserAchievementById(Request $request, string $user_achievement_id): JsonResponse
    {
        try {
            $userAchievement = UserAchievement::where('id', $user_achievement_id)->paginate(1);

            if (!isset($userAchievement)) {
                return $this->respondNotFound('User achievement not found');
            }

            return $this->respondWithData(
                [
                    'userAchievement' => $userAchievement,
                ]
                , 'Successfully retrieved user achievement');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createUserAchievement(Request $request): JsonResponse
    {
        try {
            $userAchievement = new UserAchievement();
            $userAchievement->user_id = $request->user_id;
            $userAchievement->description = $request->description;
            $userAchievement->save();

            return $this->respondWithData(
                [
                    'userAchievement' => $userAchievement,
                ]
                , 'Successfully created user achievement');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateUserAchievement(Request $request, string $user_achievement_id): JsonResponse
    {
        try {
            $userAchievement = UserAchievement::where('id', $user_achievement_id)->first();

            if (!isset($userAchievement)) {
                return $this->respondNotFound('User achievement not found');
            }

            if ($userAchievement->user_id !== $request->user()->id) {
                return $this->respondForbidden('You are not allowed to update this user achievement');
            }

            $userAchievement->user_id = $request->user_id;
            $userAchievement->description = $request->description;
            $userAchievement->save();

            return $this->respondWithData(
                [
                    'userAchievement' => $userAchievement,
                ]
                , 'Successfully updated user achievement');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteUserAchievement(Request $request, string $user_achievement_id): JsonResponse
    {
        try {
            $userAchievement = UserAchievement::where('id', $user_achievement_id)->first();

            if (!isset($userAchievement)) {
                return $this->respondNotFound('User achievement not found');
            }

            if ($userAchievement->user_id !== $request->user()->id) {
                return $this->respondForbidden('You are not allowed to delete this user achievement');
            }

            $userAchievement->delete();

            return $this->respondWithData(
                [
                    'userAchievement' => $userAchievement,
                ]
                , 'Successfully deleted user achievement');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
