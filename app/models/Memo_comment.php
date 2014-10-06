<?php
class Memo_comment extends Eloquent
{
	protected $table = 'memo_comments';
	protected $fillable = array(
		'id_user',
		'id_memo',
		'comment'
		);
	public static function rules(){
		return array(
			'comment'=>'required'
			);
	}

	public static function messages(){
		return array(
			'required'=>':attribute harus di isi'
			);
	}
	public function user(){
		return $this->belongsTo('user','id_user','id');
	}

	public function memo(){
		return $this->belongsTo('memo','id_memo','id');
	}
}
?>