<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Yousport_Service_Yousport extends Phpfox_Service
{
     public function getPhotos($iTotal)
    {
       $aRows = Phpfox::getLib("phpfox.database")->select("p.*,pi.description, u.user_name,u.full_name")
        ->from(phpfox::getT('photo'),'p')
        ->join(Phpfox::getT('user'), 'u', 'u.user_id = p.user_id')
		->join(Phpfox::getT('photo_info'),'pi', 'p.photo_id=pi.photo_id')
        ->where('p.privacy=0 and p.is_featured=1')
        ->order('p.time_stamp DESC')
        ->limit($iTotal)
        ->execute('getSlaveRows');
       foreach ($aRows as $iKey => $aRow)
        {
            $aRows[$iKey]['time_stamp'] = date("F j, Y",$aRow['time_stamp']);
            $aRows[$iKey]['large_image']=str_replace("%s","_1024",$aRow['destination']);
            $aRows[$iKey]['thumb_image']=str_replace("%s","_75",$aRow['destination']);         
        }

        return $aRows;

    }    
    public function getNewVideos($iTotal)
    {
       $aRows = Phpfox::getLib("phpfox.database")->select('*')
        ->from(phpfox::getT('video'),'v')
        ->join(Phpfox::getT('user'), 'u', 'u.user_id = v.user_id')
        ->order('time_stamp DESC')
        ->limit($iTotal)
        ->execute('getSlaveRows');
        
        return $aRows;
                    
    }
    
    public function getTopVideos($iTotal)
    {
       $aRows = Phpfox::getLib("phpfox.database")->select('*')
        ->from(phpfox::getT('video'),'v')
        ->join(Phpfox::getT('user'), 'u', 'u.user_id = v.user_id')
        ->order('total_view DESC')
        ->limit($iTotal)
        ->execute('getSlaveRows');
        
        return $aRows;
                    
    }
     public function getNewBlogs($iTotal)
    {
        $aRows = Phpfox::getLib("phpfox.database")->select('u.*,b.blog_id, b.time_stamp, b.title,b.total_comment,b.total_view, bt.text, b.total_view,'.(Phpfox::getParam('core.allow_html') ? 'bt.text_parsed' : 'bt.text') .' AS text,' . Phpfox::getUserField())
        ->from(Phpfox::getT('blog'), 'b') 
        ->join(Phpfox::getT('user'), 'u', 'b.user_id = u.user_id')
        ->join(Phpfox::getT('blog_text'), 'bt', 'b.blog_id = bt.blog_id')
        ->where('b.privacy = 0')
        ->order('b.time_stamp DESC')
        ->limit($iTotal)
        ->execute('getSlaveRows'); 
        
        foreach ($aRows as $iKey => $aRow)
        {
            $aRows[$iKey]['time_stamp'] = date("F j, Y",$aRows[$iKey]['time_stamp']);
            $text=$aRows[$iKey]['text'];
           
            $aRows[$iKey]['text'] = substr($text, 0, 100) . '...';
           
        }
        return $aRows;   
    }
    
    public function getTopBlogs($iTotal)
    {
         $aRows = Phpfox::getLib("phpfox.database")->select('u.*,b.blog_id, b.time_stamp, b.title,b.total_comment,b.total_view, bt.text, b.total_view,'.(Phpfox::getParam('core.allow_html') ? 'bt.text_parsed' : 'bt.text') .' AS text,' . Phpfox::getUserField())
        ->from(Phpfox::getT('blog'), 'b')
        ->join(Phpfox::getT('user'), 'u', 'b.user_id = u.user_id')
        ->join(Phpfox::getT('blog_text'), 'bt', 'b.blog_id = bt.blog_id')
        ->where('b.privacy = 0')
        ->order('b.total_view DESC')
        ->limit($iTotal)
        ->execute('getSlaveRows'); 
        
        foreach ($aRows as $iKey => $aRow)
        {
            $aRows[$iKey]['time_stamp'] = date("F j, Y",$aRows[$iKey]['time_stamp']);
            $text=$aRows[$iKey]['text'];
           
            $aRows[$iKey]['text'] = substr($text, 0, 100) . '...';
            
        }

        return $aRows;   
    }

      public function getNewEvents($iTotal) {
        $aRows = Phpfox::getLib("phpfox.database")->select('e.*,count(e.event_id) AS count,' . Phpfox::getUserField())
                ->from(Phpfox::getT('event'), 'e')
                ->join(Phpfox::getT('user'), 'u', 'e.user_id = u.user_id')
                ->join(Phpfox::getT('event_invite'), 'ev', 'ev.event_id = e.event_id')
                ->where('ev.rsvp_id =1 AND e.end_time>' . PHPFOX_TIME)
                ->group('ev.event_id')
                ->order('e.time_stamp DESC')
                ->limit($iTotal)
                ->execute('getSlaveRows');
        for ($i = 0; $i < count($aRows); $i++) {
            $aRows[$i]['image_path'] = str_replace("%s", "_120", $aRows[$i]['image_path']);
        }
        foreach ($aRows as $iKey => $aRow) {
            $aRows[$iKey]['time_stamp'] = date("l, F d", $aRows[$iKey]['time_stamp']);
            $aRows[$iKey]['start_time'] = date('l, F d \a\t\ h:i A', $aRows[$iKey]['start_time']);
            $aRows[$iKey]['end_time'] = date("M j, Y", $aRows[$iKey]['end_time']);
            $ashort_name = $aRows[$iKey]['full_name'];
            if (strlen($ashort_name) > 10) {
                $ashort_name = substr($ashort_name, 0, 10) . '...';
            }}
        return $aRows;
      }

    public function getTopEvents($iTotal) {
        $aRows = Phpfox::getLib("phpfox.database")->select('e.*,count(e.event_id) AS count,' . Phpfox::getUserField())
                ->from(Phpfox::getT('event'), 'e')
                ->join(Phpfox::getT('user'), 'u', 'e.user_id = u.user_id')
                ->join(Phpfox::getT('event_invite'), 'ev', 'ev.event_id = e.event_id')
                ->where('ev.rsvp_id =1 AND e.end_time>' . PHPFOX_TIME)
                ->group('ev.event_id')
                ->order('count(ev.invited_user_id) DESC')
                ->limit($iTotal)
                ->execute('getSlaveRows');
        for ($i = 0; $i < count($aRows); $i++) {
            $aRows[$i]['image_path'] = str_replace("%s", "_120", $aRows[$i]['image_path']);
        }
        foreach ($aRows as $iKey => $aRow) {
            $aRows[$iKey]['time_stamp'] = date("M j, Y", $aRows[$iKey]['time_stamp']);
            $aRows[$iKey]['start_time'] = date('l, F d \a\t\ h:i A ', $aRows[$iKey]['start_time']);
            $aRows[$iKey]['end_time'] = date("M j, Y", $aRows[$iKey]['end_time']);
            $ashort_name = $aRows[$iKey]['full_name'];
            if (strlen($ashort_name) > 10) {
                $ashort_name = substr($ashort_name, 0, 10) . '...';
            }
            
        }

        return $aRows;
    }
}
?>
