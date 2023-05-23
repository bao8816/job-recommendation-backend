<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserProfileController extends ApiController
{
    public function getAllUserProfiles(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userProfiles = UserProfile::with('educations', 'cvs', 'experiences', 'achievements', 'skills', 'time_tables')
                ->paginate($count_per_page);

            if (count($userProfiles) === 0) {
                return $this->respondNotFound('No user profiles found');
            }

            return $this->respondWithData(
                [
                    'userProfiles' => $userProfiles,
                ]
                , 'Successfully retrieved user profiles');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserProfile(Request $request, string $id): JsonResponse
    {
        try {
            $userProfile = UserProfile::where('id', $id)->with('educations', 'cvs', 'experiences', 'achievements', 'skills', 'time_tables')
                ->paginate(1);

            if (!isset($userProfile)) {
                return $this->respondNotFound('User profile not found');
            }

            return $this->respondWithData(
                [
                    'userProfile' => $userProfile,
                ]
                , 'Successfully retrieved user profile');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateUserProfile(Request $request): JsonResponse
    {
        try {
            $userProfile = UserProfile::where('id', $request->user()->id)->first();

            if (!isset($userProfile)) {
                return $this->respondNotFound('User profile not found');
            }

            $userProfile->full_name = $request->full_name;
            $userProfile->avatar = $request->avatar;
            $userProfile->date_of_birth = $request->date_of_birth;
            $userProfile->gender = $request->gender;
            $userProfile->address = $request->address;
            $userProfile->email = $request->email;
            $userProfile->phone = $request->phone;
            $userProfile->save();

            return $this->respondWithData(
                [
                    'userProfile' => $userProfile,
                ], 'Successfully updated user profile');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
