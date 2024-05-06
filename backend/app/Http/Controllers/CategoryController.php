<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
        $categories = Category::paginate(4);
        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'categories' => $categories,
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

        $validator = Validator::make($request->all(),
            [
                'name' => 'required | unique:categories,name',
            ]
        );

        if($validator->fails()){
            return response()->json(
                [
                    'status' => 400,
                    'statusText' => 'Fail',
                    'messages' => $validator->errors(),
                ],400);
        }

        Category::create($request->all());

        return response()->json(
            [
                'status' => 201,
                'statusText' => 'success',
                'message' => 'Successfully Created',
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Category $category)
    {
        //
        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'category' => $category,
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 400,
                    'statusText' => 'Fail',
                    'messages' => $validator->errors(),
                ], 400);
        }
        $category->update($request->all());

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'message' => 'Successfully Updated',
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();

        return response()->json([
            'status' => 200,
            'statusText' => 'success',
            'message' => 'Successfully deleted',
        ], 200);
    }

    public function search(Request $request){

        $category = Category::where('categories.name','LIKE',"%{$request->name}%")->get();

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'category' => $category,
            ],200);
    }
}
