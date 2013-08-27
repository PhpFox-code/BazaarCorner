<?php
/**
 * SocialEngine 4 Widget Example
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2011 YouNet Developments
 * @license    http://www.younetco.com/
 */
class Widget_YstopnewblogController extends Engine_Content_Widget_Abstract
{
  protected $_childCount;

  public function indexAction()
  {
  	$btable = Engine_Api::_()->getDbtable('allow', 'authorization');
    $b_table_name = $btable->info('name');
    
    $cattable = Engine_Api::_()->getDbtable('categories', 'blog');
    $cat_table_name = $cattable->info('name');
    
    
    $table = Engine_Api::_()->getDbtable('blogs','blog');
    $table_name = $table->info('name');  
    // Set new blog
    $rowsNew = $table->fetchAll(
        $table->select()
            ->from($table_name)
            ->setIntegrityCheck(false)
            ->joinInner($b_table_name, "$b_table_name.resource_id = $table_name.blog_id") 
           // ->joinInner($cat_table_name, "$cat_table_name.category_id = $table_name.category_id") 
            ->where($b_table_name.'.resource_type = ?',"blog")
            ->where($b_table_name.'.role = ?',"everyone")
            ->where($b_table_name.'.action = ?', "view")
            ->order("blog_id DESC")
            ->limit(4)
    );
    $this->view->new_blogs = $rowsNew;
    
    //set top blog
    $rowsTop = $table->fetchAll(
    $table->select()
            ->from($table_name)
            ->setIntegrityCheck(false)
            // check privacy
            ->joinInner($b_table_name, "$b_table_name.resource_id = $table_name.blog_id")
            ->where($b_table_name.'.resource_type = ?',"blog")
            ->where($b_table_name.'.role = ?',"everyone")
            ->where($b_table_name.'.action = ?', "view")
            ->order("view_count DESC")
            ->limit(4)
    );
    $this->view->top_blogs = $rowsTop;
    
    // Do not render if nothing to show
    if( count($this->view->new_blogs) <= 0 )
    {
      return $this->setNoRender();
    }

     // Add count to title if configured
    if( $this->_getParam('titleCount', false) && count($this->view->top_blogs) > 0 )
    {
      $this->_childCount = count($this->view->top_blogs);
    }
  }

  public function getChildCount()
  {
    return $this->_childCount;
  }
}
