<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationController extends ApiController
{
    /**
     *  @OA\Get(
     *      path="/api/applications",
     *      summary="Get all applications",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of applications per page",
     *          required=false
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
     *          description="Bearer {token} of all roles",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved applications",
     *          @OA\JsonContent(
     *              example = {
                        "error": false,
                        "message": "Xử lí thành công",
                        "data": {
                            "applications": {
                                "current_page": 1,
                                "data": {
                                    {
                                        "id": 1,
                                        "job_id": 1,
                                        "user_id": 2,
                                        "cv_id": 2,
                                        "status": "Đang chờ",
                                        "deleted_at": null
                                    },
                                    {
                                        "id": 2,
                                        "job_id": 1,
                                        "user_id": 4,
                                        "cv_id": 4,
                                        "status": "Đang chờ",
                                        "deleted_at": null
                                    },
                                    {
                                        "id": 3,
                                        "job_id": 1,
                                        "user_id": 5,
                                        "cv_id": 5,
                                        "status": "Đang chờ",
                                        "deleted_at": null
                                    },
                                    {
                                        "id": 4,
                                        "job_id": 2,
                                        "user_id": 3,
                                        "cv_id": 3,
                                        "status": "Đang chờ",
                                        "deleted_at": null
                                    },
                                    {
                                        "id": 5,
                                        "job_id": 10,
                                        "user_id": 2,
                                        "cv_id": 2,
                                        "status": "Đang chờ",
                                        "deleted_at": null
                                    },
                                    {
                                        "id": 6,
                                        "job_id": 10,
                                        "user_id": 5,
                                        "cv_id": 5,
                                        "status": "Đang chờ",
                                        "deleted_at": null
                                    }
                                },
                                "first_page_url": "http://localhost:8000/api/applications?page=1",
                                "from": 1,
                                "last_page": 1,
                                "last_page_url": "http://localhost:8000/api/applications?page=1",
                                "links": {
                                    {
                                        "url": null,
                                        "label": "&laquo; Previous",
                                        "active": false
                                    },
                                    {
                                        "url": "http://localhost:8000/api/applications?page=1",
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
                                "path": "http://localhost:8000/api/applications",
                                "per_page": 15,
                                "prev_page_url": null,
                                "to": 6,
                                "total": 6
                            }
                        },
                        "status_code": 200
                    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No applications found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  ),
     */
    public function getAllApplications(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $applications = Application::paginate($count_per_page);

            if (count($applications) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'applications' => $applications,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/applications/user/{user_id}",
     *      summary="Get all applications by user id",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="user_id",
     *          in="path",
     *          description="User id",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of applications per page",
     *          required=false
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
     *          description="Bearer {token} of all roles",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved applications",
     *          @OA\JsonContent(
     *              example = {
                        "error": false,
                        "message": "Xử lí thành công",
                        "data": {
                            "applications": {
                                "current_page": 1,
                                "data": {
                                    {
                                    "id": 1,
                                    "job_id": 1,
                                    "user_id": 2,
                                    "cv_id": 2,
                                    "status": "Đang chờ",
                                    "deleted_at": null
                                    },
                                    {
                                    "id": 5,
                                    "job_id": 10,
                                    "user_id": 2,
                                    "cv_id": 2,
                                    "status": "Đang chờ",
                                    "deleted_at": null
                                    }
                                },
                                "first_page_url": "http://localhost:8000/api/applications/user/2?page=1",
                                "from": 1,
                                "last_page": 1,
                                "last_page_url": "http://localhost:8000/api/applications/user/2?page=1",
                                "links": {
                                    {
                                    "url": null,
                                    "label": "&laquo; Previous",
                                    "active": false
                                    },
                                    {
                                    "url": "http://localhost:8000/api/applications/user/2?page=1",
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
                                "path": "http://localhost:8000/api/applications/user/2",
                                "per_page": 15,
                                "prev_page_url": null,
                                "to": 2,
                                "total": 2
                            }
                        },
                        "status_code": 200
                    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No applications found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getApplicationsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $applications = Application::where('user_id', $user_id)->paginate($count_per_page);

            if (count($applications) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'applications' => $applications,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/applications/job/{job_id}",
     *      summary="Get all applications by job id",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="job_id",
     *          in="path",
     *          description="Job id",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of applications per page",
     *          required=false
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
     *          description="Bearer {token} of all roles",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved applications",
     *          @OA\JsonContent(
     *              example = {
                        "error": false,
                        "message": "Xử lí thành công",
                        "data": {
                            "applications": {
                            "current_page": 1,
                            "data": {
                                {
                                "id": 1,
                                "job_id": 1,
                                "user_id": 2,
                                "cv_id": 2,
                                "status": "Đang chờ",
                                "deleted_at": null
                                },
                                {
                                "id": 5,
                                "job_id": 10,
                                "user_id": 2,
                                "cv_id": 2,
                                "status": "Đang chờ",
                                "deleted_at": null
                                }
                            },
                            "first_page_url": "http://localhost:8000/api/applications/job/2?page=1",
                            "from": 1,
                            "last_page": 1,
                            "last_page_url": "http://localhost:8000/api/applications/job/2?page=1",
                            "links": {
                                {
                                "url": null,
                                "label": "&laquo; Previous",
                                "active": false
                                },
                                {
                                "url": "http://localhost:8000/api/applications/job/2?page=1",
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
                            "path": "http://localhost:8000/api/applications/job/2",
                            "per_page": 15,
                            "prev_page_url": null,
                            "to": 2,
                            "total": 2
                            }
                        },
                        "status_code": 200
                    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No applications found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getApplicationsByJobId(Request $request, string $job_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $applications = Application::where('job_id', $job_id)->paginate($count_per_page);

            if (count($applications) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'applications' => $applications,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/applications/{id}",
     *      summary="Get application by id",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Application id",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of applications per page",
     *          required=false
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
     *          description="Bearer {token} of all roles",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved application",
     *          @OA\JsonContent(
     *              example = {
                        "error": false,
                        "message": "Xử lí thành công",
                        "data": {
                            "application": {
                            "current_page": 1,
                            "data": {
                                {
                                "id": 1,
                                "job_id": 1,
                                "user_id": 2,
                                "cv_id": 2,
                                "status": "Đang chờ",
                                "deleted_at": null
                                }
                            },
                            "first_page_url": "http://localhost:8000/api/applications/1?page=1",
                            "from": 1,
                            "last_page": 1,
                            "last_page_url": "http://localhost:8000/api/applications/1?page=1",
                            "links": {
                                {
                                "url": null,
                                "label": "&laquo; Previous",
                                "active": false
                                },
                                {
                                "url": "http://localhost:8000/api/applications/1?page=1",
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
                            "path": "http://localhost:8000/api/applications/1",
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
     *          description="No applications found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getApplicationById(string $id): JsonResponse
    {
        try {
            $application = Application::where('id', $id)->paginate(1);

            if ($application === null) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'application' => $application,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Post(
     *      path="/api/applications",
     *      summary="Create new application",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token} of user role",
     *          required=true
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Application data",
     *          @OA\JsonContent(
     *              example = {
                        "job_id": 1,
                        "user_id": 2,
                        "cv_id": 2,
                        "status": "đang chờ"
                    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successfully created application",
     *          @OA\JsonContent(
     *              example = {
                        "error": false,
                        "message": "Xử lí thành công",
                        "data": {
                            "application": {
                            "id": 1,
                            "job_id": 1,
                            "user_id": 2,
                            "cv_id": 2,
                            "status": "Đang chờ",
                            "deleted_at": null
                            }
                        },
                        "status_code": 201
                    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No applications found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function createApplication(Request $request): JsonResponse
    {
        try {
            $application = new Application();
            $application->job_id = $request->job_id;
            $application->user_id = $request->user()->id;
            $application->cv_id = $request->cv_id;
            $application->save();

            return $this->respondWithData(
                [
                    'application' => $application,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Put(
     *      path="/api/applications/approve/{id}",
     *      summary="Approve application",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Application id",
     *          required=true
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
     *          description="Bearer {token} of company role",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully updated application",
     *          @OA\JsonContent(
     *              example = {
                        "error": false,
                        "message": "Xử lí thành công",
                        "data": {
                            "application": {
                            "id": 1,
                            "job_id": 1,
                            "user_id": 2,
                            "cv_id": 2,
                            "status": "Đã duyệt",
                            "deleted_at": null
                            }
                        },
                        "status_code": 200
                    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No applications found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function approveApplication(Request $request, string $id): JsonResponse
    {
        try {
            $application = Application::where('id', $id)->first();

            if ($application === null) {
                return $this->respondNotFound();
            }

            $application->status = "Đã duyệt";

            return $this->respondWithData(
                [
                    'application' => $application,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Put(
     *      path="/api/applications/reject/{id}",
     *      summary="Reject application",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Application id",
     *          required=true
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
     *          description="Bearer {token} of company role",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully updated application",
     *          @OA\JsonContent(
     *              example = {
                        "error": false,
                        "message": "Xử lí thành công",
                        "data": {
                            "application": {
                                "id": 1,
                                "job_id": 1,
                                "user_id": 2,
                                "cv_id": 2,
                                "status": "Đã từ chối",
                                "deleted_at": null
                            }
                        },
                        "status_code": 200
                    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No applications found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function rejectApplication(Request $request, string $id): JsonResponse
    {
        try {
            $application = Application::where('id', $id)->first();

            if ($application === null) {
                return $this->respondNotFound();
            }

            $application->status = "Đã từ chối";

            return $this->respondWithData(
                [
                    'application' => $application,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Delete(
     *      path="/api/applications/{id}",
     *      summary="Delete application",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Application id",
     *          required=true
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
     *          description="Successfully deleted application",
     *          @OA\JsonContent(
     *              example = {
                        "error": false,
                        "message": "Xử lí thành công",
                        "data": {
                            "application": {
                            "id": 1,
                            "job_id": 1,
                            "user_id": 2,
                            "cv_id": 2,
                            "status": "Đang chờ",
                            "deleted_at": "2023-05-19T13:01:57.000000Z"
                            }
                        },
                        "status_code": 200
                    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No applications found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function deleteApplication(string $id): JsonResponse
    {
        try {
            $application = Application::where('id', $id)->first();

            if ($application === null) {
                return $this->respondNotFound();
            }

            $application->delete();

            return $this->respondWithData(
                [
                    'application' => $application,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
