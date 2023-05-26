<?php

namespace App\Http\Controllers;

use App\Models\CV;
use App\Models\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    public function createPost(Request $request): JsonResponse
    {
        try {
            $title = $request->title;
            $content = $request->post_content;

            $post = new Post();
            $post->cv_id = $request->cv_id;
            $post->title = $title;
            $post->content = $content;
            $post->user_id = $request->user()->id;

            $post->save();

            return $this->respondCreated(
                [
                    'post' => $post,
                ], 'Successfully created post');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getPostById(Request $request, string $id): JsonResponse
    {
        try {
            $post = Post::where('id', $id)->paginate(1);

            if ($post === null) {
                return $this->respondNotFound('No post found');
            }

            return $this->respondWithData(
                [
                    'post' => $post,
                ]
                , 'Successfully retrieved post');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getAllPosts(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $posts = Post::paginate($count_per_page);

            if ($posts === null) {
                return $this->respondNotFound('No posts found');
            }

            return $this->respondWithData(
                [
                    'posts' => $posts,
                ]
                , 'Successfully retrieved posts');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getPostsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $posts = Post::where('user_id', $user_id)->paginate($count_per_page);

            if ($posts === null) {
                return $this->respondNotFound('No posts found');
            }

            return $this->respondWithData(
                [
                    'posts' => $posts,
                ]
                , 'Successfully retrieved posts');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updatePost(Request $request, string $id): JsonResponse
    {
        try {
            $post = Post::where('id', $id)->first();

            if ($post === null) {
                return $this->respondNotFound('No post found');
            }

            $post->title = $request->title;
            $post->content = $request->post_content;
            $post->save();

            return $this->respondWithData(
                [
                    'post' => $post,
                ]
                , 'Successfully updated post');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updatePostVotes(Request $request, string $id): JsonResponse
    {
        try {
            $post = Post::where('id', $id)->first();

            if ($post === null) {
                return $this->respondNotFound('No post found');
            }

            $post->upvote = $request->upvote;
            $post->downvote = $request->downvote;
            $post->save();

            return $this->respondWithData(
                [
                    'post' => $post,
                ]
                , 'Successfully updated post votes');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deletePost(Request $request, string $id): JsonResponse
    {
        try {
            $post = Post::where('id', $id)->first();

            if ($post === null) {
                return $this->respondNotFound('No post found');
            }

            $post->delete();

            return $this->respondWithData(
                [
                    'post' => $post,
                ]
                , 'Successfully deleted post');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
