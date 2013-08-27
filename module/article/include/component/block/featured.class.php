<?php

defined('PHPFOX') or exit('NO DICE!');

class Article_Component_Block_Featured extends Phpfox_Component
{

	public function process()
	{

			$aArticles = Phpfox::getService('article')->getFeaturedArticles(3);
			
			$this->template()->assign(array(										
					'sHeader' => 'Featured Articles',
					'aFArticles' => $aArticles
				)
			);	
		
		return 'block';
	}

}

?>