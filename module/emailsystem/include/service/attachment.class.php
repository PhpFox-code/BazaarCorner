<?php
  class EmailSystem_Service_attachment extends Phpfox_Service
  {
        public function __construct()
        {
            $this->_sTable = Phpfox::getT('emailsystem_attachment');
        }
        public function uploadAttachmentFiles($file,$id_file_up = 'Filedata')
        {
            if($file == null)
            {
                return false;
            }
            $oFile = Phpfox::getLib('file');
            $md5Files = 'ems_'.md5($file['name'].PHPFOX_TIME) ;
            $oFile->load($id_file_up,array());
            $sFileName = $oFile->upload($id_file_up, Phpfox::getParam('core.dir_attachment'),$md5Files);  
            if($sFileName == null)
                return false;
            return $sFileName; 
            
        
        }
        public function downloadFile($file_id)
        {
             $res = phpfox::getLib('phpfox.database')->select('*')
                        ->from($this->_sTable)
                        ->where('attachment_id = '.$file_id)
                        ->execute('getRow');
             if($res == null)
             {
                 return false;
             }
             $res['counter'] = $res['counter']+ 1;
             $id = $this->update($res,$res['attachment_id']);
             if (!isset($res['destination']))
             {
                return Phpfox_Error::display(Phpfox::getPhrase('attachment.no_such_download_found'));
             }
             $path = Phpfox::getParam('core.dir_attachment') . sprintf($res['destination'], '');
             Phpfox::getLib('file')->forceDownload($path, $res['file_name'], $res['mime_type'], $res['file_size'], 0);        
             return true;
            
        }
        public function add($aVals)
        {
            $iID  = phpfox::getLib('phpfox.database')->insert($this->_sTable,$aVals);
            return $iID;
        }
        public function get($arrLst = array())
        {
            if($arrLst == null)
            {
                $res = phpfox::getLib('phpfox.database')->select('*')
                        ->from($this->_sTable)
                        ->execute('getRows');
                return $res;
            }
            
            if(count($arrLst) >0 )
            {
                $where = "(";
                foreach($arrLst as $key=>$value )
                {
                    $where.=$value.",";
                }
                $where .= "-1)";    
                $res = phpfox::getLib('phpfox.database')->select('*')
                        ->from($this->_sTable)
                        ->where('attachment_id IN '.$where)
                        ->execute('getRows');
                return $res;
            }
            return null;
            
        }
        /**
        * delete attachment 
        * 
        * @param mixed $template_id
        */
        public function delete($id = null)
        {
            if($id !=  null)
            {
               
                phpfox::getLib('phpfox.database')->delete($this->_sTable,
                                        'attachment_id = '.$id
                                        );
            }
        }
         /**
        * Update attachment info.
        * 
        * @param mixed $template_id
        */
        public function update($aVals,$id = null)
        {
            if($id != null)
            {
                phpfox::getLib('phpfox.database')->update($this->_sTable,$aVals,'attachment_id = '.$id);
                return $id;
            }
            return null;
        }
        
  }
?>
