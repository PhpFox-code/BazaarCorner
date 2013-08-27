<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 1, 2013, 9:35 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: form.html.php 1558 2010-05-04 12:51:22Z Raymond_Benc $
 */
 
 

?>
<?php (($sPlugin = Phpfox_Plugin::get('api.template_block_gateway_form_start')) ? eval($sPlugin) : false); ?>
<?php if (count ( $this->_aVars['aGateways'] )): ?>
<?php if (count((array)$this->_aVars['aGateways'])):  $this->_aPhpfoxVars['iteration']['gateways'] = 0;  foreach ((array) $this->_aVars['aGateways'] as $this->_aVars['aGateway']):  $this->_aPhpfoxVars['iteration']['gateways']++; ?>

<form method="post" action="<?php echo $this->_aVars['aGateway']['form']['url']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if (count((array)$this->_aVars['aGateway']['form']['param'])):  foreach ((array) $this->_aVars['aGateway']['form']['param'] as $this->_aVars['sField'] => $this->_aVars['sValue']): ?>
	<div><input type="hidden" name="<?php echo $this->_aVars['sField']; ?>" value="<?php echo $this->_aVars['sValue']; ?>" /></div>
<?php endforeach; endif; ?>
	<div class="<?php if (is_int ( $this->_aPhpfoxVars['iteration']['gateways'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['gateways'] == 1): ?> row_first<?php endif; ?>">
		<div class="h3"><?php echo $this->_aVars['aGateway']['title']; ?></div>
		<div class="extra_info">
<?php echo $this->_aVars['aGateway']['description']; ?>
		</div>
		<div class="p_4 t_right">
			<input type="submit" value="<?php echo Phpfox::getPhrase('api.purchase_with_gateway_name', array('gateway_name' => $this->_aVars['aGateway']['title'])); ?>" class="button" />
		</div>
	</div>

</form>

<?php endforeach; endif; ?>
<?php else: ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('api.opps_no_payment_gateways_have_been_set_up_yet'); ?>
</div>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('api.template_block_gateway_form_end')) ? eval($sPlugin) : false); ?>
