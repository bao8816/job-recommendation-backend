<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobLocationController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostReportController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserAchievementController;
use App\Http\Controllers\UserEducationController;
use App\Http\Controllers\UserExperienceController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserSkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//------------------------------------User------------------------------------
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserAccountController::class)
    ->prefix('user_accounts')->group(function () {
        Route::put('/password', 'updatePassword');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserProfileController::class)
    ->prefix('user_profiles')->group(function () {
        Route::get('/profile', 'getUserProfile');
        Route::get('/', 'getAllUserProfiles');

        Route::put('/', 'updateUserProfile');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserEducationController::class)
    ->prefix('user_educations')->group(function () {
        Route::get('/user/{user_id}', 'getUserEducationsByUserId');
        Route::get('/{id}', 'getUserEducationById');
        Route::get('/', 'getAllUserEducations');

        Route::post('/', 'createUserEducation');

        Route::put('/{id}', 'updateUserEducation');

        Route::delete('/{id}', 'deleteUserEducation');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserExperienceController::class)
    ->prefix('user_experiences')->group(function () {
        Route::get('/user/{user_id}', 'getUserExperiencesByUserId');
        Route::get('/{id}', 'getUserExperienceById');
        Route::get('/', 'getAllUserExperiences');

        Route::post('/', 'createUserExperience');

        Route::put('/{id}', 'updateUserExperience');

        Route::delete('/{id}', 'deleteUserExperience');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserAchievementController::class)
    ->prefix('user_achievements')->group(function () {
        Route::get('/user/{user_id}', 'getUserAchievementsByUserId');
        Route::get('/{id}', 'getUserAchievementById');
        Route::get('/', 'getAllUserAchievements');

        Route::post('/', 'createUserAchievement');

        Route::put('/{id}', 'updateUserAchievement');

        Route::delete('/{id}', 'deleteUserAchievement');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserSkillController::class)
    ->prefix('user_skills')->group(function () {
        Route::get('/user/{user_id}', 'getUserSkillsByUserId');
        Route::get('/{id}', 'getUserSkillById');
        Route::get('/', 'getAllUserSkills');

        Route::post('/', 'createUserSkill');

        Route::put('/{id}', 'updateUserSkill');

        Route::delete('/{id}', 'deleteUserSkill');
    });

//------------------------------------Post------------------------------------
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostController::class)
    ->prefix('posts')->group(function () {
        Route::get('/user/{user_id}', 'getAllPostsByUserId');
        Route::get('/{id}', 'getPostById');
        Route::get('/', 'getAllPosts');

        Route::post('/', 'createPost');

        Route::put('/{id}', 'updatePost');

        Route::delete('/{id}', 'deletePost');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostReportController::class)
    ->prefix('post_reports')->group(function () {
        Route::get('/user/{user_id}', 'getAllPostReportsByUserId');
        Route::get('/post/{post_id}', 'getAllPostReportsByPostId');
        Route::get('/{id}', 'getPostReportById');
        Route::get('/', 'getAllPostReports');

        Route::post('/', 'createPostReport');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostCommentController::class)
    ->prefix('post_comments')->group(function () {
        Route::get('/user/{user_id}', 'getAllPostCommentsByUserId');
        Route::get('/post/{post_id}', 'getAllPostCommentsByPostId');
        Route::get('/{id}', 'getPostCommentById');
        Route::get('/', 'getAllPostComments');

        Route::post('/', 'createPostComment');

        Route::delete('/{id}', 'deletePostComment');
    });


//------------------------------------Job------------------------------------
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(JobController::class)
    ->prefix('jobs')->group(function () {
        Route::get('/{id}', 'getJobById');
        Route::get('/', 'getAllJobs');

        Route::put('/{id}', 'updateJobVotes');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(JobLocationController::class)
    ->prefix('job_locations')->group(function () {
        Route::get('/job/{job_id}', 'getJobLocationsByJobId');
        Route::get('/{id}', 'getJobLocationById');
        Route::get('/', 'getAllJobLocations');
    });

Route::controller(AuthController::class)
    ->prefix('auth')->group(function () {
        Route::post('/sign-up', 'signUp');
        Route::post('/sign-in', 'signIn');
    });
