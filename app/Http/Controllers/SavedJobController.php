<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSavedJobRequest;
use App\Models\SavedJob;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SavedJobController extends ApiController
{
    public function getSavedJobs(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page ?? 10;
            $order_by = $request->order_by ?? 'id';
            $order_type = $request->order ?? 'asc';

            $saved_jobs = SavedJob::filter($request, SavedJob::query())
                ->orderBy($order_by, $order_type)
                ->paginate($count_per_page);

            if (count($saved_jobs) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData([
                'saved_jobs' => $saved_jobs,
            ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getSavedJobById(string $id): JsonResponse
    {
        try {
            $saved_job = SavedJob::find($id);

            if (!$saved_job) {
                return $this->respondNotFound();
            }

            return $this->respondWithData([
                'saved_job' => $saved_job,
            ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createSavedJob(CreateSavedJobRequest $request): JsonResponse
    {
        try {
            $saved_job = SavedJob::create($request->validated());

            return $this->respondCreated([
                'saved_job' => $saved_job,
            ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateSavedJob(Request $request, string $id): JsonResponse
    {
        try {
            $saved_job = SavedJob::find($id);

            if (!$saved_job) {
                return $this->respondNotFound();
            }

            $saved_job->update($request->all());

            return $this->respondWithData([
                'saved_job' => $saved_job,
            ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteSavedJob(string $id): JsonResponse
    {
        try {
            $saved_job = SavedJob::find($id);

            if (!$saved_job) {
                return $this->respondNotFound();
            }

            $saved_job->delete();

            return $this->respondWithData(
                [
                'saved_job' => $saved_job,
                ], 'Xoá thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteSavedJobByUserAndJobId(Request $request): JsonResponse
    {
        try {
            $saved_job = SavedJob::where('user_id', $request->user_id)
                ->where('job_id', $request->job_id)
                ->first();

            if (!$saved_job) {
                return $this->respondNotFound();
            }

            $saved_job->delete();

            return $this->respondWithData(
                [
                'saved_job' => $saved_job,
                ], 'Xoá thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
