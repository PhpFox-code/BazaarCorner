<?php
/**
 * SocialEngine 4 Widget
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2011 YouNet Developments
 * @license    http://www.younetco.com/
 */

class Widget_YstopnewVideoController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    //Get new videos   
    $tableVideo = Engine_Api::_()->getItemTable('video');
    $selectNewVideo = $tableVideo->select()
      ->where('search = ?', 1)
      ->where('photo_id > ?', 0) 
      ->order('video_id DESC')
    ->limit(5);    
    
    // Hide if nothing to show
    if( count($tableVideo->fetchAll($selectNewVideo)) <= 0 ) {
        return $this->setNoRender();
    }
    $this->view->paginatorNewVideo = $paginatorNewVideo = $tableVideo->fetchAll($selectNewVideo);
/* --------------------------------------------------------- */
    //Get top videos   
    $selectTopVideo = $tableVideo->select()
      ->where('search = ?', 1)
      ->where('photo_id > ?', 0)
      ->order('view_count DESC')
    ->limit(5);    
    
    // Hide if nothing to show
    if( count($tableVideo->fetchAll($selectTopVideo)) <= 0 ) {
        return $this->setNoRender();
    }
    $this->view->paginatorTopVideo = $paginatorTopVideo = $tableVideo->fetchAll($selectTopVideo);
    
  }
}