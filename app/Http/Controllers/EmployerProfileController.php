<?php

namespace App\Http\Controllers;

use App\Models\EmployerProfile;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployerProfileController extends ApiController
{
    public function getEmployerProfiles(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page ?? 10;
            $order_by = $request->order_by ?? 'id';
            $order_type = $request->order_type ?? 'asc';

            $employer_profiles = EmployerProfile::filter($request, EmployerProfile::query())
                ->orderBy($order_by, $order_type)
                ->paginate($count_per_page);

            if (count($employer_profiles) === 0) {
                return $this->respondNotFound('No employers found');
            }

            return $this->respondWithData(
                [
                    'employer_profiles' => $employer_profiles,
                ]
                , 'Successfully retrieved employer profiles');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getEmployerProfileById(Request $request, string $id): JsonResponse
    {
        try {
            $employer_profile = EmployerProfile::where('id', $id)->first();

            if (!$employer_profile) {
                return $this->respondNotFound('Employer profile not found');
            }

            return $this->respondWithData(
                [
                    'employer_profile' => $employer_profile,
                ]
                , 'Successfully retrieved employer profile');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateEmployerProfile(Request $request, string $id): JsonResponse
    {
        try {
            $employer_profile = EmployerProfile::where('id', $id)->first();

            if (!$employer_profile) {
                return $this->respondNotFound();
            }

            $employer_profile->full_name = $request->full_name ?? $employer_profile->full_name;
            $employer_profile->avatar = $request->avatar ?? $employer_profile->avatar;

            return $this->respondWithData(
                [
                    'employer_profile' => $employer_profile,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
