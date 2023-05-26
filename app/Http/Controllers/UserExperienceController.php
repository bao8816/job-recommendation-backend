<?php

namespace App\Http\Controllers;

use App\Models\UserExperience;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserExperienceController extends ApiController
{
    /**
     *  @OA\Get(
     *      path="/api/user-experiences",
     *      summary="Get all user experiences",
     *      tags={"User Experiences"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of user experiences per page",
     *          required=false
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
     *          description="Get all user experiences successfully",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userExperiences": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "user_id": 3,
    "description": "Công việc chính:\n- Viết danh sách các câu hỏi và báo giá dự án\ncho khách hàng.\n- Thực hiện phân tích, mô tả và thiết kế sơ đồ\nhệ thống.\n- Tìm hiểu về phân tích và thiết kế hệ thống.\n- Hỗ trợ rà soát và cải tiến hệ thống.\nNhững điều đạt được:\n- Học kỹ năng giao tiếp và giải quyết vấn đề.\n- Nâng cao hiệu quả làm việc nhóm.\n- Biết sử dụng thêm các công cụ thiết kế giao\ndiện.\n- Học cách phân tích hệ thống.",
    "start": "2022-09-01",
    "end": "2022-12-01"
    }
    },
    "first_page_url": "http://localhost:8000/api/user-experiences?page=1",
    "from": 1,
    "last_page": 56,
    "last_page_url": "http://localhost:8000/api/user-experiences?page=56",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=2",
    "label": "2",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=3",
    "label": "3",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=4",
    "label": "4",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=5",
    "label": "5",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=6",
    "label": "6",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=7",
    "label": "7",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=8",
    "label": "8",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=9",
    "label": "9",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=10",
    "label": "10",
    "active": false
    },
    {
    "url": null,
    "label": "...",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=55",
    "label": "55",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=56",
    "label": "56",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences?page=2",
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": "http://localhost:8000/api/user-experiences?page=2",
    "path": "http://localhost:8000/api/user-experiences",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 56
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No user experience found",
     *          ref="#/components/responses/NotFound"
     *      )
     *  )
     */
    public function getAllUserExperiences(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userExperiences = UserExperience::paginate($count_per_page);

            if (count($userExperiences) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'userExperiences' => $userExperiences,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Get(
     *      path="/user-experiences/user/{user_id}",
     *      operationId="getUserExperiencesByUserId",
     *      tags={"User Experiences"},
     *      summary="Get user experiences by user id",
     *      @OA\Parameter(
     *          name="user_id",
     *          description="User id",
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Parameter(
     *          name="count_per_page",
     *          description="Count per page",
     *          required=false,
     *          in="query"
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
     *          description="User experiences retrieved successfully",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userExperiences": {
    "current_page": 1,
    "data": {
    {
    "id": 7,
    "user_id": 1,
    "description": "BUSINESS ANALYST, TESTER tại TECHPLUS SOLUTION\nTừ Tháng Hai – Tháng Chín 2020\nHệ thống ngân hàng lõi\no Xem xét, phân tích và tư vấn về các thông số kỹ thuật và yêu cầu\no Thực hiện kiểm tra thủ công cho các ứng dụng\no Ghi nhật ký lỗi và theo dõi để đóng cửa, làm việc với sự phát triển",
    "start": "2021-03-01",
    "end": "2021-03-01"
    }
    },
    "first_page_url": "http://localhost:8000/api/user-experiences/user/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/user-experiences/user/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences/user/1?page=1",
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
    "path": "http://localhost:8000/api/user-experiences/user/1",
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
     *          description="No user experience found",
     *          ref="#/components/responses/NotFound"
     *      )
     *  )
     */
    public function getUserExperiencesByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userExperiences = UserExperience::where('user_id', $user_id)->paginate($count_per_page);

            if (count($userExperiences) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'userExperiences' => $userExperiences,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Get(
     *      path="/user-experiences/{id}",
     *      tags={"User Experiences"},
     *      summary="Get user experience information",
     *      @OA\Parameter(
     *          name="id",
     *          description="User experience id",
     *          required=true,
     *          in="path"
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
     *          description="User experience retrieved successfully",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userExperience": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "user_id": 3,
    "description": "Công việc chính:\n- Viết danh sách các câu hỏi và báo giá dự án\ncho khách hàng.\n- Thực hiện phân tích, mô tả và thiết kế sơ đồ\nhệ thống.\n- Tìm hiểu về phân tích và thiết kế hệ thống.\n- Hỗ trợ rà soát và cải tiến hệ thống.\nNhững điều đạt được:\n- Học kỹ năng giao tiếp và giải quyết vấn đề.\n- Nâng cao hiệu quả làm việc nhóm.\n- Biết sử dụng thêm các công cụ thiết kế giao\ndiện.\n- Học cách phân tích hệ thống.",
    "start": "2022-09-01",
    "end": "2022-12-01"
    }
    },
    "first_page_url": "http://localhost:8000/api/user-experiences/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/user-experiences/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/user-experiences/1?page=1",
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
    "path": "http://localhost:8000/api/user-experiences/1",
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
     *          description="No user experience found",
     *          ref="#/components/responses/NotFound"
     *      )
     *  )
     */
    public function getUserExperienceById(Request $request, string $id): JsonResponse
    {
        try {
            $userExperience = UserExperience::where('id', $id)->paginate(1);

            if (!isset($userExperience)) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'userExperience' => $userExperience,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Post(
     *      path="/api/user-experiences",
     *      tags={"User Experiences"},
     *      summary="Create user experience",
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
    "description": "des",
    "start": "2021-05-21",
    "end": "2022-05-21",
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="User experience created successfully",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Tạo thành công",
    "data": {
    "userExperience": {
    "user_id": 2,
    "description": "des",
    "start": "2021-05-21",
    "end": "2022-05-21",
    "id": 57
    }
    },
    "status_code": 201
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *          ref="#/components/responses/InternalServerError"
     *      )
     *  )
     */
    public function createUserExperience(Request $request): JsonResponse
    {
        try {
            $userExperience = new UserExperience();
            $userExperience->user_id = $request->user()->id;
            $userExperience->description = $request->description;
            $userExperience->start = $request->start;
            $userExperience->end = $request->end;
            $userExperience->save();

            return $this->respondCreated(
                [
                    'userExperience' => $userExperience,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Put(
     *      path="/api/user-experiences/{id}",
     *      tags={"User Experiences"},
     *      summary="Update user experience",
     *      @OA\Parameter(
     *          name="id",
     *          description="User experience id",
     *          required=true,
     *          in="path",
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
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="User experience updated successfully",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "userExperience": {
    "id": 57,
    "user_id": 2,
    "description": "desdes",
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
     *          description="No user experience found",
     *          ref="#/components/responses/NotFound"
     *      )
     *  )
     */
    public function updateUserExperience(Request $request, string $id): JsonResponse
    {
        try {
            $userExperience = UserExperience::where('id', $id)->first();

            if (!isset($userExperience)) {
                return $this->respondNotFound();
            }

            if ($userExperience->user_id !== $request->user()->id) {
                return $this->respondUnauthorized('Bạn không có quyền chỉnh sửa thông tin này');
            }

            $userExperience->description = $request->description != null ? $request->description : $userExperience->description;
            $userExperience->start = $request->start != null ? $request->start : $userExperience->start;
            $userExperience->end = $request->end != null ? $request->end : $userExperience->end;
            $userExperience->save();

            return $this->respondWithData(
                [
                    'userExperience' => $userExperience,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/user-experiences/{id}",
     *      tags={"User Experiences"},
     *      summary="Delete user experience",
     *      @OA\Parameter(
     *          name="id",
     *          description="User experience id",
     *          required=true,
     *          in="path",
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
     *          description="User experience deleted successfully",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xóa thành công",
    "data": {
    "userExperience": {
    "id": 57,
    "user_id": 2,
    "description": "desdes",
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
     *          description="No user experience found",
     *          ref="#/components/responses/NotFound"
     *      )
     *  )
     */
    public function deleteUserExperience(Request $request, string $id): JsonResponse
    {
        try {
            $userExperience = UserExperience::where('id', $id)->first();

            if (!isset($userExperience)) {
                return $this->respondNotFound();
            }

            if (!$request->user()->tokenCan('mod') && $userExperience->user_id !== $request->user()->id) {
                return $this->respondUnauthorized('Bạn không có quyền xóa thông tin này');
            }

            $userExperience->delete();

            return $this->respondWithData(
                [
                    'userExperience' => $userExperience,
                ], 'Xóa thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
