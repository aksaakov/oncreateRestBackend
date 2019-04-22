<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductExtras;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('sort', 'ASC');

        if ($request->input('category_id') != null)
        {
            $products = $products->where('category_id', $request->input('category_id'));
        }
        if ($request->input('vendor_id') != null)
        {
            $products = $products->where('vendor_id', $request->input('vendor_id'));

        }
        return response()->json($products->get());

    }

    public function productExtras(Request $request)
    {
        $productsExtras = ProductExtras::orderBy('id', 'ASC');
        if ($request->input('product_id') != null)
        {
            $productsExtras = $productsExtras->where('product_id',  $request->input('product_id'));
        }

        return response()->json($productsExtras->get());
    }
}
