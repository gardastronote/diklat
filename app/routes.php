<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('before'=>'auth'),function(){
	Route::get('/',array(
			'as'=>'root',
			function(){
				$memos = Memo::orderBy('updated_at','DESC')->orderBy('created_at','DESC')->paginate(10);
				return View::make('memo.data_memo',array(
				'memos'=>$memos
				));
			}
		));
	/*--------------------------------------------------------------------
	| User
	|---------------------------------------------------------------------
	*/
	// route untuk menampilkan seluruh data user
	Route::get('/data-user',function(){
		$users = User::orderBy('created_at','DESC')->get();
		return View::make('user.data_user',array(
			'users'=>$users
			));
	});

	// route menampilkan data user untuk di tambahkan
	Route::get('/data-user/add',function(){
		return View::make('user.merge',array(
			'url'=>'data-user/add',
			'submit'=>'Tambah'
			));
	});

	// route untuk submit data user yg di tambahkan
	Route::post('/data-user/add','UserController@add');

	// router untuk menghapus avatar
	Route::get('/deleteAvatar/{id}','UserController@deleteAvatar');

	// route untuk menghapus user
	Route::get('/data-user/delete/{id}','UserController@delete');

	// route untuk menampilkan seluruh memo yg di buat user
	Route::get('data-user/data/{id}',array('before'=>'data-user',function($id){
		$user = User::find($id);
		$memos = Memo::where('id_user','=',$id)->orderBy('created_at','DESC')->paginate(10);
		if(!count($user)>0){
			App::abort(404,'Halaman tidak di temukan');
		}
		return View::make('user.data-user',array(
			'user'=>$user,
			'memos'=>$memos
			));
	}));

	// route untuk menampilkan pengaturan data user
	Route::get('data-user/edit/{id}',function($id){
		$user = User::find($id);
		if(!count($user)>0){
			App::abort(404,'Halaman tidak di temukan');
		}
		return View::make('user.merge',array(
			'user'=>$user,
			'url'=>'data-user/edit',
			'submit'=>'Ubah'
			));
	});

	// route untuk submit hasil pengaturan data user
	Route::post('data-user/edit','UserController@edit');

	/*--------------------------------------------------------------------
	| Data memo
	|---------------------------------------------------------------------
	*/

	// route untuk pencarian data memo
	Route::get('/data-memo/search','MemoController@search');

	// route untuk menampilkan seluruh data memo
	Route::get('/data-memo',function(){
		$memos = Memo::orderBy('updated_at','DESC')->orderBy('created_at','DESC')->paginate(10);
		return View::make('memo.data_memo',array(
			'memos'=>$memos
			));
	});

	//data memo unchecked
	Route::get('/data-memo/unchecked',function(){
		$memos = Memo::where('status_memo','=',0)->orderBy('created_at','DESC')->paginate(10);
		return View::make('memo.data_memo',array(
			'memos'=>$memos
			));
	});
	//data memo accepted
	Route::get('/data-memo/accepted',function(){
		$memos = Memo::where('status_memo','=',1)->orderBy('created_at','DESC')->paginate(10);
		return View::make('memo.data_memo',array(
			'memos'=>$memos
			));
	});
	//data memo edit
	Route::get('/data-memo/edit',function(){
		$memos = Memo::where('status_memo','=',2)->orderBy('created_at','DESC')->paginate(10);
		return View::make('memo.data_memo',array(
			'memos'=>$memos
			));
	});

	//data memo reject
	Route::get('/data-memo/rejected',function(){
		$memos = Memo::where('status_memo','=',3)->orderBy('created_at','DESC')->paginate(10);
		return View::make('memo.data_memo',array(
			'memos'=>$memos
			));
	});

	// route untuk menampilkan detail memo
	Route::get('/data-memo/data/{id}',function($id){
		$notif = Notification::where('id_memo','=',$id)->where('id_to','=',Auth::user()->id)->where('status','=',0)->update(array('status'=>1));;
		$memo = Memo::find($id);
		if(!count($memo)>0){
			App::abort(404,'Halaman tidak di temukan');
		}
		$comments = Memo_comment::where('id_memo','=',$id)->orderBy('created_at','DESC')->get();

		return View::make('memo.memo',array(
			'memo'=>$memo,
			'comments'=>$comments
			));
	});

	// route untuk menambahkan memo
	Route::get('/data-memo/add',function(){
		$user = Auth::user();
		return View::make('memo.merge',array(
			'url'=>'/data-memo/add',
			'user'=>$user,
			'btn'=>'Tambah'
			));
	});

	// route untuk submit menambahkan memo
	Route::post('/data-memo/add','MemoController@post_add');

	// route untuk menampilkan form perubahan memo
	Route::get('/data-memo/edit/{id}',function($id){
		$memo = Memo::find($id);
		$user = Auth::user();
		return View::make('memo.merge',array(
			'user'=>$user,
			'url'=>'/data-memo/edit',
			'memo'=>$memo,
			'btn'=>'Ubah'
			));
	});

	// route untuk submit perubahan pada memo
	Route::post('/data-memo/edit','MemoController@post_edit');

	// route untuk menghapus memo
	Route::get('/data-memo/delete/{id}','MemoController@delete');

	// route untuk mengubah status memo
	Route::get('/data-memo/status/{id}/{status}','MemoController@status');

	/*--------------------------------------------------------------------
	| Comment memo
	|---------------------------------------------------------------------
	*/
	// route untuk menambahkan komentar
	Route::post('/data-memo/data/comment/add','CommentController@post_add');

	// route untuk mengubah komentar
	Route::get('/data-memo/data/comment/{id}',function($id){
		$comment = Memo_comment::find($id);
		if(!count($comment)>0){
			App::abort(404,'Halaman tidak di temukan');
		}
		return View::make('memo.memo-comment',array(
			'comment'=>$comment
			));
	});

	// route untuk submit perubahan komentar
	Route::post('/data-memo/data/comment/edit','CommentController@post_edit');

	// route untuk menghapus komentar
	Route::get('/data-memo/data/comment/delete/{id}','CommentController@delete');

	/*--------------------------------------------------------------------
	| Notification
	|---------------------------------------------------------------------
	*/

	// route untuk menampilkan pemberitahuan
	Route::get('/notif',function(){
		$notifs = Notification::where('id_to','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
		return View::make('notif.data_notif',array(
			'notifs'=>$notifs
			));
	});

});


// route untuk menampilkan form login
Route::get('/login','UserController@login');

// route untuk submit data login
Route::post('/login','UserController@postLogin');

// route untuk logout
Route::get('/logout',array(
	'as'=>'logout',
	'uses'=>'UserController@logout'
	));
Route::get('/feed',function(){
	$user = new User;
	$user->password = Hash::make('admin');
	$user->username = 'pp';
	$user->access = 1;
	$user->save();
});
?>