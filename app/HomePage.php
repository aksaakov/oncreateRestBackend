<?php

namespace App;

use App\Settings;
use Auth;
use App\City;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $table = 'homepage';
    protected $fillable = ['Title', 'Description', 
    'mon_open', 'mon_close', 'tue_open', 'tue_close', 'wed_open', 'wed_close', 'thu_open', 'thu_close', 'fri_open', 'fri_close', 'sat_open', 'sat_close', 'sun_open', 'sun_close',
    'address', 'phone', 'email', 'facebook', 'twitter', 'instagram', 'email'];
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
