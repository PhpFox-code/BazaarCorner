
<?php
 
class EmailSystem_Component_Controller_Tracking extends Phpfox_Component
{
    public function process()
    {
        $request = $this->request();
        $req3 = $request->get('req3');
        $req4 = $request->get('req4');
        $req5 = $request->get('req5');
       
        if($req4 == null || $req4 == "")
        {
            return false;
        }
       
        if($req4 == "img")//view img
        {
             $req5 = urldecode($req5);
             $url = urldecode(base64_decode($req5));
             if($url == "" || $url == "#")
             {
                 $url = phpfox::getParam('core.path').'module/emailsystem/static/image/img.gif';
             }
             phpfox::getService('emailsystem.tracking')->updateCounterMailRead($req3);
             phpfox::getService('emailsystem.tracking')->saveHistoryEmail($req3);
             header("Location:".$url); 
        }
        if($req4 == "url")
        {
             $req5 = urldecode($req5);
             $url = urldecode(base64_decode($req5));   
             
             if(!strpos($url,'unsubscribe'))
             {
                 if($url == "" || $url == "#" || phpfox::getService('emailsystem.tracking')->url_exist($url) == false)
                 {
                     $url = phpfox::getParam('core.path');
                 }
             }
                
             phpfox::getService('emailsystem.tracking')->updateCounterMailRead($req3);
             phpfox::getService('emailsystem.tracking')->saveHistoryEmail($req3,2);
             Header('Location:'.$url);
        }
        if($req4 =='unsubscribe')
        {
            $req5 = urldecode($req5);
            $url = urldecode(base64_decode($req5));   
            $url ="";
            if($url == "" || $url == "#" || phpfox::getService('emailsystem.tracking')->url_exist($url) == false)
            {
                 $url = phpfox::getParam('core.path');
                 
            }
            phpfox::getService('emailsystem.tracking')->unsubscribeEmailSystem($req3);
            phpfox::getService('emailsystem.tracking')->saveHistoryEmail($req3,-1);
            $this->template()->assign(array(
                'message'=> ' You have unsubcribed this email. You will redirect to homepage in 5 seconds or <a href="'.phpfox::getParam('core.path').'" title="homepage">click here</a>.'
            ));
            $meta = '<meta http-equiv="refresh" content="5;url='.phpfox::getParam('core.path').'"> ';
            $this->template()->setHeader($meta);
            //Header('Location:'.$url);
        }
        
        
    }
}