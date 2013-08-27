<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');



?>
<script type="text/javascript"> var current = '';</script>
<div>
<div id="chart_div" style=""></div>
<div class="clear"></div>
</div>
{if isset($tracklist) && $tracklist.number>0}
<div id="chart_detail" style="margin-bottom: 15px;">
    <div class="table_header">
      Tracking Details
    </div>
    <div>
    <table>
        <tr>
             
            <th style="width:59px;">Date</th> 
            <th style="width:110px;">User</th>
            <th style="width:120px;">Email</th>
            <th style="width:120px;">EmailSystem Name</th>
            <th style="width:40px;">Type</th>
        </tr>
        {foreach from=$trackingdetails key=index item=trd name=trak}
        <tr class="checkRow{if is_int($index/2)} tr{/if}">
             
            <td style="width:59px;">{$trd.readDay}</td> 
            <td style="width:110px;">{$trd|user}</td>
            <td style="width:120px;">{$trd.receiver_email}</td>
            <td style="width:120px;">{$trd.emailsystem_name}</td>
            <td style="width:40px;">{if $trd.tracking_type == 1}View Mail{/if}{if $trd.tracking_type == 2}Click on Mail{/if}{if $trd.tracking_type == -1}Unsubscribe Mail{/if}</td>
                
        </tr>
        {/foreach}
        
    </table>
    {pager}
    </div>
   <div class="clear"></div>
</div>
{/if}
<div class="note" style="margin: 10px 10px 10px;">
    <span style="width: 20px;height:20px;background-color:#9DE580;">&nbsp;&nbsp;&nbsp;&nbsp;</span><span>: Current running email system in queue list.</span>
</div>  
<div class="table_header">
	{phrase var='emailsystem.emailsystems'}
</div>
<div>
	<table>
		<tr>
			<th style="width:20px;"></th>
            <th style="width:20px ;">ID</th> 
            <th style="width:60px;">Name</th> 
			<th>{phrase var='emailsystem.subject'}</th>
            <th>Owner</th>
            <th>Type</th>
			<th style="width: 20px;" align="center">Duration</th>
			<th>Last Run</th>
			<th style="width:120px;">{phrase var='emailsystem.state'}</th>
		</tr>
		{foreach from=$emList item=mailItem key=iKey name=emailsystem}
		<tr id="js_emailsystem_{$mailItem.emailsystem_id}" class="checkRow{if is_int($iKey/2)} tr{/if}" {if $mailItem.state == 1} style="background-color:#9DE580;" {/if}>
         {if $mailItem.state == 1}
            <script> current = '{$mailItem.emailsystem_name}';</script>   
         {/if}
			<td class="t_center">
				<a href="#" class="js_drop_down_link" title="Manage">{img theme='misc/bullet_arrow_down.png' alt=''}</a>
				<div class="link_menu">
					<ul>
                        {if $mailItem.type_id <3}
                    	    <li><a href="{url link='admincp.emailsystem.add' id=$mailItem.emailsystem_id}">{phrase var='emailsystem.edit_emailsystem'}</a></li>
                        {else}    
                            <li><a href="{url link='admincp.emailsystem.notifications.#admincp_emailsystem_form_'.$mailItem.type_id}">{phrase var='emailsystem.edit_emailsystem'}</a></li>
                        {/if}
                        
						{if $mailItem.state == 1 || $mailItem.state == 0}
							<li><a href="{url link='admincp.emailsystem.manage' run=$mailItem.emailsystem_id}" title="{phrase var='emailsystem.process_emailsystem'}">{phrase var='emailsystem.process_emailsystem'}</a></li>
						{/if}
                        {if $mailItem.type_id <3}
						<li><div class="user_delete">
								<a href="{url link='admincp.emailsystem.manage' delete={$mailItem.emailsystem_id}" title="{phrase var='emailsystem.delete_emailsystem_subject' subject=$mailItem.subject|clean}">{phrase var='emailsystem.delete_emailsystem'}</a>
						</div></li>
                        {/if}
                       <li><a href="{url link='admincp.emailsystem.manage' viewstat={$mailItem.emailsystem_id}">View Statistics</a></li>
					</ul>
				</div>
			</td>
            <td>{$mailItem.emailsystem_id}</td>  
            <td>{$mailItem.emailsystem_name}</td>  
			<td>{if $mailItem.type_id !=3}{$mailItem.subject}{else}{$mailItem.template_subject}{/if}</td>
            <td>{$mailItem|user}</td>
            <td>{if $mailItem.type_id eq 1}{phrase var='emailsystem.internal_pm'}{/if}{if $mailItem.type_id eq 2}{phrase var='emailsystem.external_email'}{/if}{if $mailItem.type_id eq 3}Event Malling{/if}</td>
			<td>{if $mailItem.weekly_email eq 1}Daily{/if}{if $mailItem.weekly_email eq 0}One Time{/if}{if $mailItem.weekly_email eq 2}Weekly{/if}{if $mailItem.weekly_email eq 3}Monthly{/if}</td>
			<td>{$mailItem.time_stamp|date:'feed.feed_display_time_stamp'}</td>
			<td>{if $mailItem.state == 0} {phrase var='emailsystem.not_started'} {elseif $mailItem.state == 1} {phrase var='emailsystem.already_started'} {else} {phrase var='emailsystem.completed'} {/if}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="5">
				{phrase var='emailsystem.no_emailsystems_to_show'}
			</td>
		</tr>
		{/foreach}
	</table>
</div>
{if isset($tracklist)}
{if $tracklist.number >0}
    {literal}
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
    <script type="text/javascript">
          google.load("visualization", "1", {packages:["corechart"]});
          google.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Duration');
            data.addColumn('number', 'Read Mail');
            data.addColumn('number', 'Click Link on Mail');
            data.addColumn('number', 'Unsubscribe Mail');
            
            data.addRows({/literal}{$tracklist.number}{literal});
            {/literal}
            {foreach from=$tracklist key=index item=tl name=f}
                {if $index != 'number' && $index !='name_em'}
                    data.setValue({$phpfox.iteration.f}-1, 0, '{$type_view} {$index}');
                    data.setValue({$phpfox.iteration.f}-1, 1, {$tl.total_read});
                    data.setValue({$phpfox.iteration.f}-1, 2, {$tl.total_click});
                    data.setValue({$phpfox.iteration.f}-1, 3, {$tl.total_unsubscribe});
                {/if}
            {/foreach}
           {literal}

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, {width: 700, height: 250, title: 'Email System Statistics {/literal}{$tracklist.name_em}{literal}',
                              hAxis: {title: 'Duration', titleTextStyle: {color: 'red'}}
                             });
          }
        </script>
    <script type="text/javascript">
        
        function loadChart(v)
        {
           // alert('Please waiting to loadding chart');
            $.ajaxCall('emailsystem.loadchart','id='+v);
        }
    </script>
    {/literal}  
{else}
     <script type="text/javascript">
        $('#chart_div').html("<div class='error_message'>There is no data to statistic.</div>");
     </script>
{/if}

{/if}