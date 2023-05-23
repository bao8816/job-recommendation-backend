<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthCompanyController;
use App\Http\Controllers\AuthEmployerController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CompanyReportController;
use App\Http\Controllers\CompanyVerificationController;
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
use App\Http\Controllers\UserHistoryController;
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

// --------User Account
//Only admin
//TODO: implement admin abilities for user account

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserAccountController::class)
    ->prefix('user-accounts')->group(function () {
        Route::put('/password', 'updatePassword');
    });

// ---------User Profile
// All roles
Route::middleware(['auth:sanctum'])->controller(UserProfileController::class)
    ->prefix('user-profiles')->group(function () {
        Route::get('/profile', 'getUserProfile');
        Route::get('/', 'getAllUserProfiles');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserProfileController::class)
    ->prefix('user-profiles')->group(function () {
        Route::put('/', 'updateUserProfile');
    });

// ----------User Education
// All roles
Route::middleware(['auth:sanctum'])->controller(UserEducationController::class)
    ->prefix('user-educations')->group(function () {
        Route::get('/user/{user_id}', 'getUserEducationsByUserId');
        Route::get('/{id}', 'getUserEducationById');
        Route::get('/', 'getAllUserEducations');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserEducationController::class)
    ->prefix('user-educations')->group(function () {
        Route::post('/', 'createUserEducation');

        Route::put('/{id}', 'updateUserEducation');

        Route::delete('/{id}', 'deleteUserEducation');
    });

// ----------User Experience
// All roles
Route::middleware(['auth:sanctum'])->controller(UserExperienceController::class)
    ->prefix('user-experiences')->group(function () {
        Route::get('/user/{user_id}', 'getUserExperiencesByUserId');
        Route::get('/{id}', 'getUserExperienceById');
        Route::get('/', 'getAllUserExperiences');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserExperienceController::class)
    ->prefix('user-experiences')->group(function () {
        Route::post('/', 'createUserExperience');

        Route::put('/{id}', 'updateUserExperience');

        Route::delete('/{id}', 'deleteUserExperience');
    });

// ----------User Achievement
// All roles
Route::middleware(['auth:sanctum'])->controller(UserAchievementController::class)
    ->prefix('user-achievements')->group(function () {
        Route::get('/user/{user_id}', 'getUserAchievementsByUserId');
        Route::get('/{id}', 'getUserAchievementById');
        Route::get('/', 'getAllUserAchievements');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserAchievementController::class)
    ->prefix('user-achievements')->group(function () {
        Route::post('/', 'createUserAchievement');

        Route::put('/{id}', 'updateUserAchievement');

        Route::delete('/{id}', 'deleteUserAchievement');
    });

// ----------User Skill
// All roles
Route::middleware(['auth:sanctum'])->controller(UserSkillController::class)
    ->prefix('user-skills')->group(function () {
        Route::get('/user/{user_id}', 'getUserSkillsByUserId');
        Route::get('/{id}', 'getUserSkillById');
        Route::get('/', 'getAllUserSkills');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserSkillController::class)
    ->prefix('user-skills')->group(function () {
        Route::post('/', 'createUserSkill');

        Route::put('/{id}', 'updateUserSkill');

        Route::delete('/{id}', 'deleteUserSkill');
    });

// -----------User History
// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserHistoryController::class)
    ->prefix('user-histories')->group(function () {
        Route::post('/', 'createUserHistory');

        Route::put('/{id}', 'updateUserHistory');
    });

// Only moderator
Route::middleware(['auth:sanctum', 'abilities:mod'])->controller(UserHistoryController::class)
    ->prefix('user-histories')->group(function () {
        Route::get('/user/{user_id}', 'getUserHistoriesByUserId');
        Route::get('/job/{job_id}', 'getUserHistoriesByJobId');
        Route::get('/{id}', 'getUserHistoryById');
        Route::get('/', 'getAllUserHistories');

        Route::delete('/{id}', 'deleteUserHistory');
    });

//------------------------------------POST------------------------------------
// ----------Post
// All roles
Route::middleware(['auth:sanctum'])->controller(PostController::class)
    ->prefix('posts')->group(function () {
        Route::get('/user/{user_id}', 'getPostsByUserId');
        Route::get('/{id}', 'getPostById');
        Route::get('/', 'getAllPosts');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostController::class)
    ->prefix('posts')->group(function () {
        Route::post('/', 'createPost');

        Route::put('/{id}', 'updatePost');
    });

// Only user and moderator
Route::middleware(['auth:sanctum', 'ability:user,mod'])->controller(PostController::class)
    ->prefix('posts')->group(function () {
        Route::delete('/{id}', 'deletePost');
    });

// ----------Post Report
// All roles
Route::middleware(['auth:sanctum'])->controller(PostReportController::class)
    ->prefix('post-reports')->group(function () {
        Route::get('/user/{user_id}', 'getPostReportsByUserId');
        Route::get('/post/{post_id}', 'getPostReportsByPostId');
        Route::get('/{id}', 'getPostReportById');
        Route::get('/', 'getAllPostReports');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostReportController::class)
    ->prefix('post-reports')->group(function () {
        Route::post('/', 'createPostReport');
    });

// Only user and moderator
Route::middleware(['auth:sanctum', 'abilities:user,mod'])->controller(PostReportController::class)
    ->prefix('post-reports')->group(function () {
        Route::delete('/{id}', 'deletePostReport');
    });

// ----------Post Comment
// All roles
Route::middleware(['auth:sanctum'])->controller(PostCommentController::class)
    ->prefix('post-comments')->group(function () {
        Route::get('/user/{user_id}', 'getPostCommentsByUserId');
        Route::get('/post/{post_id}', 'getPostCommentsByPostId');
        Route::get('/{id}', 'getPostCommentById');
        Route::get('/', 'getAllPostComments');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(PostCommentController::class)
    ->prefix('post-comments')->group(function () {
        Route::post('/', 'createPostComment');
    });

// Only user and moderator
Route::middleware(['auth:sanctum', 'abilities:user,mod'])->controller(PostCommentController::class)
    ->prefix('post-comments')->group(function () {
        Route::delete('/{id}', 'deletePostComment');
    });


//------------------------------------JOB------------------------------------
// ----------Job
// All roles (including guest)
Route::controller(JobController::class)
    ->prefix('jobs')->group(function () {
        Route::get('/company/{company_id}', 'getJobsByCompanyId');
        Route::get('/employer/{employer_id}', 'getJobsByEmployerId');
        Route::get('/{id}', 'getJobById');
        Route::get('/', 'getAllJobs');
    });

// Only company and employer
Route::middleware(['auth:sanctum', 'ability:company,employer'])->controller(JobController::class)
    ->prefix('jobs')->group(function () {
        Route::post('/', 'createJob');

        Route::put('/{id}', 'updateJob');
    });

// Only company, employer and moderator
Route::middleware(['auth:sanctum', 'ability:company,employer,mod'])->controller(JobController::class)
    ->prefix('jobs')->group(function () {
        Route::delete('/{id}', 'deleteJob');
    });

// ---------Job Location
// All roles (including guest)
Route::controller(JobLocationController::class)
    ->prefix('job-locations')->group(function () {
        Route::get('/job/{job_id}', 'getJobLocationsByJobId');
        Route::get('/{id}', 'getJobLocationById');
        Route::get('/', 'getAllJobLocations');
    });

// ----------Job Skill
// All roles (including guest)
Route::controller(JobSkillController::class)
    ->prefix('job-skills')->group(function () {
        Route::get('/job/{job_id}', 'getJobSkillsByJobId');
        Route::get('/{id}', 'getJobSkillById');
        Route::get('/', 'getAllJobSkills');
    });

// ------------Job Type
// All roles (including guest)
Route::controller(JobTypeController::class)
    ->prefix('job-types')->group(function () {
        Route::get('/job/{job_id}', 'getJobTypesByJobId');
        Route::get('/{id}', 'getJobTypeById');
        Route::get('/', 'getAllJobTypes');
    });

// ------------Job Report
// All roles
Route::middleware(['auth:sanctum'])->controller(JobReportController::class)
    ->prefix('job-reports')->group(function () {
        Route::get('/user/{user_id}', 'getJobReportsByUserId');
        Route::get('/job/{job_id}', 'getJobReportsByJobId');
        Route::get('/{id}', 'getJobReportById');
        Route::get('/', 'getAllJobReports');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(JobReportController::class)
    ->prefix('job-reports')->group(function () {
        Route::post('/', 'createJobReport');
    });

// Only user and moderator
Route::middleware(['auth:sanctum', 'ability:user,mod'])->controller(JobReportController::class)
    ->prefix('job-reports')->group(function () {
        Route::delete('/{id}', 'deleteJobReport');
    });


//------------------------------------COMPANY------------------------------------
// -----------Company Account
//TODO: implement admin ability for company account

// -----------Company Profile
// All roles (including guest)
Route::controller(CompanyProfileController::class)
    ->prefix('company-profiles')->group(function () {
        Route::get('/{id}', 'getCompanyProfileById');
        Route::get('/', 'getAllCompanyProfiles');
    });

// ------------Company Report
// All roles
Route::middleware(['auth:sanctum'])->controller(CompanyReportController::class)
    ->prefix('company-reports')->group(function () {
        Route::get('/user/{user_id}', 'getCompanyReportsByUserId');
        Route::get('/company/{company_id}', 'getCompanyReportsByCompanyId');
        Route::get('/{id}', 'getCompanyReportById');
        Route::get('/', 'getAllCompanyReports');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(CompanyReportController::class)
    ->prefix('company-reports')->group(function () {
        Route::post('/', 'createCompanyReport');
    });

// Only user and moderator
Route::middleware(['auth:sanctum', 'ability:user,mod'])->controller(CompanyReportController::class)
    ->prefix('company-reports')->group(function () {
        Route::delete('/{id}', 'deleteCompanyReport');
    });

// -------------Company Verification
// Only moderator and company
Route::middleware(['auth:sanctum', 'ability:mod,company'])->controller(CompanyVerificationController::class)
    ->prefix('company-verifications')->group(function () {
        Route::get('/company/{company_id}', 'getCompanyVerificationsByCompanyId');
        Route::get('/{id}', 'getCompanyVerificationById');
        Route::get('/', 'getAllCompanyVerifications');
    });

// Only company
Route::middleware(['auth:sanctum', 'ability:company'])->controller(CompanyVerificationController::class)
    ->prefix('company-verifications')->group(function () {
        Route::post('/', 'createCompanyVerification');
    });

// Only moderator
Route::middleware(['auth:sanctum', 'abilities:mod'])->controller(CompanyVerificationController::class)
    ->prefix('company-verifications')->group(function () {
        Route::put('/approve/{id}', 'approveCompanyVerification');
        Route::put('/reject/{id}', 'rejectCompanyVerification');

        Route::delete('/{id}', 'deleteCompanyVerification');
    });


//------------------------------------CV------------------------------------

// Only user
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
// -----------Employer Account
//TODO: implement admin ability for employer account

// -----------Employer Profile
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(EmployerProfileController::class)
    ->prefix('employer-profiles')->group(function () {
        Route::get('/company/{company_id}', 'getEmployerProfilesByCompanyId');
        Route::get('/{id}', 'getEmployerProfileById');
        Route::get('/', 'getAllEmployerProfiles');
    });


//------------------------------------APPLICATION------------------------------------
// All role
Route::middleware(['auth:sanctum'])->controller(ApplicationController::class)
    ->prefix('applications')->group(function () {
        Route::get('/user/{user_id}', 'getApplicationsByUserId');
        Route::get('/job/{job_id}', 'getApplicationsByJobId');
        Route::get('/{id}', 'getApplicationById');
        Route::get('/', 'getAllApplications');
    });

// Only moderator
Route::middleware(['auth:sanctum', 'abilities:mod'])->controller(ApplicationController::class)
    ->prefix('applications')->group(function () {
        Route::delete('/{id}', 'deleteApplication');
    });

// Only user
Route::middleware(['auth:sanctum', 'abilities:user'])->controller(ApplicationController::class)
    ->prefix('applications')->group(function () {
        Route::post('/', 'createApplication');
    });

// Only company
Route::middleware(['auth:sanctum', 'ability:company,employer'])->controller(ApplicationController::class)
    ->prefix('applications')->group(function () {
        Route::put('/approve/{id}', 'approveApplication');
        Route::put('/reject/{id}', 'rejectApplication');
    });

//------------------------------------AUTH------------------------------------
Route::controller(AuthAdminController::class)
    ->prefix('auth-admin')->group(function () {
        Route::post('/sign-in', 'signIn');
    });

Route::controller(AuthCompanyController::class)
    ->prefix('auth-company')->group(function () {
        Route::post('/sign-up', 'signUp');
        Route::post('/sign-in', 'signIn');
    });

Route::controller(AuthEmployerController::class)
    ->prefix('auth-employer')->group(function () {
        Route::post('/sign-in', 'signIn');
    });

Route::controller(AuthUserController::class)
    ->prefix('auth-user')->group(function () {
        Route::post('/sign-up', 'signUp');
        Route::post('/sign-in', 'signIn');
    });
