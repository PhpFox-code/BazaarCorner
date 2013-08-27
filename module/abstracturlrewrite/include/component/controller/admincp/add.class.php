<?php

defined('PHPFOX') or exit('NO DICE!');
 
class Abstracturlrewrite_Component_Controller_Admincp_Add extends Phpfox_Component
{

	public function process()
	{	
		
		$oDb = Phpfox::getLib('phpfox.database');
		
		$aNewCron = $_POST;
		
		$bCronCreated = false;
		$bCronCreatedError = false;
		if(isset($_POST['abstract_form_posted']) && isset($_POST['replacement']) && $_POST['replacement'] != "" 
			&& ((isset($_POST['url']) && $_POST['url'] != "") || (isset($_POST['module_id']) && $_POST['module_id'] != "")) 
		){ 
			
				if($_POST['module_id'] == '' && $_POST['url'] != ''){ $sUrl = $_POST['url']; }
				if($_POST['module_id'] != '' && $_POST['url'] == ''){ $sUrl = $_POST['module_id']; }
				if($_POST['module_id'] != '' && $_POST['url'] != ''){ $sUrl = $_POST['module_id']; }
			
			$aInsert['url'] = $sUrl;
			$aInsert['replacement'] = $_POST['replacement'];
			$iId = $oDb->insert(Phpfox::getT('rewrite'), $aInsert); 
			Phpfox::addMessage('Url Rewrite Created!');
			$bCronCreated = true; 
			
			//Recache Cron File
			Phpfox::getLib('cache')->remove(Phpfox::getParam('core.dir_cache').'rewrite.php', 'path');
		}
		
		if(isset($_POST['abstract_form_posted']) && $bCronCreated != true){ 
			$bCronCreatedError = true;
		}
		
		
		
		$this->template()->setTitle('Manage Url Rewrites by Abstract Enterprises');
		$this->template()->setBreadCrumb('Manage Url Rewrites by Abstract Enterprises', '');
		
	
		Phpfox::getLib('template')
			->assign(
		
			array(
			
				'aNewCron' => $aNewCron,
				'aModules' => Phpfox::getService('admincp.module')->getModules(),
				'bCronCreatedError' => $bCronCreatedError,
			)
		
		);
	}
}

?>

