<?php
class UserController extends BaseController
{
	public function login(){
		if(Auth::check()):
			return Redirect::to('/');
		endif;
		return View::make('user.login');
	}

	public function postLogin(){
		$input = Input::all();
		$validation = Validator::make($input,User::rulesLogin(),User::messages());
		if($validation->passes()){
			$data = array(
				'username'=>$input['username'],
				'password'=>$input['password']
				);
			if(Auth::attempt($data)){
				return Redirect::to('/data-memo');
			}
			return Redirect::to('/login')->with('error.login','Username atau password salah');
		}
		return Redirect::to('/login')->withErrors($validation)->with('alert-error','User Name atau Password salah');
	}

	public function logout(){
		Auth::logout();
		return Redirect::to('/');
	}

	public function index(){
		switch($this->user->access)
		{
			case ADMIN:
			$users = User::orderBy('updated_at','DESC')->count();
			$memos = Memo::orderBy('created_at','DESC')->count();
			$comments = Memo_comment::orderBy('created_at','DESC')->count();
			return View::make('user.home',array(
				'user'=>$this->user,
				'users'=>$users,
				'memos'=>$memos,
				'comments'=>$comments
				));
			break;

			case PP:
				$memos = Memo::orderBy('created_at','DESC')->count();
				$comments = Memo_comment::orderBy('created_at','DESC')->count();
			return View::make('user.home',array(
				'user'=>$this->user,
				'memos'=>$memos,
				'comments'=>$comments
				));
			case PINGROUP_PP:
				$memos = Memo::orderBy('created_at','DESC')->count();
				$comments = Memo_comment::orderBy('created_at','DESC')->count();
			return View::make('user.home',array(
				'user'=>$this->user,
				'memos'=>$memos,
				'comments'=>$comments
				));
		}
	}

/* =====================================
						ADMIN SCOPE
=======================================*/

	public function admin_user(){
		$users = User::orderBy('created_at','DESC')->paginate(5);
		return View::make('user.admin.user',array(
			'user'=>$this->user,
			'users'=>$users
			));
	}

	public function admin_user_add(){
		return View::make('user.merge',array(
			'user'=>$this->user,
			'header'=>'Tambah User',
			'action'=>'/add_user',
			'submit'=>'Tambah'
			));
	}

	public function admin_user_edit($id){
		$data = User::find($id);
		if(!count($data)>0){
			App::abort(404,'Halaman tidak ada');
		}
		return View::make('user.merge',array(
			'user'=>$this->user,
			'header'=>'Ubah user',
			'action'=>'/edit_user',
			'data'=>$data,
			'submit'=>'Ubah',
			));
	}

	public function admin_user_delete($id){
		if($id == 7){
			return Redirect::back()->with('alert-error','Tidak dapat menghapus super admin');
		}
		$user = User::find($id);
		if($user->avatar !== 'default.png'){
			File::delete(public_path().'/avatar/'.$user->avatar);
		}
		$memos = Memo::where('id_user','=',$id)->get();
		foreach($memos as $memo){
			if($memo->memo !== NULL || !empty($memo->memo)){
				File::delete(public_path().'/memo/'.$memo->memo);
			}
		}
		Memo::where('id_user','=',$id)->delete();
		Memo_comment::where('id_user','=',$id)->delete();
		$user = User::where('id','=',$id)->delete();
		if(!$user){
			return Redirect::back()->with('alert-error',ERR_DEV);
		}
		return Redirect::route('admin_user')->with('alert-success','User berhasil di hapus');
	}

/*===================================
						TASK SCOPE
====================================*/
	public function memo($id){
		$memos = Memo::orderBy('created_at','DESC')->where('id_user','=',$id)->paginate(7);
		return View::make('user.memo',array(
			'user'=>$this->user,
			'memos'=>$memos
			));
	}
	public function comment($id){
		$comments = Memo_comment::orderBy('created_at','DESC')->where('id_user','=',$id)->paginate(7);
		return View::make('user.comment',array(
			'user'=>$this->user,
			'comments'=>$comments
			));
	}
/*===================================
				GLOBAL ACTION
===================================*/

	public function user_addPost(){
		$input = Input::all();
		$validated = Validator::make($input,User::rulesCreate(),User::messages());
		if($validated->passes()){
			if(Input::hasFile('avatar')){
				$avatar = Input::file('avatar');
				$name = Str::random(32);
				$path = public_path().'/avatar/';
				$extension = $avatar->guessClientExtension();
				$name = $name.'.'.$extension;
				$avatar->move($path,$name);
				$input['avatar'] = $name;
			}else{
				unset($input['avatar']);
			}
			$input['password'] = Hash::make($input['password']);
			$created = User::create($input);
			if(!$created){
				return Redirect::back()->with('alert-error',ERR_DEV);
			}
			return Redirect::action('UserController@admin_user')->with('alert-success','User berhasil di tambahkan');
		}
		return Redirect::back()->withErrors($validated)->withInput();
	}
	public function edit(){
		$input = Input::all();
		$user = User::find($input['id']);
		if(!count($user) > 0){
			App:abort(404,'Halaman Tidak ada');
		}
		$rules = User::rulesEdit($input['id']);
		$validated = Validator::make($input,$rules,User::messages());
		if($validated->passes()){
			if(Input::hasFile('avatar')){
				if($user->avatar !== 'default.png'){
					File::delete(public_path().'/avatar/'.$user->avatar);
				}
				$name = Str::random(32);
				$extension = Input::file('avatar')->guessClientExtension();
				$name =$name.'.'.$extension;
				$path = public_path().'/avatar/';
				Input::file('avatar')->move($path,$name);
				$input['avatar'] = $name;
			}else{
				unset($input['avatar']);
			}
			if(empty($input['password'])){
				unset($input['password']);
			}else{
				$input['password'] = Hash::make($input['password']);
			}
			$update = User::find($input['id'])->update($input);
			if(!$update){
				return Redirect::back()->withInput()->with('alert-error',ERR_DEV);
			}
			return Redirect::to('data-user/data/'.$input['id'])->with('alert-success','Profil berhasil di ubah');
		}
		return Redirect::back()->withInput()->withErrors($validated);
	}
	public function profile($id){
		$profile = User::find($id);
		$memos = Memo::where('id_user','=',$id)->paginate(5);
		$comments = Memo_comment::orderBy('created_at','DESC')->where('id_user','=',$id)->get();
		if(!count($profile)>0){
			App::abort(404,'Halaman tidak ada');
		}
		return View::make('user.detail',array(
			'user'=>$this->user,
			'profile'=>$profile,
			'memos'=>$memos,
			'comments'=>$comments
			));
	}

	public function setting(){
		return View::make('user.merge',array(
			'user'=>$this->user,
			'data'=>$this->user,
			'header'=>'Pengaturan',
			'action'=>'/edit_user',
			'submit'=>'Ubah'
			));
	}

	public function deleteAvatar($id){
		$data = User::find($id);
		File::delete(public_path().'/avatar/'.$data->avatar);
		$data->avatar = 'default.png';
		$data->save();
		return Redirect::to('data-user/data/'.$id)->with('alert-success','Avatar berhasil di hapus');
	}


	public function add(){
		$input = Input::all();
		$validated = Validator::make($input,User::rules(),User::messages());
		if($validated->passes()){
			$create = User::create($input);
			if(!$create){
				return Redirect::back()->withInput()->with('alert-error',ERR_DEV);
			}
			return Redirect::route('UserController@profile',$input['username']);
		}
	}

	public function deleteUser($id){
		if($id == 4){
			return Redirect::back()->with('alert-error','Tidak dapat menghapus admin');
		}
		$user = User::find($id);
		if(count($user)>0){
			$delete = $user->delete();
			if($delete)
				return Redirect::back()->withInput()->with('alert-error',ERR_DEV);
		}
		App::abort('404','Halaman tidak di temukan');
	}

	public function search(){
		$type = Input::get('type');
		$query = Input::get('query');
		if($type !== 'full_name' && $type !== 'username' && $type !== 'email' && $type !== 'access'){
			App::abort(404,'Halaman tidak di temukan');
		}
		$users = User::where($type,'LIKE',"%$query%")->paginate(7);
		return View::make('user.search',array(
			'user'=>$this->user,
			'users'=>$users,
			));
	}
}
?>