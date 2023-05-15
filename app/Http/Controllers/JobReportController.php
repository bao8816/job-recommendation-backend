<?php

namespace App\Http\Controllers;

use App\Models\JobReport;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobReportController extends ApiController
{
    public function getAllJobReports(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobReports = JobReport::paginate($count_per_page);

            if (count($jobReports) === 0) {
                return $this->respondNotFound('No job reports found');
            }

            return $this->respondWithData(
                [
                    'jobReports' => $jobReports,
                ]
                , 'Successfully retrieved job reports');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getJobReportsByJobId(Request $request, string $job_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobReports = JobReport::where('job_id', $job_id)->paginate($count_per_page);

            if (count($jobReports) === 0) {
                return $this->respondNotFound('No job reports found');
            }

            return $this->respondWithData(
                [
                    'jobReports' => $jobReports,
                ]
                , 'Successfully retrieved job reports');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getJobReportsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobReports = JobReport::where('user_id', $user_id)->paginate($count_per_page);

            if (count($jobReports) === 0) {
                return $this->respondNotFound('No job reports found');
            }

            return $this->respondWithData(
                [
                    'jobReports' => $jobReports,
                ]
                , 'Successfully retrieved job reports');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getJobReportById(string $id): JsonResponse
    {
        try {
            $jobReport = JobReport::where('id', $id)->paginate(1);

            if (!$jobReport) {
                return $this->respondNotFound('Job report not found');
            }

            return $this->respondWithData(
                [
                    'jobReport' => $jobReport,
                ]
                , 'Successfully retrieved job report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createJobReport(Request $request): JsonResponse
    {
        try {
            $jobReport = new JobReport();
            $jobReport->job_id = $request->job_id;
            $jobReport->user_id = $request->user()->id;
            $jobReport->reason = $request->reason;

            $jobReport->save();

            return $this->respondCreated(
                [
                    'jobReport' => $jobReport,
                ]
                , 'Successfully created job report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteJobReport(Request $request, string $id): JsonResponse
    {
        try {
            $jobReport = JobReport::where('id', $id)->first();

            if (!$jobReport) {
                return $this->respondNotFound('Job report not found');
            }

            if ($request->user()->id !== $jobReport->user_id) {
                return $this->respondUnauthorized('You are not authorized to delete this job report');
            }

            $jobReport->delete();

            return $this->respondWithData(
                [
                    'jobReport' => $jobReport,
                ]
                , 'Successfully deleted job report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
