<?php

namespace App\Http\Controllers;

use App\Models\JobSkill;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobSkillController extends ApiController
{
    /**
     *  @OA\Get(
     *      path="/api/job-skills",
     *      tags={"Job Skills"},
     *      summary="Get all job skills",
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of job skills per page",
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
     *          description="Successfully retrieved job skills",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobSkills": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "job_id": 1,
    "skill": "PowerPoint"
    }
    },
    "first_page_url": "http://localhost:8000/api/job-skills?page=1",
    "from": 1,
    "last_page": 136,
    "last_page_url": "http://localhost:8000/api/job-skills?page=136",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=2",
    "label": "2",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=3",
    "label": "3",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=4",
    "label": "4",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=5",
    "label": "5",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=6",
    "label": "6",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=7",
    "label": "7",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=8",
    "label": "8",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=9",
    "label": "9",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=10",
    "label": "10",
    "active": false
    },
    {
    "url": null,
    "label": "...",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=135",
    "label": "135",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=136",
    "label": "136",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills?page=2",
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": "http://localhost:8000/api/job-skills?page=2",
    "path": "http://localhost:8000/api/job-skills",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 136
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No job skills found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getAllJobSkills(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobSkills = JobSkill::paginate($count_per_page);

            if (count($jobSkills) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'jobSkills' => $jobSkills,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/job-skills/job/{job_id}",
     *      tags={"Job Skills"},
     *      summary="Get job skills by job id",
     *      @OA\Parameter(
     *          name="job_id",
     *          in="path",
     *          description="Id of job",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of job skills per page",
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
     *          description="Successfully retrieved job skills",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobSkills": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "job_id": 1,
    "skill": "PowerPoint"
    }
    },
    "first_page_url": "http://localhost:8000/api/job-skills/job/1?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://localhost:8000/api/job-skills/job/1?page=3",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills/job/1?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": "http://localhost:8000/api/job-skills/job/1?page=2",
    "label": "2",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills/job/1?page=3",
    "label": "3",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills/job/1?page=2",
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": "http://localhost:8000/api/job-skills/job/1?page=2",
    "path": "http://localhost:8000/api/job-skills/job/1",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 3
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No job skills found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getJobSkillsByJobId(Request $request, string $job_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobSkills = JobSkill::where('job_id', $job_id)->paginate($count_per_page);

            if (count($jobSkills) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'jobSkills' => $jobSkills,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/job-skills/{id}",
     *      tags={"Job Skills"},
     *      summary="Get job skill by id",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of job skill",
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
     *          description="Successfully retrieved job skill",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobSkill": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "job_id": 1,
    "skill": "PowerPoint"
    }
    },
    "first_page_url": "http://localhost:8000/api/job-skills/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/job-skills/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-skills/1?page=1",
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
    "path": "http://localhost:8000/api/job-skills/1",
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
     *          description="Job skill not found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getJobSkillById(Request $request, string $id): JsonResponse
    {
        try {
            $jobSkill = JobSkill::where('id', $id)->paginate(1);

            if (count($jobSkill) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'jobSkill' => $jobSkill,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Post(
     *      path="/api/job-skills",
     *      tags={"Job Skills"},
     *      summary="Create job skill",
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true,
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example=
    {
    "job_id": 1,
    "reason": "abcdef"
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successfully created job skill",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Tạo thành công",
    "data": {
    "jobSkill": {
    "job_id": "1",
    "skill": "abcdef",
    "id": 137
    }
    },
    "status_code": 201
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid job skill data",
     *          ref="#/components/responses/BadRequest"
     *      ),
     *  )
     */
    public function createJobSkill(Request $request): JsonResponse
    {
        try {
            $jobSkill = new JobSkill();
            $jobSkill->job_id = $request->job_id;
            $jobSkill->skill = $request->skill;
            $jobSkill->save();

            return $this->respondCreated(
                [
                    'jobSkill' => $jobSkill,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Put(
     *      path="/api/job-skills/{id}",
     *      tags={"Job Skills"},
     *      summary="Update job skill",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of job skill",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true,
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example=
    {
    "job_id": 1,
    "reason": "abc"
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successfully created job skill",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobSkill": {
    "id": 137,
    "job_id": "1",
    "skill": "abc"
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid job skill data",
     *          ref="#/components/responses/BadRequest"
     *      ),
     *  )
     */
    public function updateJobSkill(Request $request, string $id): JsonResponse
    {
        try {
            $jobSkill = JobSkill::where('id', $id)->first();

            if (!$jobSkill) {
                return $this->respondNotFound();
            }

            $jobSkill->job_id = $request->job_id != null ? $request->job_id : $jobSkill->job_id;
            $jobSkill->skill = $request->skill != null ? $request->skill : $jobSkill->skill;
            $jobSkill->save();

            return $this->respondWithData(
                [
                    'jobSkill' => $jobSkill,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Delete(
     *      path="/api/job-skills/{id}",
     *      tags={"Job Skills"},
     *      summary="Delete a job skill",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Job skill id",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully deleted job skill",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobSkill": {
    "id": 137,
    "job_id": 1,
    "skill": "abc"
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Job skill not found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function deleteJobSkill(string $id): JsonResponse
    {
        try {
            $jobSkill = JobSkill::where('id', $id)->first();

            if (!$jobSkill) {
                return $this->respondNotFound();
            }

            $jobSkill->delete();

            return $this->respondWithData(
                [
                    'jobSkill' => $jobSkill,
                ], 'Xóa thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
