<?php

namespace App\Http\Controllers;

use Validator;
use App\HomePage;
use Illuminate\Http\Request;

class HomePageController extends BaseController
{
    protected $base = 'homepage';
    protected $cls = 'App\HomePage';

    public function getValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'Title' => 'required',
            'Description' => 'required'
        ]);
    }


}
