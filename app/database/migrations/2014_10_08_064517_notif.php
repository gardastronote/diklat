<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notif extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notif',function($table){
			$table->increments('id');
			$table->integer('id_from')->unsigned();
			$table->foreign('id_from')->references('id')->on('users')->onDelete('cascade');
			$table->integer('obj')->unsigned();
			$table->integer('id_memo')->unsigned();
			$table->foreign('id_memo')->references('id')->on('memos')->onDelete('cascade');
			$table->integer('id_to')->unsigned();
			$table->foreign('id_to')->references('id')->on('users')->onDelete('cascade');
			$table->boolean('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('notif');
	}

}
