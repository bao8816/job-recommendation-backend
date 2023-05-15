<?php

namespace App\Http\Controllers;

use App\Models\EmployerProfile;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployerProfileController extends ApiController
{
    public function getAllEmployerProfiles(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $employerProfiles = EmployerProfile::paginate($count_per_page);

            if (count($employerProfiles) === 0) {
                return $this->respondNotFound('No employers found');
            }

            return $this->respondWithData(
                [
                    'employerProfiles' => $employerProfiles,
                ]
                , 'Successfully retrieved employer profiles');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getEmployerProfilesByCompanyId(Request $request, string $company_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $employerProfiles = EmployerProfile::where('company_id', $company_id)->paginate($count_per_page);

            if (count($employerProfiles) === 0) {
                return $this->respondNotFound('No employers found');
            }

            return $this->respondWithData(
                [
                    'employerProfiles' => $employerProfiles,
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
            $employerProfile = EmployerProfile::where('id', $id)->paginate(1);

            if (!isset($employerProfile)) {
                return $this->respondNotFound('Employer profile not found');
            }

            return $this->respondWithData(
                [
                    'employerProfile' => $employerProfile,
                ]
                , 'Successfully retrieved employer profile');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
