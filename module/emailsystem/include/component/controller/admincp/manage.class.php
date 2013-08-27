<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Controller_Admincp_Manage extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		// Check if there is any task to handle
        $iId = $this->request()->get('viewstat');
        if($iId)
        {
            
            $params['group_by_month'] =1 ;
            $track = phpfox::getService('emailsystem.tracking')->getTrackingByDuration($iId,null,null,$params);
            $trackingDetails = phpfox::getService('emailsystem.tracking')->getTrackingDetails($iId,null,null,$params);
            $totalNumber = count($trackingDetails);
            $params['limit'] = 10;
            $params['total'] = $totalNumber;
            if(!$this->request()->get('page'))
            {
                $params['page'] = 1;    
            }
            else
            {
                $params['page'] = $this->request()->get('page');
            }
            $trackingDetails = phpfox::getService('emailsystem.tracking')->getTrackingDetails($iId,null,null,$params);
            
            $track['number'] = count($track);
            $type_view = 'Month';
            Phpfox::getLib('pager')->set(array('page' => $params['page'], 'size' => $params['limit'], 'count' => $totalNumber));
             $this->template()->assign(
                    array(
                        'tracklist'=>$track,
                        'type_view'=>$type_view,
                        'trackingdetails'=>$trackingDetails,
                        
                    )
                );
        }
		if ($iId = $this->request()->get('delete'))
		{
			if(Phpfox::getService('emailsystem.process')->delete($iId)) // purge users
			{
				$this->url()->send('admincp.emailsystem.manage', null, Phpfox::getPhrase('emailsystem.emailsystem_successfully_deleted'));
			}
		}
        if($iID = $this->request()->get('run'))
        {
            $send_now = true;
            $limit = phpfox::getParam('emailsystem.x_mail_per_round');
            if($limit < 0 )
            {
                $limit = 10;
            }
            Phpfox::getService('emailsystem.cron')->sendMail($iID,$limit,$send_now);
            phpfox::getService('emailsystem')->setLastRun($iID); 
            $this->url()->send('admincp.emailsystem.manage', null, null);           
        }
		// check if there is any pending job or any user pending their emailsystem.
		if ($sLink = Phpfox::getService('emailsystem')->checkPending())
		{
			$this->template()->assign(array(
					'sError' => $sLink
				)
			);
		}
		$emList = Phpfox::getService('emailsystem')->get();
		$this->template()->assign(array(
				'emList' => $emList
			)
		)
		->setTitle(Phpfox::getPhrase('emailsystem.emailsystem'))
		->setPhrase(array(
				'emailsystem.min_age_cannot_be_higher_than_max_age',
				'emailsystem.max_age_cannot_be_lower_than_the_min_age'
			)
		)
		->setBreadCrumb(Phpfox::getPhrase('emailsystem.emailsystem'),  $this->url()->makeUrl('admincp.emailsystem.add'))
		->setBreadCrumb("Manage Email Systems", null, true)//Phpfox::getPhrase('emailsystem.manage_emailsystems')
		->setEditor(array(
				)
			)
		->setHeader(array('add.js' => 'module_emailsystem'));
	}
}
?>
