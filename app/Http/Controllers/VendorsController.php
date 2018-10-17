<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

class VendorsController extends BaseController
{
    protected $base = 'vendors';
    protected $cls = 'App\Vendor';
    protected $images = ['image'];

    public function getValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
            'sort' => 'required|integer'
        ]);
    }
}
