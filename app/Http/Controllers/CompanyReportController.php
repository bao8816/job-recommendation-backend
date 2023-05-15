<?php

namespace App\Http\Controllers;

use App\Models\CompanyReport;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyReportController extends ApiController
{
    public function getAllCompanyReports(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $companyReports = CompanyReport::paginate($count_per_page);

            if (count($companyReports) === 0) {
                return $this->respondNotFound('No company reports found');
            }

            return $this->respondWithData(
                [
                    'companyReports' => $companyReports,
                ]
                , 'Successfully retrieved company reports');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCompanyReportsByCompanyId(Request $request, string $company_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $companyReports = CompanyReport::where('company_id', $company_id)->paginate($count_per_page);

            if (count($companyReports) === 0) {
                return $this->respondNotFound('No company reports found');
            }

            return $this->respondWithData(
                [
                    'companyReports' => $companyReports,
                ]
                , 'Successfully retrieved company reports');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCompanyReportsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $companyReports = CompanyReport::where('user_id', $user_id)->paginate($count_per_page);

            if (count($companyReports) === 0) {
                return $this->respondNotFound('No company reports found');
            }

            return $this->respondWithData(
                [
                    'companyReports' => $companyReports,
                ]
                , 'Successfully retrieved company reports');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCompanyReportById(string $id): JsonResponse
    {
        try {
            $companyReport = CompanyReport::where('id', $id)->first();

            if (!$companyReport) {
                return $this->respondNotFound('Company report not found');
            }

            return $this->respondWithData(
                [
                    'companyReport' => $companyReport,
                ]
                , 'Successfully retrieved company report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createCompanyReport(Request $request): JsonResponse
    {
        try {
            $companyReport = new CompanyReport();
            $companyReport->company_id = $request->company_id;
            $companyReport->user_id = $request->user()->id;
            $companyReport->reason = $request->reason;
            $companyReport->save();

            return $this->respondWithData(
                [
                    'companyReport' => $companyReport,
                ]
                , 'Successfully created company report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteCompanyReport(string $id): JsonResponse
    {
        try {
            $companyReport = CompanyReport::where('id', $id)->first();

            if (!$companyReport) {
                return $this->respondNotFound('Company report not found');
            }

            $companyReport->delete();

            return $this->respondWithData(
                [
                    'companyReport' => $companyReport,
                ]
                , 'Successfully deleted company report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
