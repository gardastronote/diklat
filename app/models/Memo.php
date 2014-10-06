<?php
class Memo extends Eloquent
{
	protected $fillable = array(
		'nomor_memo',
		'nama_memo',
		'keterangan',
		'tanggal',
		'id_rbb',
		'status',
		'karakter',
		'jumlah',
		'lama',
		'anggaran',
		'memo',
		'id_user'
		);
	protected $guarded = array('id');


	public static function rules($id=null){
		return array(
			'nomor_memo'=>'required|unique:memos,nomor_memo'.",$id",
			'nama_memo'=>'required',
			'tanggal'=>'required|date_format:Y-m-d',
			'id_rbb'=>'required|numeric',
			'status'=>'required',
			'karakter'=>'required',
			'jumlah'=>'required|numeric',
			'lama'=>'required|numeric',
			'anggaran'=>'required|numeric',
			'id_user'=>'required|numeric',
			'memo'=>'mimes:pdf|max:4096'
			);
	}

	public static $messages = array(
		'unique'=>':attribute Sudah di gunakan',
		'min'=>':attribute terlalu pendek',
		'max'=>':attribute terlalu panjang',
		'nomor_memo.unique'=>'Nomor memo sudah ada',
		'required'=>':attribute harus di isi',
		'numeric'=>':attribute harus berupa angka',
		'memo.mimes'=>'Format file yang dimasukan salah, pastikan file berupa PDF',
		'memo.max'=>'File terlalu besar, pastikan file berupa surat memo'
		);

	public function rbb(){
		return $this->belongsTo('rbb','id_rbb','id');
	}

	public function user(){
		return $this->belongsTo('user','id_user','id');
	}

	public function comments(){
		return $this->hasMany('Memo_comment','id_memo','id')->orderBy('created_at','DESC');
	}
}
?>