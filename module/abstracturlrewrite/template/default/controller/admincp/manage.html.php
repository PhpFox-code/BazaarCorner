

{*<h1>Manage Url Rewrites by Abstract Enterprises</h1>*}
<h2>Check out our other plugins at <a href="http://phpfoxmods.net" target="_blank"><u>http://phpfoxmods.net</u></a></h2>

<div style="padding:10px;font-size:12pt;"><u>NOTE</u>: Test your custom Url Rewrites thoroughly. May not work with all sections, modules, products, etc.</div>

{if $sAction == 'edit'}
    
    <form method="post" action="">
        
        {* Header Row *}
        <div class="table_header">
        Edit Url Rewrite 
        </div>
            
            <div class="table">
                <div class="table_left">
                    Url:
                </div>
                <div class="table_right">
                    
                    Select Module or enter custom:<br>
                    <select name="module_id">
                    	<option value=""> - </option>
                    {foreach from=$aModules key=sModule item=iModuleId}
                        <option value="{$sModule}" 
                        {if $aCronEdit.url == $iModuleId}selected{/if} >{translate var=$sModule prefix='module'}</option>
                    {/foreach}
                    </select> -OR- <input type="text" size="30" name="url" value="{$aCronEdit.url}" /> 
                </div>
                <div class="clear"></div>
            </div>
            
            
            
            {* BEGIN Row *}
            <div class="table">
                <div class="table_left">
                    Rewrite As:
                </div>
                <div class="table_right">
                   <input type="text" size="30" name="replacement" value="{$aCronEdit.replacement}" />      
                </div>
                <div class="clear"></div>
            </div>
            {* END Row *}
            
              
        
        {* Submit Button *}
        <div class="table_clear">
            <input type="hidden" name="abstract_form_posted" value="CRON"  />
            <input type="submit" value="Update" class="button" />
        </div>
        
        
    </form>
{else}



<table cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3" class="table_header">Url Rewrites</td>
	</tr>
    <tr>
        <th>Url/Module</th>
        <th>Rewrite As</th>
        <th></th>
	</tr>
    {foreach from=$aCrons key=iKey item=aCron}
        <tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
            
            <td>{$aCron.url}</td>
            <td>{$aCron.replacement}</td>
            <td>
            	<a href="{url link=""$aCron.url""}" target="_blank">Test</a> 
                - <a href="{url link="admincp.abstracturlrewrite.manage.edit."$aCron.rewrite_id""}">Edit</a> 
        		- <a href="{url link="admincp.abstracturlrewrite.manage.delete."$aCron.rewrite_id""}" 
                	onclick="return confirm('Are you sure?');">Delete</a> 
            </td>
        </tr>    
    {/foreach}
</table>




{/if}




	
    


