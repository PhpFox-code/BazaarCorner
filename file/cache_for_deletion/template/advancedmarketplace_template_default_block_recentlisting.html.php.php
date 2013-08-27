<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:25 am */ ?>
<?php if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
<div class="block<?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?> js_sortable<?php endif;  if (isset ( $this->_aVars['sCustomClassName'] )): ?> <?php echo $this->_aVars['sCustomClassName'];  endif; ?>"<?php if (isset ( $this->_aVars['sBlockBorderJsId'] )): ?> id="js_block_border_<?php echo $this->_aVars['sBlockBorderJsId']; ?>"<?php endif;  if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) && Phpfox ::getLib('module')->blockIsHidden('js_block_border_' . $this->_aVars['sBlockBorderJsId'] . '' )): ?> style="display:none;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['sHeader'] ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
		<div class="title <?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?>js_sortable_header<?php endif; ?>">		
<?php if (isset ( $this->_aVars['sBlockTitleBar'] )): ?>
<?php echo $this->_aVars['sBlockTitleBar']; ?>
<?php endif; ?>
<?php if (( isset ( $this->_aVars['aEditBar'] ) && Phpfox ::isUser())): ?>
			<div class="js_edit_header_bar">
				<a href="#" title="<?php echo Phpfox::getPhrase('core.edit_this_block'); ?>" onclick="$.ajaxCall('<?php echo $this->_aVars['aEditBar']['ajax_call']; ?>', 'block_id=<?php echo $this->_aVars['sBlockBorderJsId'];  if (isset ( $this->_aVars['aEditBar']['params'] )):  echo $this->_aVars['aEditBar']['params'];  endif; ?>'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_edit.png','alt' => '','class' => 'v_middle')); ?></a>				
			</div>
<?php endif; ?>
<?php if (true || isset ( $this->_aVars['sDeleteBlock'] )): ?>
			<div class="js_edit_header_bar js_edit_header_hover" style="display:none;">
<?php if (Phpfox ::getService('theme')->isInDnDMode()): ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')){
					$(this).parents('.block:first').remove(); $.ajaxCall('core.removeBlockDnD', 'sController=' + oParams['sController'] 
					+ '&amp;block_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>');} return false;"title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>
<?php else: ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')) { $(this).parents('.block:first').remove();
					$.ajaxCall('core.hideBlock', 'sController=' + oParams['sController'] + '&amp;type_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>&amp;block_id=' + $(this).parents('.block:first').attr('id')); } return false;" title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>				
<?php endif; ?>
			</div>
			
<?php endif; ?>
<?php if (empty ( $this->_aVars['sHeader'] )): ?>
<?php echo $this->_aVars['sBlockShowName']; ?>
<?php else: ?>
<?php echo $this->_aVars['sHeader']; ?>
<?php endif; ?>
              
                <!--  VIEW ALL !-->
<?php if (isset ( $this->_aVars['sLinkAll'] ) && ! isset ( $this->_aVars['aEditBar'] ) && ! isset ( $this->_aVars['sDeleteBlock'] )): ?>
                <a class="view_all_nav" href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['sLinkAll']); ?>"><?php echo Phpfox::getPhrase('yousport.view_all'); ?> <?php echo $this->_aVars['blk']; ?></a>
<?php unset($this->_aVars['sLinkAll']); ?>
<?php endif; ?>
            <!--  END VIEW ALL !-->
		</div>
           
<?php endif; ?>
<?php if (isset ( $this->_aVars['aEditBar'] )): ?>
	<div id="js_edit_block_<?php echo $this->_aVars['sBlockBorderJsId']; ?>" class="edit_bar" style="display:none;"></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aMenu'] ) && count ( $this->_aVars['aMenu'] )): ?>
	<div class="menu">
	<ul>
<?php if (count((array)$this->_aVars['aMenu'])):  $this->_aPhpfoxVars['iteration']['content'] = 0;  foreach ((array) $this->_aVars['aMenu'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['content']++; ?>
 
		<li class="<?php if (count ( $this->_aVars['aMenu'] ) == $this->_aPhpfoxVars['iteration']['content']): ?> last<?php endif;  if ($this->_aPhpfoxVars['iteration']['content'] == 1): ?> first active<?php endif; ?>"><a href="<?php echo $this->_aVars['sLink']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a></li>
<?php endforeach; endif; ?>
	</ul>
	<div class="clear"></div>
	</div>
<?php unset($this->_aVars['aMenu']); ?>
<?php endif; ?>
	<div class="content"<?php if (isset ( $this->_aVars['sBlockJsId'] )): ?> id="js_block_content_<?php echo $this->_aVars['sBlockJsId']; ?>"<?php endif; ?>>
<?php endif; ?>
		<div id="fb-root"></div>
<?php echo '
<style>
#content_holder{
	background-color:transparent;}
#main_footer_holder{
    display:none;
}
a {
    color:#35BFFF;
	text-decoration:none;
}
a:hover, a:active{
	color:#91DCFF;
}
#backlinks{
	float:right;
	padding:0 20px;
	line-height:22px;
	font-weight:bold;
	font-size:13px;
}

#backlinks a{
	text-align:right;
	display:block;
}

.title {
	display:none;
}
.holder{height:0;}

/* Footer */
#breadcrumb_content{
	display:none;}
#breadcrumb_holder{
	display:none;}
#holder_notify{
	display:none;}
/* clearfix */
.clearfix {
	clear:both;
}
/* wrapper css */
#wrapper{
	margin-top:70px;
	width:100%;
}
#wrapper hgroup{
	text-align:center;
}
#wrapper h2{
	margin:5px 0;
	color:#FF6D99;
	text-shadow:1px 1px 2px #A50031;
	font-size:33px;
	font-family:Arial Narrow, Arial, sans-serif;
}

#wrapper h3{
	font-style:italic;
	font-weight:normal;
	font-size:18px;
	text-shadow:1px 1px 0 #fff;
	color:#888;
	margin:5px 0;
}
#container{
	position:relative;
	width:1100px;
    top: 9px;
	margin-bottom: 25px;
    margin-left: -75px;
    margin-right: auto;
    margin-top: 0;
	padding-bottom: 10px;
    clear: both;

}

.grid{
	width:200px;
	min-height:100px;
	background:#fff;
	margin:8px;
	font-size:12px;
	float:left;
	box-shadow: 0 1px 3px rgba(34,25,25,0.4);
	-moz-box-shadow: 0 1px 3px rgba(34,25,25,0.4);
	-webkit-box-shadow: 0 1px 3px rgba(34,25,25,0.4);
	/*
    -webkit-transition: top 1s ease, left 1s ease;
	-moz-transition: top 1s ease, left 1s ease;
	-o-transition: top 1s ease, left 1s ease;
	-ms-transition: top 1s ease, left 1s ease;
    */
	border-top:5px solid #d115aa;
	margin:5px;/*Newly added css*/
	-webkit-box-shadow:  3px 3px 5px 0px #000;/*Newly added css*/
	box-shadow:  3px 3px 5px 0px #000;/*Newly added css*/
}

.grid strong {
	border-bottom:1px solid #ccc;
	margin:10px 0;
	display:block;
	padding:0 0 5px;
	font-size:17px;
}

.grid .meta{
	
	color:#777;
	font-style: normal;
    text-align: center;
}

.grid .meta a{
	padding-top: 5px;
	color:#000000;
	font-size: 16px;
}


/*@ Newle added css*/
.grid .grid-inner-block{
		padding: 15px;
}
.grid .add-comment{
	width:100%;
	height:26px;
	line-height:26px;
	background:#a0afd0;
	text-align:right;

}
.grid .add-comment a{
	color:#fff;
	padding-right:5px;
}
.grid .f-share-btn{
	float:right;
}
.grid .imgholder{
	position:relative;
}
.grid .imgholder img{
	max-width:100%;
	background:#ccc;
	display:block;

}
/*@ end of Newle added css*/

@media screen and (max-width : 1240px) {
	body{
		overflow:auto;
	}
}

@media screen and (max-width : 900px) {
	#backlinks{
		float:none;
		clear:both;
	}

	#backlinks a{
		display:inline-block;
		padding-right:20px;
	}

	#wrapper{
		margin-top:90px;
	}
}

#left{
	display:none;
	}

#content{
	left: 32px;
}

#wrapper{

	margin-top: 0;

	}
.grid .fb-like{
	float:left;
	 margin-top: -29px;
	 padding-left:10px;
}

.box {
  margin: 0px;
  padding: 0px;
  background: #D8D5D2;
  font-size: 11px;
  line-height: 1.4em;
  float: left;
  width: 220px;
}

.grid .icons-order-list{
	width:100%;
	padding:10px 0;
	font-size:14px;
}

.grid .icons-order-list li{
	float:left;
	display:inline;
	background:url(http://bazaarcorner.com/module/advancedmarketplace/static/image/default/icons-pic.jpg) no-repeat 0 -14px;
	margin-right: 5px;
    text-align: right;
    width: 35px;
	font-style:normal;
}
.grid .icons-order-list li.heart{
	background-position:0 1px;
	width:25px;
}
.grid .icons-order-list li.comment{
	background-position:0 -29px;
	width:25px
	margin-right: 17px;
}
.grid .icons-order-list li.buyit{
	background:none;
	padding-left:5px;
	 width: 51px;
}
.grid .icons-order-list li.buyit a{
	color:#df1602;
	font-style:normal;
}

#wrapper { /*width:1440;*/ /*margin-left:auto; margin-right:auto; */}


	#mnu { width:100%; top:0; }
	#social-contents { margin-top:20px; margin-left:auto; margin-right:auto; width:1308px; }
	#mnu-static { z-index:2; top:120px; }
	#footer-cont { position:fixed; bottom:-7px; left: 50%;
margin-left: -50%;}

	.sticky #mnu-static {
		position:fixed;
		top:0;
		left:0;
		width:100%;
}

.sticky #mnu-static {
    margin:0 auto;
}
#menutop{
    background-attachment: scroll;
    background-clip: border-box;
    background-color: #EFE3E5;
    background-image: none;
    background-origin: padding-box;
    background-position: 0 0;
    background-repeat: repeat;
    background-size: auto auto;
    height: 63px;
    left: -217px;
    position: absolute;
    top: -115px;
    width: 1351px;
}


.js_pager_view_more_link {height:20px;}
.pager_view_more_link a {background:none;border:0px;}
.pager_view_more_link a:hover {background:none;border:0px;}

.report_this_item {display:none;}
.comment_mini_action {display:none;}
#tags {
    left: 0px;
    top: 118px;
    position: fixed;
    text-align: center;
    height: 24px;
    line-height: 24px;
    padding: 4px;
    width: 100%;
    background-color: #E117B8;
    font-weight:bold;
    display:none;
	z-index:100;
}
#tags a {
    color: #fff;
    margin-right: 8px;
}

.header_bar_menu {display:none;}
.js_comment_like_holder {display:none;}
.comment_mini_content {max-width: 135px; overflow-x:hidden; }
.holder{height:0!important; z-index:1;}
#menu_mini_nav{
	position:absolute;
	z-index:100;
}
#infscr-loading {
    text-align: center;
    z-index: 100;
    position: fixed;
    left: 41%;
    bottom: 10px;
    width: 200px;
    padding: 10px;
    background: black;
    opacity: 0.8;
    color: white;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
}
.js_pager_view_more_link {display:none;}
div.comment_mini_content_holder_icon {
    height: 0px;
}
#search_text{
	 height: 17px;
    left: 631px;
    position: absolute;
    top: 12px;
    width: 251px;
	}
#toptags{
	  position: absolute;
    right: 265px;
    top: 18px;
    width: 197px;
	}
#toptags a{
	color: black;
    font-weight: bold;
    margin-left: 17px;
	}
#toptags a img{

    font-weight: bold;
    margin-left: 0px;
	margin-left: -17px;
	}
#toptags label{
	margin-left: 0px;
	vertical-align: 9px;
	}
#socialbuttons{
  margin-top: -23px;
    position: absolute;
    right: -152px;
    width: 148px;
	
	}
#js_mp_id_0{
	top: 12px;
    width: 144px;
	left: 485px;
	position: absolute;
	}
	
.demo_container { width:980px; margin:0 auto; }
#demo_top_wrapper { margin:0 0 20px 0; }
#demo_top { height:100px; padding:20px 0 0 0; }
#my_logo { font:70px Georgia, serif; }
 
/* our menu styles */
#sticky_navigation_wrapper {   
	height: 79px;
    margin-left: -217px;
    margin-top: -123px;
    width: 1349px;
	}
#sticky_navigation { width:100%; height:50px; -moz-box-shadow: 0 0 5px #999; -webkit-box-shadow: 0 0 5px #999; box-shadow: 0 0 5px #999; 
z-index: 999;
background-color: #EFE3E5;
}
#sticky_navigation ul { list-style:none; margin:0; padding:5px; }
#sticky_navigation ul li { margin:0; padding:0; display:inline; }
#sticky_navigation ul li a { display:block; float:left; margin:0 0 0 5px; padding:0 20px; height:40px; line-height:40px; font-size:14px; font-family:Arial, serif; font-weight:bold; color:#ddd; background:#333; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; }
#sticky_navigation ul li a:hover, #sticky_navigation ul li a.selected { color:#fff; background:#111; }
</style>

<script language="javascript" type="text/javascript">
var sNotFound = "';  echo Phpfox::getPhrase('advancedmarketplace.no_advancedmarketplace_listings_found');  echo '";
var sCategory = "';  echo $this->_aVars['sCategory'];  echo '";
var sText = "';  echo $this->_aVars['sText'];  echo '";
var sSearchUrl = "';  echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace.search');  echo '";
var more = 0;
$(document).ready(function() {
    $container = $(\'#container\');    
    /*
	$container.imagesLoaded(function(){
        $container.masonry({                        
            itemSelector : \'.grid\',                            
            isAnimated: false,
            isRTL: false,
        });
    }); 
	*/	
	$container.masonry({                        
		itemSelector : \'.grid\',                            
		isAnimated: false,
		isRTL: false,
	});
	reloadItems(10);
	//setTimeout(function() {showListing();}, 2500);
	$(window).scroll(function() {
        var pBottom = $(window).height() + $(window).scrollTop() >= $(document).height();
        if (pBottom == true) {
            showListing();
        }
    });    
});

popupComment = function(item_id) {        
    var params = "width=600";
    var params = params + "&item_id=" + item_id;
    tb_show("", $.ajaxBox(\'advancedmarketplace.popupComment\', params));
    return false;
};
    
changeCategory = function() {
    $(\'#bIsDone\').html(\'0\');
    $(\'#listing_page\').html(\'1\');
    $(\'#tag\').html(\'\');
    showListing();
}

enterSearch = function(event) {
    var keycode = event.keyCode;
    if (keycode == 13) {
        $(\'#bIsDone\').html(\'0\');
        $(\'#listing_page\').html(\'1\');
        $(\'#tag\').html(\'\');
        showListing();
    }
}

clickTag = function(tag) {
    $(\'#bIsDone\').html(\'0\');
    $(\'#listing_page\').html(\'1\');
    $(\'#tag\').html(tag);		$(\'#js_mp_id_0\').val(0);
    showListing();
}

clickSort = function(sort) {
    $(\'#bIsDone\').html(\'0\');
    $(\'#listing_page\').html(\'1\');
    $(\'#tag\').html(\'\');
    $(\'#sort\').html(sort);
    showListing();
}

showBlockTag = function() {
    if ($(\'#tags\').is(\':visible\')) {
        $(\'#tags\').hide();
    } else {
       $(\'#tags\').show();
    }
}

showListing = function() {
    if ($(\'#bIsDone\').html() == \'1\' || $(\'#bIsLoading\').html() == \'1\') {
        return false;
    }
    showLoading();
    var page = parseInt($(\'#listing_page\').html());
    var sort = $(\'#sort\').html();
    var tag = $(\'#tag\').html();
    var category = $(\'#js_mp_id_0\').val();
    var text = $(\'#search_text\').val();
    $Core.ajax(\'advancedmarketplace.viewMoreListing\',
    {
        params:
        {
            page: page,
            category: category,
            text: text,
            tag: tag,
            sort: sort,
        },
        type: \'POST\',
        success: function(response)
        {    
            var response = $.parseJSON(response);
            var iTotal = response[\'iTotal\'];
            var sContent = response[\'sContent\'];
            var bIsDone = response[\'bIsDone\'];
            $(\'#bIsDone\').html(bIsDone);                        
            if (iTotal == 0)
            {
                $(\'#container\').html(\'<div style="padding:10px;">\' + sNotFound + \'</div>\');
                hideLoading();
                return;
            }
            $container = $(\'#container\');            		
			if (page > 1)
            {
                $container.append(sContent);                
            }
            else
            {
                $container.html(sContent);                 
            }  
			$(\'#listing_page\').html(page+1);
            reloadItems(500);
            hideLoading();            
            $Core.loadInit();
        }
    });
}
reloadItems = function(iTime) 
{
	setTimeout(function() {$container.masonry(\'reload\');hideLoading();}, iTime);
}
showLoading = function()
{
    $(\'#bIsLoading\').html(\'1\');
    $(\'#infscr-loading\').show();
    $(\'#infscr-loading img\').show();
    $(\'#infscr-loading span\').hide();
}
hideLoading = function()
{
    $(\'#bIsLoading\').html(\'0\');
    $(\'#infscr-loading\').fadeOut(\'slow\');    
    /*
    $(\'#infscr-loading img\').hide();
    $(\'#infscr-loading span\').show();
    setTimeout(function() {$(\'#infscr-loading\').fadeOut(\'slow\');}, 1000);
    */
}


/* START FLOATING MENU */
$(function() {
 
    // grab the initial top offset of the navigation
    var sticky_navigation_offset_top = $(\'#sticky_navigation\').offset().top;
     
    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var sticky_navigation = function(){
        var scroll_top = $(window).scrollTop(); // our current vertical position from the top
         
        // if we\'ve scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (scroll_top > sticky_navigation_offset_top) {
            $(\'#sticky_navigation\').css({ \'position\': \'fixed\', \'top\':0, \'left\':0 });
        } else {
            $(\'#sticky_navigation\').css({ \'position\': \'relative\' });
			
        }  
    };
     
    // run our function on load
    sticky_navigation();
     
    // and run it again every time you scroll
    $(window).scroll(function() {
         sticky_navigation();
    });
 
});
/*END FLOATING MENU */
</script>
<script src="';  echo Phpfox::getParam('core.path');  echo 'module/advancedmarketplace/static/jscript/masonry/jquery.masonry.min.js"></script>
<script src="';  echo Phpfox::getParam('core.path');  echo 'module/advancedmarketplace/static/jscript/pinit.js"></script>
'; ?>

<!--start -->
 
    <!-- this will be our navigation menu -->
<div id="sticky_navigation_wrapper">
<div id="sticky_navigation">
<div class="demo_container">
<div style="float: right; margin-right: 291px; margin-top: 23px;">
<?php echo $this->_aVars['sCategories']; ?>
<input onkeyup="return enterSearch(event);" type="text" name="search_text" id="search_text"  />
<div id="toptags">
<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace.search', array('sort' => 'latest')); ?>" onclick="clickSort('latest');return false;">New</a>
<a href="javascript:void(0);" onclick="showBlockTag();">Tags</a>
<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace.search', array('sort' => 'most-liked')); ?>" onclick="clickSort('most-liked');return false;">Popular</a>
<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace'); ?>">All</a>
<div id="socialbuttons"><strong><label><em> follow us </em></label></strong> <a href="http://www.facebook.com/pages/BazaarCorner-Community/372718919476074" target="_new"><img src="http://www.bazaarcorner.com/images/social/facebook-icon.png" /></a><a href="https://plus.google.com/u/0/115650280852785289743/" target="_new"><img src="http://www.bazaarcorner.com/images/social/googleplus-icon.png" /></a><a href="https://twitter.com/bazaarcorner" target="_new"><img src="http://www.bazaarcorner.com/images/social/twitter-icon.png" /></a></div></div>
</div>
            </div>
        </div>
    </div>

 
<!-- some other content should go here, in order to have a scrollbar -->

<!--end -->
<section id="wrapper">




<div id="loading" style="display:none;"><div style="padding:50px;width:100%;text-align:center;"><img src="<?php echo Phpfox::getParam('core.path'); ?>module/advancedmarketplace/static/image/large.gif" /></div></div>
<div id="container"><?php /* Cached: February 25, 2013, 5:25 am */  if ($this->_aVars['aListings']):  if (count((array)$this->_aVars['aListings'])):  foreach ((array) $this->_aVars['aListings'] as $this->_aVars['iKey'] => $this->_aVars['aListing']): ?>
<?php /* Cached: February 25, 2013, 5:25 am */ ?>
<div class="grid" >     
    <div class="grid-inner-block">   
     
                  
        <a href="<?php echo $this->_aVars['aListing']['url']; ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean(Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aListing']['title'])); ?>">
<?php if ($this->_aVars['aListing']['image_path'] != NULL): ?>
            <div class="imgholder"><img style="width:250px;height:<?php echo $this->_aVars['aListing']['image_height']; ?>" title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['aListing']['image_path']; ?>"/>
            <div style="position:absolute; bottom:8px; right:8px; width:46px; height:20px;"><a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fbazaarcorner.com%2F&media=<?php echo $this->_aVars['aListing']['url']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div></div>
<?php else: ?>
            <div class="imgholder"><img style="width:170px;height:<?php echo $this->_aVars['aListing']['image_height']; ?>" title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/noimage.png"  /></div>
<?php endif; ?>
        </a>
        <p>
<?php if ($this->_aVars['aListing']['price'] > 0): ?>
            <div style="background-color:#E3E3E3;border-radius: 5px; font-size: 18px; position:absolute;top:13px; padding-right: 5px;padding-left: 3px;padding-bottom: 2px;padding-top: 2px;left: 10px;"><img src="http://www.bazaarcorner.com/images/tag.png" width="20" height="20" /><font color="#000000"> <?php echo Phpfox::getService('core.currency')->getSymbol($this->_aVars['aListing']['currency_id']);  echo $this->_aVars['aListing']['price']; ?></font></div>
<?php endif; ?>
        </p>
        <div class="meta">	  
          
             
             
             
             
<div class="fb-like" data-href="<?php echo $this->_aVars['aListing']['url']; ?>" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="lucida grande"> </div>
            <div class="clear"></div>
            <a href="<?php echo $this->_aVars['aListing']['url']; ?>"><?php echo $this->_aVars['aListing']['title']; ?></a>
            
            <ul class="icons-order-list">
                <li>
                <?php
                    $past_time = $this->_aVars["aListing"]["time_stamp"];
                    $current_time = time();
                    $diff = $current_time - $past_time;
                    $days = floor($diff/(24*60*60));
                    $remainder = $diff - $days*(24*60*60);
                    $hours = floor($remainder/3600);
                    $remainder = $remainder - ($hours*60*60);
                    $minutes = floor($remainder/60);
                    $seconds = $remainder-$minutes*60;
                    echo $days>0 ? $days .'D': ($hours>0 ? $hours. 'H':($minutes>0?$minutes .'M':''));
                    ?>
                </li>
               
                <li class="comment">
<?php echo $this->_aVars['aListing']['aFeed']['total_comment']; ?>
                </li>
                <li class="buyit">
<?php if ($this->_aVars['aListing']['price'] > 0): ?>
                    <a href="<?php echo $this->_aVars['aListing']['url']; ?>">Grab It</a>
<?php else: ?>
                    <a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aListing']['user_name']); ?>">Contact Seller</a>
<?php endif; ?>
                </li>
            </ul>
        </div>           
    </div>     
    <div>         
<?php Phpfox::getBlock('advancedmarketplace.comment', array('aFeed' => $this->_aVars['aListing']['aFeed'],'feed_display' => 'mini')); ?>
    </div>
    <div class="add-comment"> 
        <a href="<?php if (! Phpfox ::isUser()):  echo Phpfox::getLib('phpfox.url')->makeUrl('user.login');  endif; ?>" <?php if (Phpfox ::isUser()): ?>onclick="popupComment(<?php echo $this->_aVars['aListing']['aFeed']['item_id']; ?>);return false;"<?php endif; ?>>Add Comment</a>
<?php if ($this->_aVars['aListing']['aFeed']['total_comment'] > 3): ?><span style="color:#EFE3E5;">|</span><a style="padding:0px 5px;" href="<?php echo $this->_aVars['aListing']['url']; ?>">View All</a><?php endif; ?>
    </div>
</div>
<?php endforeach; endif;  endif; ?></div>
</section>

<div style="display:none;" id="text"></div>
<div style="display:none;" id="sort"></div>
<div style="display:none;" id="tag"></div>
<div style="display:none;" id="listing_page">2</div>
<div style="display:none;" id="bIsLoading">0</div>
<div style="display:none;" id="bIsDone"><?php echo $this->_aVars['bIsDone']; ?></div>

<div id="infscr-loading"><img alt="Loading..." src="<?php echo Phpfox::getParam('core.path'); ?>module/advancedmarketplace/static/image/loading.gif"><span style="display:none;opacity: 1;" >No more pages to load.</span></div>



		
		
<?php if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
	</div>
<?php if (isset ( $this->_aVars['aFooter'] ) && count ( $this->_aVars['aFooter'] )): ?>
	<div class="bottom">
		<ul>
<?php if (count((array)$this->_aVars['aFooter'])):  $this->_aPhpfoxVars['iteration']['block'] = 0;  foreach ((array) $this->_aVars['aFooter'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['block']++; ?>

				<li id="js_block_bottom_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"<?php if ($this->_aPhpfoxVars['iteration']['block'] == 1): ?> class="first"<?php endif; ?>>
<?php if ($this->_aVars['sLink'] == '#'): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'ajax_image')); ?>
<?php endif; ?>
					<a href="<?php echo $this->_aVars['sLink']; ?>" id="js_block_bottom_link_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a>
				</li>
<?php endforeach; endif; ?>
		</ul>
	</div>
<?php endif; ?>
</div>
<?php unset($this->_aVars['sHeader'], $this->_aVars['sModule'], $this->_aVars['sComponent'], $this->_aVars['aFooter'], $this->_aVars['sBlockBorderJsId'], $this->_aVars['bBlockDisableSort'], $this->_aVars['bBlockCanMove'], $this->_aVars['aEditBar'], $this->_aVars['sDeleteBlock'], $this->_aVars['sBlockTitleBar'], $this->_aVars['sBlockJsId'], $this->_aVars['sCustomClassName']);  endif; ?>

<?php Phpfox::getBlock('ad.inner', array('sClass' => $this->_aVars['sClass'])); ?>
