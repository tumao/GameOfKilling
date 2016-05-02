<?php 
namespace App\Controllers;

use Core\Controllers\Controller;
use App\Models\Config;

class BaseController extends Controller
{
	public function __construct()
	{
		parent::__construct ();
		$this->view->setTemplateDir (APP_PATH.'/views/fronts/default/');		// 重新设置 模板的目录
	}
}