<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function countAll(){

        $companies = Company::count();

        $jobPosts = JobPost::count();

        $users = User::where('id','!=',1)->count();

        return response()->json([
            'status' => 200,
            'statusText' => 'success',
            'companyCount' => $companies,
            'jobPostCount' => $jobPosts,
            'users' => $users
        ],200);
    }

    public function compainesJobPost(){

        $companies = Company::withCount('jobPosts')
                    ->get();

        foreach($companies as $index => $company){
            $companies[$index]['accept'] = JobPost::find($company->id)->whereHas('applicants',function($query){
                $query->where('status','Accept');
            })->count();

            $companies[$index]['pending'] = JobPost::find($company->id)->whereHas('applicants',function($query){
                $query->where('status','Pending');
            })->count();

            $companies[$index]['reject'] = JobPost::find($company->id)->whereHas('applicants',function($query){
                $query->where('status','Reject');
            })->count();
        }

        return response()->json([
            'status' => 200,
            'statusText' => 'success',
            'companies' => $companies,
        ],200);
    }
}
