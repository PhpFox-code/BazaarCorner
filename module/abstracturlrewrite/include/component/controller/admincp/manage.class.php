<?php

defined('PHPFOX') or exit('NO DICE!');
 
class Abstracturlrewrite_Component_Controller_Admincp_Manage extends Phpfox_Component
{

	public function process()
	{	
		//Load Things 
		$oDb = Phpfox::getLib('phpfox.database');
		$aVals = Phpfox::getLib('phpfox.request')->getRequests();
		//print_r($aVals);
		
		//Picture Location 
		$sSiteUrl = str_replace('index.php?do=/','',Phpfox::getParam('core.path'));
		 
		//Set Action 
		$sAction = ''; 
		
		//Perform Update 
		$bCronUpdated = false;
		if(isset($_POST['abstract_form_posted']) && isset($_POST['replacement']) && $_POST['replacement'] != "" 
			&& ((isset($_POST['url']) && $_POST['url'] != "") || (isset($_POST['module_id']) && $_POST['module_id'] != "")) 
		){ 
				
				if($_POST['module_id'] == '' && $_POST['url'] != ''){ $sUrl = $_POST['url']; }
				if($_POST['module_id'] != '' && $_POST['url'] == ''){ $sUrl = $_POST['module_id']; }
				if($_POST['module_id'] != '' && $_POST['url'] != ''){ $sUrl = $_POST['module_id']; }
				
				$aUpdate['url'] = $sUrl;
				$aUpdate['replacement'] = $_POST['replacement'];
				$oDb->update(Phpfox::getT('rewrite'), $aUpdate, "rewrite_id = ".$aVals['req5']);
				$bCronUpdated = true;
				$sAction = 'edit'; 
				Phpfox::addMessage('Rewrite Updated!');
				
				//Recache Cron File
				Phpfox::getLib('cache')->remove(Phpfox::getParam('core.dir_cache').'rewrite.php', 'path');
			
		}
		
		//Get Cron For Edit 
		$aCronEdit = array();
		if(isset($aVals['req4']) && $aVals['req4'] == 'edit' && isset($aVals['req5']) && $aVals['req5'] > 0){ 
			
			$aCronEdit = $oDb
				->select('*')
				->from(Phpfox::getT('rewrite'))
				->where("rewrite_id = ".$aVals['req5'])
				->execute('getSlaveRow');
				$sAction = 'edit'; 
		}
		
		//Delete Cron 
		if(isset($aVals['req4']) && $aVals['req4'] == 'delete' && isset($aVals['req5']) && $aVals['req5'] > 0){ 
			
			$oDb->delete(Phpfox::getT('rewrite'), "rewrite_id = ".$aVals['req5']);
			$sAction = ''; 
			Phpfox::addMessage('Rewrite Deleted!');
			
			//Recache Cron File
			Phpfox::getLib('cache')->remove(Phpfox::getParam('core.dir_cache').'rewrite.php', 'path');
		}
				
		//Get Cron List 
		$aCrons = array();
		if($sAction == ''){
			$aCrons = $oDb
				->select('*')
				->from(Phpfox::getT('rewrite'))
				->order('url ASC')
				->execute('getSlaveRows');		
				
		}		
		
		$this->template()->setTitle('Manage Url Rewrites by Abstract Enterprises');
		$this->template()->setBreadCrumb('Manage Url Rewrites by Abstract Enterprises', '');
	
		Phpfox::getLib('template')
			->assign(
		
			array(
			
				'aCrons' => $aCrons,
				'aCronEdit' => $aCronEdit,
				'bCronUpdated' => $bCronUpdated,
				'sAction' => $sAction,
				'aModules' => Phpfox::getService('admincp.module')->getModules(),
				'sSiteUrl' => $sSiteUrl,
			)
		
		);
	}
}

?>

