<?php
namespace App\Models;

use Core\Orms\Orm;
use Illuminate\Database\Capsule\Manager as DB;

class Catelogue extends Orm
{
	public $timestamps = false;

	private $tree;

	private $del_ids;

	public function add($data)
	{
		DB::insert('INSERT INTO 
				`catelogues` (name,path,icon,root,memo) 
				VALUES (?,?,?,?,?)',
				[$data['name'],$data['path'],$data['icon'],$data['rid'],$data['memo']]);
		return 1;
	}

	/**
	 * 
	 * 
	 * */
	public function update($data, $id)
	{
		$result = DB::update("UPDATE `catelogues` SET name=? , path=? , icon=? , memo=? WHERE id=?",[$data['name'],$data['path'],$data['icon'],$data['memo'],$id]);
		if($result)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	/**
	 *	删除菜单，包括子菜单
	 *
	 *
	 */
	public function del($id)
	{
		$menus = $this->show();
		$sons = $this->find_son($menus, $id);
		$ids = array();
		if(!empty($this->del_ids))
		{
			foreach($this->del_ids as $v)
			{
				$ids[] = $v->id;
			}
		}
		$ids[] = $id;
		foreach($ids as $x)
		{
			DB::delete('DELETE FROM `catelogues` WHERE `id` = ?',array($x));
		}
		return 1;
		
	}
	// 展示所有的可以显示的菜单项
	public function show()
	{
		$cates = DB::select('SELECT * FROM `catelogues` WHERE `show`=?',[1]);
		return $cates;
	}

	/**
	 *	获取菜单，可以进行分页
	 *	@param int $page 	页码
	 *	@param int $limit 	每页显示信息的条数
	 *	@return array
	 */
	public function getMenus()
	{
		$menus = DB::select('SELECT * FROM `catelogues`');
		
		$tree = $this->__init_menu_tree($menus, 0);
		return $tree;
	}

	private function __init_menu_tree($list, $rid)
	{
		$children = $this->__find_children($list, $rid);
		if(empty($children))
		{
			return NULL;
		}

		foreach($children as $k => $v)
		{
			$res = $this->__init_menu_tree($list, $v->id);
			if($res != NULL)
			{
				$children[$k]->children = $res;
			}
			else
			{
				$children[$k]->children = NULL;
			} 
		}
		return $children;
	}

	private function __find_children($arr, $rid)
	{
		$children = array();
		foreach($arr as & $x)
		{
			if($x->root == $rid)
			{
				$children[] = $x;
			}
		}
		return $children;
	}

	/**
	 *	
	 *
	 *
	 */
	private function find_son($list, $id)
	{
		$children  = $this->__find_children($list, $id);
		if(empty($children))
		{
			return NULL;
		}
		// else
		// {
		// 	$this->del_ids[] = $children;
		// }

		foreach($children as $k => $v)
		{
			$this->find_son($list, $v->id);
			$this->del_ids[] = $v;
		}
		return $children;
	}
}