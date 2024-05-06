<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Models\JobPost;
use Illuminate\Support\Facades\Route;

Route::post('login',[AuthController::class,'login'])->name('login');
Route::post('register',[AuthController::class,'register'])->name('register');

Route::post('requestOTP', [EmailVerificationController::class, 'requestOTP'])->name('requestOTP');
Route::post('verifyOTP', [EmailVerificationController::class, 'verifyOTP'])->name('verifyOTP');


Route::middleware('auth:api')->prefix('admin')->namespace('App\Http\Controllers')->group(function () {

    // dashboard
    Route::get('allReport','ReportController@countAll');
    Route::get('companyReport','ReportController@compainesJobPost');

    // category route
    Route::post('category/search','CategoryController@search');
    Route::resource('category', CategoryController::class);

    // job type route
    Route::post('jobType/search','JobTypeController@search');
    Route::resource('jobType', JobTypeController::class);

    // job post route
    Route::post('jobPost/search','JobPostController@search')->name('jobPost.search');
    Route::get('jobPost/getActiveJobPosts','JobPostController@getActiveJobPosts')->name('jobPost.search');
    Route::post('jobPost/getActiveJobPosts/search','JobPostController@activeJobPostSearch');
    Route::resource('jobPost',JobPostController::class);

    // company route
    Route::post('company/search','CompanyController@search');
    Route::resource('company', CompanyController::class);

    // location route
    Route::post('location/search','LocationController@search');
    Route::resource('location',LocationController::class);


    // applicants route
    Route::get('applicants/getPersonalInfo/{userId}','ApplicantController@getApplicantInfo');
    Route::post('applicants/acceptReject','ApplicantController@acceptOrReject');
    Route::get('applicants/{jobPostId}/{status}','ApplicantController@filterApplicants');
    Route::resource('applicants',ApplicantController::class);

    // logout
    Route::post('logout','Auth\AuthController@logout');

});

Route::prefix('frontend')->name('frontend.')->namespace('App\Http\Controllers')->group(function(){

    // category
    Route::prefix('category')->group(function () {
        Route::get('/','Api\CategoryApiController@getAll')->name('category.getAll');
    });
    Route::prefix('company')->group(function () {
        Route::get('/','Api\CompanyApiController@getAll')->name('company.getAll');
    });

    Route::prefix('jobType')->group(function(){
        Route::get('/','Api\JobTypeApiController@getAll')->name('jobType.getAll');
    });

    // company
    Route::resource('company', CompanyController::class);

    // job post
    Route::prefix('jobPost')->group(function(){
        Route::get('/','Api\JobPostApiController@getAllPosts')->name('jobPost.getAll');
        Route::post('search','Api\JobPostApiController@searchJob')->name('jobPost.searchJob');
        Route::middleware('auth:api')->get('jobDetails/{id}/{user_id}','Api\JobPostApiController@getJobPostDetails')->name('jobPost.jobDetails');
        Route::middleware('auth:api')->post('applyJobPost','Api\JobPostApiController@applyJobPost')->name('jobPost.apply');
        Route::middleware('auth:api')->post('getAppliedJobPost','Api\JobPostApiController@getAppliedJobPost')->name('jobPost.getApplied');
    });

    // save job
    Route::prefix('profile')->middleware('auth:api')->name('profile.')->group(function(){

        // get save jobs
        Route::get('getSaveJobs/{userId}','SaveJobController@getSaveJob')->name('get_save_jobs');

        // save job posts
        Route::post('saveJob','SaveJobController@saveJob')->name('save_job');

        // remove save job
        Route::get('removeSaveJob/{saveJobId}','SaveJobController@removeJob')->name('remove_save_job');
    });

    // personal info
    Route::prefix('personal_info')->middleware('auth:api')->name('personalInfo.')->group(function(){

        // get personal info
        Route::get('getPersonalInfo/{userId}','PersonalInfoController@getPersonalInfo')->name('getPersonalInfo');

        // save personal info
        Route::post('addPersonalInfo','PersonalInfoController@addPersonalInfo')->name('addPersonalInfo');

        // edit personal info
        Route::post('editPersonalInfo/{userId}','PersonalInfoController@editPersonalInfo')->name('editPersonalInfo');

        // add education
        Route::post('addEducation','PersonalInfoController@addNewEducation')->name('addEducation');

        // edit Education
        Route::post('editEducation/{educationId}','PersonalInfoController@editEducation')->name('editEducation');

        // delete education
        Route::get('deleteEducation/{educationId}','PersonalInfoController@deleteEducation')->name('deleteEducation');

        // add experience
        Route::post('addExperience','PersonalInfoController@addNewExperience')->name('addExperience');

        // edit experience
        Route::post('editExperience/{experienceId}','PersonalInfoController@editExperience')->name('editExperience');

        // delete experience
        Route::get('deleteExperience/{experienceId}','PersonalInfoController@deleteExperience')->name('deleteEExperience');

    });

     // logout
     Route::middleware(['auth:api','verified'])->post('logout','Auth\AuthController@logout');
});
