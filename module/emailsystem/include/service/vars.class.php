<?php
  class EmailSystem_Service_vars extends Phpfox_Service
  {
        public function __construct()
        {
            $this->_sTable = Phpfox::getT('emailsystem_vars');
        }
        
        /**
        * Check exist of varsname
        * 
        * @param mixed $var_display
        */
        public function isExist($var_display = "")
        {
            $var_display = phpfox::getLib('phpfox.database')->escape($var_display);
            $res = phpfox::getLib('phpfox.database')->select('*')
                            ->from($this->_sTable)
                            ->where('var_display = "'.$var_display.'"')
                            ->execute('getSlaveRows');
            if($res != null && count($res) >0)
            {
                return true;
            }
            return false;
        }
        /**
        * Get All list Varsname
        * 
        */
        public function getListVars()
        {
            $res = phpfox::getLib('phpfox.database')->select('*')
                            ->from($this->_sTable)
                            ->execute('getRows');
            if( count($res) <=0)
            {
                return null;
            }
            $lstVars = array();
            foreach($res as $r=>$v)
            {
                    
                $v['var_translate'] = base64_decode($v['var_translate']);
                //$vss ="$unsubscribe_url = phpfox::getService('emailsystem.tracking')->generateunsubscribeTracking("",$mail_id);";
                
                $lstVars[$v['var_display']] = array(
                                                'var_display'=>$v['var_display'],
                                                'var_id' => $v['var_id'],
                                                'var_translate' => $v['var_translate'],
                                                'var_description' => $v['var_description'],
                                                //'var_name' => $v['var_name'],
                                                );
            }
            return $lstVars;
        }
        /**
        * Insert new vars
        * 
        * @param string $aVals
        * @param mixed $isSerialize
        */
        public function add($aVals,$isSerialize = true )
        {
            if($isSerialize == true)
            {
                $aVals['var_translate'] = base64_encode($aVals['var_translate']);
            }
            $iID  = phpfox::getLib('phpfox.database')->insert($this->_sTable,$aVals);
            return $iID;
        }
        /**
        * Get vars name by var_display.
        * 
        * @param mixed $var_display
        */
        public function get($var_display = null)
        {
            if($var_display == null)
            {
                return $this->getListVars();
            }
            $var_display = phpfox::getLib('phpfox.database')->escape($var_display);                 
            $res = phpfox::getLib('phpfox.database')->select('*')
                            ->from($this->_sTable)
                            ->where('var_display = "'.$var_display.'"')
                            ->execute('getSlaveRow');
            if($res != null && count($res) >0)
            {
                return $res;
            }
            return null;
        }
        /**
        * Delete vars
        * 
        * @param mixed $var_display
        */
        public function delete($var_display = null)
        {
            if($var_display !=  null)
            {
                $var_display = phpfox::getLib('phpfox.database')->escape($var_display);  
                phpfox::getLib('phpfox.database')->delete($this->_sTable,
                                        'var_display = "'.$var_display.'"'
                                        );
            }
        }
        /**
        * Update vars.
        * 
        * @param mixed $var_id
        */
        public function update($aVals,$var_id = null)
        {
            if($var_id != null)
            {
                phpfox::getLib('phpfox.database')->update($this->_sTable,$aVals,'var_id = '.$var_id);
            }
        }
        public function tranlate($vars,$params = array())
        {
            $translate_var = unserialize($vars['var_translate']);
            $res = "";
            if(is_array($translate_var))
            {
                $res = eval($translate_var['code']);
            }
            else
            {
                $res = eval("echo ".$translate_var);
            }
            return $res;
        }
  }
?>
