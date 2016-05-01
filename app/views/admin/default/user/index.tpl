<div class="easyui-layout layout" style="width:100%; height:100%;">
   	{include file="shared/header.tpl"}
    {include file="shared/left.tpl"}
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
</div>