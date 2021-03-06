<?php
class UserController extends BaseController
{
	/**
	 * Redirect ke login page
	 * @return View:user.login
	 */
	public function login(){
		if(Auth::check()):
			return Redirect::to('/');
		endif;
		return View::make('user.login');
	}

	/**
	 * Post data login ketika user submit
	 * @return View:memo.data_memo
	 */
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

	/**
	 * Logout user
	 * @return View:user.login
	 */
	public function logout(){
		Auth::logout();
		return Redirect::to('/');
	}

	public function add(){
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
			return Redirect::to('data-user/')->with('alert-success','User berhasil di tambahkan');
		}
		return Redirect::back()->withErrors($validated)->withInput();
	}
	
	public function delete($id){
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
		$user = User::where('id','=',$id)->delete();
		if(!$user){
			return Redirect::back()->with('alert-error',ERR_DEV);
		}
		return Redirect::to('data-user/')->with('alert-success','User berhasil di hapus');
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
			return Redirect::to('data-user/')->with('alert-success','Profil berhasil di ubah');
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

	public function deleteAvatar($id){
		$data = User::find($id);
		File::delete(public_path().'/avatar/'.$data->avatar);
		$data->avatar = 'default.png';
		$data->save();
		return Redirect::to('data-user/')->with('alert-success','Avatar berhasil di hapus');
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