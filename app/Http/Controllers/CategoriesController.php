<?php

namespace App\Http\Controllers;

use App\Settings;
use Validator;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends BaseController
{
    protected $base = 'categories';
    protected $cls = 'App\Category';
    protected $images = ['image'];

    protected function getAdditionalData($data = null)
    {
        return [
            'categories' => Category::withDepth()->defaultOrder()->get()
        ];
    }

    public function getValidator(Request $request)
    {
        $rules = [
            'name' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|image'
        ];
        if (Settings::getSettings()->multiple_cities) {
            $rules['city_id'] = 'required';
        }
        return Validator::make($request->all(), $rules);
    }

    public function save($item, Request $request)
    {
        $validator = $this->getValidator($request);
        if ($validator->passes()) {
            $item->fill($request->all());
            $item->save();
            if($request->hasFile('image')) {
                //Get Filename with the extension
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                //Get Filename only
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //Get Extension only
                $extension = $request->file('image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //Upload Image
                $path = $request->file('image')->storeAs('/category_images', $fileNameToStore, 'public_directory');
                $item->image='category_images/'.$fileNameToStore;
                $item->save();
    
            } else {
                $fileNameToStore = 'noimage.jpg';
            }
    }
        
        // $item = new Category;
        // $item->name = $request->input('name');
        
        // $item->save(); 
        return redirect(route($this->base . '.index'));
    }

    protected function getIndexItems($data)
    {
        if ($data != null) {
            $categories = Category::policyScope();
            if (is_array($data) && isset($data['city_id'])) {
                $categories = $categories->where('city_id', $data['city_id']);
            }
            if (is_array($data) && isset($data['restaurant_id'])) {
                $categories = $categories->where('restaurant_id', $data['restaurant_id']);
            }
            if (is_array($data) && isset($data['image'])) {
                $products = $products->where('image', '=', $data['image']);
            }
            return $categories->paginate(50);
        }
        else {
            return Category::policyScope()->paginate(50);
        }
    }

    public function up(Request $request, $id)
    {
        $category = Category::find($id);
        $category->beforeNode($category->getPrevSibling())->save();
        return redirect('/categories');
    }

    public function down(Request $request, $id)
    {
        $category = Category::find($id);
        $category->afterNode($category->getNextSibling())->save();
        return redirect('/categories');
    }
}
