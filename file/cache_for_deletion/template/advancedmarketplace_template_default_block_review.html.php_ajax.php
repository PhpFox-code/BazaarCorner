<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: August 3, 2013, 10:39 pm */ ?>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php echo '
<style type="text/css">
    table.yn_review {
		width: 100%;
    }
    table.yn_review td {
        text-align: left;
        vertical-align: top;
        padding:5px;
        color: #7B7B7B;
        font-size: 12px;
		width: 100%;
    }
    table.yn_review tr{
		border-bottom: 1px solid #E4E4E4;
		margin-bottom: 3px;
	}
    table.yn_review tr td{
		padding-top: 20px;
		padding-bottom: 20px;
	}
    table.yn_review td.detail_content
    {
		position: relative;
		width: 100%;
		display: block;
    }
    table.yn_review td.image_user
    {
        text-align: center;
        width: 80px;
    }
    table.yn_review td.review{
		text-align: center;
	}
    table.yn_review td.review div.anchor{
		text-align: center;
		position: relative;
		padding-top: 10px;
	}
    .add_new_review a
    {
        float: right;
        font-size: 12px;
        padding: 10px;
    }

    .rwdelete {
        background-position: 0 100%;
		display: block;
		width: 12px;
		position: absolute;
		right: 15px;
		top: 5px;
		height: 12px;
        background-image: url("';  echo $this->_aVars['corepath'];  echo 'module/advancedmarketplace/static/image/default/manibuton.png");
		opacity: 0.4;
		filter: alpha(opacity = 40);
    }

    .rwdelete:hover {
		opacity: 1;
		filter: alpha(opacity = 100);
    }
	
	.ssbt {
		padding-left: 20px!important;
		padding-right: 20px!important;
		margin-top: 20px!important;
	}
	
	.owner-detail .user-image {
		width: 50px;
		float: left;
	}
	
	.owner-detail .anchor {
		float: left;
		min-width: 400px;
		padding-left: 15px;
	}
	
	.detail_content .review-content {
		clear: both;
		width: 100%;
		padding-top: 15px;
		color: #474747;
	}
</style>
<script type="text/javascript" language="javascript">
    $Behavior.advmarket_ratingJS = function(){
		$(".rwdelete").click(function(evt){
			evt.preventDefault();
			
			if(confirm(\'';  echo Phpfox::getPhrase('advancedmarketplace.are_you_sure', array('phpfox_squote' => true));  echo '\')){
				$.ajaxCall("advancedmarketplace.deleteReview", "rid=" + $(this).attr("ref"));
			}
			
			return false;
		});
	}
</script>
'; ?>

<?php if (( $this->_aVars['iCurrentUserId'] !== ( ( int ) $this->_aVars['aListing']['user_id'] ) )): ?>
	<div class="add_new_review yn_reviewrating" id="yn_advmarketplace_rating">
		<input class="button ssbt" type="button" value="<?php echo Phpfox::getPhrase('advancedmarketplace.add_new_review'); ?>" />
	</div>
<?php else: ?>
	<div class="add_new_review yn_reviewrating" id="yn_advmarketplace_rating">
		&nbsp;
	</div>
<?php endif; ?>
<div class="clear"></div>
<?php if (count ( $this->_aVars['aRating'] )): ?>
	<table class="yn_review">
<?php if (count((array)$this->_aVars['aRating'])):  foreach ((array) $this->_aVars['aRating'] as $this->_aVars['iKey'] => $this->_aVars['aRate']): ?>
			<tr id="rw_ref_<?php echo $this->_aVars['aRate']['rate_id']; ?>">
				<td class="detail_content">
<?php if (phpfox ::getUserParam('advancedmarketplace.delete_other_reviews') || ( phpfox ::getUserParam('advancedmarketplace.can_delete_own_review') && $this->_aVars['aRate']['user_id'] == phpfox ::getUserId())): ?>
						<a href="#" ref="<?php echo $this->_aVars['aRate']['rate_id']; ?>" class="rwdelete">&nbsp;</a>
<?php endif; ?>
					<div class="owner-detail">
						<div class="user-image">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aRate'],'suffix' => '_50_square','max_width' => '50','max_height' => '50')); ?>
						</div>
						<div class="anchor">
							<div class="">
								
								<div class="listing_rate" style="background: none;width: 140px;height: 18px;">
<?php for($i = 1; $i <= $this->_aVars["aRate"]["rating"] / 2; $i++) { ?>
										<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/staronsm.png" />
<?php } ?>
<?php for($i = 1; $i <= 5 - $this->_aVars["aRate"]["rating"] / 2; $i++) { ?>
										<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/staroffsm.png" />
<?php } ?>
								</div>
							</div>
							<div>
<?php echo Phpfox::getTime(Phpfox::getParam('advancedmarketplace.advancedmarketplace_view_time_stamp'), $this->_aVars['aRate']['timestamp']); ?>&nbsp;|&nbsp;<?php echo Phpfox::getPhrase("advancedmarketplace.by"); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aRate']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aRate']['user_name'], ((empty($this->_aVars['aRate']['user_name']) && isset($this->_aVars['aRate']['profile_page_id'])) ? $this->_aVars['aRate']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aRate']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?>
							</div>
						</div>
					</div>
					
<?php if ($this->_aVars['aRate']['content']): ?>
						<div class="review-content">
<?php echo $this->_aVars['aRate']['content']; ?>
						</div>
<?php endif; ?>
				</td>
			</tr>
<?php endforeach; endif; ?>
	</table>
<?php endif; ?>
<?php if (count ( $this->_aVars['aRating'] ) > 0): ?>
<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager'); ?>
<?php else: ?>
	<div class="extra_info">
<?php echo Phpfox::getPhrase('advancedmarketplace.no_reviews_found'); ?>
	</div>
<?php endif; ?>
<input type="hidden" id="xf_page" value="<?php echo $this->_aVars['page']; ?>" />
