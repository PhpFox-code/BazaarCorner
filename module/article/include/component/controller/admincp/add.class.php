<?php

defined('PHPFOX') or exit('NO DICE!');

class Article_Component_Controller_Admincp_Add extends Phpfox_Component
{

	public function process()
	{
		$bIsEdit = false;
		if ($iEditId = $this->request()->getInt('id'))
		{
			if ($aCategory = Phpfox::getService('article.category')->getForEdit($iEditId))
			{
				$bIsEdit = true;
				
				$this->template()->setHeader('<script type="text/javascript">$(function(){$(\'#js_mp_category_item_' . $aCategory['parent_id'] . '\').attr(\'selected\', true);});</script>')->assign('aForms', $aCategory);
			}
		}		
		
		if ($aVals = $this->request()->getArray('val'))
		{
			if ($bIsEdit)
			{
				if (Phpfox::getService('article.category.process')->update($aCategory['category_id'], $aVals))
				{
					$this->url()->send('admincp.article.add', array('id' => $aCategory['category_id']), 'Category Successfully Updated.');
				}
			}
			else 
			{
				if (Phpfox::getService('article.category.process')->add($aVals))
				{
					$this->url()->send('admincp.article.add', null, 'Category Successfully Added');
				}
			}
		}
		
		$this->template()->setTitle(($bIsEdit ? 'Edit a Category' : 'Create a new Category'))
			->setBreadcrumb(($bIsEdit ? 'Edit a Category' : 'Create a new Category'), $this->url()->makeUrl('admincp.article'))
			->assign(array(
					'sOptions' => Phpfox::getService('article.category')->display('option')->get(),
					'bIsEdit' => $bIsEdit
				)
			);
	}
	
}

?>