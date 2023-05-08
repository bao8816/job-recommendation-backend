<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyProfileController extends ApiController
{
    public function getAllCompanyProfiles(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $companyProfiles = CompanyProfile::paginate($count_per_page);

            if (count($companyProfiles) === 0) {
                return $this->respondNotFound('No company profiles found');
            }

            return $this->respondWithData(
                [
                    'companyProfiles' => $companyProfiles,
                ]
                , 'Successfully retrieved company profiles');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCompanyProfileById(Request $request, string $id): JsonResponse
    {
        try {
            $companyProfile = CompanyProfile::where('id', $id)->paginate(1);

            if (!isset($companyProfile)) {
                return $this->respondNotFound('Company profile not found');
            }

            return $this->respondWithData(
                [
                    'companyProfile' => $companyProfile,
                ]
                , 'Successfully retrieved company profile');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
