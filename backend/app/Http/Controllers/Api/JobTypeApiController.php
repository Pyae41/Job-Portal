<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobType;
use Illuminate\Http\Request;

class JobTypeApiController extends Controller
{
    //
    public function getAll(){
        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'jobTypes' => JobType::all(),
            ],200);
    }
}
