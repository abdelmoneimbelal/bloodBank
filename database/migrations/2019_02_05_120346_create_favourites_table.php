<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFavouritesTable extends Migration {

	public function up()
	{
		Schema::create('favourites', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned();
			$table->integer('article_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('favourites');
	}
}