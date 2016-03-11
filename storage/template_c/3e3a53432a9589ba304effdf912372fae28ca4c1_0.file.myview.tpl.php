<?php
/* Smarty version 3.1.29, created on 2016-01-26 20:35:32
  from "/www/quick/app/views/myview.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56a76814e80227_82616191',
  'file_dependency' => 
  array (
    '3e3a53432a9589ba304effdf912372fae28ca4c1' => 
    array (
      0 => '/www/quick/app/views/myview.tpl',
      1 => 1453811731,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56a76814e80227_82616191 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
 	<h1>这是我自己的模板</h1>
 	<?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
,<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>

</body>
</html><?php }
}
