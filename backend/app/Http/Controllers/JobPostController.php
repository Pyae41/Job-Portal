<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index($status =null)
    {
        //
        $jobposts = JobPost::with('company')
            ->latest()
            ->paginate(4);


        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'jobPosts' => $jobposts,
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'job_type_id' => 'required',
            'company_id' => 'required',
            'location_id' => 'required',
            'job_position' => 'required',
            'skill' => 'required',
            'salary' => 'required',
            'deadline' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 400,
                    'statusText' => 'fail',
                    'messages' => $validator->errors(),
                ], 400);
        }

        $data = $request->all();

        JobPost::create($data);

        return response()->json(
            [
                'status' => 201,
                'statusText' => 'success',
                'message' => 'Successfully created',
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(JobPost $jobPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(JobPost $jobPost)
    {
        //
        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'jobPost' => $jobPost,
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, JobPost $jobPost)
    {
        //
        if (!$request->has('status')) {
            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
                'job_type_id' => 'required',
                'company_id' => 'required',
                'job_position' => 'required',
                'location_id' => 'required',
                'skill' => 'required',
                'salary' => 'required',
                'deadline' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => 400,
                        'statusText' => 'success',
                        'messages' => $validator->errors(),
                    ], 400);
            }
        }

        $jobPost->update($request->all());

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'message' => 'Successfully updated',
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(JobPost $jobPost)
    {
        //
        $jobPost->delete();

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'message' => 'Successfully deleted',
            ], 200);
    }

    public function search(Request $request)
    {

        $jobposts = JobPost::orWhere('companies.name', 'like', "%$request->searchData%")
            ->orWhere('job_posts.job_position', 'like', "%$request->searchData%")
            ->leftJoin('companies', 'companies.id', 'job_posts.company_id')
            ->orderBy('job_posts.id','desc')
            ->paginate(5);

        $jobposts->data = array_reverse($jobposts->toArray()['data']);

        if (!empty($jobposts->toArray()['data'])) {
            return response()->json(
                [
                    'status' => 200,
                    'statusText' => 'success',
                    'jobpost' => $jobposts,
                ], 200);
        }

        return response()->json(
            [
                'status' => 404,
                'statusText' => 'not found',
                'message' => 'Job Post Not found',
            ], 404);
    }


    public function getActiveJobPosts(){

        $jobposts = JobPost::with('company')
            ->where('status','Active')
            ->latest()
            ->paginate(4);

        if($jobposts){
            return response()->json(
                [
                    'status' => 200,
                    'statusText' => 'success',
                    'jobposts' => $jobposts,
                ], 200);
        }

        return response()->json([
            'status' =>4-4,
            'statusText' => 'fail',
            'message' => 'No Content',
        ],404);
    }

    public function activeJobPostSearch(Request $request){
        $jobposts = JobPost::with('company')
            ->select('job_posts.*')
            ->orWhere('job_position','LIKE',"%$request->searchData%")
            ->leftJoin('companies','companies.id','job_posts.company_id')
            ->orWhere('companies.name','LIKE',"%$request->searchData%")
            ->where('status','Active')
            ->get();

        if($jobposts){
            return response()->json(
                [
                    'status' => 200,
                    'statusText' => 'success',
                    'jobpost' => $jobposts,
                ], 200);
        }

        return response()->json([
            'status' =>4-4,
            'statusText' => 'fail',
            'message' => 'No Content',
        ],404);
    }
}
