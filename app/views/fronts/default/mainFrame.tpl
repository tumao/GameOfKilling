<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>
	{if isset($title)}
		{$title}
	{else}
		杀人游戏
	{/if}
	</title>

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
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
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