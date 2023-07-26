<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\UserAchievement;
use App\Models\UserEducation;
use App\Models\UserExperience;
use App\Models\UserProfile;
use App\Models\UserSkill;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends ApiController
{
    public function getAllUserProfiles(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page ?? 10;

            $user_profiles = UserProfile::with('educations', 'cvs', 'experiences', 'achievements', 'skills', 'time_table')
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
            $user_profile = UserProfile::where('id', $id)->with('educations', 'cvs', 'experiences', 'achievements', 'skills', 'time_table')
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

    public function updateUserProfile(UpdateUserProfileRequest $request): JsonResponse
    {
        try {
            $user_profile = UserProfile::where('id', $request->user()->id)
                ->with('educations', 'cvs', 'experiences', 'achievements', 'skills', 'time_table')
                ->first();

            if (!$user_profile) {
                return $this->respondNotFound();
            }

            $user_profile->full_name = $request->full_name ?? $user_profile->full_name;
            $user_profile->about_me = $request->about_me ?? $user_profile->about_me;
            $user_profile->good_at_position = $request->good_at_position ?? $user_profile->good_at_position;
            $user_profile->year_of_experience = $request->year_of_experience ?? $user_profile->year_of_experience;
            $user_profile->date_of_birth = $request->date_of_birth ?? $user_profile->date_of_birth;
            $user_profile->gender = $request->gender ?? $user_profile->gender;
            $user_profile->address = $request->address ?? $user_profile->address;
            $user_profile->email = $request->email ?? $user_profile->email;
            $user_profile->phone = $request->phone ?? $user_profile->phone;
            $user_profile->is_private = $request->is_private ?? $user_profile->is_private;

            // upload avatar
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $file_name = $file->getClientOriginalName();
                $file_name = str_replace(' ', '_', $file_name);
                $file_name = preg_replace('/[^A-Za-z0-9\-\.]/', '', $file_name);
                $file_name = time() . '_' . $file_name;

                $path = Storage::disk('s3')->putFileAs(
                    'user_avatar',
                    $file,
                    $file_name,
                );
                $url = Storage::disk('s3')->url($path);

                if (!$path || !$url) {
                    return $this->respondInternalServerError('Không thể upload avatar');
                }

                $user_profile->avatar = $url;
            }

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

    public function importUserProfile(Request $request, string $id): JsonResponse
    {
        try {
            $object = $request->json('object');
            $profile = $object['user_profile'];

            $user_profile = UserProfile::where('id', $id)
                ->with('educations', 'cvs', 'experiences', 'achievements', 'skills', 'time_table')
                ->first();

            if (!$user_profile) {
                return $this->respondNotFound();
            }

            // update profile
            $user_profile->full_name = $profile['full_name'] ?? $user_profile->full_name;
            $user_profile->avatar = $profile['avatar'] ?? $user_profile->avatar;
            $user_profile->about_me = $profile['about_me'] ?? $user_profile->about_me;
            $user_profile->good_at_position = $profile['good_at_position'] ?? $user_profile->good_at_position;
            $user_profile->date_of_birth = Carbon::createFromFormat('d/m/Y', $profile['date_of_birth'])->toDateString()
                ?? $user_profile->date_of_birth;
            $user_profile->address = $profile['address'] ?? $user_profile->address;
            $user_profile->email = $profile['email'] ?? $user_profile->email;
            $user_profile->phone = $profile['phone'] ?? $user_profile->phone;
            $user_profile->save();
            //---------------------------------------------

            // update educations
            // delete all current educations and insert new educations
            if (isset($object['profile']['educations'])) {
                $educations = $object['profile']['educations'];
                $user_profile->education()->delete();
                $user_profile->education()->createMany($educations);
            }
            //---------------------------------------------

            // update experiences
            // delete all current experiences and insert new experiences
            if (isset($object['profile']['experiences'])) {
                $experiences = $object['profile']['experiences'];
                $user_profile->experience()->delete();
                $user_profile->experience()->createMany($this->formatDates($experiences));
            }
            //---------------------------------------------

            // update achievements
            // delete all current achievements and insert new achievements
            if (isset($object['profile']['achievements'])) {
                $achievements = $object['profile']['achievements'];
                $user_profile->achievement()->delete();
                $user_profile->achievement()->createMany($achievements);
            }
            //---------------------------------------------

            // update skills
            // delete all current skills and insert new skills
            if (isset($object['profile']['skills'])) {
                $skills = $object['profile']['skills'];
                $user_profile->skill()->delete();
                $user_profile->skill()->createMany($skills);
            }
            //---------------------------------------------

            return $this->respondWithData(
                [
                    'user_profile' => $user_profile,
                ], 'Cập nhật thông tin thành công'
            );
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    private function formatDates($data): array
    {
        return collect($data)->map(function ($item) {
            $item['start'] = Carbon::createFromFormat('d/m/Y', $item['start'])->toDateString();
            $item['end'] = Carbon::createFromFormat('d/m/Y', $item['end'])->toDateString();
            return $item;
        })->all();
    }
}
