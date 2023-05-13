<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostCommentController extends ApiController
{
    public function createPostComment(Request $request): JsonResponse
    {
        try {
            $comment = new PostComment();
            $comment->post_id = $request->post_id;
            $comment->user_id = $request->user()->id;
            $comment->content = $request->comment_content;

            $comment->save();

            return $this->respondCreated(
                [
                    'comment' => $comment,
                ], 'Successfully created comment');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getAllPostComments(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $comments = PostComment::paginate($count_per_page);

            return $this->respondWithData(
                [
                    'comments' => $comments,
                ], 'Successfully retrieved comments');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getPostCommentById(string $id): JsonResponse
    {
        try {
            $comment = PostComment::where('id', $id)->paginate(1);

            if ($comment === null) {
                return $this->respondNotFound('Comment not found');
            }

            return $this->respondWithData(
                [
                    'comment' => $comment,
                ], 'Successfully retrieved comment');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getPostCommentsByPostId(Request $request, string $post_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $comments = PostComment::where('post_id', $post_id)->paginate($count_per_page);

            return $this->respondWithData(
                [
                    'comments' => $comments,
                ], 'Successfully retrieved comments');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getPostCommentsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $comments = PostComment::where('user_id', $user_id)->paginate($count_per_page);

            return $this->respondWithData(
                [
                    'comments' => $comments,
                ], 'Successfully retrieved comments');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deletePostComment(Request $request, string $id): JsonResponse
    {
        try {
            $comment = PostComment::where('id', $id)->first();

            if ($comment === null) {
                return $this->respondNotFound('Comment not found');
            }

            if ($comment->user_id !== $request->user()->id) {
                return $this->respondForbidden('You are not authorized to delete this comment');
            }

            $comment->delete();

            return $this->respondWithData(
                [
                    'comment' => $comment,
                ], 'Successfully deleted comment');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
