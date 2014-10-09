<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatusNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('notif',function($table){
			$table->dropColumn('status');
		});
		Schema::table('notif',function($table){
			$table->boolean('status')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('notif',function($table){
			$table->dropColumn('status');
		});
		Schema::table('notif',function($table){
			$table->boolean('status');
		});
	}

}
