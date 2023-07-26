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
            $encoded_object = $request->object;
            if (is_array($encoded_object)) {
                $encoded_object = json_encode($encoded_object);
            }

            $object = json_decode($encoded_object, true);
            $profile = $object['user_profile'];
            $educations = $object['user_profile']['educations'];
            $experiences = $object['user_profile']['experiences'];
            $achievements = $object['user_profile']['achievements'];
            $skills = $object['user_profile']['skills'];

            $user_profile = UserProfile::where('id', $id)
                ->first();

            $user_educations = UserEducation::where('user_id', $id)
                ->get();

            $user_experiences = UserExperience::where('user_id', $id)
                ->get();

            $user_achievements = UserAchievement::where('user_id', $id)
                ->get();

            $user_skills = UserSkill::where('user_id', $id)
                ->get();

            if (!$user_profile
                || !$user_educations
                || !$user_experiences
                || !$user_achievements
                || !$user_skills) {
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
            foreach ($user_educations as $user_education) {
                $user_education->delete();
            }

            if (count($educations) > 0) {
                foreach ($educations as $education) {
                    $user_education = new UserEducation();
                    $user_education->user_id = $id;
                    $user_education->university = $education['university'];
                    $user_education->major = $education['major'];
                    $user_education->start = $education['start'];
                    $user_education->end = $education['end'];
                    $user_education->save();
                }
            }
            //---------------------------------------------

            // update experiences
            // delete all current experiences and insert new experiences
            foreach ($user_experiences as $user_experience) {
                $user_experience->delete();
            }

            if (count($experiences) > 0) {
                foreach ($experiences as $experience) {
                    $user_experience = new UserExperience();
                    $user_experience->user_id = $id;
                    $user_experience->title = $experience['title'];
                    $user_experience->position = $experience['position'];
                    $user_experience->description = $experience['description'];
                    $user_experience->start = Carbon::createFromFormat('d/m/Y', $experience['start'])->toDateString();
                    $user_experience->end = Carbon::createFromFormat('d/m/Y', $experience['end'])->toDateString();
                    $user_experience->save();
                }
            }
            //---------------------------------------------

            // update achievements
            // delete all current achievements and insert new achievements
            foreach ($user_achievements as $user_achievement) {
                $user_achievement->delete();
            }

            if (count($achievements) > 0) {
                foreach ($achievements as $achievement) {
                    $user_achievement = new UserAchievement();
                    $user_achievement->user_id = $id;
                    $user_achievement->description = $achievement['description'];
                    $user_achievement->save();
                }
            }
            //---------------------------------------------

            // update skills
            // delete all current skills and insert new skills
            foreach ($user_skills as $user_skill) {
                $user_skill->delete();
            }

            if (count($skills) > 0) {
                foreach ($skills as $skill) {
                    $user_skill = new UserSkill();
                    $user_skill->user_id = $id;
                    $user_skill->skill = $skill['skill'];
                    $user_skill->save();
                }
            }
            //---------------------------------------------

            return $this->respondWithData(
                [
                    'user_profile' => $user_profile,
                    'educations' => $user_educations,
                    'experiences' => $user_experiences,
                    'achievements' => $user_achievements,
                    'skills' => $user_skills,
                ], 'Cập nhật thông tin thành công'
            );
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
