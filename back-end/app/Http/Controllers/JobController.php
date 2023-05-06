<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends ApiController
{
    public function getAllJobs(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobs = Job::paginate($count_per_page);

            if (count($jobs) === 0) {
                return $this->respondNotFound('No jobs found');
            }

            return $this->respondWithData(
                [
                    'jobs' => $jobs,
                ]
            , 'Successfully retrieved jobs');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getJobById(string $id): JsonResponse
    {
        try {
            $job = Job::where('id', $id)->paginate(1);

            if ($job === null) {
                return $this->respondNotFound('No job found');
            }

            return $this->respondWithData(
                [
                    'job' => $job,
                ]
                , 'Successfully retrieved job');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateJobVotes(Request $request, string $id): JsonResponse
    {
        try {
            $job = Job::where('id', $id)->first();

            if ($job === null) {
                return $this->respondNotFound('No job found');
            }

            $job->upvote = $request->upvote;
            $job->downvote = $request->downvote;
            $job->save();

            return $this->respondWithData(
                [
                    'job' => $job,
                ]
                , 'Successfully updated job votes');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
