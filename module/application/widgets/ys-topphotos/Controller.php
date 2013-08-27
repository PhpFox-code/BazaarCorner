<?php
/**
 * SocialEngine 4 Widget
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2011 YouNet Developments
 * @license    http://www.younetco.com/
 */
class Widget_YstopPhotosController extends Engine_Content_Widget_Abstract
{
  protected $_childCount;
  public function indexAction()
  {
      $btable = Engine_Api::_()->getDbtable('allow', 'authorization');
        $b_table_name = $btable->info('name');

        $table = Engine_Api::_()->getDbtable('photos','album');
        $table_name = $table->info('name');
        // Set top photos variable        
        $select= $table->select()
        ->from($table_name)
        ->setIntegrityCheck(false)
        // check privacy
        ->joinInner($b_table_name, "$b_table_name.resource_id = $table_name.album_id")
        ->where($b_table_name.'.resource_type = ?',"album")
        ->where($b_table_name.'.role = ?',"everyone")
        ->where($b_table_name.'.action = ?', "view")
        ->order("view_count DESC")
        ->limit(4);
        $rows = $table->fetchAll($select);

        if( count($rows) <= 0 ){
            return $this->setNoRender();
        }
        $this->view->top_photos = $rows;

        // Add count to title if configured
        if( $this->_getParam('titleCount', false) && count($rows) > 0 )
        {
            $this->_childCount = count($rows);
        }
  }
  
  public function getChildCount()
  {
    return $this->_childCount;
  }
}