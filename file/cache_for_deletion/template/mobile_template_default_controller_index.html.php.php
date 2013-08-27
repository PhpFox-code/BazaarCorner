<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 8:17 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: index.html.php 4031 2012-03-20 15:08:25Z Raymond_Benc $
 */
 
 

?>
						<div id="mobile_main_menu">		
<?php if (count((array)$this->_aVars['aMobileMenus'])):  $this->_aPhpfoxVars['iteration']['menu'] = 0;  foreach ((array) $this->_aVars['aMobileMenus'] as $this->_aVars['iKey'] => $this->_aVars['aMenu']):  $this->_aPhpfoxVars['iteration']['menu']++; ?>

							<div class="mobile_main_menu">
										<a href="<?php echo $this->_aVars['aMenu']['link']; ?>">
<?php if (isset ( $this->_aVars['aMenu']['total'] ) && $this->_aVars['aMenu']['total'] > 0): ?>
											<span class="new"><?php echo $this->_aVars['aMenu']['total']; ?></span>
<?php endif; ?>
											<img src="<?php echo $this->_aVars['aMenu']['icon']; ?>" alt="" />
											<div><?php echo $this->_aVars['aMenu']['phrase']; ?></div>
										</a>
							</div>
<?php if (is_int ( $this->_aPhpfoxVars['iteration']['menu'] / 3 )): ?>
									<div class="clear"></div>
<?php endif; ?>
								
<?php endforeach; endif; ?>
						</div>
						<div class="clear"></div>
