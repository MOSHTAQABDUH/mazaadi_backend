<?php

namespace App\DataTables;

use App\Models\Auction;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AuctionDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		$dataTable = new EloquentDataTable($query);

		return $dataTable->addColumn('action', 'admin.auctions.datatables_actions')
			->editColumn('primary_image', function ($q) {
				return '<img class="card-img-top img-responsive" src="' . $q->primary_image . '" / alt="' . $q->name . '">';
			})
			->editColumn('user_id', function ($q) {
				return $q->user->name;
			})->rawColumns([
			'user_id',
			'action',
			'primary_image',
		]);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Auction $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Auction $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->columns($this->getColumns())
			->minifiedAjax()
			->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
			->parameters([
				'dom' => 'Bfrtip',
				'stateSave' => true,
				'responsive' => true,
				'autoWidth' => false,
				'order' => [[0, 'desc']],
				'buttons' => [
					[
						'extend' => 'create',
						'className' => 'btn btn-default btn-sm no-corner',
						'text' => '<i class="fa fa-plus"></i> ' . __('auth.app.create') . '',
					],
					[
						'extend' => 'export',
						'className' => 'btn btn-default btn-sm no-corner',
						'text' => '<i class="fa fa-download"></i> ' . __('auth.app.export') . '',
					],
					[
						'extend' => 'print',
						'className' => 'btn btn-default btn-sm no-corner',
						'text' => '<i class="fa fa-print"></i> ' . __('auth.app.print') . '',
					],
					[
						'extend' => 'reset',
						'className' => 'btn btn-default btn-sm no-corner',
						'text' => '<i class="fa fa-undo"></i> ' . __('auth.app.reset') . '',
					],
					[
						'extend' => 'reload',
						'className' => 'btn btn-default btn-sm no-corner',
						'text' => '<i class="fa fa-refresh"></i> ' . __('auth.app.reload') . '',
					],
				],
				'language' => [
					'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/English.json'),
				],
			]);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			'id' => new Column(['title' => __('models/auctions.fields.id'), 'data' => 'id', 'searchable' => false]),
			'name' => new Column(['title' => __('models/auctions.fields.name'), 'data' => 'name', 'searchable' => false]),
			'phone' => new Column(['title' => __('models/auctions.fields.phone'), 'data' => 'phone', 'searchable' => false]),
			'location_name' => new Column(['title' => __('models/auctions.fields.location_name'), 'data' => 'location_name', 'searchable' => false]),
			'owner_name' => new Column(['title' => __('models/auctions.fields.owner_name'), 'data' => 'owner_name', 'searchable' => false]),
			'start_price' => new Column(['title' => __('models/auctions.fields.start_price'), 'data' => 'start_price', 'searchable' => false]),
			'user_id' => new Column(['title' => __('models/auctions.fields.user_id'), 'data' => 'user_id', 'searchable' => false]),

			'status' => new Column(['title' => __('models/auctions.fields.status'), 'data' => 'status', 'searchable' => false]),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return '$MODEL_NAME_PLURAL_SNAKE_$datatable_' . time();
	}
}
