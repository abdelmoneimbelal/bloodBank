<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->integer('age');
			$table->integer('number_ofbage_requierd');
			$table->string('hospital_name');
			$table->integer('phone');
			$table->text('detailes');
			$table->integer('latitude');
			$table->integer('longtude');
            //$table->enum('blood_type',array('O+','O-','A+','A-','B+','B-','AB+','AB-'));
			$table->integer('client_id')->unsigned();
			$table->integer('blood_type_id')->unsigned();
			$table->integer('city_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
