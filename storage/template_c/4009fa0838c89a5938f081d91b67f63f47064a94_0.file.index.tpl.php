<?php
/* Smarty version 3.1.29, created on 2016-01-28 18:51:21
  from "/www/quick/app/views/admin/default/user/index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56a9f2a9a62c79_86066758',
  'file_dependency' => 
  array (
    '4009fa0838c89a5938f081d91b67f63f47064a94' => 
    array (
      0 => '/www/quick/app/views/admin/default/user/index.tpl',
      1 => 1453978265,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:shared/header.tpl' => 1,
    'file:shared/left.tpl' => 1,
  ),
),false)) {
function content_56a9f2a9a62c79_86066758 ($_smarty_tpl) {
?>
<div class="easyui-layout layout" style="width:100%; height:100%;">
   	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:shared/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:shared/left.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div data-options="region:'center',title:'朱雀管理系统>>菜单',iconCls:'icon-ok'">	<!-- 正文 -->
   		<table class="easyui-datagrid" style="width:98%; height:80%"
        		data-options="
        			rownumbers:true,
        			singleSelect:true,
        			url:'datagrid.json',
        			method:'get',
        			toolbar:toolbar,
        			pagination:true,
        			pageSize:20
        			">
	        <thead>
	            <tr>
	                <th data-options="field:'itemid',width:80">Item ID</th>
	                <th data-options="field:'productid',width:100">Product</th>
	                <th data-options="field:'listprice',width:80,align:'right'">List Price</th>
	                <th data-options="field:'unitcost',width:80,align:'right'">Unit Cost</th>
	                <th data-options="field:'attr1',width:240">Attribute</th>
	                <th data-options="field:'status',width:60,align:'center'">Status</th>
	            </tr>
	        </thead>
	    </table>
	 
    </div>
</div><?php }
}
