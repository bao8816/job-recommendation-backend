<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobTypeController extends ApiController
{
    public function getAllJobTypes(Request $request): JsonResponse
    {
        try {
            $jobTypes = JobType::all();

            if (count($jobTypes) === 0) {
                return $this->respondNotFound('No job types found');
            }

            return $this->respondWithData(
                [
                    'jobTypes' => $jobTypes,
                ]
                , 'Successfully retrieved job types');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getJobTypeById(Request $request, string $id): JsonResponse
    {
        try {
            $jobType = JobType::where('id', $id)->paginate(1);

            if (!isset($jobType)) {
                return $this->respondNotFound('Job type not found');
            }

            return $this->respondWithData(
                [
                    'jobType' => $jobType,
                ]
                , 'Successfully retrieved job type');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getJobTypesByJobId(Request $request, string $job_id): JsonResponse
    {
        try {
            $jobTypes = JobType::where('job_id', $job_id)->get();

            if (count($jobTypes) === 0) {
                return $this->respondNotFound('No job types found');
            }

            return $this->respondWithData(
                [
                    'jobTypes' => $jobTypes,
                ]
                , 'Successfully retrieved job types');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
