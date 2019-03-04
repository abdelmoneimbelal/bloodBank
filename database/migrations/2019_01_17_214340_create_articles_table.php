<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('image');
			$table->text('description');
			$table->integer('category_id')->unsigned();
            $table->date('publish_date');
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}
