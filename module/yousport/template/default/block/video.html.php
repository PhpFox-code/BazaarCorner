<script tyle="text/javascript">
 {literal}
$Behavior.yousportvideo = function(){
		var fadeTTime = 0.00001;
		$("#yn_show_latestvideo").click(function(evt){
			evt.preventDefault();
			$("#yn_latestvideo").stop(false, false).fadeIn(fadeTTime, function(){
				$("#yn_topvideo").fadeOut(fadeTTime);
			});
			$("#yn_tab").find(".active").removeClass("active");
			$(this).parent().addClass("active");
			return false;
		});
		$("#yn_show_topvideo").click(function(evt){
			evt.preventDefault();
			$("#yn_topvideo").stop(false, false).fadeIn(fadeTTime, function(){
				$("#yn_latestvideo").fadeOut(fadeTTime);
			});
			$("#yn_tab").find(".active").removeClass("active");
			$(this).parent().addClass("active");
			return false;
		});
		
		$("#yn_topvideo").hide();
		
	};
        {/literal}
</script>

<div class="menu">
    <ul id="yn_tab">
        <li class="first active"><a id="yn_show_latestvideo" href="#">{phrase var='yousport.latest_video'}</a></li>
        <li class="last"><a id="yn_show_topvideo" href="#">{phrase var='yousport.top_videos'}</a></li>
    </ul>
    <div class="clear"></div>
</div>
  
<div style="padding: 10px;">    
        <div id="yn_latestvideo">
        {if !count($aNewVideos)}
            <div class="extra_info">
                {phrase var='yousport.no_videos_found'}
			<ul class="action"><li></li></ul>
            </div>
            {else}
            {foreach from=$aNewVideos item=aNewVideo}

                    <div id="lasted_video"> 

                        <a href="{url link='video/'.$aNewVideo.video_id'/'.$aNewVideo.title'}">
                            {img server_id=$aNewVideo.image_server_id path='video.url_image' file=$aNewVideo.image_path suffix='_120' width=130 height=90 class='js_mp_fix_width' title=$aNewVideo.title}</a><br/>
                        <div class="lasted_video_title">
                            <div style="margin-bottom: 8px;"><a href="{url link='video/'.$aNewVideo.video_id'/'.$aNewVideo.title'}" title="{$aNewVideo.title}">{$aNewVideo.title|clean|shorten:50:"...":false}</a></div>

                            <span class="grey_lv" style="color:#999;">{phrase var='yousport.by'} </span>
                            <a style="color:#3399ff;" href="{$aNewVideo.user_name}" title="{$aNewVideo.user_name}">{$aNewVideo.full_name|clean|shorten:10:"...":false}</a>
                            <br/>
                            <span class="grey_lv" style="color:#999;">{$aNewVideo.total_view} {phrase var='yousport.view'}</span>
                        </div>
                    </div>     
            {/foreach}
             {unset var=$aNewVideos}
            {/if}
            <div class="clear"></div>
        </div>
    <div id="yn_topvideo">
        {if !count($aTopVideos)}
            <div class="extra_info">
                 {phrase var='yousport.no_videos_found'}
			<ul class="action"><li></li></ul>
            </div>
        {else}
            {foreach from=$aTopVideos item=aTopVideo}
                    
                    <div id="lasted_video"> 
                        <a href="{url link='video/'.$aTopVideo.video_id'/'.$aTopVideo.title'}">{img server_id=$aTopVideo.image_server_id path='video.url_image' file=$aTopVideo.image_path suffix='_120' width=130 height=90 class='js_mp_fix_width' title=$aTopVideo.title}</a><br/>
                        <div class="lasted_video_title">
                            <div style="margin-bottom: 8px;">
                                <a href="{url link='video/'.$aTopVideo.video_id'/'.$aTopVideo.title'}" title="{$aTopVideo.title}">{$aTopVideo.title|clean|shorten:50:"...":false}</a></div>
                            <span class="grey_lv" style="color:#999;">{phrase var='yousport.by'}  </span>
                            <a style="color:#3399ff;" href="{$aTopVideo.user_name}" title="{$aTopVideo.user_name}">{$aTopVideo.full_name|clean|shorten:10:"...":false}</a>
                            <br/>
                            <span class="grey_lv" style="color:#999;">{$aTopVideo.total_view} {phrase var='yousport.view'}</span>
                        </div>
                    </div>     
            {/foreach}
            {unset var=$aTopVideos}
        {/if}
        <div class="clear"></div>
    </div>
        
</div>

