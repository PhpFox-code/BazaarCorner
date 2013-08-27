<?php
/**
 * SocialEngine 4 Widget Example
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2011 YouNet Developments
 * @license    http://www.younetco.com/
 */
class Widget_YstopnewgroupController extends Engine_Content_Widget_Abstract
{
    protected $_childCount;

  public function indexAction()
  {
     
    $table = Engine_Api::_()->getDbtable('groups','group');
    //Get top group
    $rowsTop = $table->fetchAll(
    $table->select()
        ->where('photo_id > ?', 0)
        ->order("view_count DESC")
        ->limit(4)
        );
    // Set top group variable
    $this->view->top_groups = $rowsTop;
    
    //Get new group
    $rowsNew = $table->fetchAll(
    $table->select()
        ->where('photo_id > ?', 0)
        ->order("group_id DESC")
        ->limit(4)
        );
    // Set top group variable
    $this->view->new_groups = $rowsNew;
     
    // Do not render if nothing to show
    if( count($this->view->new_groups) <= 0 )
    {
      return $this->setNoRender();
    }
    // Add count to title if configured
    if( $this->_getParam('titleCount', false) && count($this->view->top_groups) > 0 )
    {
      $this->_childCount = count($this->view->top_groups);
    }
  }

  public function getChildCount()
  {
    return $this->_childCount;
  }
}
