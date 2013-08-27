<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');
/**
 * 
 * 
 * @copyright       [YOUNET_COPYRIGHT]
 * @author          YouNet Company
 * @package         YouNet_Event
 */
?>
<div id="tags">
    {foreach from=$aTags item=aTag}
        <a href="#" onclick="clickTag('{$aTag.key}');" title="{$aTag.key|parse|clean}">{$aTag.key}</a>  
    {/foreach}
</div>