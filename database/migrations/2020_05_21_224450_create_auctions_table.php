<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuctionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('auctions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('phone');
			$table->string('lat');
			$table->string('lng');
			$table->string('location_name');
			$table->string('owner_name');
			$table->enum('status', ['on', 'off', 'finished', 'canceled', 'pending'])->default('pending');
			$table->longText('details');
			$table->string('start_price');
			$table->longText('primary_image');
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->foreignId('city_id')->constrained()->onDelete('cascade');
			$table->foreignId('country_id')->constrained()->onDelete('cascade');
			$table->foreignId('category_id')->constrained()->onDelete('cascade');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('auctions');
	}
}
