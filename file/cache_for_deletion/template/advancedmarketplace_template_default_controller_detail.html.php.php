<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:12 am */ ?>
<?php




 echo '
<style type="text/css">
    div#content #js_advancedmarketplace_listingdetail_tab div.menu
    {
        height:34px;
        background: #ececec;
        border-bottom: #dfdfdf;
    }
    div#content #js_advancedmarketplace_listingdetail_tab div.menu ul
    {
        padding-left: 10px;
    }
    div#content #js_advancedmarketplace_listingdetail_tab div.menu ul li a
    {
        line-height: 33px;
        font-size: 14px;
        color: #000;
    }
    div#content #js_advancedmarketplace_listingdetail_tab div.menu ul li.active
    {
        background: url(';  echo $this->_aVars['corepath'];  echo 'module/advancedmarketplace/static/image/default/menu-l.png) no-repeat;
		padding-left: 14px;
		margin-top: -4px;
    }
    div#content #js_advancedmarketplace_listingdetail_tab div.menu ul li.active a
    {
        background: url(';  echo $this->_aVars['corepath'];  echo 'module/advancedmarketplace/static/image/default/menu-r.png) no-repeat 100% 0;
		display: block;
		line-height: 38px;
		padding-right: 22px;
		}
    div#content #js_advancedmarketplace_listingdetail_tab div.menu ul li a
    {
        border:none;
        border-radius:0;
        background: none;
    }
    .short_description_title
    {
        background: url(';  echo $this->_aVars['corepath'];  echo 'module/advancedmarketplace/static/image/default/border.png) repeat-x bottom;
    margin: 20px 0;
    }
    .description_title
    {
        background: #fff;
        font-size: 14px;
        padding: 4px 19px 4px 0;
    }
    .listing_detail
    {
        padding-left: 10px;
    }
    .short_description_content
    {
        color: #7B7B7B;
        font-size: 12px;
    }
    .short_description_content table tr td
    {
        height: 20px;
        width: 135px;
    }
	.native-float-div {
		position: absolute;
		right: -270px;
		top: -30px;
	}
	.native-float-div .aitem {
		margin-left: 5px;
	}
	.view_more_link {
		background-position: 64% 60% !important;
		padding-left: 170px !important;
		}
	.item_bar_action_holder ul {
		border: none;
	}
</style>    
'; ?>


<div class="yn_detail_block">
		<div id="js_advancedmarketplace_listingdetail_tab" class="">
			<div class="menu">
				<ul id="yn_tab">
					<li class="first active"><a id="yn_show_yn_listingcontent" href="#"><?php echo Phpfox::getPhrase('advancedmarketplace.listing_detail'); ?></a></li>
					<li class="last"><a id="yn_show_yn_listingrating" href="#"><?php echo Phpfox::getPhrase('advancedmarketplace.review'); ?> (<span class="review-count"><?php echo $this->_aVars['iRatingCount']; ?></span>)</a></li>
				</ul>
				<div class="clear"></div>
			</div>
		<div class="">

			<div id="yn_listingcontent">
<?php Phpfox::getBlock("advancedmarketplace.listingdetail", array()); ?>
			</div>

			<div id="yn_listingrating" style="display: none;">
<?php Phpfox::getBlock("advancedmarketplace.review", array('aRating' => $this->_aVars['aRating'],'iCount' => $this->_aVars['iCount'],'iPage' => $this->_aVars['iPage'],'iSize' => $this->_aVars['iSize'])); ?>
			</div>
		</div>
	</div>
</div>

<div class="item_view">
	<div <?php if ($this->_aVars['aListing']['view_id'] != 0): ?>style="display:none;" class="js_moderation_on"<?php endif; ?>>
<?php Phpfox::getBlock('feed.comment', array()); ?>
	</div>
</div>


<div class="native-float-div">
	<a style="display: none;" class="aitem" onclick="$Core.composeMessage({'user_id': <?php echo PHPFOX::getUserId(); ?>}); return false;" href="">
		<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/item_mail.png" />
	</a>
	<a style="display: none;" class="aitem yn_reviewrating" href="" alt="<?php echo Phpfox::getPhrase("advancedmarketplace.rate_this_listing"); ?>" title="<?php echo Phpfox::getPhrase("advancedmarketplace.rate_this_listing"); ?>">
		<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/item_comment.png" />
	</a>
<?php if(phpfox::getParam('advancedmarketplace.can_print_a_listing') == true) { ?>
	<a class="aitem print remove_otheraction" target="_blank" href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("advancedmarketplace.print");  echo $this->_aVars['aListing']['listing_id']; ?>">
		<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/item_print.png" />
	</a>
<?php } ?>
</div>

<?php echo '
<script language="javascript" type="text/javascript">
	var iCheck = 0;
	function updateReviewCount(iCount) {
		
	}
	$Behavior.advancedmarketplaceRating = function(){
		$(".yn_reviewrating").children("input").click(function(evt){
			evt.preventDefault();
			var page = ($("#xf_page").size() > 0)?$("#xf_page").val():0;
			tb_show("';  echo Phpfox::getPhrase("advancedmarketplace.rating", array('phpfox_squote' => true));  echo '", $.ajaxBox(\'advancedmarketplace.ratePopup\', \'height=300&page=\' + page + \'&width=550&id=';  echo $this->_aVars['aListing']['listing_id'];  echo '\'));
			return false;
		});
	};
	$Behavior.advancedmarketplaceViewDetail = function(){
		var fadeTTime = 100;
		$("#yn_show_yn_listingcontent").click(function(evt){
			evt.preventDefault();
			$("#yn_listingcontent").stop(false, false).fadeIn(fadeTTime, function(){
				$("#yn_listingrating").fadeOut(fadeTTime);
			});
			$("#yn_tab").find(".active").removeClass("active");
			$(this).parent().addClass("active");
			return false;
		});
		$("#yn_show_yn_listingrating").click(function(evt){
			evt.preventDefault();
			$("#yn_listingrating").stop(false, false).fadeIn(fadeTTime, function(){
				$("#yn_listingcontent").fadeOut(fadeTTime);
			});
			$("#yn_tab").find(".active").removeClass("active");
			$(this).parent().addClass("active");
			return false;
		});
		
		if(iCheck == 0)
		{
			$("#yn_listingrating").hide();
			iCheck++;
		}
		$(".remove_otheraction").unbind();
		
		if($("#right").size()) {
			$(".native-float-div").css({
				"right": ("-" + $("#right").width() + "px")
			});
		}
	};
</script>
'; ?>

