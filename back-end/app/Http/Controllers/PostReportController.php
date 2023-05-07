<?php

namespace App\Http\Controllers;

use App\Models\PostReport;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostReportController extends ApiController
{
    public function createPostReport(Request $request): JsonResponse
    {
        try {
            $post_id = $request->post_id;
            $user_id = $request->user()->id;
            $reason = $request->reason;

            $postReport = new PostReport();
            $postReport->post_id = $post_id;
            $postReport->user_id = $user_id;
            $postReport->reason = $reason;

            $postReport->save();

            return $this->respondCreated(
                [
                    'postReport' => $postReport,
                ], 'Successfully created post report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
    public function getAllPostReports(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $postReports = PostReport::paginate($count_per_page);

            if (count($postReports) === 0) {
                return $this->respondNotFound('No post reports found');
            }

            return $this->respondWithData(
                [
                    'postReports' => $postReports,
                ]
            , 'Successfully retrieved post reports');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getPostReportById(string $id): JsonResponse
    {
        try {
            $postReport = PostReport::where('id', $id)->paginate(1);

            if ($postReport === null) {
                return $this->respondNotFound('No post report found');
            }

            return $this->respondWithData(
                [
                    'postReport' => $postReport,
                ]
                , 'Successfully retrieved post report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getPostReportsByPostId(Request $request, string $post_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $postReport = PostReport::where('post_id', $post_id)->paginate($count_per_page);

            if ($postReport === null) {
                return $this->respondNotFound('No post report found');
            }

            return $this->respondWithData(
                [
                    'postReport' => $postReport,
                ]
                , 'Successfully retrieved post report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getPostReportsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $postReport = PostReport::where('user_id', $user_id)->paginate($count_per_page);

            if ($postReport === null) {
                return $this->respondNotFound('No post report found');
            }

            return $this->respondWithData(
                [
                    'postReport' => $postReport,
                ]
                , 'Successfully retrieved post report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deletePostReport(Request $request, string $id): JsonResponse
    {
        try {
            $postReport = PostReport::where('id', $id)->first();

            if ($postReport === null) {
                return $this->respondNotFound('No post report found');
            }

            if ($request->user()->id !== $postReport->user_id) {
                return $this->respondUnauthorized('You are not authorized to delete this post report');
            }

            $postReport->delete();

            return $this->respondWithData(
                [
                    'postReport' => $postReport,
                ]
                , 'Successfully deleted post report');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
