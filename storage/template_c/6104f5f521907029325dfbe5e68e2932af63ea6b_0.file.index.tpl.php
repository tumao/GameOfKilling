<?php
/* Smarty version 3.1.29, created on 2016-03-12 13:44:13
  from "/www/quick/app/views/admin/default/catelogue/index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56e3acad05d070_66798889',
  'file_dependency' => 
  array (
    '6104f5f521907029325dfbe5e68e2932af63ea6b' => 
    array (
      0 => '/www/quick/app/views/admin/default/catelogue/index.tpl',
      1 => 1457761451,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:shared/header.tpl' => 1,
    'file:shared/left.tpl' => 1,
  ),
),false)) {
function content_56e3acad05d070_66798889 ($_smarty_tpl) {
?>
<div class="easyui-layout layout" style="width:100%; height:100%;">
   	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:shared/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:shared/left.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div data-options="region:'center',title:'朱雀管理系统>>菜单',iconCls:'icon-ok'">	<!-- 正文 -->
        <table id="MenuTree" title="使用右键编辑菜单&nbsp;&raquo;&nbsp;<a class='easyui-linkbutton' href='javascript: Menu.append(0);'>新增顶级菜单</a>"></table>	 
    </div>
    <div id="ConMenu" class="easyui-menu" style="width:120px;">
        <div onclick="Menu.edit()" data-options="iconCls:'icon-edit'">编辑</div>
        <div class="menu-sep"></div>
        <div onclick="Menu.append(-1)" data-options="iconCls:'icon-add'">添加</div>
        <div onclick="Menu.removeIt()" data-options="iconCls:'icon-remove'">删除</div>
        <div class="menu-sep"></div>
        <div onclick="Menu.moveup()" data-options="iconCls:'my-icon-moveup'">上移</div>
        <div onclick="Menu.movedown()" data-options="iconCls:'my-icon-movedown'">下移</div>
        <div class="menu-sep"></div>
        <div onclick="Menu.collapse()">折叠</div>
        <div onclick="Menu.expand()">展开</div>
        <div class="menu-sep"></div>
        <div onclick="Menu.reload()" data-options="iconCls:'icon-reload'">刷新</div>
    </div>
    <div class="my-ui-hidden">
        <div id="FormAdd" style="padding:15px;">
            <div style="margin-top: 10px;">
                <span>菜单</span>
                <input id="name" type="text" class="easyui-validatebox" data-options="required:true" />
            </div>
            <div style="margin-top: 10px;">
                <span>路径</span>
                <input id="path" type="text" class="easyui-validatebox" data-options="required:true" />
            </div>
            <div style="margin-top: 10px;">
                <span>图标</span>
                <input id="icon" type="text" />
            </div>
            <div style="margin-top: 10px;">
                <span>备注</span>
                <input id="memo" type="text" />
            </div>
        </div>
    </div>
</div><?php }
}
