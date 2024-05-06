<?php

namespace App\Http\Controllers;

use App\Models\SaveJob;
use App\Models\User;
use Illuminate\Http\Request;

class SaveJobController extends Controller
{
    //

    public function getSaveJob($userId){

        $saveJob = SaveJob::with('jobPost','jobPost.company')->where('user_id',$userId)->paginate(5);

        if(empty($saveJob)){
            return response()->json([
                'status' => 404,
                'statusText' => 'fail',
                'message' => 'No save jobs',
            ],404);
        }

        return response()->json([
            'status' => 200,
            'statusText' => 'success',
            'save_jobs' => $saveJob,
        ],200);
    }

    public function saveJob(Request $request){

        $saveJob = SaveJob::create($request->all());

        if($saveJob){
            return response()->json([
                'status' => 201,
                'statusText' => 'success',
                'message' => 'successfully saved',
            ],201);
        }

        return response()->json([
            'status' => 400,
            'statusText' => 'fail',
            'message' => 'fail to save'
        ],400);
    }

    public function removeJob($saveJobId){

        $saveJob = SaveJob::where('id',$saveJobId)->delete();

        if($saveJob){
            return response()->json([
                'status' => 200,
                'statusText' => 'success',
                'message' => 'successfully removed',
            ],201);
        }

        return response()->json([
            'status' => 400,
            'statusText' => 'fail',
            'message' => 'fail to remove'
        ],400);
    }
}
