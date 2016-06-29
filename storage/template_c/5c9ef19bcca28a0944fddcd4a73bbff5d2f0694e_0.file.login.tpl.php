<?php
/* Smarty version 3.1.29, created on 2016-05-21 21:06:13
  from "/www/GameOfKilling/app/views/admin/default/user/login.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57405d450d4cc2_26089246',
  'file_dependency' => 
  array (
    '5c9ef19bcca28a0944fddcd4a73bbff5d2f0694e' => 
    array (
      0 => '/www/GameOfKilling/app/views/admin/default/user/login.tpl',
      1 => 1457666416,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57405d450d4cc2_26089246 ($_smarty_tpl) {
?>
<div class="login">
	<div class="easyui-panel" title="后台登陆" style="width:400px;padding:30px 70px 20px 70px; margin-left:auto; margin-right:auto;">
        <div style="margin-bottom:10px">
            <input id="username" class="easyui-textbox" style="width:100%;height:40px;padding:12px" data-options="prompt:'Username',iconCls:'icon-man',iconWidth:38">
        </div>
        <div style="margin-bottom:20px">
            <input id="password" class="easyui-textbox" type="password" style="width:100%;height:40px;padding:12px" data-options="prompt:'Password',iconCls:'icon-lock',iconWidth:38">
        </div>
        <div style="margin-bottom:20px">
            <input id="remember" type="checkbox" checked="checked">
            <span>记住密码</span>
        </div>
        <div>
            <a  href="javascript:void(0)" class="easyui-linkbutton" onclick="userLogin()" data-options="iconCls:'icon-ok'" style="padding:5px 0px;width:100%;">
                <span style="font-size:14px;">登陆</span>
            </a>
        </div>
    </div>
</div><?php }
}
