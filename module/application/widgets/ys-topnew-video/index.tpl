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
	function tabWidgetNewVideo(){
		document.getElementById('newvideo').style.display = 'block';
		document.getElementById('topvideo').style.display = 'none';
		document.getElementById('tabnewvideo').className = 'h_active';
		document.getElementById('tabtopvideo').className = 'h_noactive';
	}
	function tabWidgetTopVideo(){
		document.getElementById('newvideo').style.display = 'none';
		document.getElementById('topvideo').style.display = 'block';
		document.getElementById('tabnewvideo').className = 'h_noactive';
		document.getElementById('tabtopvideo').className = 'h_active';
	}
</script>
<div class="fixbox">
    <div class="widget_box">
        <h3><?php echo $this->translate('Videos');?><span><a href="<?php echo $this->url(array('module'=>'video','controller' => 'index','action'=>'browse'), 'default', true) ;?>"><?php echo $this->translate('> &nbsp; View all Videos');?></a></span></h3>
        <ul>
                <li id="tabnewvideo" class="h_active"><a href="javascript:void(0)" onclick="tabWidgetNewVideo();"><b><?php echo $this->translate('Latest Videos');?></b></a></li> 
                <li id="tabtopvideo" class="h_noactive"><a href="javascript:void(0)" onclick="tabWidgetTopVideo();"><b><?php echo $this->translate('Top Videos');?></b></a></li>        
        </ul>
    </div>
<ul id="topvideo-feed" class="feed">
    <div id="newvideo">
	    <?php foreach ($this->paginatorNewVideo as $itemNvideo): ?>	   
        <div class="ThumbVideo">
          <div class="video_widget">
				    <?php echo $this->htmlLink($itemNvideo->getHref(), $this->itemPhoto($itemNvideo, 'thumb.profile', $itemNvideo->getTitle())) ?>
		    </div>
          <div class='blogs_browse_info'>
            <p class='blogs_browse_info_title'>
                    <?php                    
                        echo $this->htmlLink($itemNvideo->getHref(), strip_tags(substr($itemNvideo->getTitle(), 0, 60)) );    
                        if (strlen($itemNvideo->getTitle())>59) echo $this->translate("...");              
                    ?>
            </p>
            <p class="post_widget">
              <span>
                   <?php 
                        $owner = $itemNvideo->getOwner();
                        echo $this->translate('By %1$s', $this->htmlLink($owner->getHref(), $owner->getTitle()));               
                    ?>
              </span>
              <span class="ViewCount">
                    <?php 
                        echo $itemNvideo->view_count . ' ' . $this->translate('views');
                    ?>
              </span>
            </p>
          </div>  
        <div class="Clear"></div>
        </div>
	    <?php endforeach; ?>
    </div> <!-- end newvideo -->
<!-- **************************************************************************** -->
    <div id="topvideo">
      <?php foreach ($this->paginatorTopVideo as $itemTvideo): ?>       
        <div class="ThumbVideo">
          <div class="video_widget">
                    <?php echo $this->htmlLink($itemTvideo->getHref(), $this->itemPhoto($itemTvideo, 'thumb.profile', $itemTvideo->getTitle())) ?>
            </div>
          <div class='blogs_browse_info'>
            <p class='blogs_browse_info_title'>
                    <?php                    
                        echo $this->htmlLink($itemTvideo->getHref(), strip_tags(substr($itemTvideo->getTitle(), 0, 60)) );    
                        if (strlen($itemTvideo->getTitle())>59) echo $this->translate("...");              
                    ?>
            </p>
            <p class="post_widget">
              <span>
                   <?php 
                        $owner = $itemTvideo->getOwner();
                        echo $this->translate('By %1$s', $this->htmlLink($owner->getHref(), $owner->getTitle()));               
                    ?>
              </span>
              <span class="ViewCount">
                    <?php 
                        echo $itemTvideo->view_count . ' ' . $this->translate('views');
                    ?>
              </span>
            </p>
          </div>  
        <div class="Clear"></div>
        </div>
        <?php endforeach; ?>    
     </div>  <!-- end topvideo --> 
</ul>
</div> <!-- end fixbox --> 
