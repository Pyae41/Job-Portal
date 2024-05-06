<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $companies = Company::paginate(6);

        // foreach($companies as $company){
        //     $company['company_logo'] = url('storage/'.$company->company_logo);
        // };

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'companies' => $companies,
            ], 200);
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

        $validator = Validator::make($request->all(), [
            'name' => 'required | unique:companies,name',
            'email' => 'required | unique:companies,email',
            'phone' => 'required | numeric | unique:companies,phone',
            'address' => 'required',
            'company_logo' => 'required | max:1024',
        ]);

        // return $request->all();

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 400,
                    'statusText' => 'Fail',
                    'messages' => $validator->errors(),
                ], 400);
        }

        $data = $request->all();

        $path = $request->file('company_logo')->getRealPath();
        $logo = file_get_contents($path);
        $base64 = base64_encode($logo);

        $data['company_logo'] = $base64;

        Company::create($data);

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
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Company $company)
    {
        //
        return response()->json([
            'status' => 200,
            'statusText' => 'success',
            'company' => $company,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Company $company)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 400,
                    'statusText' => 'Fail',
                    'errors' => $validator->errors(),
                ], 400);
        }

        $data = $request->all();

        if ($request->file('company_logo') != null) {

            $path = $request->file('company_logo')->getRealPath();
            $logo = file_get_contents($path);
            $base64 = base64_encode($logo);

            $data['company_logo'] = $base64;
        }


        $company->update($data);
        // return $request->all();

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
    public function destroy(Company $company)
    {
        //
        $company->delete();

        return response()->json([
            'status' => 200,
            'statusText' => 'success',
            'message' => 'Successfully deleted',
        ], 200);
    }

    public function search(Request $request){

        $company = Company::where('companies.name','LIKE',"%{$request->name}%")->get();

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'company' => $company,
            ],200);
    }
}
