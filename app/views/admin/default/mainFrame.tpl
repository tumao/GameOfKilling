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
	{if !empty($currentCss)}
		{foreach $currentCss as $cssFile}
	<link rel="stylesheet" type="text/css" href="{$cssFile}">
		{/foreach}
	{/if}
	<!-- js 脚本 -->
	<script type="text/javascript" src="/resources/public/js/jquery.min.js"></script>
	<script type="text/javascript" src="/resources/public/js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="/resources/admin/default/js/common.js"></script>
	{if !empty($currentJs)}
		{foreach $currentJs as $jsFile}
	<script type="text/javascript" src="{$jsFile}"></script>
		{/foreach}
	{/if}
</head>
<body>
	{include file=$contentTpl}
</body>
</html>