<?php
/* Smarty version 3.1.29, created on 2016-03-11 14:42:53
  from "/www/GameOfKilling/app/views/admin/default/shared/left.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56e268ed09d388_93962759',
  'file_dependency' => 
  array (
    '7ff0dc2faf022cd604bd4dd393c03735d7cd1ec1' => 
    array (
      0 => '/www/GameOfKilling/app/views/admin/default/shared/left.tpl',
      1 => 1457666416,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56e268ed09d388_93962759 ($_smarty_tpl) {
?>
<div data-options="region:'west',split:true" title="导航菜单" style="width:250px;">	<!-- 左边栏 BEGIN -->
	<ul id="subMenuTree" __current_menu_id='<?php echo $_smarty_tpl->tpl_vars['current_menu_id']->value;?>
' class="easyui-tree" data-options='{animate:true, data:<?php echo $_smarty_tpl->tpl_vars['leftMenu']->value;?>
,onClick:$.commonlib.submenu_click}'></ul>
</div>	<!-- 左边栏 END--><?php }
}
