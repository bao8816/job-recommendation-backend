<?php

namespace App\Http\Controllers;

use App\Models\JobLocation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobLocationController extends ApiController
{
    public function getJobLocationById(string $job_location_id): JsonResponse
    {
        try {
            $job_location = JobLocation::where('id', $job_location_id)->paginate(1);

            if ($job_location === null) {
                return $this->respondNotFound('No job location found');
            }

            return $this->respondWithData(
                [
                    'job_location' => $job_location,
                ]
                , 'Successfully retrieved job location');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getJobLocationsByJobId(Request $request, string $job_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $job_location = JobLocation::where('job_id', $job_id)->paginate($count_per_page);

            if ($job_location === null) {
                return $this->respondNotFound('No job location found');
            }

            return $this->respondWithData(
                [
                    'job_location' => $job_location,
                ]
                , 'Successfully retrieved job location');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getAllJobLocations(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $job_locations = JobLocation::paginate($count_per_page);

            if (count($job_locations) === 0) {
                return $this->respondNotFound('No job locations found');
            }

            return $this->respondWithData(
                [
                    'job_locations' => $job_locations,
                ]
            , 'Successfully retrieved job locations');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
