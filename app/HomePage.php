<?php

namespace App;

use App\Settings;
use Auth;
use App\City;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $table = 'homepage';
    protected $fillable = ['Title', 'Descritpion'];

    // public function city()
    // {
    // 	return $this->belongsTo(City::class);
    // }

    // /**
    //  * Relation of models accessible by current user
    //  * @return Relation
    //  */
    // public static function policyScope()
    // {
    //     if (Settings::getSettings()->multiple_cities && !Auth::user()->access_full) {
    //         return HomePage::whereIn('city_id', City::policyScope()->pluck('id')->all())->
    //             orderBy('created_at', 'DESC');
    //     }
    //     else {
    //         return HomePage::orderBy('created_at', 'DESC');
    //     }
    // }

    
}
