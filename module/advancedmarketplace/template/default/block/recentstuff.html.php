<?php
if(isset($this->_aVars['aListings']) && count($this->_aVars['aListings']) > 0 ):
$aListings = $this->_aVars['aListings'];
?>

<div class="row">
    <div class="ten columns"><h3>Recently Added Stuff</h3></div>
    <div class="two column" style="margin-top: 20px"><a href="#" style="float:right">view more</a></div>
</div>

<div class="row" id="recentstuff">
    <?php foreach($aListings as $aListing): ?>
        <div class="item ">
            <!-- Item Image -->
            <span class="ItemImage">
                <?php $image_path = (isset($aListing['image_path']) && !empty($aListing['image_path'])) ? $aListing['image_path'] : $this->_aVars['corepath'].'module/advancedmarketplace/static/image/default/noimage.png';?>
                <img src="<?=$image_path?>" class="img-shadow" title="<?=$aListing['title']?>"/>
            </span>
            <div class="ItemAction">
                <div class="wrap"></div>
                <div class="wrap-desc">
                <span class="item-title"><?=ucfirst($aListing['title'])?></span>
                <span class="item-price">$<?=$aListing['price']?></span>
                </div>
            </div>
            <div class="ItemAction2">
                <div class="wrap"></div>
                <div class="wrap-desc">
                    <span class="item-title"><?=ucfirst($aListing['title'])?></span>
                    <span class="item-price">$<?=$aListing['price']?></span>
                    <span class="item-preview-btn">
                        <a href="#" class="button radius">Preview</a>
                    </span>
                    <div class="social-buttons">
                        <a title="Share on facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=$aListing['url']?>" target="_blank">
                            <img src="/theme/frontend/yousport/template/new/images/icons/facebook.png">
                        </a>
                        &nbsp;
                        <a title="Share on twitter" href="https://twitter.com/intent/tweet?original_referer=<?=$this->_aVars['corepath']?>&amp;text=Check this out! '&amp;tw_p=tweetbutton&amp;url=<?=$aListing['url']?>" class="btn" id="b" target="_blank">
                            <img src="/theme/frontend/yousport/template/new/images/icons/twitter.png">
                        </a>
                        <!--
                        &nbsp;
                        &nbsp;
                        <a href="https://www.pinterest.com/BazaarCorner2012" target="_blank">
                            <img src="/theme/frontend/yousport/template/new/images/icons/pinterest.png">
                        </a>
                        -->
                    </div>
                    <!--
                    <div class="item-category">
                        <span class="item-category-label">Category:</span>
                        <span class="item-category-text">Fashion</span>
                    </div>
                    -->
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>