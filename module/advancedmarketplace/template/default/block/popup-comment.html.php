{literal}<style>
.js_box_content {padding:5px; 15px;}
#comments .js_pager_view_more_link {
    height: 24px;
}
#comments .comment_mini_content {width: 530px; overflow-x:hidden; }
#comments div.comment_mini_content_holder_icon {
    height: 0px;
}
#comments .parent_item_feed .js_feed_comment_border, .item_view .js_feed_comment_border {
    margin: 0px 0px 10px 0px;
}
#comments .parent_item_feed .js_feed_comment_border {border:0px;}
#comments .js_feed_comment_view_more {max-height:200px;overflow-y:scroll;}
#comments .js_pager_view_more_link {display:block;}
#comments .comment_mini_content {max-width: 560px; overflow-x:hidden; }
</style>{/literal}
<div id="comments">
    {module name='advancedmarketplace.comment' aFeed=$aFeed feed_display='mini'}				
</div>
{if Phpfox::isUser()}
{literal}<script type="text/javascript">
$Behavior.initPopup = function()
{    
    var popup = $("#comments").closest(".js_box");
    $('#close-btn').click(function(evt) {	        
		tb_remove();
		return false;
	});    
    var js_box_close = popup.find(".js_box_close");
	setTimeout(function(){js_box_close.hide();}, 1);
}
</script>{/literal}
{/if}