<?php
  class EmailSystem_Service_Notifications extends Phpfox_Service
  {
        public function __construct()
        {
            $this->_sTable = Phpfox::getT('emailsystem_notifications');
        }
        public function get()
        {
             $res = phpfox::getLib('phpfox.database')->select('*')
                                ->from($this->_sTable,'enf')
                                ->join(phpfox::getT('emailsystem'),'es','es.type_id = enf.notifications_type')
                                ->join(phpfox::getT('emailsystem_template'),'et','et.template_id = es.template_id')
                                ->execute('getRows');
             return $res;
        }
        public function update($ems_notification_id = null,$aVals)
        {
            if($ems_notification_id != null)
            {
                  phpfox::getLib('phpfox.database')->update($this->_sTable,$aVals,'ems_notifications_id ='.$ems_notification_id);
            }
            
             
        }
        public function add($aVals,$ems_notification_id = null)
        {
             phpfox::getLib('phpfox.database')->insert($this->_sTable,$aVals);
        }
       
  }
?>
