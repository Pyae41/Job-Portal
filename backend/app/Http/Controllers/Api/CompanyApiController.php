<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyApiController extends Controller
{
    //

    public function getAll()
    {
        $companies = Company::paginate(10);

        return response()->json(
            [
                'status' => 200,
                'statusText' => 'success',
                'companies' => $companies,
            ], 200);
    }
}
