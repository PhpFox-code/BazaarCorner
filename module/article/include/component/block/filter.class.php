<?php

defined('PHPFOX') or exit('NO DICE!');

class Article_Component_Block_Filter extends Phpfox_Component
{

	public function process()
	{
		$this->template()->assign(array(
				'sHeader' => 'Search'
			)
		);	
		
		return 'block';
	}

}

?>