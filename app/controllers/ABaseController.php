<?php 
namespace App\Controllers\Admin;

use Core\Controllers\Controller;
use App\Models\Catelogue;

class ABaseController extends Controller
{
	private $menus;

	private $headMenu;

	private $leftMenu;

	private $request_uri;

	private $current_menu_id;

	public $out_put_format = 'tpl';	// 输出数据的格式，默认的是带有模板的一些参数的

	public function __construct()
	{
		parent::__construct();
		$this->__check_is_login();

		// echo $this->out_put_format;exit;
		if($this->out_put_format == 'tpl')
		{
			$this->init_page();
			$this->request_uri = $_SERVER['REQUEST_URI'];
		}

	}

	private function init_page()
	{
		$Cat = new Catelogue;	// catelogue model
		$this->menus = $Cat->show();	// 显示所有的菜单
		$this->request_uri = trim($_SERVER['REQUEST_URI']);
		$this->getHeadMenu();

		$this->view->assign('headMenu',$this->headMenu);
		$this->view->assign('leftMenu', $this->leftMenu);
		$this->view->assign('current_menu_id', $this->current_menu_id);
	}

	private function __check_is_login()
	{
		
		$request_uri = $_SERVER['REQUEST_URI'];
		if(isset($_SESSION['uid']))
		{
			return true;
		}
		else
		{
			if($request_uri != '/admin/login')
			{
				header('location:/admin/login');
			}
		}
	}

	private function getHeadMenu()
	{
		$menus = & $this->menus;
		foreach($menus as $menuItem)
		{
			if($menuItem->root == 0)
			{
				$item['id'] 	= $menuItem->id;
				$item['text']	= $menuItem->name;
				$item['iconCls']= $menuItem->icon;
				if($this->_find_uri_curr($this->request_uri, $menuItem->path))
				{
					$item['checked'] = true;
					$leftMenu = $this->__init_menu_tree($this->menus, $menuItem->id);
					$this->leftMenu = json_encode($leftMenu);
				}
				else
				{
					$item['checked'] = false;
				}
				$item['attributes'] = array(
						'path'	=> $menuItem->path,
					);
				$this->headMenu[] = $item;
			}
		}
	}


	private function __init_menu_tree ($list, $rid)
	{
		$children = $this->__find_child_menu ($list, $rid);
		if (empty ($children))
		{
			return NULL;
		}
		foreach ($children as $k=>$v)
		{
			$res = $this->__init_menu_tree ($list, $v['id']);
			if ($res != NULL)
			{
				$children [$k]['children'] = $res;
			}
			else
			{
				$children [$k]['children'] = NULL;
			}
		}
		return $children;
	}

	private function __find_child_menu ($arr, $rid)
	{
		$children = array();
		foreach($arr as & $x)
		{
			if($x->root == $rid)
			{
				$children[] = array(
					'id'	=>	$x->id,
					'text'	=>	$x->name,
					'iconCls'	=> $x->icon,
					'attribute'	=> array('path'=>$x->path)
					);
				if($this->_find_uri_curr($this->request_uri, $x->path))
				{
					$x->checked = true;
					$this->current_menu_id = $x->id;
				}
				else
				{
					$x->checked = false;
				}
			}
		}
		return $children;
	}



	/**
	 *	判断uri是否在$curr_uri 中出现
	 *
	 *
	 */
	private function _find_uri_curr($curr_uri, $uri)
	{
		$uri	= preg_replace('/(\/)+/iu', '/', $uri);
		return strstr($curr_uri, $uri) !== false;
	}


}