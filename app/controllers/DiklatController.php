<?php
class DiklatController extends BaseController
{
	public function index(){
		$memos = Memo::orderBy('created_at','DESC')->paginate(5);
		$comments = Memo_comment::orderBy('created_at','DESC')->paginate(5);
		return View::make('diklat.index',array(
			'user'=>$this->user,
			'memos'=>$memos,
			'comments'=>$comments
			));
	}
}
?>