<?php

namespace App\Http\Controllers;

use App\Models\UserEducation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserEducationController extends ApiController
{
    /**
     *  @OA\Get(
     *      path="/api/user-educations",
     *      summary="Get all user educations",
     *      tags={"User Education"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of user educations per page",
     *          required=false
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="User educations",
     *          @OA\JsonContent(
     *               example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userEducations": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "user_id": 1,
    "university": "Đại học Ngoại thương",
    "start": "2016-01-01",
    "end": "2020-01-01"
    }
    },
    "first_page_url": "http://localhost:8000/api/user-educations?page=1",
    "from": 1,
    "last_page": 54,
    "last_page_url": "http://localhost:8000/api/user-educations?page=54",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=2",
    "label": "2",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=3",
    "label": "3",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=4",
    "label": "4",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=5",
    "label": "5",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=6",
    "label": "6",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=7",
    "label": "7",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=8",
    "label": "8",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=9",
    "label": "9",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=10",
    "label": "10",
    "active": false
    },
    {
    "url": null,
    "label": "...",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=53",
    "label": "53",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=54",
    "label": "54",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations?page=2",
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": "http://localhost:8000/api/user-educations?page=2",
    "path": "http://localhost:8000/api/user-educations",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 54
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="User educations not found",
     *          ref="#/components/responses/404"
     *      )
     *  )
     */
    public function getAllUserEducations(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userEducations = UserEducation::paginate($count_per_page);

            if (count($userEducations) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'userEducations' => $userEducations,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/user-educations/users/{user_id}",
     *      summary="Get user educations by user id",
     *      tags={"User Education"},
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
     *          description="Number of user educations per page",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="Accept",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="User educations",
     *          @OA\JsonContent(
     *               example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userEducations": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "user_id": 1,
    "university": "Đại học Ngoại thương",
    "start": "2016-01-01",
    "end": "2020-01-01"
    }
    },
    "first_page_url": "http://localhost:8000/api/user-educations/user/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/user-educations/user/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations/user/1?page=1",
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
    "path": "http://localhost:8000/api/user-educations/user/1",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 1
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="User educations not found",
     *          ref="#/components/responses/404"
     *      )
     *  )
     */
    public function getUserEducationsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userEducations = UserEducation::where('user_id', $user_id)->paginate($count_per_page);

            if (count($userEducations) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'userEducations' => $userEducations,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/user-educations/{id}",
     *      summary="Get user education by id",
     *      tags={"User Education"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="User education id",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="Accept",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="User education",
     *          @OA\JsonContent(
     *               example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userEducation": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "user_id": 1,
    "university": "Đại học Ngoại thương",
    "start": "2016-01-01",
    "end": "2020-01-01"
    }
    },
    "first_page_url": "http://localhost:8000/api/user-educations/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/user-educations/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-educations/1?page=1",
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
    "path": "http://localhost:8000/api/user-educations/1",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 1
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="User education not found",
     *          ref="#/components/responses/404"
     *      )
     *  )
     */
    public function getUserEducationById(Request $request, string $id): JsonResponse
    {
        try {
            $userEducation = UserEducation::where('id', $id)->paginate(1);

            if (!isset($userEducation)) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'userEducation' => $userEducation,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Post(
     *      path="/api/user-educations",
     *      tags={"User Education"},
     *      summary="Create user education",
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
     *          description="Bearer {token}",
     *          required=true
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example=
    {
    "university": "uni",
    "start": "2021-05-20",
    "end": "2022-05-20"
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="User education created",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Tạo thành công",
    "data": {
    "userEducation": {
    "user_id": 1,
    "university": "uni",
    "start": "2021-05-20",
    "end": "2022-05-20",
    "id": 55
    }
    },
    "status_code": 201
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          ref="#/components/responses/BadRequest"
     *      )
     *  )
     */
    public function createUserEducation(Request $request): JsonResponse
    {
        try {
            $userEducation = new UserEducation();
            $userEducation->user_id = $request->user()->id;
            $userEducation->university = $request->university;
            $userEducation->start = $request->start;
            $userEducation->end = $request->end;
            $userEducation->save();

            return $this->respondCreated(
                [
                    'userEducation' => $userEducation,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Put(
     *      path="/api/user-educations/{id}",
     *      tags={"User Education"},
     *      summary="Update user education",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="User education id",
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
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example=
    {
    "start": "2021-05-21",
    "end": "2022-05-21"
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="User education updated",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userEducation": {
    "id": 55,
    "user_id": 1,
    "university": "uni",
    "start": "2021-05-21",
    "end": "2022-05-21"
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          ref="#/components/responses/BadRequest"
     *      )
     *  )
     */
    public function updateUserEducation(Request $request, string $id): JsonResponse
    {
        try {
            $userEducation = UserEducation::where('id', $id)->first();

            if (!isset($userEducation)) {
                return $this->respondNotFound();
            }

            if ($userEducation->user_id !== $request->user()->id) {
                return $this->respondUnauthorized('Bạn không có quyền chỉnh sửa thông tin này');
            }

            $userEducation->university = $request->university != null ? $request->university : $userEducation->university;
            $userEducation->start = $request->start != null ? $request->start : $userEducation->start;
            $userEducation->end = $request->end != null ? $request->end : $userEducation->end;
            $userEducation->save();

            return $this->respondWithData(
                [
                    'userEducation' => $userEducation,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Delete(
     *      path="/api/user-educations/{id}",
     *      tags={"User Education"},
     *      summary="Delete user education",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="User education id",
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
     *          description="User education deleted",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xoá thành công",
    "data": {
    "userEducation": {
    "id": 55,
    "user_id": 1,
    "university": "uni",
    "start": "2021-05-21",
    "end": "2022-05-21"
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="User education not found",
     *          ref="#/components/responses/NotFound"
     *      )
     *  )
     */
    public function deleteUserEducation(Request $request, string $id): JsonResponse
    {
        try {
            $userEducation = UserEducation::where('id', $id)->first();

            if (!isset($userEducation)) {
                return $this->respondNotFound();
            }

            if (!$request->user()->tokenCan('mod') && $userEducation->user_id !== $request->user()->id) {
                return $this->respondUnauthorized('Bạn không có quyền xóa thông tin này');
            }

            $userEducation->delete();

            return $this->respondWithData(
                [
                    'userEducation' => $userEducation,
                ], 'Xoá thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
