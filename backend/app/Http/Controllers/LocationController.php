<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
        $locations = Location::paginate(5);

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'locations' => $locations,
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
            'city' => 'required | unique:locations,city',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 400,
                    'statusText' => 'fail',
                    'messages' => $validator->errors(),
                ], 400);
        }

        Location::create($request->all());

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
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Location $location)
    {
        //
        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'location' => $location,
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Location $location)
    {
        //

        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 400,
                    'statusText' => 'fail',
                    'messages' => $validator->errors(),
                ], 400);
        }

        $location->update($request->all());

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'message' => 'Successfully updated',
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
        $location->delete();

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'message' => 'Successfully deleted',
            ], 200);
    }
    public function search(Request $request)
    {

        $location = Location::orWhere('locations.city', 'LIKE', "%{$request->location}%")
            ->orWhere('locations.country', 'LIKE', "%{$request->location}%")->get();

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'location' => $location,
            ], 200);
    }
}
