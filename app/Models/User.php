<?php

namespace App\Models;
use Eloquent as Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={"name", "email", "password"},
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      )
 * )
 */
class User extends Model {
	use Notifiable, HasTranslations;
	public $table = 'users';
	public $translatable = ['name'];
	public $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'name' => 'string',
		'email' => 'string',
		'password' => 'string',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required|string',
		'email' => 'required|string',
		'password' => 'required|string',
	];

}
