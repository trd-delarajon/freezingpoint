jQuery(document).ready(function(){
  jQuery('#menu ul li').hover(function(){
	jQuery(this).find('ul:first').slideDown(100);
	jQuery(this).addClass("hover");
	},function(){
	jQuery(this).find('ul').css('display','none');
	jQuery(this).removeClass("hover");
	});
  jQuery('#menu ul li:has(ul)').find("a:first").append(" <span class='menu_more'>»</span> ");
   var menu_width = 0;
		jQuery('#menu ul:first > li').each(function(){
       menu_width = jQuery(this).outerWidth()+menu_width;
		if(menu_width > jQuery(this).parents("ul").innerWidth()){
			jQuery(this).prev().addClass("menu_last_item");
			menu_width = jQuery(this).outerWidth();
			}						   
});
		
		//comment
     jQuery("#comment").focus(function(){
           jQuery(this).parent().find("label").hide();
             }).blur(function(){
				 jQuery(this).parent().find("label").show();
				 });

//// camera slider
           if(jQuery("div.banner").length>0){
			jQuery('#camera_wrap_banner').camera({
				thumbnails: true,
				height: '500px'
			});
		   }

	//Featured home page
	 jQuery(".Featured_item").live({mouseenter:function(){
				jQuery(this).find("img:first").stop().animate({top:"-300px"},{queue:false,duration:400});
				}, mouseleave:function() {
				jQuery(this).find("img:first").stop().animate({top:"0px"},{queue:false,duration:400});
				}
	});
});
