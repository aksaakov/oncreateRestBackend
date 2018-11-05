<?php

namespace App\Http\Controllers\Api;

use App\HomePage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $hp = HomePage::all();
        return response()->json($hp);
    }
}
