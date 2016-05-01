(function($){
	$.commonlib = (function(){
		this.submenu_click = function(node){
			window.location.href = node.attribute.path;
		};
		this.selsubmenu	= function() {
			if ($('ul#subMenuTree').size() < 1) return true;
			var menuid = $('ul#subMenuTree').attr('__current_menu_id');
			if (menuid == '' || menuid == 0) return false;
			var selectedmenu = $('ul#subMenuTree').tree('find', menuid);
			$('ul#subMenuTree').tree('select', selectedmenu.target);
		};
		return this;
	})();
	
})(jQuery);
$(function(){
	$.commonlib.selsubmenu();
});
