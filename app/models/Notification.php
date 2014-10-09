<?php
class Notification extends Eloquent
{
	protected $table = 'notif';
	protected $fillable = array('id_from','obj','id_memo','id_to','status');

	public function from(){
		return $this->belongsTo('User','id_from','id');
	}

	public function to(){
		return $this->belongsTo('User','id_to','id');
	}

	public function memo(){
		return $this->belongsTo('Memo','id_memo','id');
	}
}
?>