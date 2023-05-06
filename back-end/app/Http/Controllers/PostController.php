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
            $cv_path = $request->cv_path;
            $title = $request->title;
            $content = $request->post_content;

            $post = new Post();
            $post->cv_id = CV::where('cv_path', $cv_path)->first()->id;
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

    public function getAllPostsByUserId(Request $request, string $user_id): JsonResponse
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

            if ($request->user()->id !== $post->user_id) {
                return $this->respondUnauthorized('You are not authorized to update this post');
            }

            $post->title = $request->title;
            $post->content = $request->post_content;
            $post->upvote = $request->upvote;
            $post->downvote = $request->downvote;
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

    public function deletePost(Request $request, string $id): JsonResponse
    {
        try {
            $post = Post::where('id', $id)->first();

            if ($post === null) {
                return $this->respondNotFound('No post found');
            }

            if ($request->user()->id !== $post->user_id) {
                return $this->respondUnauthorized('You are not authorized to delete this post');
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
