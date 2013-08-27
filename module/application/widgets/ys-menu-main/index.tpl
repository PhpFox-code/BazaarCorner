<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2011 YouNet Developments
 */
?>

<?php
$modu = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
$acti = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
$i = 0;
$arrMore = array();
$total = 0;
?>

<div id='layout_core_menu_main'>
 <ul>
    <?php foreach( $this->navigation as $item ): ?>
    	<?php
        $label = $item->getLabel();
		if($i < 8){
	    	if((strstr(strtolower($label),$modu) != "") || ($modu=="core" && $label=="Home") || ($modu=="user" && $label=="Members" && $acti != "home") || ($modu=="user" && strtolower($label)==$acti)){
	    	?>
	    	<li class="actives"><?php echo "<a href='" . $item->getHref() . "'>" . $this->translate($item->getLabel()) . "</a>"?></li>
	        <?php
	        $total +=1;
	        $i += 1;
	    	}else{
	        ?>
	        <li><?php echo "<a href='" . $item->getHref() . "'>" . $this->translate($item->getLabel()) . "</a>"?></li>
	        <?php
	        $i += 1;
	        }
	    }else{
		  	if(strstr(strtolower($label),$modu) != ""){
	    	$arrMore[$i] = "<a href='" . $item->getHref() . "' class ='active' >" . $this->translate($item->getLabel()) . "</a>";
	  		$i += 1;
	    	}else{
	    	$arrMore[$i] = "<a href='" . $item->getHref() . "'>" . $this->translate($item->getLabel()) . "</a>";
	  		$i += 1;
	    	}
	    }
       ?>
    <?php endforeach;
    if($i > 8){
    if($total > 0){
    ?>
    <li id = "more" class="view_more_menu"><a href="javascript: void(0)" class="onmousehover" ><b><?php echo $this->translate('More');?> </b></a>
            <div id="dropmenu1" class="dropmenudiv">
                <ul>
                <?php
                    for($j = 8; $j < $i; $j++){
                ?>
                      <li><?php echo $arrMore[$j]; ?></li>
                        
                <?php    }
                ?>
                </ul>
            </div>
    </li>
    <?php
    }else{
    ?>
    <li id = "more" class="actives"><a href="javascript: void(0)" class="onmousehover"><b> <?php echo $this->translate('More');?> </b></a>
            <div id="dropmenu1" class="dropmenudiv">
                <ul>
                <?php
                    for($j = 8; $j < $i; $j++){
                ?>
                      <li><?php echo $arrMore[$j]; ?></li>
                        
                <?php    }
                ?>
                </ul>
            </div>
    </li>
    <?php
    }
    }
    ?>
    </ul>
<!--Search---------------------------------!-->
	<?php if($this->search_check):?>
	<div class="FormSearch">
		<div class="search_logo">
			<form action="<?php echo $this->url(array('controller' => 'search'), 'default', true) ?>" method="get">
				<div class="InputTextSearch">
				    <input class="TextSearch"  id="global_search_field" type='text' name='query' value="Search" onblur="if (this.value == '') { this.value='Search'; this.style.color = '#c4c4c4';  }" onfocus="if (this.value == 'Search') { this.value=''; this.style.color = '#555'; }">
				</div>
				<div class="ButtonSubmit">
				    <input class="ButtonSearchMain" type="submit" value="">
				</div>
		    </form>
		</div>
	</div>
	<?php endif;?>
 </div>
 