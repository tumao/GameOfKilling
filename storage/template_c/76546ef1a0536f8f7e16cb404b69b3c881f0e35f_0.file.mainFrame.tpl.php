<?php
/* Smarty version 3.1.29, created on 2016-01-31 12:36:10
  from "/www/quick/app/views/admin/default/mainFrame.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56ad8f3a2abc95_88772133',
  'file_dependency' => 
  array (
    '76546ef1a0536f8f7e16cb404b69b3c881f0e35f' => 
    array (
      0 => '/www/quick/app/views/admin/default/mainFrame.tpl',
      1 => 1454214958,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56ad8f3a2abc95_88772133 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>后台</title>

	<!-- 样式 -->
	<link rel="stylesheet" type="text/css" href="/resources/public/css/theme/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="/resources/public/css/theme/icon.css">
	<link rel="stylesheet" type="text/css" href="/resources/public/css/theme/color.css">
	<link rel="stylesheet" type="text/css" href="/resources/admin/default/css/common.css">
	<?php if (!empty($_smarty_tpl->tpl_vars['currentCss']->value)) {?>
		<?php
$_from = $_smarty_tpl->tpl_vars['currentCss']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_cssFile_0_saved_item = isset($_smarty_tpl->tpl_vars['cssFile']) ? $_smarty_tpl->tpl_vars['cssFile'] : false;
$_smarty_tpl->tpl_vars['cssFile'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['cssFile']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['cssFile']->value) {
$_smarty_tpl->tpl_vars['cssFile']->_loop = true;
$__foreach_cssFile_0_saved_local_item = $_smarty_tpl->tpl_vars['cssFile'];
?>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>
">
		<?php
$_smarty_tpl->tpl_vars['cssFile'] = $__foreach_cssFile_0_saved_local_item;
}
if ($__foreach_cssFile_0_saved_item) {
$_smarty_tpl->tpl_vars['cssFile'] = $__foreach_cssFile_0_saved_item;
}
?>
	<?php }?>
	<!-- js 脚本 -->
	<?php echo '<script'; ?>
 type="text/javascript" src="/resources/public/js/jquery.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="/resources/public/js/jquery.easyui.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="/resources/admin/default/js/common.js"><?php echo '</script'; ?>
>
	<?php if (!empty($_smarty_tpl->tpl_vars['currentJs']->value)) {?>
		<?php
$_from = $_smarty_tpl->tpl_vars['currentJs']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_jsFile_1_saved_item = isset($_smarty_tpl->tpl_vars['jsFile']) ? $_smarty_tpl->tpl_vars['jsFile'] : false;
$_smarty_tpl->tpl_vars['jsFile'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['jsFile']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['jsFile']->value) {
$_smarty_tpl->tpl_vars['jsFile']->_loop = true;
$__foreach_jsFile_1_saved_local_item = $_smarty_tpl->tpl_vars['jsFile'];
?>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>
"><?php echo '</script'; ?>
>
		<?php
$_smarty_tpl->tpl_vars['jsFile'] = $__foreach_jsFile_1_saved_local_item;
}
if ($__foreach_jsFile_1_saved_item) {
$_smarty_tpl->tpl_vars['jsFile'] = $__foreach_jsFile_1_saved_item;
}
?>
	<?php }?>
</head>
<body>
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, $_smarty_tpl->tpl_vars['contentTpl']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</body>
</html><?php }
}
