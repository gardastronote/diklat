<?php
class MemoController extends BaseController
{
	public function index(){
		$memos = Memo::orderBy('created_at','DESC')->paginate(10);
		return View::make('diklat.task.memo.index',array(
			'user'=>$this->user,
			'memos'=>$memos
			));
	}
	public function view($id){
		$memo = Memo::find($id);
		$comments = $memo->comments;
		return View::make('diklat.task.memo.view',array(
			'memo'=>$memo,
			'user'=>$this->user,
			'comments'=>$comments
			));
	}

	public function post_add(){
		$memo = Input::all();
		$validate = Validator::make($memo,Memo::rules(),Memo::$messages);
		if($validate->passes()){
			if(isset($memo['memo'])){
				$pdf = $memo['memo'];
				$name = Str::random(32);
				$path = public_path().'/memo/';
				$name = $name.'.pdf';
				$pdf->move($path,$name);

				$memo['memo'] = $name;
			}
			Memo::create($memo);
			return Redirect::to('/data-memo')->with('alert-success','Memo berhasil di tambahkan');
		}
		return Redirect::to('/data-memo/add')->withErrors($validate)->withInput();
	}

	public function delete($id){
		$memo = Memo::find($id);
		if(!count($memo)>0){
			App::abort(404,'Halaman tidak di temukan');
		}
		if($memo->memo !== NULL || !empty($memo->memo)){
			File::delete(public_path().'/memo/'.$memo->memo);
		}
		$coments = Memo_comment::where('id_memo','=',$id)->delete();
		$delete = $memo->delete();
		if(!$delete || !$coments){
			return Redirect::back()->with('alert-error',ERR_DEV);
		}
		
			return Redirect::to('/data-memo')->with('alert-success','Memo berhasil di hapus');
	}

	public function post_edit(){
		$input = Input::all();
		$validate = Validator::make($input,Memo::rules($input['id']),Memo::$messages);
		if($validate->passes()){
			$memoData = Memo::find($input['id']);
			if(isset($input['memo'])){
				$pdf = $input['memo'];
				$name = Str::random(32);
				$path = public_path().'/memo/';
				$name = $name.'.pdf';
				$pdf->move($path,$name);
				
				$input['memo'] = $name;
				
				if(!empty($memoData->memo)){
					File::delete(public_path().'/memo/'.$memoData->memo);
				}
			}
			if($input['memo'] == ''){
				unset($input['memo']);
			}
			$edit = $memoData->update($input);
			if($edit){
				return Redirect::to('/data-memo')->with('alert-success','Memo berhasil di ubah');
			}
			return Redirect::back()->with('alert-error',ERR_DEV);
		}

		return Redirect::back()->withErrors($validate)->with('alert-error','Memo gagal di ubah');
	}

	public function deleteMemo($id){
		$memo = Memo::find($id);
		if(!count($memo)>0){
			App:abort(404,'Halaman tidak ditemukan');
		}
		File::delete(public_path().'/memo/'.$memo->memo);
		$memo->memo = NULL;
		$memo->save();
		return Redirect::action('MemoController@view',$id)->with('alert-success','Memo Berhasil di hapus');
	}

	public function search(){
		$type = Input::get('type');
		$query = Input::get('query');
		if($type !== 'username' && $type !== 'nomor_memo' && $type !== 'nama_memo' && $type !== 'rbb' && $type !== 'karakter'){
			App::abort(404,'Halaman tidak ditemukan');
		}
		if($type == 'rbb'){
			$memos = Memo::whereHas('rbb',function($q){
				$q->where('rbb','LIKE',"%".Input::get('query')."%");
			})->orderBy('updated_at','DESC')->paginate(10);
		}elseif($type == 'username'){
			$memos = Memo::whereHas('user',function($q){
				$q->where('username','LIKE','%'.Input::get('query').'%');
			})->orderBy('updated_at','DESC')->paginate(10);
		}else{
			$memos = Memo::where($type,'LIKE',"%$query%")->paginate(7);
		}

		return View::make('memo.data_memo',array(
			'memos'=>$memos
			));
	}

	public function status($id,$status){
		$memo = Memo::find($id);
		if(!count($memo)>0){
			App::abort(404,'Halaman tidak di temukan');
		}
		if($status != ACCEPTED && $status != REJECTED && $status != EDIT){
			App::abort(404,'Halaman tidak di temukan');
		}
		$memo->status_memo = $status;
		$update = $memo->save();
		$stat = array(
			'id_from'=>Auth::user()->id,
			'obj'=>$status,
			'id_memo'=>$id,
			'id_to'=>$memo->id_user
			);
		Notification::create($stat);
		if(!$update){
			return Redirect::back()->with('alert.error',ERR_DEV);
		}
		return Redirect::back()->with('alert.success','Status memo berhasil di ubah');
	}
}
?>