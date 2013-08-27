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
    function tabWidgetNewGroup(){
        document.getElementById('newgroup').style.display = 'block';
        document.getElementById('topgroup').style.display = 'none';
        document.getElementById('tabnewgroup').className = 'h_active';
        document.getElementById('tabtopgroup').className = 'h_noactive';
    }
    function tabWidgetTopGroup(){
        document.getElementById('newgroup').style.display = 'none';
        document.getElementById('topgroup').style.display = 'block';
        document.getElementById('tabnewgroup').className = 'h_noactive';
        document.getElementById('tabtopgroup').className = 'h_active';
    }
</script>

<div class="fixbox">
    <div class="widget_box widget_groups">
        <h3><?php echo $this->translate('Groups');?><span><a href="<?php echo $this->url(array('module'=>'groups','controller' => 'index'), 'default', true) ;?>"><?php echo $this->translate('> &nbsp; View all Groups');?></a></span></h3>
        <ul>
                <li id="tabtopgroup" class="h_active"><a href="javascript:void(0)" onclick="tabWidgetTopGroup();"><b><?php echo $this->translate('Top Groups');?></b></a></li>
                <li id="tabnewgroup" class="h_noactive"><a href="javascript:void(0)" onclick="tabWidgetNewGroup();"><b><?php echo $this->translate('Latest Groups');?></b></a></li>                
        </ul>
    </div>
<ul id="topgroup-feed" class="feed">
    <div id="newgroup">
        <?php foreach ($this->new_groups as $itemNgroup): ?>       
        <div class="ThumbVideo">
            <div class="photo">
                <?php echo $this->htmlLink($itemNgroup->getHref(), $this->itemPhoto($itemNgroup, 'thumb.profile'), array('class' => 'linkthumb')) ?>
            </div> <!-- end photo -->
            <div class="info">
                <div class="title">
                  <?php echo $this->htmlLink($itemNgroup->getHref(), $itemNgroup->getTitle()) ?>
                </div>
                <div class="owner">
                <?php
                    $owner = $itemNgroup->getOwner();
                    echo $this->translate('Lead by %1$s ',  $this->htmlLink($owner->getHref(), $owner->getTitle()) );                    
                ?>
                </div>
                <div class="membercount">
                <?php
                    echo $this->translate(array('Member: %s ', 'Members: %s ', $itemNgroup->member_count), $this->locale()->toNumber($itemNgroup->member_count));
                ?>
                </div>
          </div> <!-- end info -->        
        <div class="Clear"></div>
        </div>
        <?php endforeach; ?>
    </div> <!-- end newgroup -->
    
    <div id="topgroup">
        <?php foreach ($this->top_groups as $itemTgroup): ?>       
        <div class="ThumbVideo">
            <div class="photo">
                <?php echo $this->htmlLink($itemNgroup->getHref(), $this->itemPhoto($itemTgroup, 'thumb.profile'), array('class' => 'linkthumb')) ?>
            </div> <!-- end photo -->
            <div class="info">
                <div class="title">
                  <?php echo $this->htmlLink($itemTgroup->getHref(), $itemTgroup->getTitle()) ?>
                </div>
                <div class="owner">
                  <?php
                    $owner = $itemTgroup->getOwner();
                    echo $this->translate('Lead by %1$s ',  $this->htmlLink($owner->getHref(), $owner->getTitle()) );
                ?>
                </div>
                <div class="membercount">
                <?php
                    echo $this->translate(array('Member: %s ', 'Members: %s ', $itemNgroup->member_count), $this->locale()->toNumber($itemNgroup->member_count));
                ?>
                </div>
          </div> <!-- end info -->       
        <div class="Clear"></div>
        </div>
        <?php endforeach; ?>
    </div> <!-- end topgroup -->
</ul>
</div>