<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationshipFixed extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('memo_comments',function($table){
			$table->integer('id_user')->unsigned();
			$table->integer('id_memo')->unsigned();
			$table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('id_memo')->references('id')->on('memos')->onDelete('cascade');
		});

		Schema::table('memos',function($table){
			$table->integer('id_rbb')->unsigned();
			$table->integer('id_user')->unsigned();
			$table->foreign('id_rbb')->references('id')->on('rbbs')->onDelete('cascade');
			$table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
			$table->dropForeign('memos_id_rbb_foreign');
			$table->dropForeign('memos_id_user_foreign');
			$table->dropColumn('id_rbb');
			$table->dropColumn('id_user');
		});

		Schema::table('memo_comments',function($table){
			$table->dropForeign('memo_comments_id_memo_foreign');
			$table->dropForeign('memo_comments_id_user_foreign');
			$table->dropColumn('id_user');
			$table->dropColumn('id_memo');
		});
		Schema::table('memo_comments',function($table){
			$table->integer('id_user')->unsigned();
			$table->integer('id_memo')->unsigned();
		});

		Schema::table('memos',function($table){
			$table->integer('id_rbb')->unsigned();
			$table->integer('id_user')->unsigned();
		});
	}

}
