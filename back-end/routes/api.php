<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CompanyReportController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\EmployerProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobLocationController;
use App\Http\Controllers\JobReportController;
use App\Http\Controllers\JobSkillController;
use App\Http\Controllers\JobTypeController;
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

//------------------------------------USER------------------------------------
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserAccountController::class)
    ->prefix('user-accounts')->group(function () {
        Route::put('/password', 'updatePassword');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserProfileController::class)
    ->prefix('user-profiles')->group(function () {
        Route::get('/profile', 'getUserProfile');
        Route::get('/', 'getAllUserProfiles');

        Route::put('/', 'updateUserProfile');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserEducationController::class)
    ->prefix('user-educations')->group(function () {
        Route::get('/user/{user_id}', 'getUserEducationsByUserId');
        Route::get('/{id}', 'getUserEducationById');
        Route::get('/', 'getAllUserEducations');

        Route::post('/', 'createUserEducation');

        Route::put('/{id}', 'updateUserEducation');

        Route::delete('/{id}', 'deleteUserEducation');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserExperienceController::class)
    ->prefix('user-experiences')->group(function () {
        Route::get('/user/{user_id}', 'getUserExperiencesByUserId');
        Route::get('/{id}', 'getUserExperienceById');
        Route::get('/', 'getAllUserExperiences');

        Route::post('/', 'createUserExperience');

        Route::put('/{id}', 'updateUserExperience');

        Route::delete('/{id}', 'deleteUserExperience');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserAchievementController::class)
    ->prefix('user-achievements')->group(function () {
        Route::get('/user/{user_id}', 'getUserAchievementsByUserId');
        Route::get('/{id}', 'getUserAchievementById');
        Route::get('/', 'getAllUserAchievements');

        Route::post('/', 'createUserAchievement');

        Route::put('/{id}', 'updateUserAchievement');

        Route::delete('/{id}', 'deleteUserAchievement');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserSkillController::class)
    ->prefix('user-skills')->group(function () {
        Route::get('/user/{user_id}', 'getUserSkillsByUserId');
        Route::get('/{id}', 'getUserSkillById');
        Route::get('/', 'getAllUserSkills');

        Route::post('/', 'createUserSkill');

        Route::put('/{id}', 'updateUserSkill');

        Route::delete('/{id}', 'deleteUserSkill');
    });

//------------------------------------POST------------------------------------
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostController::class)
    ->prefix('posts')->group(function () {
        Route::get('/user/{user_id}', 'getPostsByUserId');
        Route::get('/{id}', 'getPostById');
        Route::get('/', 'getAllPosts');

        Route::post('/', 'createPost');

        Route::put('/{id}', 'updatePost');

        Route::delete('/{id}', 'deletePost');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostReportController::class)
    ->prefix('post-reports')->group(function () {
        Route::get('/user/{user_id}', 'getPostReportsByUserId');
        Route::get('/post/{post_id}', 'getPostReportsByPostId');
        Route::get('/{id}', 'getPostReportById');
        Route::get('/', 'getAllPostReports');

        Route::post('/', 'createPostReport');

        Route::delete('/{id}', 'deletePostReport');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostCommentController::class)
    ->prefix('post-comments')->group(function () {
        Route::get('/user/{user_id}', 'getPostCommentsByUserId');
        Route::get('/post/{post_id}', 'getPostCommentsByPostId');
        Route::get('/{id}', 'getPostCommentById');
        Route::get('/', 'getAllPostComments');

        Route::post('/', 'createPostComment');

        Route::delete('/{id}', 'deletePostComment');
    });


//------------------------------------JOB------------------------------------
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(JobController::class)
    ->prefix('jobs')->group(function () {
        Route::get('/{id}', 'getJobById');
        Route::get('/', 'getAllJobs');

        Route::put('/{id}', 'updateJobVotes');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(JobLocationController::class)
    ->prefix('job-locations')->group(function () {
        Route::get('/job/{job_id}', 'getJobLocationsByJobId');
        Route::get('/{id}', 'getJobLocationById');
        Route::get('/', 'getAllJobLocations');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(JobSkillController::class)
    ->prefix('job-skills')->group(function () {
        Route::get('/job/{job_id}', 'getJobSkillsByJobId');
        Route::get('/{id}', 'getJobSkillById');
        Route::get('/', 'getAllJobSkills');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(JobTypeController::class)
    ->prefix('job-types')->group(function () {
        Route::get('/job/{job_id}', 'getJobTypesByJobId');
        Route::get('/{id}', 'getJobTypeById');
        Route::get('/', 'getAllJobTypes');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(JobReportController::class)
    ->prefix('job-reports')->group(function () {
        Route::get('/user/{user_id}', 'getJobReportsByUserId');
        Route::get('/job/{job_id}', 'getJobReportsByJobId');
        Route::get('/{id}', 'getJobReportById');
        Route::get('/', 'getAllJobReports');

        Route::post('/', 'createJobReport');

        Route::delete('/{id}', 'deleteJobReport');
    });


//------------------------------------COMPANY------------------------------------
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(CompanyProfileController::class)
    ->prefix('company-profiles')->group(function () {
        Route::get('/{id}', 'getCompanyProfileById');
        Route::get('/', 'getAllCompanyProfiles');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(CompanyReportController::class)
    ->prefix('company-reports')->group(function () {
        Route::get('/user/{user_id}', 'getCompanyReportsByUserId');
        Route::get('/company/{company_id}', 'getCompanyReportsByCompanyId');
        Route::get('/{id}', 'getCompanyReportById');
        Route::get('/', 'getAllCompanyReports');

        Route::post('/', 'createCompanyReport');

        Route::delete('/{id}', 'deleteCompanyReport');
    });

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(CVController::class)
    ->prefix('cvs')->group(function () {
        Route::get('/user/{user_id}', 'getCVsByUserId');
        Route::get('/{id}', 'getCVById');
        Route::get('/', 'getAllCVs');

        Route::post('/', 'createCV');

        Route::put('/{id}', 'updateCV');

        Route::delete('/{id}', 'deleteCV');
    });


//------------------------------------EMPLOYER------------------------------------
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(EmployerProfileController::class)
    ->prefix('employer-profiles')->group(function () {
        Route::get('/company/{company_id}', 'getEmployerProfilesByCompanyId');
        Route::get('/{id}', 'getEmployerProfileById');
        Route::get('/', 'getAllEmployerProfiles');
    });

//------------------------------------AUTH------------------------------------
Route::controller(AuthController::class)
    ->prefix('auth')->group(function () {
        Route::post('/sign-up', 'signUp');
        Route::post('/sign-in', 'signIn');
    });
