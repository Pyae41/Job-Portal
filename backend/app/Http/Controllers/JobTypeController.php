<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
        $jobTypes = JobType::paginate(7);
        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'jobTypes' => $jobTypes
            ],200);
    }

    /**
     * Show the form for creating a new resource.
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

        $validator = Validator::make($request->all(),[
            'job_type' => 'required',
        ],[
            'required' => 'Please Enter Job Type',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'statusText' => 'fail',
                'messages' => $validator->errors(),
            ],400);
        }

        JobType::create($request->all());

        return response()->json(
            [
                'status' => 201,
                'statusText' => 'success',
                'message' => 'Successfully created'
            ],201);

    }

    /**
     * Display the specified resource.
     *
     */
    public function show(JobType $jobType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(JobType $jobType)
    {
        //
        return response()->json(
            [
                'status' => 200,
                'jobType' => $jobType
            ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, JobType $jobType)
    {
        //
        $validator = Validator::make($request->all(),[
            'job_type' => 'required',
        ],[
            'required' => 'Please Enter Job Type',
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'status' => 400,
                    'statusText' => 'fail',
                    'messages' => $validator->errors(),
                ],400);
        }

        $jobType->update($request->all());

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'message' => 'Successfully updated'
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(JobType $jobType)
    {
        //
        $jobType->delete();

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'message' => 'Successfully deleted'
            ],200);
    }

    public function search(Request $request){

        $jobType = JobType::where('job_types.job_type','LIKE',"%{$request->job_type}%")->get();

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'jobType' => $jobType,
            ],200);
    }
}
