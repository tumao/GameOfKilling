var List = (function($) {			// 房间列表
	this.createRoom = function(){
		window.location.href = '/opening';		// 页面跳转
	};
	return this;
})(jQuery);

var Opening = (function ($){
	this.addRoom = function (){
		var killer = document.getElementById('killer').value;
		var police = document.getElementById('police').value;
		var commoner = document.getElementById('commoner').value;
		var password = document.getElementById('password').value;

		window.location.href = "/room?killer=" + killer + "&police=" + police + "&commoner=" + commoner + "&password=" + password;
	};
	this.setrole = function (){
		$.ajax ({
			url : '/setRole',
			type :'POST',
			success : function (rp){
				alert ('新一轮游戏的角色分配成功,请游戏成员回复“111”查看自己的身份！');
			}
		});
	};
	this.setresult = function (){
		var id = document.getElementsByName ('result');
		var winid = 0;
		for (var i = 0; i  < id.length; i++)
		{
			if (id[i].checked)
			{
				winid = id[i].value;
			}
		}
		$.ajax ({
			url : '/setResult',
			type : 'GET',
			data : {winid:winid},
			success : function (rp){
				alert ('游戏结果设置成功');
			}
		});
	};
	return this;
})(jQuery);
