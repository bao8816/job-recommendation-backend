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
        Route::get('/{user_id}', 'getUserProfileById');
        Route::get('/', 'getAllUserProfiles');

        Route::put('/', 'updateUserProfile');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserEducationController::class)
    ->prefix('user_educations')->group(function () {
        Route::get('/user/{user_id}', 'getUserEducationsByUserId');
        Route::get('/{user_education_id}', 'getUserEducationById');
        Route::get('/', 'getAllUserEducations');

        Route::post('/', 'createUserEducation');

        Route::put('/{user_education_id}', 'updateUserEducation');

        Route::delete('/{user_education_id}', 'deleteUserEducation');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserExperienceController::class)
    ->prefix('user_experiences')->group(function () {
        Route::get('/user/{user_id}', 'getUserExperiencesByUserId');
        Route::get('/{user_experience_id}', 'getUserExperienceById');
        Route::get('/', 'getAllUserExperiences');

        Route::post('/', 'createUserExperience');

        Route::put('/{user_experience_id}', 'updateUserExperience');

        Route::delete('/{user_experience_id}', 'deleteUserExperience');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserAchievementController::class)
    ->prefix('user_achievements')->group(function () {
        Route::get('/user/{user_id}', 'getUserAchievementsByUserId');
        Route::get('/{user_achievement_id}', 'getUserAchievementById');
        Route::get('/', 'getAllUserAchievements');

        Route::post('/', 'createUserAchievement');

        Route::put('/{user_achievement_id}', 'updateUserAchievement');

        Route::delete('/{user_achievement_id}', 'deleteUserAchievement');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserSkillController::class)
    ->prefix('user_skills')->group(function () {
        Route::get('/user/{user_id}', 'getUserSkillsByUserId');
        Route::get('/{user_skill_id}', 'getUserSkillById');
        Route::get('/', 'getAllUserSkills');

        Route::post('/', 'createUserSkill');

        Route::put('/{user_skill_id}', 'updateUserSkill');

        Route::delete('/{user_skill_id}', 'deleteUserSkill');
    });

//------------------------------------Post------------------------------------
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostController::class)
    ->prefix('posts')->group(function () {
        Route::get('/user/{user_id}', 'getAllPostsByUserId');
        Route::get('/{post_id}', 'getPostById');
        Route::get('/', 'getAllPosts');

        Route::post('/', 'createPost');

        Route::put('/{post_id}', 'updatePost');

        Route::delete('/{post_id}', 'deletePost');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostReportController::class)
    ->prefix('post_reports')->group(function () {
        Route::get('/user/{user_id}', 'getAllPostReportsByUserId');
        Route::get('/post/{post_id}', 'getAllPostReportsByPostId');
        Route::get('/{post_report_id}', 'getPostReportById');
        Route::get('/', 'getAllPostReports');

        Route::post('/', 'createPostReport');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostCommentController::class)
    ->prefix('post_comments')->group(function () {
        Route::get('/user/{user_id}', 'getAllPostCommentsByUserId');
        Route::get('/post/{post_id}', 'getAllPostCommentsByPostId');
        Route::get('/{post_comment_id}', 'getPostCommentById');
        Route::get('/', 'getAllPostComments');

        Route::post('/', 'createPostComment');

        Route::delete('/{post_comment_id}', 'deletePostComment');
    });


//------------------------------------Job------------------------------------
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(JobController::class)
    ->prefix('jobs')->group(function () {
        Route::get('/{job_id}', 'getJobById');
        Route::get('/', 'getAllJobs');

        Route::put('/{job_id}', 'updateJobVotes');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(JobLocationController::class)
    ->prefix('job_locations')->group(function () {
        Route::get('/job/{job_id}', 'getJobLocationsByJobId');
        Route::get('/{job_location_id}', 'getJobLocationById');
        Route::get('/', 'getAllJobLocations');
    });

Route::controller(AuthController::class)
    ->prefix('auth')->group(function () {
        Route::post('/sign-up', 'signUp');
        Route::post('/sign-in', 'signIn');
    });
