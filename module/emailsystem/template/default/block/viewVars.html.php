<?php
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Attachment
 * @version 		$Id: add.html.php 2285 2011-02-01 15:59:25Z Miguel_Espinoza $
 */

defined('PHPFOX') or exit('NO DICE!');

?>
{literal}
<style type="text/css">
    .lstVars ul
    {
        list-style: none;
        margin-top: 0px;
        margin-bottom: 0px;
        padding-left: 0px;
    }
    .lstVars ul li
    {
        padding-right: 0;
    }    
</style>
{/literal}
<div class="lstVars" align="center">
    <ul style="">
        {foreach from=$lstVars item=v key=iv}
            <li class="go_left emoticon_preview" style="width:30% ;">
                <a style="text-decoration: none;" href="javascript:void(0)" onclick="Phpfox.EmailSystem.InsertVar('{$editor}','\[{$v.var_display}]');tb_remove();" title="{$v.var_description}">[{$v.var_display}]</a>
            </li>
        {/foreach}
    </ul>
</div>
<script type="text/javascript">Phpfox.loadInit();</script>
{literal}
<script type="text/javascript">
    
</script>
{/literal}

