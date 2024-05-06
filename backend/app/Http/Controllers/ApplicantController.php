<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Application;
use App\Models\JobPost;
use App\Models\PersonalInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $applicants = Application::with('user','user.personalInfo')
                        ->where('status','Pending')
                        ->where('job_post_id',$id)->paginate(10);


        if($applicants){
            return response()->json(
                [
                    'status' => 200,
                    'statusText' => 'success',
                    'applicants' => $applicants,
                ],200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function getApplicantInfo($personalId){

        $infos = PersonalInfo::with('educations','experiences')
                ->where('user_id',$personalId)
                ->first();

        if($infos){
            return response()->json([
                'status' => 200,
                'statusText' => 'success',
                'personalInfos' => $infos,
            ],200);
        }

        return response()->json([
            'status' => 404,
            'statusText' => 'fail',
            'message' => 'No Content',
        ],404);
    }

    public function acceptOrReject(Request $request){

        $applicants = Application::where('user_id',$request->user_id)
                        ->where('job_post_id',$request->job_post_id)->first();

        if($applicants){
            $applicants->status = $request->status;

            if($applicants->update()){

                if($request->email){
                    $mail = [
                        'head' => "HMM",
                        'title' => $request->status == 'Accept' ? 'Congradulation' : 'Sorry!Please Try Another job',
                        'subject' => 'Joportal Information',
                        'body' => $request->status == 'Accept' ? 'Your CV meets our requirement' : 'Your CV does not meet our requirement',
                    ];

                    if($request->status == 'Accept'){
                        $mail['link'] = "http://localhost:8080/jobs/jobDetail/$request->job_post_id";
                    }

                    Mail::to($request->email)->send(new SendMail($mail));
                }

                return response()->json([
                    'status' => 200,
                    'statusText' => 'Success',
                    'message' => 'Successfully added'
                ],200);
            }
        }

        return response()->json([
            'status' => 404,
            'statusText' => 'Fail',
            'message' => 'Not Found',
        ],404);
    }

    function filterApplicants($job_post_id,$status){

        $applicants = Application::with('user.personalInfo')
                        ->where('status',$status)
                        ->where('job_post_id',$job_post_id)
                        ->paginate(5);

        if($applicants){
            return response()->json(
                [
                    'status' => 200,
                    'statusText' => 'success',
                    'applicants' => $applicants,
                ],200);
        }

        return response()->json([
            'status' => 404,
            'statusText' => 'fail',
            'message' => "No content"
        ],404);
    }
}
