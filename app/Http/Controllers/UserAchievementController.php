<?php

namespace App\Http\Controllers;

use App\Models\UserAchievement;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAchievementController extends ApiController
{
    /**
     * @OA\Get(
     *      path="/api/user-achievements",
     *      summary="Get all user achievements",
     *      tags={"User Achievements"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of user achievements per page",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="Accept header",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved user achievements",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userAchievements": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "user_id": 1,
    "description": "Top 30 hành trình kiểm toán viên năm 2018 do CFAA- FTU bình chọn"
    }
    },
    "first_page_url": "http://localhost:8000/api/user-achievements?page=1",
    "from": 1,
    "last_page": 16,
    "last_page_url": "http://localhost:8000/api/user-achievements?page=16",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=2",
    "label": "2",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=3",
    "label": "3",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=4",
    "label": "4",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=5",
    "label": "5",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=6",
    "label": "6",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=7",
    "label": "7",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=8",
    "label": "8",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=9",
    "label": "9",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=10",
    "label": "10",
    "active": false
    },
    {
    "url": null,
    "label": "...",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=15",
    "label": "15",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=16",
    "label": "16",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements?page=2",
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": "http://localhost:8000/api/user-achievements?page=2",
    "path": "http://localhost:8000/api/user-achievements",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 16
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No user achievements found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getAllUserAchievements(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userAchievements = UserAchievement::paginate($count_per_page);

            if (count($userAchievements) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'userAchievements' => $userAchievements,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Get(
     *      path="/api/user-achievements/user/{user_id}",
     *      summary="Get user achievements by user id",
     *      tags={"User Achievements"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="user_id",
     *          in="path",
     *          description="User id",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of user achievements per page",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="Accept header",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved user achievements",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userAchievements": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "user_id": 1,
    "description": "Top 30 hành trình kiểm toán viên năm 2018 do CFAA- FTU bình chọn"
    }
    },
    "first_page_url": "http://localhost:8000/api/user-achievements/user/1?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://localhost:8000/api/user-achievements/user/1?page=3",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements/user/1?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": "http://localhost:8000/api/user-achievements/user/1?page=2",
    "label": "2",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements/user/1?page=3",
    "label": "3",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements/user/1?page=2",
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": "http://localhost:8000/api/user-achievements/user/1?page=2",
    "path": "http://localhost:8000/api/user-achievements/user/1",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 3
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No user achievements found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getUserAchievementsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userAchievements = UserAchievement::where('user_id', $user_id)->paginate($count_per_page);

            if (count($userAchievements) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'userAchievements' => $userAchievements,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Get(
     *      path="/api/user-achievements/{id}",
     *      summary="Get user achievement by id",
     *      tags={"User Achievements"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="Accept header",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved user achievement",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userAchievement": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "user_id": 1,
    "description": "Top 30 hành trình kiểm toán viên năm 2018 do CFAA- FTU bình chọn"
    }
    },
    "first_page_url": "http://localhost:8000/api/user-achievements/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/user-achievements/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-achievements/1?page=1",
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
    "path": "http://localhost:8000/api/user-achievements/1",
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
     *          description="No user achievements found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getUserAchievementById(Request $request, string $id): JsonResponse
    {
        try {
            $userAchievement = UserAchievement::where('id', $id)->paginate(1);

            if (!isset($userAchievement)) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'userAchievement' => $userAchievement,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Post(
     *      path="/api/user-achievements",
     *      summary="Create user achievement",
     *      tags={"User Achievements"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="Accept header",
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
    "description": "des"
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully created user achievement",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Tạo thành công",
    "data": {
    "userAchievement": {
    "user_id": 1,
    "description": "des",
    "id": 17
    }
    },
    "status_code": 201
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No user achievements found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function createUserAchievement(Request $request): JsonResponse
    {
        try {
            $userAchievement = new UserAchievement();
            $userAchievement->user_id = $request->user()->id;
            $userAchievement->description = $request->description;
            $userAchievement->save();

            return $this->respondCreated(
                [
                    'userAchievement' => $userAchievement,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Put(
     *      path="/api/user-achievements/{id}",
     *      summary="Update user achievement",
     *      tags={"User Achievements"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="Accept header",
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
    "description": "desdes"
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully updated user achievement",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userAchievement": {
    "id": 17,
    "user_id": 1,
    "description": "desdes"
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No user achievements found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function updateUserAchievement(Request $request, string $id): JsonResponse
    {
        try {
            $userAchievement = UserAchievement::where('id', $id)->first();

            if (!isset($userAchievement)) {
                return $this->respondNotFound();
            }

            if ($userAchievement->user_id !== $request->user()->id) {
                return $this->respondUnauthorized('Bạn không có quyền chỉnh sửa thông tin này');
            }

            $userAchievement->description = $request->description !== null ? $request->description : $userAchievement->description;
            $userAchievement->save();

            return $this->respondWithData(
                [
                    'userAchievement' => $userAchievement,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/user-achievements/{id}",
     *      summary="Delete user achievement",
     *      tags={"User Achievements"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="Accept header",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully deleted user achievement",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xóa thành công",
    "data": {
    "userAchievement": {
    "id": 17,
    "user_id": 1,
    "description": "desdes"
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No user achievements found",
     *          ref="#/components/responses/NotFound"
     *      )
     *  )
     */
    public function deleteUserAchievement(Request $request, string $id): JsonResponse
    {
        try {
            $userAchievement = UserAchievement::where('id', $id)->first();

            if (!isset($userAchievement)) {
                return $this->respondNotFound();
            }

            if (!$request->user()->tokenCan('mod') && $userAchievement->user_id !== $request->user()->id) {
                return $this->respondUnauthorized('Bạn không có quyền xóa thông tin này');
            }

            $userAchievement->delete();

            return $this->respondWithData(
                [
                    'userAchievement' => $userAchievement,
                ], 'Xóa thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
