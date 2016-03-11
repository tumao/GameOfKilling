<?php
namespace App\Api;

use App\Controllers\BaseController;

class FileController extends BaseController
{
	public function test()
	{
		$test = array(
			'name'	=> 'xiaoming',
			'age'	=> '18',
			'sex'	=> 'female'
			);
		exit(json_encode($test));
	}
}