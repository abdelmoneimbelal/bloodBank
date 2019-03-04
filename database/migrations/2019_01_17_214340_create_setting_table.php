<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingTable extends Migration {

	public function up()
	{
		Schema::create('setting', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('phone');
			$table->string('facebok');
			$table->string('twiter');
			$table->string('gmail');
			$table->string('youtube');
			$table->string('instegram');
			$table->string('whats_app');
		});
	}

	public function down()
	{
		Schema::drop('setting');
	}
}