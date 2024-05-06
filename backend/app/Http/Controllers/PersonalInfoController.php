<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\PersonalInfo;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDOException;

class PersonalInfoController extends Controller
{
    function getPersonalInfo($userId){

        $personalInfo = PersonalInfo::with('educations','experiences')->where('user_id',$userId)->first();

        if($personalInfo){
            return response()->json([
                'status' => 200,
                'statusText' => 'success',
                'personalInfo' => $personalInfo
            ],200);
        }

        return response()->json([
            'status' => 404,
            'statusText' => 'faild',
            'message' => "Personal Information with user id - $userId is not founded."
        ],404);
    }
    function addPersonalInfo(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required | unique:personal_infos,email',
            'nrc' => 'required | unique:personal_infos,nrc',
            'dob' => 'required',
            'phone' => "required | unique:personal_infos,phone",
            'address' => "required",
            'city' => 'required',
            'skill' => 'required',
            'marital_status' => 'required',
            'gender' => 'required',
            'education.*' => 'required',
            'experience.*' => 'required',
            'profession' => 'required',
            'profile_pic' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'statusText' => 'fail',
                'message' => $validator->errors(),
            ],400);
        }

        $data = $request->all();

        // change photo to 64 base characters
        // $path = $request->file('profile_pic')->getRealPath();
        // $logo = file_get_contents($path);
        // $base64 = base64_encode($logo);

        // $data['profile_pic'] = $base64;

        $personalInfoId = PersonalInfo::create($data)->id;

        if(!empty($personalInfoId)){
            $ed_success = false;
            $exp_success = false;

            if(!empty($data['education'])){
                try{
                    foreach($data['education'] as $education){
                        $education = json_decode($education,true);
                        $education['personal_info_id'] = $personalInfoId;
                        Education::create($education);
                    }

                    $ed_success = true;
                }
                catch(PDOException $e){
                    $ed_success = false;
                }

            }

            if(!empty($data['experience'])){
                try{
                    foreach($data['experience'] as $experience){
                        $experience = json_decode($experience,true);
                        $experience['personal_info_id'] = $personalInfoId;
                        Experience::create($experience);
                    }

                    $exp_success = true;
                }
                catch(PDOException $e){
                    $exp_success = false;
                }
            }

            if($ed_success && $exp_success){
                return response()->json([
                    'status' => 201,
                    'statusText' => 'success',
                    'message' => "Successfully Added Personal Information"
                ],201);
            }

        }

        return response()->json([
            'status' => 400,
            'statusText' => 'fail',
            'message' => 'Fail to add personal information'
        ],200);
    }

    function editPersonalInfo(Request $request,$userId){

        $updatePersonalInfo = PersonalInfo::where('user_id',$userId)->update($request->all());

        if($updatePersonalInfo){
            return response()->json([
                'status' => 200,
                'statusText' => "success",
                'message' => "Successfully Updated"
            ],200);
        }

        return response()->json([
            'status' => 400,
            'statusText' => 'fail',
            'message' => 'Fail to update personal informartion'
        ],400);
    }
    function editEducation(Request $request,$educationId){

        $education = Education::where('id',$educationId)->update($request->all());

        if($education){
            return response()->json([
                'status' => 200,
                'statusText' => "success",
                'message' => "Successfully Updated"
            ],200);
        }

        return response()->json([
            'status' => 400,
            'statusText' => 'fail',
            'message' => 'Fail to update education'
        ],400);
    }


    function editExperience(Request $request,$experienceId){
        $experience = Experience::where('id',$experienceId)->update($request->all());

        if($experience){
            return response()->json([
                'status' => 200,
                'statusText' => "success",
                'message' => "Successfully Updated"
            ],200);
        }

        return response()->json([
            'status' => 400,
            'statusText' => 'fail',
            'message' => 'Fail to update experience'
        ],400);
    }

    function addNewEducation(Request $request){

        $validator = Validator::make($request->all(),[
            'personal_info_id' => 'required',
            'degree_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'statusText' => 'fail',
                'message' => $validator->errors(),
            ],400);
        }

        Education::create($request->all());

        return response()->json([
            'status' => 201,
            'statusText' => 'success',
            'message' => "Successfully Added Education"
        ],201);
    }


    function addNewExperience(Request $request){
        $validator = Validator::make($request->all(),[
            'personal_info_id' => 'required',
            'company_name' => 'required',
            'positin' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'statusText' => 'fail',
                'message' => $validator->errors(),
            ],400);
        }

        Experience::create($request->all());

        return response()->json([
            'status' => 201,
            'statusText' => 'success',
            'message' => "Successfully Added Education"
        ],201);
    }

    function deleteEducation($educationId){

        $deleteEducation = Education::where('id',$educationId)->delete();

        if($deleteEducation){
            return response()->json([
                'status' => 200,
                'statusText' => "success",
                'message' => "Successfully deleted"
            ],200);
        }

        return response()->json([
            'status' => 400,
            'statusText' => "fail",
            'message' => "FAil to  delete education"
        ],400);
    }

    function deleteExperience($experienceId){
        $deleteExperience = Experience::where('id',$experienceId)->delete();

        if($deleteExperience){
            return response()->json([
                'status' => 200,
                'statusText' => "success",
                'message' => "Successfully deleted"
            ],200);
        }

        return response()->json([
            'status' => 400,
            'statusText' => "fail",
            'message' => "FAil to  delete experience"
        ],400);
    }
}
