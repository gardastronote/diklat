<?php
class TaskController extends BaseController
{
	public function index(){
		switch($this->user->access)
		{
			case ADMIN:
			$users = User::orderBy('updated_at','DESC')->take(5)->get();
			$memos = Memo::orderBy('created_at','DESC')->take(5)->get();
			$rbbs = Rbb::orderBy('created_at','DESC')->take(5)->get();
			$comments = Memo_comment::orderBy('created_at','DESC')->take(5)->get();
			return View::make('diklat.task.admin',array(
				'user'=>$this->user,
				'users'=>$users,
				'memos'=>$memos,
				'rbbs'=>$rbbs,
				'comments'=>$comments
				));
			break;
			case PP:
				$memos = Memo::where('id_user','=',$this->user->id)->take(5)->get();
				$comments = Memo_comment::whereHas('memo',function($q){
					$q->where('id_user','=',$this->user->id);
				})->orderBy('created_at','DESC')->get();
				return View::make('diklat.task.pp',array(
					'user'=>$this->user,
					'memos'=>$memos,
					'comments'=>$comments
					));
			break;
			case PINGROUP_PP:
				$memos = Memo::orderBy('created_at','DESC')->take(5)->get();
				return View::make('diklat.task.pingroup_pp',array(
					'user'=>$this->user,
					'memos'=>$memos,
					));
			break;
		}
	}
}
?>