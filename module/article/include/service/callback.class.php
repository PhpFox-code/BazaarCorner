<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * Author		Teamwurkz Technologies Inc.
 * package		phpfox article module 
 */
 
class Article_Service_Callback extends Phpfox_Service 
{

	public function __construct()
	{	
		$this->_sTable = Phpfox::getT('article');
	}

	public function getAttachmentField()
	{
		return array('article', 'article_id');
	}
	
}

?>