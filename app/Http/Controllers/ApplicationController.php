<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationController extends ApiController
{
    public function getAllApplications(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $applications = Application::paginate($count_per_page);

            if (count($applications) === 0) {
                return $this->respondNotFound('No applications found');
            }

            return $this->respondWithData(
                [
                    'applications' => $applications,
                ]
                , 'Successfully retrieved applications');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getApplicationsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $applications = Application::where('user_id', $user_id)->paginate($count_per_page);

            if (count($applications) === 0) {
                return $this->respondNotFound('No applications found');
            }

            return $this->respondWithData(
                [
                    'applications' => $applications,
                ]
                , 'Successfully retrieved applications');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getApplicationsByJobId(Request $request, string $job_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $applications = Application::where('job_id', $job_id)->paginate($count_per_page);

            if (count($applications) === 0) {
                return $this->respondNotFound('No applications found');
            }

            return $this->respondWithData(
                [
                    'applications' => $applications,
                ]
                , 'Successfully retrieved applications');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getApplicationById(string $id): JsonResponse
    {
        try {
            $application = Application::where('id', $id)->paginate(1);

            if ($application === null) {
                return $this->respondNotFound('No application found');
            }

            return $this->respondWithData(
                [
                    'application' => $application,
                ]
                , 'Successfully retrieved application');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createApplication(Request $request): JsonResponse
    {
        try {
            $application = Application::create($request->all());

            return $this->respondWithData(
                [
                    'application' => $application,
                ]
                , 'Successfully created application');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateApplication(Request $request, string $id): JsonResponse
    {
        try {
            $application = Application::where('id', $id)->first();

            if ($application === null) {
                return $this->respondNotFound('No application found');
            }

            $application->update($request->all());

            return $this->respondWithData(
                [
                    'application' => $application,
                ]
                , 'Successfully updated application');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteApplication(string $id): JsonResponse
    {
        try {
            $application = Application::where('id', $id)->first();

            if ($application === null) {
                return $this->respondNotFound('No application found');
            }

            $application->delete();

            return $this->respondWithData(
                [
                    'application' => $application,
                ]
                , 'Successfully deleted application');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
