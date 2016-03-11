<?php
/* Smarty version 3.1.29, created on 2016-01-31 14:56:49
  from "/www/quick/app/views/admin/default/shared/left.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56adb03107a174_42164358',
  'file_dependency' => 
  array (
    '40f92507f6dc860ba9f65dbf8f569f142177ac84' => 
    array (
      0 => '/www/quick/app/views/admin/default/shared/left.tpl',
      1 => 1454223389,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56adb03107a174_42164358 ($_smarty_tpl) {
?>
<div data-options="region:'west',split:true" title="导航菜单" style="width:250px;">	<!-- 左边栏 BEGIN -->
	<ul id="subMenuTree" __current_menu_id='<?php echo $_smarty_tpl->tpl_vars['current_menu_id']->value;?>
' class="easyui-tree" data-options='{animate:true, data:<?php echo $_smarty_tpl->tpl_vars['leftMenu']->value;?>
,onClick:$.commonlib.submenu_click}'></ul>
</div>	<!-- 左边栏 END--><?php }
}
