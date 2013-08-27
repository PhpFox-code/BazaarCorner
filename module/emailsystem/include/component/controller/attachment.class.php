<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');


class EmailSystem_Component_Controller_attachment extends Phpfox_Component 
{
    /**
     * Class process method wnich is used to execute this component.
     */
    public function process()
    {
             
        $request = $this->request();
        if($this->request()->get('req3') == "download")
        {
            $idD = $this->request()->get('req4');
            phpfox::getService('emailsystem.attachment')->downloadFile($idD);
            exit;
        }
        if (isset($_FILES['Filedata']))
        {
            if($_FILES['Filedata']['error'] == 0)
            {
     
                $sFileName = Phpfox::getService('emailsystem.attachment')->uploadAttachmentFiles($_FILES['Filedata']);
                if($sFileName == false)
                {
                    $errors = "";
                    //echo $errors;
                }
                else
                {
                    $aVals = array(
                            'view_id' =>0,
                            'item_id' =>0,
                            'user_id' => Phpfox::getUserId(),
                            'time_stamp' =>PHPFOX_TIME,
                            'file_name' => $_FILES['Filedata']['name'],
                            'file_size' =>$_FILES['Filedata']['size'],
                            'destination' => $sFileName,
                            'extension' =>$this->_getExtension($sFileName),
                            'mine_type' =>'',
                            'is_image' =>0,
                            'counter' =>0,
                        );
                     $id= Phpfox::getService('emailsystem.attachment')->add($aVals);
                     
                     $this->_echo($id) ;
                }
                //$log->lwrite('sFileName'.$sFileName);
            }
        }
        else if (!isset($_FILES['file']))
        {
            exit;
        }
        $this->template()->setTemplate('blank');
       
         
    }
    private function _getExtension($sFileName)
    {
        $index = strrpos($sFileName,'.');
        if ($index >0)
        {
            return substr($sFileName,$index+1);
        }
        return "Unk";
        
    }
    private function _echo($sTxt)
    {
        $str = "([startData])";
        $str .= $sTxt;
        $str.= "([endData])";
        echo $str;
    }
}

?>
