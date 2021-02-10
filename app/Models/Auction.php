<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Auction
 * @package App\Models
 * @version May 21, 2020, 12:47 pm UTC
 *
 * @property string $name
 * @property string $phone
 * @property string $lat
 * @property string $lng
 * @property string $location_name
 * @property string $owner_name
 * @property string $status
 * @property string $details
 * @property string $start_price
 * @property integer $user_id
 * @property string $primary_image
 */

class Auction extends Model {

	public $table = 'auctions';

	public $fillable = [
		'id',
		'name',
		'phone',
		'lat',
		'lng',
		'location_name',
		'owner_name',
		'status',
		'details',
		'start_price',
		'user_id',
		'primary_image',
		'category_id',
		'city_id',
		'country_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'name' => 'string',
		'phone' => 'string',
		'lat' => 'string',
		'lng' => 'string',
		'location_name' => 'string',
		'owner_name' => 'string',
		'start_price' => 'string',
		'user_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required|string',
		'phone' => 'required',
		'lat' => 'required|string',
		'lng' => 'required|string',
		'primary_image' => 'required',
		'location_name' => 'string',
		'owner_name' => 'string',
		'details' => 'string',
		'category_id' => 'required|integer|exists:categories,id',
		'city_id' => 'required|integer|exists:cities,id',
		'country_id' => 'required|integer|exists:countries,id',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function category() {
		return $this->hasOne(Category::class, 'id', 'category_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function user() {
		return $this->hasOne('\App\User', 'id', 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function city() {
		return $this->hasOne(City::class, 'id', 'city_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function country() {
		return $this->hasOne(Country::class, 'id', 'country_id');
	}

	public function getPrimaryImageAttribute($value) {
		return ($value) ? \Storage::url($value) : null;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function images() {
		return $this->hasMany(File::class, 'relation_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function offers() {
		return $this->hasMany(Offer::class);
	}

}
