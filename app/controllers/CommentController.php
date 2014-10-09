<?php
class CommentController extends BaseController
{
	public function index(){
		$comments = Memo_comment::orderBy('created_at','DESC')->paginate(5);
		return View::make('diklat.task.memo.comment',array(
			'user'=>$this->user,
			'comments'=>$comments
			));
	}

	public function delete($id){
		$comment = Memo_comment::find($id);
		if(!count($comment)>0){
			App::abort(404,'Page tida ada');
		}
		$delete = $comment->delete();
		if(!$delete){
			return Redirect::back()->with('alert-error',ERR_DEV);
		}
		return Redirect::back()->with('alert-success','Komentar berhasil di hapus');
	}

	public function edit($id){
		$comment = Memo_comment::find($id);
		if(!count($comment)>0){
			App::abort(404,'Halaman tidak ada');
		}
		return View::make('diklat.task.memo.edit_comment',array(
			'user'=>$this->user,
			'comment'=>$comment
			));
	}

	public function post_edit(){
		$input = Input::all();
		$validated = Validator::make($input,Memo_comment::rules(),Memo_comment::messages());
		if($validated->passes()){
			$comment = Memo_comment::find($input['id'])->update($input);
			if(!$comment){
				return Redirect::back()->with('alert-error',ERR_DEV);
			}
			return Redirect::to('data-memo/data/'.$input['id_memo'])->with('alert-success','Komentar berhasil di ubah');
		}
		return Redirect::back()->withInput()->withErrors($validated);
	}

	public function post_add(){
		$input = Input::all();
		$validated = Validator::make($input,Memo_comment::rules(),Memo_comment::messages());
		if($validated->passes()){
			//data memo
			$memo = Memo::find($input['id_memo']);
			//Pengaturan notifikasi jika sudah ada yg mengomentari
			$notifs_to = Memo_comment::where('id_memo','=',$input['id_memo'])->select('id_user')->distinct()->get();
			if(count($notifs_to)>0){
				foreach($notifs_to as $notif_to){
					//cek user sama dengan penerima notif
					if($notif_to->id_user !== Auth::user()->id && $notif_to->id_user !== $memo->id_user){
						$notif = array(
							'id_from'=>Auth::user()->id,
							'obj'=>COMMENT,
							'id_memo'=>$input['id_memo'],
							'id_to'=>$notif_to->id_user
							);
						$notif = Notification::create($notif);
						if(!$notif){
							return Redirect::back()->with('alert.error',ERR_DEV);
						}
					}
				}
				if(Auth::user()->id !== $memo->id_user){
					$notif = array(
						'id_from'=>Auth::user()->id,
						'obj'=>COMMENT,
						'id_memo'=>$input['id_memo'],
						'id_to'=>$memo->id_user
						);
					$notif = Notification::create($notif);
					if(!$notif){
						return Redirect::back()->with('alert.error',ERR_DEV);
					}
				}
			}else{
				//mengatur notifikasi jika belum ada yg mengomentari
					$notif = array(
						'id_from'=>Auth::user()->id,
						'obj'=>COMMENT,
						'id_memo'=>$memo->id,
						'id_to'=>$memo->id_user
						);
					$notif = Notification::create($notif);
					if(!$notif){
						return Redirect::back()->with('alert.error',ERR_DEV);
					}
			}
			$create = Memo_Comment::create($input);
			if(!$create){
				return Redirect::back()->with('alert-error',ERR_DEV);
			}
			return Redirect::to('data-memo/data/'.$input['id_memo'])->with('alert-success','Komentar berhasil di tambahkan');
		}
		return Redirect::back()->withErrors($validated)->withInput();
	}
}
?>