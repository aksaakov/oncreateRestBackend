<?php

namespace App\Http\Controllers;

use App\ProductImage;
use App\ProductExtras;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Validator;
use Gate;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Services\ProductsImportService;

class ProductsController extends BaseController
{
    protected $base = 'products';
    protected $cls = 'App\Product';
    protected $orderBy = 'sort';
    protected $orderByDir = 'ASC';

    protected function getIndexItems($data)
    {
        if ($data != null) {
            $products = Product::policyScope()->
                orderBy($this->orderBy, $this->orderByDir);
            if (is_array($data) && isset($data['q'])) {
                $products = $products->where(function ($query) use ($data) {
                    $q = '%' . $data['q'] . '%';
                    return $query->where('description', 'LIKE', $q)->
                        orWhere('name', 'LIKE', $q);
                });
            }
            if (is_array($data) && isset($data['category'])) {
                $products = $products->where('category_id', '=', $data['category']);
            }
            if (is_array($data) && isset($data['vendor'])) {
                $products = $products->where('vendor_id', '=', $data['vendor']);
            }
            if (is_array($data) && isset($data['city'])) {
                $category_ids = Category::where('city_id', $data['city'])->pluck('id');
                $products = $products->whereIn('category_id', $category_ids);
            }
            if (is_array($data) && isset($data['restaurant'])) {
                $category_ids = Category::where('restaurant_id', $data['restaurant'])->pluck('id');
                $products = $products->whereIn('category_id', $category_ids);
            }
            if (is_array($data) && isset($data['tax_group'])) {
                $products = $products->where('tax_group_id', '=', $data['tax_group']);
            }
            return $products->paginate(20);
        }
        else {
            return Product::policyScope()->
                orderBy($this->orderBy, $this->orderByDir)->paginate(20);
        }
    }

    protected function getAdditionalData($data = null)
    {
        return [
            'categories' => Category::policyScope()->get()
        ];
    }

    public function getValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|between:0,99999999|numeric',
            'sort' => 'required|integer',
            'category_id' => 'required'
        ]);
    }

    protected function save($item, Request $request)
    {
        $validator = $this->getValidator($request);
        if ($validator->passes()) {
            $item->fill($request->all());
            $item->save();
            if(Input::get('extras') != null){
                $y = 0;
                foreach(Input::get('extras') as $extra_name_input) {
                    $x = $request->extra_price[$y++];
                    $prodExtra = new ProductExtras([
                        'product_id' => $item->id,
                        'extra_type' => 'Extras',
                        'extra_name' => $extra_name_input,
                        'extra_price' => $x,
                    ]);
                    $prodExtra->save();
                }
            }

            if(Input::get('exclusions') != null){
                foreach(Input::get('exclusions') as $exclusion_name_input) {

                    $prodExtra = new ProductExtras([
                        'product_id' => $item->id,
                        'extra_type' => 'Exclusions',
                        'extra_name' => $exclusion_name_input,
                    ]);

                    $prodExtra->save();
                }
            }
            if (Input::file('image') != null) {
                foreach (Input::file('image') as $image) {
                    if ($image != null) {
                        $new_file = str_random(10) . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('product_images'), $new_file);
                        $pi = new ProductImage([
                            'image' => '/product_images/' . $new_file,
                            'product_id' => $item->id
                        ]);
                        $pi->save();
                    }
                }
            }
            return redirect(route($this->base . '.index'));
        } else {
            $errors = $validator->messages();
            return view($this->base . '.form', array_merge(compact('item', 'errors'), $this->getAdditionalData()));
        }
    }

    public function deleteImage(Request $request, $id)
    {
        $pi = ProductImage::find($id);
        if ($pi) {
            $pi->delete();
        }
        return response()->json([]);
    }

    public static function deleteExtra(Request $request, $id)
    {
        $pe = ProductExtras::find($id);
        if ($pe) {
            $pe->delete();
        }
        return response()->json([]);
    }

    public function autocomplete(Request $request)
    {
        $q = $request->input('query');
        $products = Product::policyScope();
        $city = $request->input('city_id');
        $restaurant_id = $request->input('restaurant_id');
        if (!empty($city)) {
            $category_ids = Category::where('city_id', $city)->pluck('id');
            $products = $products->whereIn('category_id', $category_ids);
        }
        if (!empty($restaurant_id)) {
            $category_ids = Category::where('restaurant_id', $restaurant_id)->pluck('id');
            $products = $products->whereIn('category_id', $category_ids);
        }
        $products = $products->where('name', 'like', '%' . $q . '%')->
            limit(20)->get();
        $result = [
            'query' => $q,
            'suggestions' => []
        ];
        foreach ($products as $product) {
            $result['suggestions'][] = [
                'data' => $product->id,
                'value' => $product->name
            ];
        }
        return response()->json($result);
    }

    public function bulk_upload()
    {
        if (!Gate::allows('create', $this->cls)) {
            return redirect('/');
        }
        return view('products.bulk_upload');
    }

    public function bulk(Request $request)
    {
        if (!Gate::allows('create', $this->cls)) {
            return redirect('/');
        }
        $file_name = Input::file('fl');
        $result = [
            'created' => 0,
            'updated' => 0
        ];
        if ($file_name != null) {
            $service = new ProductsImportService();
            $result = $service->import(
                $file_name->getPathName(),
                $request->input('city_id'),
                $request->input('restaurant_id')
            );
        }
        return redirect(route('products.index'))->with('status', __('messages.products.imported', $result));;
    }
}
