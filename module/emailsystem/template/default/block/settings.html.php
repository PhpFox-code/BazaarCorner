<?php


defined('PHPFOX') or exit('NO DICE!');

?>   

{if count($lst_ems) > 0}
    {literal}
		<script type="text/javascript">
		$Behavior.initBlockEmailSystemSettingsAccount = function (){
		$('#js_block_border_emailsystem_settings').show();
		$('.page_section_menu ul li a').each(function(){
		   if($('.page_section_menu ul li a').index($(this))>0)
		   {
				$(this).bind('click',function(){
			  $('#js_block_border_emailsystem_settings').hide();
		   });
		   }   
		   else
		   {
			   $(this).bind('click',function(){
			  $('#js_block_border_emailsystem_settings').show();
		   });
		   }
		   
		});
		}
		</script>
	{/literal}
    <div class="extra_info m_s">
    {if isset($user_ems_settings.is_receiver_email ) && $user_ems_settings.is_receiver_email eq 0}
        <p id="m_s_p2" style="padding-bottom:5px ;">Select the letters you want to be received from system. If you want to be received email from system. <a href="javascript:void(0)" onclick="javascript:letter(1);return false;">Click here</a></p>  
        <p id="m_s_p1" style="padding-bottom:5px ;display:none;">Select the letters you want to be received from system. If you don't want to be received any more. <a href="javascript:void(0);" onclick="javascript:letter(0)">Click here</a></p>     
    {else}
        <p id="m_s_p1" style="padding-bottom:5px ;">Select the letters you want to be received from system. If you don't want to be received any more. <a href="javascript:void(0);" onclick="javascript:letter(0);return false;">Click here</a></p>      
        <p id="m_s_p2" style="padding-bottom:5px ;display:none;">Select the letters you want to be received from system. If you want to be received email from system. <a href="javascript:void(0);" onclick="javascript:letter(1);return false;">Click here</a></p>  
    {/if}
    </div>
    {if isset($user_ems_settings.is_receiver_email ) && $user_ems_settings.is_receiver_email eq 0} 
    {else}
    <div id="sm_s_t">
    <span><label><font style="color: #333333;font-size: 11px;font-weight: bold;padding: 10px 0 0 0px;">Duration</font> <select name="duration_l" id="durtion_l" onchange="viewgroup_ems(this.value)">
        <option value="-1">All</option>
        <!--<option value="0">One Time</option>-->
        <option value="1">Daily</option>
        <option value="2">Weekly</option>
        <option value="3">Monthly</option>
    </select></label></span>
    <div class="lst_emalsys table" >
         {foreach from=$lst_ems key=index item=ems}
         {if (($ems.weekly_email != 0 && in_array($ems.emailsystem_id,$emsSystems)  &&  ($user_gender==$ems.gender_email || $ems.gender_email==0))|| ($ems.type_id >=3))}
            <div class="checkbox gr_{$ems.weekly_email}">
            <label><input class="checkbox_ls" type="checkbox" value="{$ems.emailsystem_id}" name="gr_{$ems.weekly_email}" {if isset($user_ems_settings.emailsystem_list)}{if  in_array($ems.emailsystem_id,$user_ems_settings.emailsystem_list)}checked{/if}{else}checked{/if}/>{$ems.emailsystem_name|clean|shorten:35:'...'}</label>
            </div>
            {/if}
         {/foreach}
            <div class="checkbox gr_ot2" style="">
                   <label><input class="checkbox_ls" type="checkbox" value="ot2" name="gr_ot2" {if isset($user_ems_settings.emailsystem_list)}{if  in_array('ot2',$user_ems_settings.emailsystem_list)}checked{/if}{else}checked{/if}>Other Email Systems</label> 
            </div>
    </div>
       <a href="javascript:void(0)" onclick="javascript:savesettings()"><input style="margin-bottom:1px;" type="submit" class="button" value="Save"></a> <span id="ajaxLoadding"></span> 
    </div>
    {/if}
{/if}
{literal}
<style type="text/css">
    .lst_emalsys
    {
        margin:10px 0;
    }
    .m_s
    {
         font-size: 12px;
    }
    #js_block_border_emailsystem_settings
    {
         border-bottom: 1px solid #DFDFDF;
        padding: 8px 4px;
        position: relative;
    }
</style>
{/literal}
<script type="text/javascript">
	{literal}
    /*$Behavior.initBlockEmailSystemSettingsAccount = function (){
		$('#js_block_border_emailsystem_settings').show();
		$('.page_section_menu ul li a').each(function(){
		if($('.page_section_menu ul li a').index($(this))>0)
		{
			$(this).bind('click',function(){
			$('#js_block_border_emailsystem_settings').hide();
			});
		}   
		else
		{
			$(this).bind('click',function(){
			$('#js_block_border_emailsystem_settings').show();
			});
		}
   
		});
	}*/

    function viewgroup_ems(v)
    {
        for(index = 0 ; index < 4 ; index++)
        {
            var view_g_v ='.gr_'+index;  
            
            if(v == index || v == -1)
            {
                $(view_g_v).show();
            }
            else
            {
                $(view_g_v).hide();    
            }
        }
    }
    function letter(value)
    {
        
        $.ajaxCall('emailsystem.changeletter','st='+value);  
    }
    function savesettings()
    {
        $('#ajaxLoadding').html($.ajaxProcess(''));
        var length = 0;
        length = $('.checkbox_ls:checked').length;
        var is_receiver_email = 1;
        var val = [];
        $('.checkbox_ls:checked').each(function(i){
          val[i] = $(this).val();
        });
        if(length == 0)
        {
            if(confirm("Are you sure disable emailsystem.You do not receive any email from system ?")) 
            {
                 is_receiver_email = 0;
            }
        }
        $.ajaxCall('emailsystem.saveSetting','lst='+val+'&is_receiver_email='+is_receiver_email);
    }
    function reloadPage()
    {

        if(!document.getElementById('lst_emalsys'))
        {
            window.location.href = self.location.href;
            
        }
    }    
	{/literal}
</script>


