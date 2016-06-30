<div class = "roomheader">
	<span>房间号:</span>
	<span>{$roomid}</span>

</div>
<div class="roombody">
	<div style="width:100px; margin-left:auto; margin-right:auto; margin-bottom:20px;">人员配置信息</div>
	<div class='cell'><span>凶手:</span><span style="margin-left: 20px;">{$killer}</span></div>
	<div class='cell'><span>警察:</span><span style="margin-left: 20px;">{$police}</span></div>
	<div class='cell'><span>平民:</span><span style="margin-left: 20px;">{$commoner}</span></div>
</div>
{if $password neq ''}
<div class="roombody">
	<!-- <span>房间密码：</span><span>{$password}</span> -->
</div>
{/if}
<div class="footer">
	<span>回复房间号可以加入房间进行游戏</span>
</div>