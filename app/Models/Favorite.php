<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Favorite",
 *      required={"user_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="auction_id",
 *          description="auction_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Favorite extends Model {
	public $fillable = [
		'user_id',
		'auction_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'user_id' => 'integer',
		'auction_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'auction_id' => 'required|exists:auctions,id',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\hasMany
	 **/
	public function auctions() {
		return $this->hasMany(Auction::class, 'id', 'auction_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\hasMany
	 **/
	public function user() {
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

}
