<?php

namespace App\Repositories;

use App\Models\Auction;
use App\Repositories\BaseRepository;

/**
 * Class AuctionRepository
 * @package App\Repositories
 * @version May 21, 2020, 12:47 pm UTC
 */

class AuctionRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
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
		return Auction::class;
	}

	public function create($input) {

		if (request()->hasFile('primary_image')) {
			$input['primary_image'] = up()->upload([
				'file' => 'primary_image',
				'path' => 'auctions',
				'upload_type' => 'single',
				'delete_file' => '',
			]);
		}

		$model = $this->model->create($input);
		up()->upload([
			'file' => 'images',
			'path' => 'auctions',
			'upload_type' => 'multi',
			'delete_file' => '',
			'file_type' => 'auction',
			'relation_id' => $model->id,
		]);

		$model->save();
		return $model;
	}

	public function update($input, $id) {
		$query = $this->model->newQuery();

		$model = $query->findOrFail($id);
		if (request()->hasFile('primary_image')) {
			$input['primary_image'] = up()->upload([
				'file' => 'primary_image',
				'path' => 'auctions',
				'upload_type' => 'single',
				'delete_file' => $model->image,
			]);
		}

		$model->fill($input);

		up()->upload([
			'file' => 'images',
			'path' => 'auctions',
			'upload_type' => 'multi',
			'delete_file' => $model->images,
			'file_type' => 'auction',
			'relation_id' => $model->id,
		]);
		$model->save();

		return $model;
	}
}
