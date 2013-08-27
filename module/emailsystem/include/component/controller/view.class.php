<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Controller_View extends Phpfox_Component
{
	public function process()
	{
		$iId = $this->request()->getInt('id', null);
		if ($iId === null)
		{
			$this->url()->send('newsletter', null, Phpfox::getPhrase('newsletter.that_newsletter_does_not_exist'));
		}
		$sMode = $this->request()->getInt('mode', 'html');
		if ($sMode != 'html' && $sMode != 'plain')
		{
			$this->url()->send('newsletter', null, Phpfox::getPhrase('newsletter.please_choose_either_html_or_plain_text'));
		}
		$aNewsletter = Phpfox::getService('newsletter')->get($iId);
		$aNewsletter['mode'] = $sMode;
		
		$this->template()
			->setTemplate('blank')
			->assign(array(
				'aNewsletter' => $aNewsletter,
				'view.js' => 'module_newsletter'
			))
			->setHeader(array(
				'<script>sUrl = "' . $this->url()->makeUrl('newsletter.view', array('id' => $iId)) . '"</script>',
				'view.js' => 'module_newsletter'
			));
	}
}
?>
