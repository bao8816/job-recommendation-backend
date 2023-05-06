<?php

namespace App\Http\Controllers;

use App\Models\UserEducation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserEducationController extends ApiController
{
    public function getAllUserEducations(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userEducations = UserEducation::paginate($count_per_page);

            if (count($userEducations) === 0) {
                return $this->respondNotFound('No user educations found');
            }

            return $this->respondWithData(
                [
                    'userEducations' => $userEducations,
                ]
                , 'Successfully retrieved user educations');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserEducationsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userEducations = UserEducation::where('user_id', $user_id)->paginate($count_per_page);

            if (count($userEducations) === 0) {
                return $this->respondNotFound('No user educations found');
            }

            return $this->respondWithData(
                [
                    'userEducations' => $userEducations,
                ]
                , 'Successfully retrieved user educations');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserEducationById(Request $request, string $user_education_id): JsonResponse
    {
        try {
            $userEducation = UserEducation::where('id', $user_education_id)->paginate(1);

            if (!isset($userEducation)) {
                return $this->respondNotFound('User education not found');
            }

            return $this->respondWithData(
                [
                    'userEducation' => $userEducation,
                ]
                , 'Successfully retrieved user education');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createUserEducation(Request $request): JsonResponse
    {
        try {
            $userEducation = new UserEducation();
            $userEducation->user_id = $request->user()->id;
            $userEducation->university = $request->university;
            $userEducation->start = $request->start;
            $userEducation->end = $request->end;
            $userEducation->save();

            return $this->respondWithData(
                [
                    'userEducation' => $userEducation,
                ]
                , 'Successfully created user education');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateUserEducation(Request $request, string $user_education_id): JsonResponse
    {
        try {
            $userEducation = UserEducation::where('id', $user_education_id)->first();

            if (!isset($userEducation)) {
                return $this->respondNotFound('User education not found');
            }

            if ($userEducation->user_id !== $request->user()->id) {
                return $this->respondForbidden('You are not allowed to update this user education');
            }

            $userEducation->university = $request->university;
            $userEducation->start = $request->start;
            $userEducation->end = $request->end;
            $userEducation->save();

            return $this->respondWithData(
                [
                    'userEducation' => $userEducation,
                ]
                , 'Successfully updated user education');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteUserEducation(Request $request, string $user_education_id): JsonResponse
    {
        try {
            $userEducation = UserEducation::where('id', $user_education_id)->first();

            if (!isset($userEducation)) {
                return $this->respondNotFound('User education not found');
            }

            if ($userEducation->user_id !== $request->user()->id) {
                return $this->respondForbidden('You are not allowed to delete this user education');
            }

            $userEducation->delete();

            return $this->respondWithData(
                [
                    'userEducation' => $userEducation,
                ]
                , 'Successfully deleted user education');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
