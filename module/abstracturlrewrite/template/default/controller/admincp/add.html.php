

{*<h1>Manage Url Rewrites by Abstract Enterprises</h1>*}
<h2>Check out our other plugins at <a href="http://phpfoxmods.net" target="_blank"><u>http://phpfoxmods.net</u></a></h2>


{if $bCronCreatedError == true}
<div class="error_message">Please enter all fields!</div>
{/if}

    <form method="post" action="">
        
        {* Header Row *}
        <div class="table_header">
        Add New Url Rewrite 
        </div>
        
            
            
            <div class="table">
                <div class="table_left">
                    Module:
                </div>
                <div class="table_right">
                   Select Module or enter custom:<br> 
                   <select name="module_id">
                   		<option value=""> - </option>
                    {foreach from=$aModules key=sModule item=iModuleId}
                        <option value="{$sModule}" 
                        {if isset($aNewCron.module_id) && $aNewCron.module_id == $iModuleId}selected{/if} >{translate var=$sModule prefix='module'}</option>
                    {/foreach}
                    </select> -OR- <input type="text" size="30" name="url" value="{if isset($aNewCron.url)}{$aNewCron.url}{/if}" /> 
                </div>
                <div class="clear"></div>
            </div>
            
             <div class="table">
                <div class="table_left">
                    Rewrite As:
                </div>
                <div class="table_right">
                   <input type="text" size="30" name="replacement" value="{if isset($aNewCron.replacement)}{$aNewCron.replacement}{/if}" />     
                </div>
                <div class="clear"></div>
            </div>
            
        
        {* Submit Button *}
        <div class="table_clear">
            <input type="hidden" name="abstract_form_posted" value="CRON"  />
            <input type="submit" value="Create" class="button" />
        </div>
        
        
    </form>