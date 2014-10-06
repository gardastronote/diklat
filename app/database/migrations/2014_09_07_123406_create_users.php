<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users',function($table){
			$table->increments('id');
			$table->string('username',32)->unique()->index();
			$table->string('full_name',128);
			$table->string('email',64);
			$table->string('password',128);
			$table->integer('access')->default(1);
			$table->string('avatar',128)->default('default.png');
			$table->string('remember_token',128);
			$table->timestamps();
		});

		Schema::create('memos',function($table){
			$table->increments('id');
			$table->string('nomor_memo',64);
			$table->string('nama_memo',128);
			$table->text('keterangan');
			$table->date('tanggal');
			$table->integer('id_rbb');
			$status = array('public','inhouse');
			$table->enum('status',$status);
			$table->string('karakter',64);
			$table->integer('jumlah');
			$table->integer('lama');
			$table->integer('anggaran');
			$table->integer('id_user');
			$table->timestamps();
		});

		Schema::create('rbbs',function($table){
			$table->increments('id');
			$table->string('rbb',64);
			$table->timestamps();
		});

		Schema::create('memo_comments',function($table){
			$table->increments('id');
			$table->integer('id_memo')->index();
			$table->integer('id_user')->index();
			$table->text('comment');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
		Schema::dropIfExists('memos');
		Schema::dropIfExists('rbbs');
		Schema::dropIfExists('memo_comments');
	}

}
