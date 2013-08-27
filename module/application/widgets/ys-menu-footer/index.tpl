<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2011 YouNet Developments
 */
?>
<?php $route = $this->viewer()->getIdentity()
             ? array('route'=>'user_general', 'action'=>'home')
             : array('route'=>'default'); ?>
<div class="minu_footer">
    <ul>
        <?php foreach( $this->navigation as $item ): ?>
        <li class="MiniFooter"><?php echo "<a href='" . $item->getHref() . "'><b>" . $this->translate($item->getLabel()) . "</b></a>" ?></li>
        <?php endforeach; ?>
        
        <li class="follt"><?php echo $this->htmlLink('http://twitter.com/#!/Modules2Buy','')?></li>
        <li class="follf"><?php echo $this->htmlLink('http://www.facebook.com/pages/Modules2Buy/131149303573349?ref=ts','')?></li>
    </ul>
</div>
<div class="Clear"></div>
<div class="logo_footer">
    <div class="LogoFooter">
        <div class="ImgLogo"><?php echo $this->htmlLink($route, "<img src='" . $this->baseUrl('/application/themes/yousport/images/logo-footer.png') . "'>");?></div>
        <div class="DesignBy">
            <span><?php echo $this->translate('Copyright &copy;%s', date('Y')),' ','by' ?> <?php echo $this->translate('YouNet.') ?> 
				<?php echo $this->translate('Allrights reserved') ?>
			</span>
            <span><?php echo $this->translate('Designed by YouNet') ?></span>           
        </div>       
    </div>
    <div class="FooterLanguage">
            <?php if( 1 !== count($this->languageNameList) ): ?>
            <form method="post" action="<?php echo $this->url(array('controller' => 'utility', 'action' => 'locale'), 'default', true) ?>" style="display:inline-block">
              <?php $selectedLanguage = $this->translate()->getLocale() ?>
              <?php echo $this->formSelect('language', $selectedLanguage, array('onchange' => '$(this).getParent(\'form\').submit();'), $this->languageNameList) ?>
              <?php echo $this->formHidden('return', $this->url()) ?>
            </form>
    <?php endif; ?>
    </div>
</div>
 