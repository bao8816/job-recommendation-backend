<?php

namespace App\Http\Controllers;

use App\Models\UserSkill;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserSkillController extends ApiController
{
    public function getAllUserSkills(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userSkills = UserSkill::paginate($count_per_page);

            if (count($userSkills) === 0) {
                return $this->respondNotFound('No user skills found');
            }

            return $this->respondWithData(
                [
                    'userSkills' => $userSkills,
                ]
                , 'Successfully retrieved user skills');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserSkillsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userSkills = UserSkill::where('user_id', $user_id)->paginate($count_per_page);

            if (count($userSkills) === 0) {
                return $this->respondNotFound('No user skills found');
            }

            return $this->respondWithData(
                [
                    'userSkills' => $userSkills,
                ]
                , 'Successfully retrieved user skills');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserSkillById(Request $request, string $user_skill_id): JsonResponse
    {
        try {
            $userSkill = UserSkill::where('id', $user_skill_id)->paginate(1);

            if (count($userSkill) === 0) {
                return $this->respondNotFound('No user skill found');
            }

            return $this->respondWithData(
                [
                    'userSkill' => $userSkill,
                ]
                , 'Successfully retrieved user skill');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createUserSkill(Request $request): JsonResponse
    {
        try {
            $userSkill = new UserSkill();

            $userSkill->user_id = $request->user_id;
            $userSkill->skill = $request->skill;
            $userSkill->save();

            return $this->respondCreated(
                [
                    'userSkill' => $userSkill,
                ]
                , 'Successfully created user skill');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateUserSkill(Request $request, string $user_skill_id): JsonResponse
    {
        try {
            $userSkill = UserSkill::where('id', $user_skill_id)->first();

            if (!$userSkill) {
                return $this->respondNotFound('No user skill found');
            }

            if ($userSkill->user_id !== $request->user()->id) {
                return $this->respondUnauthorized('You are not authorized to update this user skill');
            }

            $userSkill->user_id = $request->user()->id;
            $userSkill->skill = $request->skill;
            $userSkill->save();

            return $this->respondWithData(
                [
                    'userSkill' => $userSkill,
                ]
                , 'Successfully updated user skill');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteUserSkill(Request $request, string $user_skill_id): JsonResponse
    {
        try {
            $userSkill = UserSkill::where('id', $user_skill_id)->first();

            if (!$userSkill) {
                return $this->respondNotFound('No user skill found');
            }

            if ($userSkill->user_id !== $request->user()->id) {
                return $this->respondUnauthorized('You are not authorized to delete this user skill');
            }

            $userSkill->delete();

            return $this->respondNoContent();
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
