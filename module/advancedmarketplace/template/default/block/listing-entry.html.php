<div class="grid" >     
    <div class="grid-inner-block">   
     
                  
        <a href="{$aListing.url}" title="{$aListing.title|parse|clean}">
        {if $aListing.image_path != NULL}
            <div class="imgholder"><img style="width:250px;height:{$aListing.image_height}" title="{$aListing.title}" src="{$aListing.image_path}"/>
            <div style="position:absolute; bottom:8px; right:8px; width:46px; height:20px;"><a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fbazaarcorner.com%2F&media={$aListing.url}" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div></div>
        {else}      
            <div class="imgholder"><img style="width:170px;height:{$aListing.image_height}" title="{$aListing.title}" src="{$corepath}module/advancedmarketplace/static/image/default/noimage.png"  /></div>
        {/if}
        </a>
        <p>
        {if $aListing.price > 0}                        
            <div style="background-color:#E3E3E3;border-radius: 5px; font-size: 18px; position:absolute;top:13px; padding-right: 5px;padding-left: 3px;padding-bottom: 2px;padding-top: 2px;left: 10px;"><img src="http://www.bazaarcorner.com/images/tag.png" width="20" height="20" /><font color="#000000"> {$aListing.currency_id|currency_symbol}{$aListing.price}</font></div>
        {/if}
        </p>
        <div class="meta">	  
          
             
             
             
             
<div class="fb-like" data-href="{$aListing.url}" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="lucida grande"> </div>
            <div class="clear"></div>
            <a href="{$aListing.url}">{$aListing.title}</a>
            
            <ul class="icons-order-list">
                <li>
                <?php
                    $past_time = $this->_aVars["aListing"]["time_stamp"];
                    $current_time = time();
                    $diff = $current_time - $past_time;
                    $days = floor($diff/(24*60*60));
                    $remainder = $diff - $days*(24*60*60);
                    $hours = floor($remainder/3600);
                    $remainder = $remainder - ($hours*60*60);
                    $minutes = floor($remainder/60);
                    $seconds = $remainder-$minutes*60;
                    echo $days>0 ? $days .'D': ($hours>0 ? $hours. 'H':($minutes>0?$minutes .'M':''));
                    ?>
                </li>
               
                <li class="comment">
                    {$aListing.aFeed.total_comment}
                </li>
                <li class="buyit">
                {if $aListing.price > 0}
                    <a href="{$aListing.url}">Grab It</a>
                {else}
                    <a href="{url link=$aListing.user_name}">Contact Seller</a>
                {/if}
                </li>
            </ul>
        </div>           
    </div>     
    <div>         
        {module name='advancedmarketplace.comment' aFeed=$aListing.aFeed feed_display='mini'}				
    </div>
    <div class="add-comment"> 
        <a href="{if !Phpfox::isUser()}{url link='user.login'}{/if}" {if Phpfox::isUser()}onclick="popupComment({$aListing.aFeed.item_id});return false;"{/if}>Add Comment</a>
        {if $aListing.aFeed.total_comment > 3}<span style="color:#EFE3E5;">|</span><a style="padding:0px 5px;" href="{$aListing.url}">View All</a>{/if}
    </div>
</div>