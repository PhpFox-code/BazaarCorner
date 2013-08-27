<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

$oTpl->setHeader('cache', array(
		'main.js' => 'style_script'
	)
);

$oTpl->setHeader(array(
		"<!--[if IE 7]>\n\t\t\t<script type=\"text/javascript\" src=\"" . $oTpl->getStyle('jscript', 'ie7.js') . "?v=" . Phpfox::getLib('template')->getStaticVersion() . "\"></script>\n\t\t<![endif]-->"
	)
);
$spage='';
$controller = $oModule->getFullControllerName();
if(phpfox::isUser())
{
    if($controller == 'core.index-member')
    {
        $spage='member index';
    }
    
    else
     $spage='member';
}
else
{
    if($controller == 'core.index-visitor')
        $spage = 'visitor index';
    else
        $spage='visitor';
}
$oTpl->assign(array(
    'spage'=>$spage,
    'controller' => $controller

));

?>