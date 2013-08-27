<?php
  class EmailSystem_Service_Settings extends Phpfox_Service
  {
        public function __construct()
        {
            $this->_sTable = Phpfox::getT('emailsystem_receiver_setting');
        }
        public function get($user_id = null)
        {
             if($user_id != null)
             {
                 $res = phpfox::getLib('phpfox.database')->select('*')
                                ->from($this->_sTable)
                                ->where('receiver_id = '.$user_id)
                                ->execute('getRow');
                 if($res)
                 {
                        $res['emailsystem_list'] = unserialize($res['emailsystem_list']); 
                 }
                
                 return $res;
             }
             return array();
        }
        public function update($user_id = null,$aVals)
        {
            if($user_id != null)
            {
                  //$aVals['emailsystem_list'] = serialize($aVals['emailsystem_list']);
                  phpfox::getLib('phpfox.database')->update($this->_sTable,$aVals,'receiver_id ='.$user_id);
            }
            
             
        }
        public function add($aVals,$user_id = null)
        {
            if($user_id != null)
            {
                phpfox::getLib('phpfox.database')->insert($this->_sTable,$aVals);
            }
        }
       
  }
?>
