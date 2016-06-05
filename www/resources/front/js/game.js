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

		$.ajax({
			url 	:'/opening',
			data 	: {killer:killer, police:police, commoner:commoner},
			type 	: 'post',
			dataType : 'json',
			success : function (rp){
				
			}
		});
	};
	return this;
})(jQuery);
