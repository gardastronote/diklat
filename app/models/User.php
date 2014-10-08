<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $fillable = array(
		'username',
		'full_name',
		'email',
		'password',
		'access',
		'avatar'
		);

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function rulesLogin(){
		return array(
			'username'=>'required',
			'password'=>'required'
			);
	}

	public static function rulesCreate(){
		return array(
			'username'=>'required|alpha_dash|min:2|max:18|unique:users,username',
			'full_name'=>'required|min:2|max:32',
			'email'=>'email|unique:users,email',
			'password'=>'required|min:3,max:12',
			're_password'=>'required|same:password',
			'avatar'=>'image'
			);
	}

	public static function rulesEdit($id = NULL){
		return array(
			'username'=>"required|alpha_dash|min:2|max:12|unique:users,username,$id",
			'full_name'=>'required|min:2|max:32',
			'password'=>'min:3,max:12',
			're_password'=>'same:password',
			'email'=>"email|unique:users,email,$id",
			'avatar'=>'image'
			);
	}

	public static function messages(){
		return array(
			'unique'=>':attribute sudah di gunakan',
			'required'=>':attribute Harus Di isi',
			'max'=>':attribute Terlalu panjang',
			'min'=>':attribute Terlalu pendek',
			'image'=>':attribute Harus berupa gambar',
			'email'=>'Data yang di masukan harus berupa email',
			're_password.required'=>'Pengulangan password harus di isi',
			're_password.same'=>'Password tidak sama dengan yg dimasukan'
			);
	}

	public static function rules_setting(){
		return array();
	}

	public static function rules_messages(){
		return array();
	}

}
