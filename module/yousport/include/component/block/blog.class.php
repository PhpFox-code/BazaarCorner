<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined('PHPFOX') or exit('NO DICE!'); 
class Yousport_Component_Block_Blog extends Phpfox_Component
{
    public function process()
    {
        $aBlogs = Phpfox::getService('yousport')->getNewBlogs(3);
        $aTopBlogs = Phpfox::getService('yousport')->getTopBlogs(3);

        $sLinkAll = 'blog';
        $this->template()->assign('sLinkAll',$sLinkAll);
        $blk=Phpfox::getPhrase('yousport.blog');
        $this->template()->assign('blk',$blk);
        
        $this->template()->assign(array(              
                'sHeader'=> Phpfox::getPhrase('yousport.blog_post'),
                'aBlogs' => $aBlogs,
                'aTopBlogs' => $aTopBlogs
            )
        );
        return 'block'; 
    }
}

?>
