<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 8:27 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		PhpFox
 * @version 		$Id: email.html.php 1284 2009-11-27 23:44:31Z Raymond_Benc $
 */
 
 

 if ($this->_aVars['bHtml']): ?>	
<?php if ($this->_aVars['bMessageHeader']): ?>
<?php if (isset ( $this->_aVars['sName'] )): ?>
<?php echo Phpfox::getPhrase('core.hello_name', array('name' => $this->_aVars['sName'])); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('core.hello'); ?>
<?php endif; ?>,
	<br />
	<br />
<?php endif; ?>
<?php echo $this->_aVars['sMessage']; ?>
	<br />
	<br />
<?php echo $this->_aVars['sEmailSig']; ?>
<?php else: ?>
<?php if ($this->_aVars['bMessageHeader']): ?>
<?php if (isset ( $this->_aVars['sName'] )): ?>
<?php echo Phpfox::getPhrase('core.hello_name', array('name' => $this->_aVars['sName'])); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('core.hello'); ?>
<?php endif; ?>,
<?php endif; ?>
<?php echo $this->_aVars['sMessage']; ?>

<?php echo $this->_aVars['sEmailSig']; ?>
<?php endif; ?>
