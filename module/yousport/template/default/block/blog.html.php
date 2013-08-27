<script tyle="text/javascript">
 {literal}
$Behavior.yousportblog = function(){
        var fadeTTime = 0.00001;
        $("#yn_show_latestblog").click(function(evt){
                evt.preventDefault();
                $("#yn_latestblog").stop(false,false).fadeIn(fadeTTime, function(){
                        $("#yn_topblog").fadeOut(fadeTTime);
                });
                $("#yn_tab_blog").find(".active").removeClass("active");
                $(this).parent().addClass("active");
                return false;
        });
        $("#yn_show_topblog").click(function(evt){
                evt.preventDefault();
                $("#yn_topblog").stop(false, false).fadeIn(fadeTTime, function(){
                        $("#yn_latestblog").fadeOut(fadeTTime);
                });
                $("#yn_tab_blog").find(".active").removeClass("active");
                $(this).parent().addClass("active");
                return false;
        });

        $("#yn_topblog").hide();

};
        {/literal}
</script>

<div class="menu">
    <ul id="yn_tab_blog">
        <li class="first active"><a id="yn_show_latestblog" href="#">{phrase var='yousport.latest_blog'}</a></li>
        <li class="last"><a id="yn_show_topblog" href="#">{phrase var='yousport.top_blog'}</a></li>
    </ul>
    <div class="clear"></div>
</div>
<div>
  <div id="yn_latestblog">
        {if !count($aBlogs)}
            <div class="extra_info">
                {phrase var='yousport.no_blogs_found'}
				<ul class="action"><li></li></ul>
            </div>
            {else}
                {foreach from=$aBlogs item=aBlog name=blogs}
                    <div id="blog_frame">
                        <div class="blog_left">
                        {img user=$aBlog suffix='_120_square' class='img_blog' }
                        </div>
                        <div class="blog_right">
                            <div class="title_blog"><a href="{url link='blog/'.$aBlog.blog_id'/'.$aBlog.title'}" title="{$aBlog.title}">{$aBlog.title|clean|shorten:25:"...":false}</a></div>
                        <div class="extra_info">
                             {phrase var='yousport.by'} <a href="{url link=$aBlog.user_name}">{$aBlog.full_name}</a><br/>
                          
                        </div>
                        <div class="blog_content">
                            <span> {$aBlog.text}</b></i></u></span>
                        </div>
                            <div class="extra_info blog_footer">{$aBlog.time_stamp}
                            </div>
                        </div>
                       
                        <div class="clear"></div>
                    </div>
                {/foreach}
                {unset var=$aBlogs}
        {/if}
    </div>
    <div id="yn_topblog">
        {if !count($aTopBlogs)}
        <div class="extra_info">
            {phrase var='yousport.no_blogs_found'}
			<ul class="action"><li></li></ul>
        </div>
        {else}
            {foreach from=$aTopBlogs item=aTopBlog name=blogs}
        <div id="blog_frame">
            <div class="blog_left" >
            {img user=$aTopBlog suffix='_120_square' class='img_blog' }
            </div>
            <div class="blog_right">
                <div class="title_blog"><a href="{url link='blog/'.$aTopBlog.blog_id'/'.$aTopBlog.title'}" title="{$aTopBlog.title}">{$aTopBlog.title|clean|shorten:25:"...":false}</a></div>
                <div class="extra_info">
                     {phrase var='yousport.by'} <a href="{url link=$aTopBlog.user_name}">{$aTopBlog.full_name}</a><br/>
                          
                 </div>                   
                 <div class="blog_content">
                    <span> {$aTopBlog.text}</b></i></u></span>
                </div>
                 <div class="extra_info blog_footer">{$aTopBlog.time_stamp}
                            </div>
            </div>
            <div class="clear"></div>
        </div>
            {/foreach}
            {unset var=$aTopBlogs}
        {/if}
    </div>
</div>
