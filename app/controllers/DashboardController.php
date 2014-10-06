<?php
class DashboardController extends BaseController
{
	public function menu(){
		return View::make('dashboard');
	}
}
?>