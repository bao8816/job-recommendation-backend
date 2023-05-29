<?php

namespace App\Http\Controllers;

use App\Models\CompanyReport;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyReportController extends ApiController
{
    public function getCompanyReports(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page ?? 10;
            $order_by = $request->order_by ?? 'id';
            $order_type = $request->order_type ?? 'asc';

            $company_reports = CompanyReport::filter($request, CompanyReport::query())
                ->orderBy($order_by, $order_type)
                ->paginate($count_per_page);

            if (count($company_reports) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'company_reports' => $company_reports,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCompanyReportById(string $id): JsonResponse
    {
        try {
            $company_report = CompanyReport::where('id', $id)->first();

            if (!$company_report) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'company_report' => $company_report,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createCompanyReport(Request $request): JsonResponse
    {
        try {
            $company_report = new CompanyReport();
            $company_report->company_id = $request->company_id;
            $company_report->user_id = $request->user()->id;
            $company_report->reason = $request->reason;
            $company_report->save();

            return $this->respondCreated(
                [
                    'company_report' => $company_report,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteCompanyReport(string $id): JsonResponse
    {
        try {
            $company_report = CompanyReport::where('id', $id)->first();

            if (!$company_report) {
                return $this->respondNotFound();
            }

            $company_report->delete();

            return $this->respondWithData(
                [
                    'company_report' => $company_report,
                ], 'Xoá thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
