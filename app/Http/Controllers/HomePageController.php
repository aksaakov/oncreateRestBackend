<?php

namespace App\Http\Controllers;
use Validator;
use App\HomePage;
use Illuminate\Http\Request;
use Gate;

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

     /**
     * Returns relation for current search conditions
     * @param  $data Request 'filter' parameter
     * @return Relation
     */
    protected function getIndexItems($data)
    {
        if ($data != null) {
            $homepageinfo = HomePage::policyScope();
            if (is_array($data) && isset($data['q'])) {
                $homepageinfo = $homepageinfo->where('Title', 'LIKE', '%' . $data['q'] . '%');
            }
            if (is_array($data) && isset($data['city_id'])) {
                $homepageinfo = $homepageinfo->where('city_id', $data['city_id']);
            }
            return $homepageinfo->paginate(20);
        }
        return HomePage::policyScope();
    }

    public function index(Request $request)
    {
        if (!Gate::allows('create', $this->cls)) {
            return redirect('/');
        }
        $item = HomePage::getHomePageInfo();
        return view($this->base . '.form', array_merge(compact('item'), $this->getAdditionalData()));
    }

    public function update(Request $request, $id)
    {
        $item = call_user_func([$this->cls, 'find'], $id);
        if (!Gate::allows('update', $item)) {
            return redirect('/');
        }
        return $this->save($item, $request);
    }

        public function store(Request $request)
    {
        if (!Gate::allows('create', $this->cls)) {
            return redirect('/');
        }
        return $this->save(new $this->cls, $request);
    }
}