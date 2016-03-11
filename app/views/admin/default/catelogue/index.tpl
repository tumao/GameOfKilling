<div class="easyui-layout layout" style="width:100%; height:100%;">
   	{include file="shared/header.tpl"}
    {include file="shared/left.tpl"}
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
        <div id="FormAdd">
            <div>
                <span>菜单名</span>
                <input id="name" type="text" class="easyui-validatebox" data-options="required:true" />
            </div>
            <div>
                <span>路径</span>
                <input id="path" type="text" class="easyui-validatebox" data-options="required:true" />
            </div>
            <div>
                <span>图标</span>
                <input id="icon" type="text" />
            </div>
            <div>
                <span>备注</span>
                <input id="memo" type="text" />
            </div>
        </div>
    </div>
</div>