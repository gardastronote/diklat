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
		'uses'=>'UserController@index'
		));


	Route::post('/add_user','UserController@user_addPost');
	Route::post('/edit_user','UserController@user_editPost');

	Route::group(array('before'=>'admin'),function(){
		Route::get('/admin','UserController@index');
		Route::get('/admin/user',array(
			'as'=>'admin_user',
			'uses'=>'UserController@admin_user'));
		Route::get('/admin/user/add',array(
			'as'=>'admin_user_add',
			'uses'=>'UserController@admin_user_add'
			));

		Route::get('/admin/user/edit/{id}',array(
			'as'=>'admin_user_edit',
			'uses'=>'UserController@admin_user_edit'
			));
		Route::get('/admin/user/delete/{id}',array(
			'as'=>'admin_user_delete',
			'uses'=>'UserController@admin_user_delete'
			));
	});
	Route::get('/deleteAvatar/{id}','UserController@deleteAvatar');
	Route::get('/setting',array(
		'as'=>'setting',
		'uses'=>'UserController@setting'
		));

	/*===============================
								USER
	===============================*/

	Route::get('/profile',array(
		'uses'=>'UserController@index'
		));
	Route::get('profile/{id}',array(
		'uses'=>'UserController@profile'
		));
	Route::get('profile/{id}/memo',array(
		'as'=>'user_memo',
		'uses'=>'UserController@memo'
		));
	Route::get('profile/{id}/comment',array(
		'as'=>'user_comment',
		'uses'=>'UserController@comment'
		));
	Route::post('/profile/setting',array(
		'uses'=>'UserController@postSetting'
		));

	Route::get('/task',array(
		'as'=>'task',
		'uses'=>'TaskController@index'
		));
	/*--------------------------------------------------------------------
	| User
	|---------------------------------------------------------------------
	*/

	Route::get('/data-user',function(){
		$users = User::orderBy('created_at','DESC')->get();
		return View::make('user.data_user',array(
			'users'=>$users
			));
	});
	Route::get('/data-user/add',function(){
		return View::make('user.merge',array(
			'url'=>'data-user/add',
			'submit'=>'Tambah'
			));
	});
	Route::post('/data-user/add','UserController@add');

	Route::get('/data-user/delete/{id}','UserController@delete');
	Route::get('data-user/data/{id}',function($id){
		$user = User::find($id);
		$memos = Memo::where('id_user','=',$id)->orderBy('created_at','DESC')->paginate(10);
		if(!count($user)>0){
			App::abort(404,'Halaman tidak di temukan');
		}
		return View::make('user.data-user',array(
			'user'=>$user,
			'memos'=>$memos
			));
	});

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

	Route::post('data-user/edit','UserController@edit');

	/*--------------------------------------------------------------------
	| Data memo
	|---------------------------------------------------------------------
	*/
	Route::get('/data-memo/search','MemoController@search');
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
	Route::get('/data-memo/add',function(){
		$user = Auth::user();
		return View::make('memo.merge',array(
			'url'=>'/data-memo/add',
			'user'=>$user,
			'btn'=>'Tambah'
			));
	});
	Route::post('/data-memo/add','MemoController@post_add');
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
	Route::post('/data-memo/edit','MemoController@post_edit');
	Route::get('/data-memo/delete/{id}','MemoController@delete');

	Route::get('/data-memo/status/{id}/{status}','MemoController@status');

	/*--------------------------------------------------------------------
	| Comment memo
	|---------------------------------------------------------------------
	*/

	Route::get('/data-memo/data/comment/{id}',function($id){
		$comment = Memo_comment::find($id);
		if(!count($comment)>0){
			App::abort(404,'Halaman tidak di temukan');
		}
		return View::make('memo.memo-comment',array(
			'comment'=>$comment
			));
	});
	Route::post('/data-memo/data/comment/edit','CommentController@post_edit');
	Route::post('/data-memo/data/comment/add','CommentController@post_add');
	Route::get('/data-memo/data/comment/delete/{id}','CommentController@delete');
	Route::get('/task/memo',array(
		'as'=>'task_memo',
		'uses'=>'MemoController@index'
		));
	Route::get('/task/comment',array(
		'as'=>'task_comment',
		'uses'=>'CommentController@index'
		));

	Route::get('/delete_memo/{id}','MemoController@deleteMemo');

	/*--------------------------------------------------------------------
	| Notification
	|---------------------------------------------------------------------
	*/

	Route::get('/notif',function(){
		$notifs = Notification::where('id_to','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
		return View::make('notif.data_notif',array(
			'notifs'=>$notifs
			));
	});

	/*==================================
							MEMO COMMENT
	==================================*/
	Route::get('/task/memo/comment',array(
		'as'=>'task_memo_comment',
		'uses'=>'CommentController@index'
		));
	Route::get('/task/memo/comment/edit/{id}',array(
		'uses'=>'CommentController@edit'
		));
	Route::post('/task/memo/comment/edit',array(
		'uses'=>'CommentController@postEdit'
		));
	Route::get('/task/memo/comment/delete/{id}',array(
		'uses'=>'CommentController@delete'
		));

	/*==================================
								SEARCH
	==================================*/
	Route::get('/search/user',array(
		'as'=>'search_user',
		'uses'=>'UserController@search'
		));

	Route::get('/search/memo',array(
		'as'=>'serach_memo',
		'uses'=>'MemoController@search'
		));

	Route::get('/task/memo/add','MemoController@add');
	Route::post('/add_memo','MemoController@post');
	Route::post('/task/memo/comment','CommentController@postAdd');
	Route::get('/task/memo/view/{id}','MemoController@view');

	Route::group(array('before'=>'memo'),function(){

		Route::get('/task/memo/delete/{id}','MemoController@delete');
		Route::get('/task/memo/edit/{id}','MemoController@edit');
	});
	Route::post('/edit_memo','MemoController@editPost');
});

Route::get('/login','UserController@login');
Route::get('/logout',array(
	'as'=>'logout',
	'uses'=>'UserController@logout'
	));

Route::post('/login','UserController@postLogin');
Route::get('/feed',function(){
	$user = new User;
	$user->password = Hash::make('admin');
	$user->username = 'pp';
	$user->access = 1;
	$user->save();
});
?>