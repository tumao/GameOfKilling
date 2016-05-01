<?php
/* Smarty version 3.1.29, created on 2016-03-11 14:42:53
  from "/www/GameOfKilling/app/views/admin/default/shared/header.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56e268ed0897d5_01652426',
  'file_dependency' => 
  array (
    'a5156f19472367232916812591ad51ed0875d2d2' => 
    array (
      0 => '/www/GameOfKilling/app/views/admin/default/shared/header.tpl',
      1 => 1457666416,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56e268ed0897d5_01652426 ($_smarty_tpl) {
?>
 <div data-options="region:'north'" style="height:90px; background:url(/resources/admin/default/image/header_bg.gif)"><!-- 页头 -->
	<div class="logo">
		<span>后台管理</span>
	</div>
	<div class="navigation">
	<?php if ($_smarty_tpl->tpl_vars['headMenu']->value) {?>
		<?php
$_from = $_smarty_tpl->tpl_vars['headMenu']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_0_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_0_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['attributes']['path'];?>
" 
			class="easyui-linkbutton <?php if ($_smarty_tpl->tpl_vars['item']->value['checked'] == true) {?>check<?php }?>" 
			data-options="iconCls:'<?php echo $_smarty_tpl->tpl_vars['item']->value['iconCls'];?>
'" 
			style="width:80px"><?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>
</a>
		<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
	<?php }?>
	</div>
	<div class="user_info">
		<span>您好，小明</span> |
		<a href="#" data-options="">返回前台</a> |
		<a href="#" data-options="">注销</a>
	</div>
</div><?php }
}
