 <div data-options="region:'north'" style="height:90px; background:url(/resources/admin/default/image/header_bg.gif)"><!-- 页头 -->
	<div class="logo">
		<span>后台管理</span>
	</div>
	<div class="navigation">
	{if $headMenu}
		{foreach $headMenu as $item}
		<a href="{$item.attributes['path']}" 
			class="easyui-linkbutton {if $item.checked == true}check{/if}" 
			data-options="iconCls:'{$item.iconCls}'" 
			style="width:80px">{$item.text}</a>
		{/foreach}
	{/if}
	</div>
	<div class="user_info">
		<span>您好，小明</span> |
		<a href="#" data-options="">返回前台</a> |
		<a href="#" data-options="">注销</a>
	</div>
</div>