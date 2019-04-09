<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ProductExtras extends Model
{
    protected $fillable = ['product_id', 'extra_type', 'extra_name', 'extra_price'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
