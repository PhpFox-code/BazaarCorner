<?php
$this->headLink()
        ->prependStylesheet($this->baseUrl().'/application/css.php?request=application/widgets/ys-topphotos/lofslider.css');
$this->headScript()
       ->appendFile($this->baseUrl() . '/application/themes/yousport/js/jquery-1.5.1.min.js')
       ->appendFile($this->baseUrl() . '/application/themes/yousport/js/jquery.easing.js')
       ->appendFile($this->baseUrl() . '/application/themes/yousport/js/lofslider.js');   
?>

 <!-- ----------------------------------- THE CONTENT ----------------------------------------------- -->
<div id="lofslidecontent45" class="lof-slidecontent">
<div class="preload"><div></div></div>
 <!-- MAIN CONTENT --> 
  <div class="lof-main-outer">
      <ul class="lof-main-wapper">
      <?php
            foreach( $this->top_photos as $itemTopPhoto):
      ?>     
        <li>
            <a href="<?php echo $itemTopPhoto->getHref(); ?>">
                    <?php echo $this->htmlImage($itemTopPhoto->getPhotoUrl(), $itemTopPhoto->getTitle(), array(
                      'id' => 'media_photo','class' => 'LargeImg', 'title' => $itemTopPhoto->getTitle(), 
                      'alt' => $itemTopPhoto->getDescription()
                    )); ?>
            </a>        
            <div class="lof-main-item-desc">
                <h3>
                    <a target="_self" title="<?php echo  $itemTopPhoto->getTitle(); ?>" href="<?php echo  $itemTopPhoto->getHref(); ?>">
                        <?php echo  $itemTopPhoto->getTitle(); ?>
                    </a>
                </h3>
                <p>
                   <?php echo $itemTopPhoto->getDescription(); ?>
                </p>
            </div>
        </li>
      <?php endforeach; ?> 
      </ul>      
  </div>
  <!-- END MAIN CONTENT --> 
    <!-- NAVIGATOR -->

  <div class="lof-navigator-outer">
          <ul class="lof-navigator"> 
          <?php
            foreach( $this->top_photos as $itemTopPhoto):
          ?>      
           <li>
                   <div>
                        <a href="<?php echo $itemTopPhoto->getHref(); ?>">
                            <?php echo $this->htmlImage($itemTopPhoto->getPhotoUrl(), $itemTopPhoto->getTitle(), array(
                              'id' => 'media_photo','class' => 'LargeImg', 'title' => $itemTopPhoto->getTitle(), 
                              'alt' => $itemTopPhoto->getDescription()
                            )); ?>
                        </a>
                    <h3>
                        <a  title="<?php echo  $itemTopPhoto->getTitle(); ?>" href="<?php echo  $itemTopPhoto->getHref(); ?>">
                            <?php 
                            echo strip_tags(substr( $itemTopPhoto->getTitle(), 0, 25)); 
                            if (strlen( $itemTopPhoto->getTitle())>24) echo $this->translate("...");
                            ?>
                        </a>
                    </h3>
                    <p class="Description">
                            <?php 
                                echo strip_tags(substr($itemTopPhoto->getDescription(), 0, 50)); 
                                if (strlen($itemTopPhoto->getDescription())>49) echo $this->translate("..."); 
                            ?>  
                     </p>
                    <p class="Creationdate">
                            <?php echo $this->timestamp($itemTopPhoto->creation_date) ?>
                    </p>
                </div>
            </li>
        <?php endforeach; ?>                  
        </ul>
  </div>
 </div> 
<!-- ----------------------------------- END OF THE CONTENT ----------------------------------------------- -->
<script type="text/javascript" language="javaScript">
   jQuery.noConflict();
   jQuery(document).ready(function($){
       $('#lofslidecontent45').lofJSidernews({
            auto        :   true,
            interval    :   4000,
            easing      :   'easeInOutSine',
            duration    :   1200,
            maxItemDisplay: 4,			
		});		
  });
</script>