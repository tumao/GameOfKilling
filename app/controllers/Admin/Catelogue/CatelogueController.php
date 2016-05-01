<?php
namespace App\Controllers\Admin\Catelogue;

use App\Controllers\Admin\ABaseController;
use App\Models\Catelogue;

class CatelogueController extends ABaseController
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->view->addJs('admin/default/js/catelogue.js');
		if($this->ispost())
		{

		}
		else
		{
			$this->view->show('catelogue/index');
		}
		
	}

	public function tree()
	{
		$Cate = new Catelogue;
		$menus = $Cate->getMenus();
		exit(json_encode($menus));
	}

	/**
	 *	移动菜单项
	 *
	 *
	 */
	public function move()
	{

	}

	/**
	 *	添加菜单项
	 *	@param string name, string icon, string rid, string memo,string path
	 *	@return json
	 */
	public function add()
	{
		$field = ['name', 'icon', 'path', 'rid', 'memo'];
		$data = array();
		foreach ($field as $key => $value)
		{
			$data[$value] = $this->p($value);
		}
		$data['root'] = $this->p('rid');
		$Cate = new Catelogue;
		$result = $Cate->add($data);
		if($result)
		{
			$data['root'] = $data['rid'];
			unset($data['rid']);
			exit(json_encode(array('info'=>'添加成功！','code' => 0, 'data'=>$data)));
		}
		else
		{
			exit(json_encode(array('info'=> '添加失败!', 'code' => -1)));
		}
	}

	/**
	 *	更新菜单项
	 *
	 *
	 */
	public function update()
	{
		$id = $this->p('id');
		$field = ['icon','name','memo','path'];
		$data = array();
		foreach($field as $v)
		{
			$data[$v] = $this->p($v);
		}
		$Cate = new Catelogue;
		$result = $Cate->update($data, $id);
		if($result)
		{
			exit(json_encode(array('code'=>0)));
		}
		else
		{
			exit(json_encode(array('code'=>0,'info'=>'数据更新失败！')));
		}

	}

	/**
	 *	更新
	 *
	 *
	 */
	public function reload()
	{

	}

	/**
	 *	删除
	 *
	 *
	 */
	public function del()
	{
		$id = $this->r('id');
		$Cate = new Catelogue;
		$result = $Cate->del($id);
		if($result)
		{
			exit(json_encode(array('info' => '记录删除成功!', 'code'=>0)));
		}
		else
		{
			exit(json_encode(array('info' => '记录删除失败!', 'code'=> -1)));
		}
	}
}