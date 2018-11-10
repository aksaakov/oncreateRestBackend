<?php

namespace App;

use App\Settings;
use Auth;
use App\City;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $table = 'homepage';
    protected $fillable = ['Title', 'Description'];
    protected $appends = ['image_url'];
    protected $hidden = ['image'];
    private static $instance;
    public $timestamps = false;
    protected $primaryKey = 'Title';
    public $incrementing = false;
    
 

    public function city()
    {
    	return $this->belongsTo(City::class);
    }

    public function getImageUrlAttribute()
    {
      return url($this->image);
    }
    
     /**
     * Current homepage object, with caching
     * @return HomePage
     */
    public static function getHomePageInfo()
    {
    	if (self::$instance == null) {
    		self::$instance = HomePage::first();
			if (self::$instance == null) {
				self::$instance = new HomePage();
			}
    	}
    	return self::$instance;
    }
    /**
     * Relation of models accessible by current user
     * @return Relation
     */
    public static function policyScope()
    {
        if (Settings::getSettings()->multiple_cities && !Auth::user()->access_full) {
            return HomePage::whereIn('city_id', City::policyScope()->pluck('id')->all());
        }
        else {
            return HomePage::all();
        }
    }    
}
