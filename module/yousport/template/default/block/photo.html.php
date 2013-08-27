<link rel="stylesheet" type="text/css" href="{$sCorePath}/module/yousport/static/css/style2.css" />
<script type="text/javascript" src="{$sCorePath}/module/yousport/static/jscript/script.js" ></script>
<script type="text/javascript" src="{$sCorePath}/module/yousport/static/jscript/jquery.easing.js" ></script>
{literal}
<script type="text/javascript">
 $(document).ready( function(){	
		var buttons = { previous:$('#jslidernews2 .button-previous') ,
						next:$('#jslidernews2 .button-next') };			 
		$('#jslidernews2').lofJSidernews( { interval:5000,
                                                    /*easing:'easeInOutQuad',*/
													direction:'opacity',
                                                    duration:1200,
                                                    auto:true,
                                                    mainWidth:627,
                                                    mainHeight:400,
                                                    navigatorHeight: 100,
                                                    navigatorWidth: 367,
                                                    maxItemDisplay:4,
                                                    buttons:buttons } );						
	});

</script>
<style>
	
	ul.lof-main-wapper li {
		position:relative;	
	}
</style>
{/literal}
{if !count($aNewPhotos)}   
{else}
<!------------------------------------- THE CONTENT ------------------------------------------------->
<div id="jslidernews2" class="lof-slidecontent" style="width:957px; height:400px;">
	<div class="preload"><div></div></div>     
    		 <!-- MAIN CONTENT --> 
              <div class="main-slider-content" style="width:627px; height:400px;">
                <ul class="sliders-wrap-inner">
                     {foreach from=$aNewPhotos item=aNewPhoto name=anew} 
                    <li>
                          <img src="{$sCorePath}file/pic/photo/{$aNewPhoto.large_image}" title="{$aNewPhoto.title}" />           
                          <div class="slider-description">
                            <div class="slider-meta">
                                <a title="{$aNewPhoto.title}" href="{url link='photo/'.$aNewPhoto.photo_id'/'.$aNewPhoto.title'}">
                                    {$aNewPhoto.title|clean|shorten:25:"...":false}
                                </a>
								<div class="tp_photo_info"> {$aNewPhoto.description|clean|shorten:150:"...":false}</div>
                            </div>
                         </div>
                    </li> 
                    {/foreach}
                  </ul>  	
            </div>
 		   <!-- END MAIN CONTENT --> 
           <!-- NAVIGATOR -->
           	<div class="navigator-content">
                  <div class="navigator-wrapper">
                        <ul class="navigator-wrap-inner">
                            {foreach from=$aNewPhotos item=aNewPhoto name=anew}
                          <li>
                                <div>
                                    <img src="{$sCorePath}file/pic/photo/{$aNewPhoto.thumb_image}" />
                                    <div class="title_small"> {$aNewPhoto.title|clean|shorten:25:"...":false}<br/>
                                        <span>{$aNewPhoto.time_stamp}</span> 
                                        <br/><span>{phrase var='yousport.by'} <a href="{$aNewPhoto.user_name}">{$aNewPhoto.full_name}</a></span>
                                    </div>
                                </div>    
                            </li>  
                            {/foreach}
                        </ul>
                  </div>
   
             </div> 
          <!----------------- END OF NAVIGATOR --------------------->
         
           
 </div> 
{/if}