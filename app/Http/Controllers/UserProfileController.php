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
            $count_per_page = $request->count_per_page ?? 10;

            $user_profiles = UserProfile::with('educations', 'cvs', 'experiences', 'achievements', 'skills', 'time_tables')
                ->paginate($count_per_page);

            if (count($user_profiles) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'user_profiles' => $user_profiles,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserProfile(Request $request, string $id): JsonResponse
    {
        try {
            $user_profile = UserProfile::where('id', $id)->with('educations', 'cvs', 'experiences', 'achievements', 'skills', 'time_tables')
                ->first();

            if (!$user_profile) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'user_profile' => $user_profile,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateUserProfile(Request $request): JsonResponse
    {
        try {
            $user_profile = UserProfile::where('id', $request->user()->id)->first();

            if (!$user_profile) {
                return $this->respondNotFound();
            }

            $user_profile->full_name = $request->full_name ?? $user_profile->full_name;
            $user_profile->avatar = $request->avatar ?? $user_profile->avatar;
            $user_profile->date_of_birth = $request->date_of_birth ?? $user_profile->date_of_birth;
            $user_profile->gender = $request->gender ?? $user_profile->gender;
            $user_profile->address = $request->address ?? $user_profile->address;
            $user_profile->email = $request->email ?? $user_profile->email;
            $user_profile->phone = $request->phone ?? $user_profile->phone;
            $user_profile->save();

            return $this->respondWithData(
                [
                    'user_profile' => $user_profile,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
