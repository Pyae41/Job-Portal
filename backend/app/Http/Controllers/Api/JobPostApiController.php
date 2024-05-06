<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobPost;
use App\Models\PersonalInfo;
use Exception;
use Illuminate\Http\Request;

class JobPostApiController extends Controller
{
    //
    public function getAllPosts()
    {
        $jobposts = JobPost::with('company', 'location', 'jobType', 'category')
            ->where('status', 'Active')
            ->latest()
            ->paginate(5);

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'jobPosts' => $jobposts,
            ], 200);
    }

    public function getJobPostDetails($id, $user_id)
    {
        // dd($id);
        try {
            // dd($user_id);
            $applied = Application::where('user_id', $user_id)
                ->where('job_post_id', $id)
                ->first();

            $jobpost = JobPost::with('company', 'location', 'category', 'jobType', 'applicants')
                ->where('job_posts.id', $id)
                ->first();

            if (!empty($applied)) {
                $jobpost['status'] = $applied->status;
                $jobpost['applied'] = true;
            } else {
                $jobpost['applied'] = false;
                $jobpost['applicant_count'] = 0;
            }

            return response()->json(
                [
                    'status' => 200,
                    'statusText' => 'success',
                    'jobPost' => $jobpost,
                ], 200);

        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 404,
                    'statusText' => 'Not Found',
                    'message' => 'Job post not',
                ], 404);

        }

    }
    public function searchJob(Request $request)
    {

        if (!empty($request->category_id)) {
            $jobposts = JobPost::with('company', 'location', 'jobType', 'category')
                ->select('job_posts.*')
                ->leftJoin('categories', 'categories.id', 'job_posts.category_id')
                ->where('categories.id', $request->category_id)
                ->where('status', 'Active')
                ->paginate(5);
        } else if (!empty($request->job_type_id)) {
            $jobposts = JobPost::with('company', 'location', 'jobType', 'category')
                ->select('job_post.*')
                ->where('job_types.id',$request->job_type_id)
                ->where('status', 'Active')
                ->leftJoin('job_types', 'job_types.id', 'job_posts.job_type_id')
                ->paginate(5);
        } else {
            $jobposts = JobPost::with('company', 'location', 'jobType', 'category')
                ->select('job_post.*')
                ->where('categories.name',$request->category_id)
                ->where('job_types.job_type',$request->job_type_id)
                ->where('status', 'Active')
                ->leftJoin('categories', 'categories.id', 'job_posts.category_id')
                ->leftJoin('job_types', 'job_types.id', 'job_posts.job_type_id')
                ->paginate(5);
        }
        if (count($jobposts) === 0) {
            return response()->json(
                [
                    'status' => 404,
                    'statusText' => 'Not Found',
                    'message' => 'Job post not',
                ], 404);
        }

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'jobPosts' => $jobposts,
            ], 200);
    }

    public function applyJobPost(Request $request)
    {

        $data = $request->all();

        $personalInfo = PersonalInfo::where('user_id', $request->user_id)->first();
        if ($personalInfo) {
            $applicant = Application::create($data);
            if ($applicant) {
                return response()->json(
                    [
                        'status' => 201,
                        'statusText' => 'success',
                        'message' => 'Successfully applied',
                    ], 201);
            }
        }

        return response()->json(
            [
                'status' => 400,
                'statusText' => 'fail',
                'message' => 'Fail to apply,Try again',
            ], 400);
    }

    public function getAppliedJobPost(Request $request)
    {

        if (isset($request->user_id)) {

            $appliedJobs = Application::with('jobPost','jobPost.company')->where('user_id', $request->user_id);


            if(isset($request->status)){
                $appliedJobs = $appliedJobs->where('status',$request->status)->paginate(5);
            }

            else{
                $appliedJobs = $appliedJobs->paginate(5);
            }

            if($appliedJobs){
                return response()->json([
                    'status' => 200,
                    'statusText' => 'successs',
                    'appliedJobs' => $appliedJobs,
                ], 200);
            }
        }

        return response()->json([
            'status' => 404,
            'statusText' => 'fail',
            'message' => 'No Content',
        ], 404);
    }
}
