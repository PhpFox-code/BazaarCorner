<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 YouNet Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 YouNet Developments
 * @license    http://www.socialengine.net/license/
 */
class Widget_YsHomeLinksController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    // Don't render this if not logged in
    $this->view->viewer = $viewer = Engine_Api::_()->user()->getViewer();
    if( !$viewer->getIdentity() ) {
        return $this->setNoRender();
    }
    /*
    $db = Engine_Db_Table::getDefaultAdapter();
    $db->beginTransaction();
    $selectGenger = $db->select()
            ->from('engine4_user_fields_values')
            //->joinLeft('engine4_user_fields_values','engine4_user_fields_values.item_id = engine4_users.user_id')
            ->where('engine4_user_fields_values.field_id = ?',5)
            ->where ('engine4_user_fields_values.item_id = ?',$viewer->getIdentity());
            //->where('engine4_users.search = ?', 1);    
    if (count($db->fetchAll($selectGenger)) > 0) 
    {
        $genders = array('2' => 'Male', '3' => 'Female');
        
        foreach ($db->fetchAll($selectGenger) as $item2)
           $this->view->gender = $gender = $genders[$item2["value"]];
           
    }
        // birthday
    $selectDate = $db->select()
        ->from('engine4_user_fields_values')
        ->where('engine4_user_fields_values.field_id = ?', 6)
        ->where ('engine4_user_fields_values.item_id = ?', $viewer->getIdentity());
        //->where('engine4_users.search = ?', 1);    
    if (count($db->fetchAll($selectDate)) > 0)
    {
        foreach ($db->fetchAll($selectDate) as $item)
           $this->view->birthday = $birthday = $item["value"];
        
    }
     */       
    //die("");
  }

  public function getCacheKey()
  {
    return Engine_Api::_()->user()->getViewer()->getIdentity();
  }
}