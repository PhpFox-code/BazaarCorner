<?php
/**
 * SocialEngine 4 Widget Example
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2011 YouNet Developments
 * @license    http://www.younetco.com/
 */
?>
 <script language="JavaScript">
    function tabWidgetNewBlog(){
        document.getElementById('newblog').style.display = 'block';
        document.getElementById('topblog').style.display = 'none';
        document.getElementById('tabnewblog').className = 'h_active';
        document.getElementById('tabtopblog').className = 'h_noactive';
    }
    function tabWidgetTopBlog(){
        document.getElementById('newblog').style.display = 'none';
        document.getElementById('topblog').style.display = 'block';
        document.getElementById('tabnewblog').className = 'h_noactive';
        document.getElementById('tabtopblog').className = 'h_active';
    }
</script>

<div class="fixbox">
    <div class="widget_box widget_blogs">
        <h3><?php echo $this->translate('Blog Posts');?><span><a href="<?php echo $this->url(array('module'=>'blogs','controller' => 'index'), 'default', true) ;?>"><?php echo $this->translate('> &nbsp; View all Blogs');?></a></span></h3>
        <ul>
                <li id="tabnewblog" class="h_active"><a href="javascript:void(0)" onclick="tabWidgetNewBlog();"><b><?php echo $this->translate('Latest Blog Posts');?></b></a></li> 
                <li id="tabtopblog" class="h_noactive"><a href="javascript:void(0)" onclick="tabWidgetTopBlog();"><b><?php echo $this->translate('Top Blog Posts');?></b></a></li>        
        </ul>
    </div>
<ul id="topblog-feed" class="feed">
    <div id="newblog">
        <?php foreach ($this->new_blogs as $itemNblog): ?>       
        <div class="ThumbVideo">
            <div class="photo">
                <?php echo $this->htmlLink($itemNblog->getHref(), $this->itemPhoto($itemNblog->getOwner(), 'thumb.profile'), array('class' => 'linkthumb')) ?>
            </div> <!-- end photo -->
            <div class="info">
                <div class="title">
                  <?php echo $this->htmlLink($itemNblog->getHref(), $itemNblog->getTitle()) ?>
                </div>
                <div class="owner">
                  <?php
                    $owner = $itemNblog->getOwner();
                    echo $this->translate('Posted %1$s',  $this->timestamp($itemNblog->creation_date) );
                    echo $this->translate(' by %1$s ',  $this->htmlLink($owner->getHref(), $owner->getTitle()) );  
                ?>
                </div>
              
                <div class="description">
                    <?php echo $this->string()->truncate($this->string()->stripTags($itemNblog->body), 150) ?>
                 </div>
          </div> <!-- end info -->
          <div class="stats">
                    <span class="viewcount"><?php echo $this->translate(array('%s view', '%s views', $itemNblog->view_count), $this->locale()->toNumber($itemNblog->view_count)) ?></span>
                    <span class="commment"><?php echo $this->translate(array('%s comment', '%s comments', $itemNblog->comment_count), $this->locale()->toNumber($itemNblog->comment_count)) ?></span>
          </div> <!-- end stats -->
          
        <div class="Clear"></div>
        </div>
        <?php endforeach; ?>
    </div> <!-- end newblog -->
    
    <div id="topblog">
        <?php foreach ($this->top_blogs as $itemTblog): ?>       
        <div class="ThumbVideo">
            <div class="photo">
                <?php echo $this->htmlLink($itemTblog->getHref(), $this->itemPhoto($itemTblog->getOwner(), 'thumb.profile'), array('class' => 'linkthumb')) ?>
            </div> <!-- end photo -->
            <div class="info">
                <div class="title">
                  <?php echo $this->htmlLink($itemTblog->getHref(), $itemTblog->getTitle()) ?>
                </div>
                <div class="owner">
                  <?php
                    $owner = $itemTblog->getOwner();
                    echo $this->translate('Posted %1$s',  $this->timestamp($itemTblog->creation_date) );
                    echo $this->translate(' by %1$s ',  $this->htmlLink($owner->getHref(), $owner->getTitle()) );  
                ?>
                </div>
              
                <div class="description">
                    <?php echo $this->string()->truncate($this->string()->stripTags($itemTblog->body), 150) ?>
                 </div>
          </div> <!-- end info -->
          <div class="stats">
                    <span class="viewcount"><?php echo $this->translate(array('%s view', '%s views', $itemTblog->view_count), $this->locale()->toNumber($itemTblog->view_count)) ?></span>
                    <span class="commment"><?php echo $this->translate(array('%s comment', '%s comments', $itemTblog->comment_count), $this->locale()->toNumber($itemTblog->comment_count)) ?></span>
          </div> <!-- end stats -->
          
        <div class="Clear"></div>
        </div>
        <?php endforeach; ?>
    </div> <!-- end topblog -->
</ul>
</div>