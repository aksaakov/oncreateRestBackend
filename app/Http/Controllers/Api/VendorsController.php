<?php

namespace App\Http\Controllers\Api;

use App\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index(Request $request)
    {
        $vendors = Vendor::orderBy('sort', 'ASC')->get();
        return response()->json($vendors->get());
    }
}
