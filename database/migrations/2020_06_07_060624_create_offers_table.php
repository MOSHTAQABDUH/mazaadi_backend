<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('offers', function (Blueprint $table) {
			$table->increments('id');
			$table->decimal('price', 10, 2)->default('0');
			$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
			$table->foreignId('auction_id')->constrained('auctions')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('offers');
	}
}
