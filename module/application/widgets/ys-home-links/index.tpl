<div class="quicklinks">
    <?php $viewer = $this->viewer(); ?>
    <div class="user_photo_home">       
        <?php if($viewer->photo_id > 0){ ?> 
            <?php echo $this->htmlLink($viewer->getHref(), $this->itemPhoto($viewer, 'thumb.normal', $viewer->getTitle()),array('title'=>$viewer->getTitle())) ?>
        <?php }else{ ?>
            <a href="<?php echo $this->baseUrl('profile/').$viewer->username; ?>" title="<?php echo $viewer->username ?>"><img src="<?php echo $this->baseUrl('application/modules/User/externals/images/nophoto_user_thumb_profile.png') ?>" alt="<?php echo $viewer->username ?>"></a>
        <?php } ?>
    </div>
    <div class="user_home_right">
        <div class="user_title_home"><?php echo $this->htmlLink($viewer->getHref(), $viewer->getTitle()) ?></div>
        
        <?php // if($this->birthday): ?><span class="userdate"><?php // echo $this->birthday; ?></span><?php // endif; ?>
        <?php // if($this->gender): ?><span class="gender"><?php // echo $this->gender; ?></span><?php // endif; ?>
          <?php echo $this->htmlLink(array('route' => 'default', 'module' => 'activity', 'controller' => 'notifications'), $this->translate("View Recent Updates")); ?>
          //
          <a href="<?php echo $this->baseUrl('profile/').$viewer->username ;?>"> <?php echo $this->translate('View My Profile');?></a>
          //
          <a href="<?php echo $this->baseUrl('members/edit/profile') ;?>"> <?php echo $this->translate('Edit My Profile');?></a>
          //
          <a href="<?php echo $this->baseUrl('members') ;?>"> <?php echo $this->translate('Browse Members');?></a>
          
    </div>
    <div class="space-line"></div>
    
</div>
