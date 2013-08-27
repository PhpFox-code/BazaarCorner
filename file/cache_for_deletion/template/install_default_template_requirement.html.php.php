<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: March 2, 2013, 11:24 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: requirement.html.php 2526 2011-04-13 18:15:51Z Raymond_Benc $
 */
 
 

?>
<script type="text/javascript">
<!--
<?php echo '
	function showHiddenTags(oObj)
	{
		$(oObj).parents(\'.group_holder:first\').find(\'.table_hidden\').each(function()
		{			
			$(this).toggle();
		});
		
		return false;
	}
'; ?>

-->
</script>
<?php if (count((array)$this->_aVars['aChecks'])):  foreach ((array) $this->_aVars['aChecks'] as $this->_aVars['aGroup']): ?>
<?php if (count ( $this->_aVars['aGroup']['checks'] )): ?>
<div class="group_holder">	
	<div class="table_header">
<?php echo $this->_aVars['aGroup']['title']; ?>
	</div>
<?php if (count((array)$this->_aVars['aGroup']['checks'])):  foreach ((array) $this->_aVars['aGroup']['checks'] as $this->_aVars['sCheck'] => $this->_aVars['sValue']): ?>
	<div class="table<?php if (isset ( $this->_aVars['aGroup']['hide'] ) && ! $this->_aVars['sValue']): ?> table_hidden<?php endif; ?>"<?php if (isset ( $this->_aVars['aGroup']['hide'] ) && ! $this->_aVars['sValue']): ?> style="display:none;"<?php endif; ?>>
		<div class="table_left">
<?php echo $this->_aVars['sCheck']; ?>:
		</div>
		<div class="table_right">
<?php if ($this->_aVars['sValue']):  echo $this->_aVars['aGroup']['passed'];  if ($this->_aVars['sCheck'] == 'include/setting/server.sett.php'): ?> (Rename "include/setting/server.sett.php.new" to "include/setting/server.sett.php")<?php endif;  else:  echo $this->_aVars['aGroup']['failed'];  endif; ?>
		</div>
	</div>
<?php endforeach; endif; ?>
</div>
<?php endif; ?>
<?php endforeach; endif; ?>
<div class="table_clear">
<?php if ($this->_aVars['bIsPassed']): ?>
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("".$this->_aVars['sUrl'].".requirement"); ?>" id="install_form">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div><input type="hidden" name="val[passed]" value="1" /></div>
		<input type="submit" value="Proceed to next step" class="button" id="button" />
	
</form>

<?php else: ?>
	<input type="button" value="Refresh" onclick="window.location.href='<?php echo Phpfox::getLib('phpfox.url')->makeUrl("".$this->_aVars['sUrl'].".requirement"); ?>';" class="button" />	
<?php endif; ?>
</div>
