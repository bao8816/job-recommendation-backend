<?php

namespace App\Http\Controllers;

use App\Models\CompanyVerification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyVerificationController extends ApiController
{
    public function getAllCompanyVerifications(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $companyVerifications = CompanyVerification::paginate($count_per_page);

            if (count($companyVerifications) === 0) {
                return $this->respondNotFound('No company verifications found');
            }

            return $this->respondWithData(
                [
                    'companyVerifications' => $companyVerifications,
                ]
                , 'Successfully retrieved company verifications');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCompanyVerificationsByCompanyId(Request $request, string $company_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $companyVerifications = CompanyVerification::where('company_id', $company_id)->paginate($count_per_page);

            if (count($companyVerifications) === 0) {
                return $this->respondNotFound('No company verifications found');
            }

            return $this->respondWithData(
                [
                    'companyVerifications' => $companyVerifications,
                ]
                , 'Successfully retrieved company verifications');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCompanyVerificationById(Request $request, string $id): JsonResponse
    {
        try {
            $companyVerification = CompanyVerification::where('id', $id)->paginate(1);

            if (count($companyVerification) === 0) {
                return $this->respondNotFound('No company verification found');
            }

            return $this->respondWithData(
                [
                    'companyVerification' => $companyVerification,
                ]
                , 'Successfully retrieved company verification');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createCompanyVerification(Request $request): JsonResponse
    {
        try {
            $companyVerification = new CompanyVerification();
            $companyVerification->company_id = $request->company_id;
            $companyVerification->verification_url = $request->verification_url;
            $companyVerification->save();

            return $this->respondWithData(
                [
                    'companyVerification' => $companyVerification,
                ]
                , 'Successfully created company verification');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function approveCompanyVerification(Request $request, string $id): JsonResponse
    {
        try {
            $companyVerification = CompanyVerification::where('id', $id)->first();

            if ($companyVerification === null) {
                return $this->respondNotFound('No company verification found');
            }

            $companyVerification->status = 'Hợp lệ';
            $companyVerification->save();

            return $this->respondWithData(
                [
                    'companyVerification' => $companyVerification,
                ]
                , 'Successfully approved company verification');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function rejectCompanyVerification(Request $request, string $id): JsonResponse
    {
        try {
            $companyVerification = CompanyVerification::where('id', $id)->first();

            if ($companyVerification === null) {
                return $this->respondNotFound('No company verification found');
            }

            $companyVerification->status = 'Không hợp lệ';
            $companyVerification->save();

            return $this->respondWithData(
                [
                    'companyVerification' => $companyVerification,
                ]
                , 'Successfully denied company verification');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteCompanyVerification(Request $request, string $id): JsonResponse
    {
        try {
            $companyVerification = CompanyVerification::where('id', $id)->first();

            if ($companyVerification === null) {
                return $this->respondNotFound('No company verification found');
            }

            $companyVerification->delete();

            return $this->respondWithData(
                [
                    'companyVerification' => $companyVerification,
                ]
                , 'Successfully deleted company verification');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
