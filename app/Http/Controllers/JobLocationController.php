<?php

namespace App\Http\Controllers;

use App\Models\JobLocation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobLocationController extends ApiController
{
    /**
     *  @OA\Get(
     *      path="/api/job-locations/{id}",
     *      tags={"Job Locations"},
     *      summary="Get job location by id",
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Job Location ID",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved job location",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "job_location": {
    "current_page": 1,
    "data": {
    {
    "id": 3,
    "job_id": 3,
    "location": "Hà Nội: 84 Tô Ngọc Vân"
    }
    },
    "first_page_url": "http://localhost:8000/api/job-locations/3?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/job-locations/3?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations/3?page=1",
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
    "path": "http://localhost:8000/api/job-locations/3",
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
     *          description="Job location not found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getJobLocationById(string $id): JsonResponse
    {
        try {
            $job_location = JobLocation::where('id', $id)->paginate(1);

            if ($job_location === null) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'job_location' => $job_location,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/job-locations/job/{job_id}",
     *      tags={"Job Locations"},
     *      summary="Get job locations by job id",
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of job locations per page",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="job_id",
     *          in="path",
     *          description="Job ID",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved job locations",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "job_location": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "job_id": 1,
    "location": "Hồ Chí Minh: 72 Bình Giã"
    }
    },
    "first_page_url": "http://localhost:8000/api/job-locations/job/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/job-locations/job/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations/job/1?page=1",
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
    "path": "http://localhost:8000/api/job-locations/job/1",
    "per_page": 15,
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
     *          description="Job locations not found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getJobLocationsByJobId(Request $request, string $job_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $job_location = JobLocation::where('job_id', $job_id)->paginate($count_per_page);

            if ($job_location === null) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'job_location' => $job_location,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/job-locations",
     *      tags={"Job Locations"},
     *      summary="Get all job locations",
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of job locations per page",
     *          required=false
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved job locations",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Successfully retrieved job locations",
    "data": {
    "job_locations": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "job_id": 1,
    "location": "Hồ Chí Minh: 72 Bình Giã"
    }
    },
    "first_page_url": "http://localhost:8000/api/job-locations?page=1",
    "from": 1,
    "last_page": 56,
    "last_page_url": "http://localhost:8000/api/job-locations?page=56",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=2",
    "label": "2",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=3",
    "label": "3",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=4",
    "label": "4",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=5",
    "label": "5",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=6",
    "label": "6",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=7",
    "label": "7",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=8",
    "label": "8",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=9",
    "label": "9",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=10",
    "label": "10",
    "active": false
    },
    {
    "url": null,
    "label": "...",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=55",
    "label": "55",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=56",
    "label": "56",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/job-locations?page=2",
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": "http://localhost:8000/api/job-locations?page=2",
    "path": "http://localhost:8000/api/job-locations",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 56
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Job locations not found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
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

    /**
     *  @OA\Post(
     *      path="/api/job-locations",
     *      tags={"Job Locations"},
     *      summary="Create a job location",
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
     *          required=false
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example=
    {
    "job_id": 1,
    "location": "abc"
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successfully created job location",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Tạo thành công",
    "data": {
    "job_location": {
    "job_id": "1",
    "location": "abc",
    "id": 57
    }
    },
    "status_code": 201
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid job location data",
     *          ref="#/components/responses/BadRequest"
     *      ),
     *  )
     */
    public function createJobLocation(Request $request): JsonResponse
    {
        try {
            $job_location = new JobLocation();
            $job_location->job_id = $request->job_id;
            $job_location->location = $request->location;
            $job_location->save();

            return $this->respondCreated(
                [
                    'job_location' => $job_location,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Put(
     *      path="/api/job-locations/{id}",
     *      tags={"Job Locations"},
     *      summary="Update a job location",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Job location id",
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
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example=
    {
    "job_id": 1,
    "location": "abc"
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully updated job location",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "job_location": {
    "id": 57,
    "job_id": "1",
    "location": "abcdef"
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Job location not found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function updateJobLocation(Request $request, string $id): JsonResponse
    {
        try {
            $job_location = JobLocation::where('id', $id)->first();

            if (!$job_location){
                return $this->respondNotFound();
            }

            $job_location->job_id = $request->job_id = null ? $job_location->job_id : $request->job_id;
            $job_location->location = $request->location = null ? $job_location->location : $request->location;
            $job_location->save();

            return $this->respondWithData(
                [
                    'job_location' => $job_location,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Delete(
     *      path="/api/job-locations/{id}",
     *      tags={"Job Locations"},
     *      summary="Delete a job location",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Job location id",
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
     *          description="Successfully deleted job location",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "job_location": {
    "id": 57,
    "job_id": 1,
    "location": "abcdef"
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Job location not found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function deleteJobLocation(string $id): JsonResponse
    {
        try {
            $job_location = JobLocation::where('id', $id)->first();

            if (!$job_location){
                return $this->respondNotFound();
            }

            $job_location->delete();

            return $this->respondWithData(
                [
                    'job_location' => $job_location,
                ], 'Xoá thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
