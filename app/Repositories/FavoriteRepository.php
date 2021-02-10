<?php

namespace App\Repositories;

use App\Models\Favorite;
use App\Repositories\BaseRepository;

/**
 * Class FavoriteRepository
 * @package App\Repositories
 * @version June 6, 2020, 2:30 pm UTC
 */

class FavoriteRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
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
		return Favorite::class;
	}

	public function create($input) {
		$model = Favorite::firstOrCreate($input);
		$model->save();
		return $model;
	}

	public function update($input, $id) {
		$query = $this->model->newQuery();
		$model = $query->findOrFail($id);
		$model->fill($input);
		$model->save();
		return $model;
	}
}
