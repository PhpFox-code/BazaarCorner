<?php

defined('PHPFOX') or exit('NO DICE!');

class Article_Component_Controller_Admincp_Index extends Phpfox_Component
{
	public function process()
	{
		if ($aOrder = $this->request()->getArray('order'))
		{
			if (Phpfox::getService('article.category.process')->updateOrder($aOrder))
			{
				$this->url()->send('admincp.article', null, 'Ctaegory order successfully updated.');
			}
		}		
		
		if ($iDelete = $this->request()->getInt('delete'))
		{
			if (Phpfox::getService('article.category.process')->delete($iDelete))
			{
				$this->url()->send('admincp.article', null, 'Category successfully deleted.');
			}
		}
	
		$this->template()->setTitle('Manage Categories')
			->setBreadcrumb('Manage Categories', $this->url()->makeUrl('admincp.article'))
			->setHeader(array(
					'jquery/ui.js' => 'static_script',
					'admin.js' => 'module_article',
					'<script type="text/javascript">Phpfox.article.url(\'' . $this->url()->makeUrl('admincp.article') . '\');</script>'
				)
			)
			->assign(array(
					'sCategories' => Phpfox::getService('article.category')->display('admincp')->get()
				)
			);	
	}
	
}

?>