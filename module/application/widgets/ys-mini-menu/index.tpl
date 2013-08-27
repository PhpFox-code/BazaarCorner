<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2011 YouNet Developments
 * @author     YouNet Developments
 */
?>
<?php
function cutStringuser($str,$limit){
	if(strlen($str)<=$limit){
		return $str;
	}else{
		$arrStr = explode(" ",$str);
		if(count($arrStr)==1){
			return strip_tags(substr($str, 0, 20));
		}
		
		if(count($arrStr)>=3){
		$newLimit = $arrStr[0] . " " . $arrStr[1] . " " . $arrStr[2];
		$n=2;
		}else if(count($arrStr)==2){
		$newLimit = $arrStr[0] . " " . $arrStr[1];
		$n = 1;
		}
		if(strlen($newLimit)<=$limit-2){
			$newStr = $newLimit . "..";
			return $newStr;
		}else{
			$newLimit = $arrStr[0];
			for($i=1; $i<$n; $i++){
			$newLimit = $newLimit . " " . $arrStr[$i];
			}
			if(strlen($newLimit)<=$limit-2){
				$newStr = $newLimit . "..";
				return $newStr;
			}else{
				$newStr = $arrStr[0] . "..";
				if(strlen($newStr)<= $limit-2){
				return $newStr;
				}else{
					return strip_tags(substr($newStr, 0, 20));
				}
				
			}
		}
	}

}
?>
<div id='core_menu_mini_menu'>
<?php
    // Reverse the navigation order (they're floating right)
    $count = count($this->navigation);
    foreach( $this->navigation->getPages() as $item ) $item->setOrder(--$count);
    $route = array('route'=>'user_logout', 'action'=>'logout');
	$viewer = $this->viewer();
  ?>
  <div class="fixie">
  <ul>  
    <?php
	if( $viewer && $viewer->getIdentity() ) {
	?>
	 <li id='<?php if( $this->notificationCount ) echo "core_menu_mini_menu_updates" ?>' style="<?php if( !($this->viewer->getIdentity()) ) echo "display : none;" ?>">
      <?php if( $this->notificationCount ):?>
        <span  onclick="toggleUpdatesPulldown(event, this, '4');"  class="updates_pulldown">
            <div class="pulldown_contents_wrapper">
                  <div class="pulldown_contents">
                    <ul class="notifications_menu" id="notifications_menu">
                      <div class="notifications_loading" id="notifications_loading">
                        <img src='application/modules/Core/externals/images/loading.gif' style='float:left; margin-right: 5px;' />
                        <?php echo $this->translate("Loading ...") ?>              </div>
                    </ul>
                  </div>
                  <div class="pulldown_options">
                    <?php echo $this->htmlLink(array('route' => 'default', 'module' => 'activity', 'controller' => 'notifications'),
                       $this->translate('View All Updates'),
                       array('id' => 'notifications_viewall_link')) ?>
                           
                         
                        <?php echo $this->htmlLink('javascript:void(0);', $this->translate('Mark All Read'), array(
                          'id' => 'notifications_markread_link',
                        'onclick' => "en4.activity.hideNotifications('". $this->string()->escapeJavascript($this->translate("0 Updates")) ."');"
                        )) ?>                      
                  </div>            
                </div>
                <a href="javascript:void(0);" id="updates_toggle" <?php if( $this->notificationCount ):?> class="new_updates"<?php endif;?>>
             <?php echo $this->translate(array('%s Update ', ' %s Updates ', $this->notificationCount), $this->locale()->toNumber($this->notificationCount))              
             ?>
                </a>
        </span>
        <!--
        <span id="core_menu_mini_menu_updates_close">
          <a href="javascript:void(0);" onclick="en4.activity.hideNotifications();">x</a>
        </span>
        -->

      <?php else:?>
        <?php echo $this->htmlLink(array('route' => 'default', 'module' => 'activity', 'controller' => 'notifications'),
                                   $this->translate(array('%s Update', '%s Updates', $this->notificationCount), $this->locale()->toNumber($this->notificationCount)),
                                   array('id' => 'core_menu_mini_menu_updates_count')) ?>
      <?php endif;

      ?>
    </li>
	<?php
    foreach( $this->navigation as $item ): ?>
    <?php
    	if($item->getLabel() != 'Sign Out'){
    ?>
    <li><?php echo $this->htmlLink($item->getHref(), $this->translate($item->getLabel())) ?></li>

    <?php
    	}
    ?>
    <?php endforeach; ?>
    <li>
    	<div class="member_signout">
    		<a href="<?php echo $this->url(array('controller' => 'logout'), 'default', true) ;?>"><?php echo $this->translate('Sign Out'); ?></a>
    	</div>
    </li>
<?php
	}
?>

  
<?php 
    if(!$viewer || !$viewer->getIdentity() ) {

 ?>
<li class="Login">
        <a href="<?php echo $this->url(array('controller' => 'login'), 'default', true) ;?>"><?php echo $this->translate('Login'); ?></a>
        <span class ="mini_yb" >|</span>
</li>
<li class="Login"> 
        <a href="<?php echo $this->url(array('controller' => 'signup'), 'default', true) ;?>"><?php echo $this->translate('Sign up'); ?></a>
</li>
  <?php }?>
  
  </ul>
  
</div>
</div>


<script type='text/javascript'>
  var notificationUpdater;

  en4.core.runonce.add(function(){
    new OverText($('global_search_field'), {
      poll: true,
      pollInterval: 500,
      positionOptions: {
        position: ( en4.orientation == 'rtl' ? 'upperRight' : 'upperLeft' ),
        edge: ( en4.orientation == 'rtl' ? 'upperRight' : 'upperLeft' ),
        offset: {
          x: ( en4.orientation == 'rtl' ? -4 : 4 ),
          y: 2
        }
      }
    });

    if($('notifications_markread_link')){
      $('notifications_markread_link').addEvent('click', function() {
        //$('notifications_markread').setStyle('display', 'none');
        en4.activity.hideNotifications('<?php echo $this->string()->escapeJavascript($this->translate("0 Updates"));?>');
      });
    }

    <?php if ($this->updateSettings && $this->viewer->getIdentity()): ?>
    notificationUpdater = new NotificationUpdateHandler({
              'delay' : <?php echo $this->updateSettings;?>
            });
    notificationUpdater.start();
    window._notificationUpdater = notificationUpdater;
    <?php endif;?>
  });


  var toggleUpdatesPulldown = function(event, element, user_id) {
    if( element.className=='updates_pulldown' ) {
      element.className= 'updates_pulldown_active';
      showNotifications();
    } else {
      element.className='updates_pulldown';
    }
  }

  var showNotifications = function() {
    en4.activity.updateNotifications();
    new Request.HTML({
      'url' : en4.core.baseUrl + 'activity/notifications/pulldown',
      'data' : {
        'format' : 'html',
        'page' : 1
      },
      'onComplete' : function(responseTree, responseElements, responseHTML, responseJavaScript) {

        if(responseHTML){
          // hide loading icon
          if($('notifications_loading')) $('notifications_loading').setStyle('display', 'none');

          $('notifications_menu').innerHTML = responseHTML;
          $('notifications_menu').addEvent('click', function(event){
            event.stop(); //Prevents the browser from following the link.

            var current_link = event.target;
            var notification_li = $(current_link).getParent('li');

            // if this is true, then the user clicked on the li element itself
            if (notification_li.id == 'core_menu_mini_menu_update') notification_li = current_link;

            var forward_link;
            if(current_link.get('href')){
              forward_link = current_link.get('href');
            }
            else{
              forward_link = $(current_link).getElements('a:last-child').get('href');
            }

            if(notification_li.get('class')=='notifications_unread'){
              notification_li.removeClass('notifications_unread');
              en4.core.request.send(new Request.JSON({
                url : en4.core.baseUrl + 'activity/notifications/markread',
                data : {
                  format     : 'json',
                  'actionid' : notification_li.get('value')
                },
                onSuccess : window.location = forward_link
              }));
            }
            else window.location = forward_link;
          });
        }
        else $('notifications_loading').innerHTML = '<?php echo $this->string()->escapeJavascript($this->translate("You have no new updates."));?>';
      }
    }).send();
  };

</script>
