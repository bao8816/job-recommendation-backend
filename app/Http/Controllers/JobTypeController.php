<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobTypeController extends ApiController
{
    /**
     *  @OA\Get(
     *      path="/api/job-types",
     *      summary="Get all job types",
     *      tags={"Job Types"},
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of job types per page",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved job types",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobTypes": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "job_id": 1,
    "type": "Nhân viên"
    }
    },
    "first_page_url": "http://localhost:8000/api/job-types?page=1",
    "from": 1,
    "last_page": 52,
    "last_page_url": "http://localhost:8000/api/job-types?page=52",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": "http://localhost:8000/api/job-types?page=2",
    "label": "2",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=3",
    "label": "3",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=4",
    "label": "4",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=5",
    "label": "5",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=6",
    "label": "6",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=7",
    "label": "7",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=8",
    "label": "8",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=9",
    "label": "9",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=10",
    "label": "10",
    "active": false
    },
    {
    "url": null,
    "label": "...",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=51",
    "label": "51",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=52",
    "label": "52",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types?page=2",
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": "http://localhost:8000/api/job-types?page=2",
    "path": "http://localhost:8000/api/job-types",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 52
    }
    },
    "status_code": 200
    }
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No job types found",
     *          ref="#/components/responses/NotFound",
     *      ),
     *  )
     */
    public function getAllJobTypes(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobTypes = JobType::paginate($count_per_page);

            if (count($jobTypes) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'jobTypes' => $jobTypes,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/job-types/{id}",
     *      summary="Get job type by id",
     *      tags={"Job Types"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of job type",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved job type",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobType": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "job_id": 1,
    "type": "Nhân viên"
    }
    },
    "first_page_url": "http://localhost:8000/api/job-types/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/job-types/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types/1?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": null,
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": null,
    "path": "http://localhost:8000/api/job-types/1",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 1
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Job type not found",
     *          ref="#/components/responses/NotFound",
     *      ),
     *  )
     */
    public function getJobTypeById(Request $request, string $id): JsonResponse
    {
        try {
            $jobType = JobType::where('id', $id)->paginate(1);

            if (count($jobType) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'jobType' => $jobType,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/job-types/job/{job_id}",
     *      summary="Get job types by job id",
     *      tags={"Job Types"},
     *      @OA\Parameter(
     *          name="job_id",
     *          in="path",
     *          description="Id of job",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved job types",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobTypes": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "job_id": 1,
    "type": "Nhân viên"
    }
    },
    "first_page_url": "http://localhost:8000/api/job-types/job/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/job-types/job/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-types/job/1?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": null,
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": null,
    "path": "http://localhost:8000/api/job-types/job/1",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 1
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No job types found",
     *          ref="#/components/responses/NotFound",
     *      ),
     *  )
     */
    public function getJobTypesByJobId(Request $request, string $job_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobTypes = JobType::where('job_id', $job_id)->paginate($count_per_page);

            if (count($jobTypes) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'jobTypes' => $jobTypes,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Post(
     *      path="/api/job-types",
     *      summary="Create job type",
     *      tags={"Job Types"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example=
    {
    "job_id": 1,
    "type": "abc"
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successfully created job type",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Tạo thành công",
    "data": {
    "jobType": {
    "job_id": "1",
    "type": "abc",
    "id": 53
    }
    },
    "status_code": 201
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid job type data",
     *          ref="#/components/responses/BadRequest",
     *      ),
     *  )
     */
    public function createJobType(Request $request): JsonResponse
    {
        try {
            $jobType = new JobType();
            $jobType->job_id = $request->job_id;
            $jobType->type = $request->type;
            $jobType->save();

            return $this->respondCreated(
                [
                    'jobType' => $jobType,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Put(
     *      path="/api/job-types/{id}",
     *      summary="Update job type",
     *      tags={"Job Types"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of job type",
     *          required=true,
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example=
    {
    "type": "abcdef"
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully updated job type",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobType": {
    "id": 53,
    "job_id": 1,
    "type": "abcdef"
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid job type data",
     *          ref="#/components/responses/BadRequest",
     *      ),
     *  )
     */
    public function updateJobType(Request $request, string $id): JsonResponse
    {
        try {
            $jobType = JobType::find($id);

            if (!$jobType) {
                return $this->respondNotFound();
            }

            $jobType->job_id = $request->job_id != null ? $request->job_id : $jobType->job_id;
            $jobType->type = $request->type != null ? $request->type : $jobType->type;
            $jobType->save();

            return $this->respondWithData(
                [
                    'jobType' => $jobType,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Delete(
     *      path="/api/job-types/{id}",
     *      summary="Delete job type",
     *      tags={"Job Types"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of job type",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully deleted job type",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xoá thành công",
    "data": {
    "jobType": {
    "id": 53,
    "job_id": 1,
    "type": "abcdef"
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Job type not found",
     *          ref="#/components/responses/NotFound",
     *      ),
     *  )
     */
    public function deleteJobType(string $id): JsonResponse
    {
        try {
            $jobType = JobType::find($id);

            if (!$jobType) {
                return $this->respondNotFound();
            }

            $jobType->delete();

            return $this->respondWithData(
                [
                    'jobType' => $jobType,
                ], 'Xóa thành công');
        } catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
