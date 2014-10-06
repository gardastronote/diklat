<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemoNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('memos',function($table){
			$table->dropColumn('memo');
		});
		Schema::table('memos',function($table){
			$table->string('memo',128)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('memos',function($table){
			$table->dropColumn('memo');
		});
	}

}
