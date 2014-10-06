<?php
class SearchController extends BaseController
{
	public function index($type,$memo = NULL,$query){
		switch($type)
		{
			case 'user':
			break;
			case 'memo':
				switch($memo)
				{
					case 'rbb':
					break;
					case 'nomor_memo':
				}
			break;
		}
	}
}
?>