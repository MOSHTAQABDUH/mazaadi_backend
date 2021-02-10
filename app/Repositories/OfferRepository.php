<?php

namespace App\Repositories;

use App\Models\Auction;
use App\Models\Offer;
use App\Notifications\NewOffer;
use App\Repositories\BaseRepository;
use App\User;
use JWTAuth;

/**
 * Class OfferRepository
 * @package App\Repositories
 * @version June 7, 2020, 6:06 am UTC
 */

class OfferRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'price',
		'user_id',
	];

	/**
	 * Return searchable fields
	 *
	 * @return array
	 */
	public function getFieldsSearchable() {
		return $this->fieldSearchable;
	}

	/**
	 * Configure the Model
	 **/
	public function model() {
		return Offer::class;
	}

	public function create($input) {

		$input['user_id'] = JWTAuth::user()->id;

		$model = $this->model->firstOrCreate($input);
		$model->save();

		/*
			                     get order informations
		*/
		$auction = Auction::where('id', $input['auction_id'])->first();

		User::findOrFail($auction->user->id)->notify(new NewOffer($model));
		$user_devices[] = $auction->user->device_id;

		pushNotifications($user_devices, 'new offer on your auction check it', 'offer price = ' . $model->price, 'newOffer', $model);

		return $model;
	}
}
