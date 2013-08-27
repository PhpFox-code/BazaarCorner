<script tyle="text/javascript">
 {literal}
$Behavior.yousportevent = function(){
		var fadeTTime = 0.00001;
		$("#yn_show_latestevent").click(function(evt){
			evt.preventDefault();
			$("#yn_latestevent").stop(false, false).fadeIn(fadeTTime, function(){
				$("#yn_topevent").fadeOut(fadeTTime);
			});
			$("#yn_tab_event").find(".active").removeClass("active");
			$(this).parent().addClass("active");
			return false;
		});
		$("#yn_show_topevent").click(function(evt){
			evt.preventDefault();
			$("#yn_topevent").stop(false, false).fadeIn(fadeTTime, function(){
				$("#yn_latestevent").fadeOut(fadeTTime);
			});
			$("#yn_tab_event").find(".active").removeClass("active");
			$(this).parent().addClass("active");
			return false;
		});
		
		$("#yn_topevent").hide();
		
	};
        {/literal}
</script>
<div class="menu">
    <ul id="yn_tab_event">
		<li class="first active"><a id="yn_show_latestevent" href="#">{phrase var='yousport.latest_event'}</a></li>
        <li class="last"><a id="yn_show_topevent" href="#">{phrase var='yousport.top_events'}</a></li>
        
    </ul>
    <div class="clear"></div>
</div>

<div>
    <div id="yn_topevent">
        {if !count($aTopEvents)}
            <div class="extra_info">
                {phrase var='yousport.no_events_found'}
				<ul class="action"><li></li></ul>
            </div>
        {else}

            {foreach from=$aTopEvents item=aTopEvent name=events}
            <div id="content_blocks">
                <div class="image_event">
                    <a href="{url link='event/'.$aTopEvent.event_id'/'.$aTopEvent.title'}">
                        {if $aTopEvent.image_path != null}
                            <img src='{$sCorePath}file/pic/event/{$aTopEvent.image_path}' />
                            {else}
                            <img src='{$sCorePath}/theme/frontend/yousport/style/default/image/images/no_photo.jpg' />
                            {/if}
                    </a>
                </div>	
                <div class="image_user_event">				
                        <div class="row_title">	
                            <div class="row_title_image">
                                <a href="{$aTopEvent.user_name}"> {img user=$aTopEvent suffix='_50_square' class='img_blog' }</a>
                            </div>
                             </div>	

                </div>
                 <div class="clear"></div>
                 <div class="tp_event_cont">		
                    <a class="event_title" href="{url link='event/'.$aTopEvent.event_id'/'.$aTopEvent.title'}" title="{$aTopEvent.title}">{$aTopEvent.title|clean|shorten:50:"...":false}</a>																
                    <div class="extra_info"> {$aTopEvent.start_time} · <a href="{$aTopEvent.user_name}">{$aTopEvent.full_name|clean|shorten:25:"...":false}</a></div>
                 </div>
             </div>
            {/foreach}
            {unset var=$aTopEvents}
         {/if}
    </div>
    <div id="yn_latestevent">
        {if !count($aEvents)}
            <div class="extra_info">
                {phrase var='yousport.no_events_found'}
				<ul class="action"><li></li></ul>
            </div>
        {else}

        {foreach from=$aEvents item=aEvent name=events}
        <div id="content_blocks">
            <div class="image_event">
                <a href="{url link='event/'.$aEvent.event_id'/'.$aEvent.title'}">
                    {if $aEvent.image_path != null}
                        <img src='{$sCorePath}file/pic/event/{$aEvent.image_path}' />
                        {else}
                        <img src='{$sCorePath}/theme/frontend/yousport/style/default/image/images/no_photo.jpg' />
                        {/if}
                </a>
            </div>	
            <div class="image_user_event">				
                    <div class="row_title">	
                        <div class="row_title_image">
                            <a href="$aEvent.user_name"> {img user=$aEvent suffix='_50_square' class='img_blog' }</a>
                        </div>
                         </div>	

            </div>
             <div class="clear"></div>
             <div class="tp_event_cont">		
                <a class="event_title" href="{url link='event/'.$aEvent.event_id'/'.$aEvent.title'}" title="{$aEvent.title}">{$aEvent.title|clean|shorten:50:"...":false}</a>																
                <div class="extra_info"> {$aEvent.start_time} · <a href="$aEvent.user_name">{$aEvent.full_name|clean|shorten:25:"...":false}</a></div>
             </div>
         </div>
        {/foreach}
         {unset var=$aEvents}
        {/if}

    </div>
</div>
