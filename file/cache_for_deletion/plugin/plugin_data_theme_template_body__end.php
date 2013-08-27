<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (Phpfox::getParam(\'facebook.enable_facebook_connect\'))
{
	// echo \'<div id="fb-root"></div>\';
} if (Phpfox::getParam(\'janrain.enable_janrain_login\'))
{
	echo \'<script type="text/javascript">
		  var rpxJsHost = (("https:" == document.location.protocol) ? "https://" : "http://static.");
		  document.write(unescape("%3Cscript src=\\\'" + rpxJsHost +
		"rpxnow.com/js/lib/rpx.js\\\' type=\\\'text/javascript\\\'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		  RPXNOW.overlay = true;
		  RPXNOW.language_preference = \\\'en\\\';
		</script>\';	
} '; ?>