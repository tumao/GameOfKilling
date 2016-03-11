function userLogin(){
	var username = $.trim($('#username').val());
	var password = $.trim($('#password').val());
	var remember = $("#remember:checked").size() < 1 ? false : true;
	if(username == ''){
		$('#username').focus();
		return false;
	}
	if(password == '')
	{
		$('#password').focus();
		return false;
	}
	$.ajax({
		'url' 	: '/admin/login',
		'dataType' : 'json',
		'type' 	: 'POST',
		'data' 	: {username:username, password:password, remember:remember},
		'success' : function(rp){
			console.log(rp);
			if(rp.code > 0){
				window.location.href = rp.url;
			}else{
				return $.messager.alert('提示',rp.info,'error');
				$('#password').empty();
				$('#password').focus();
			}
		}
	});
}