<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 7, 2013, 3:59 pm */ ?>
<?php if (Phpfox ::getLib('module')->getFullControllerName() != 'user.login'): ?>
<div id="login_links">
yawa
    <ul>
<?php if (Phpfox ::isModule('invite') && Phpfox ::getService('invite')->isInviteOnly()): ?>
<?php else: ?>
        <li class="signup_link"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.register'); ?>"><?php echo Phpfox::getPhrase('yousport.signup'); ?></a></li>
<?php endif; ?>
        <li class="login_link"><a class="has_drop_down" id="loginbtn"><?php echo Phpfox::getPhrase('yousport.login'); ?></a>
<?php (($sPlugin = Phpfox_Plugin::get('user.template.login_header_set_var')) ? eval($sPlugin) : false); ?>
            <ul id="header_menu_login">
                <li>
<?php if (isset ( $this->_aVars['bCustomLogin'] )): ?>
                    <div id="header_menu_login_holder">
<?php endif; ?>
                        <div class="header_menu_tit">Login</div>
                        <form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.login'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
                            <div class="header_menu_login_left">
                                <div class="header_menu_login_label"><?php if (Phpfox ::getParam('user.login_type') == 'user_name'):  echo Phpfox::getPhrase('user.user_name');  elseif (Phpfox ::getParam('user.login_type') == 'email'):  echo Phpfox::getPhrase('user.email');  else:  echo Phpfox::getPhrase('user.login');  endif; ?>:</div>
                                <div style="float:right"><input type="text" name="val[login]" value="" class="header_menu_login_input" tabindex="1" /></div>
                            </div>
                            <div class="clear"></div>
                            <div class="header_menu_login_right">
                                <div class="header_menu_login_label"><?php echo Phpfox::getPhrase('user.password'); ?>:</div>
                                <div ><input type="password" name="val[password]" value="" class="header_menu_login_input" tabindex="2" /></div>

                            </div>
                            <div class="clear"></div>
                            <div>
                                <div class="header_menu_forgot_pass">
                                    <a class="forgot_pass" href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.password.request'); ?>"><?php echo Phpfox::getPhrase('user.forgot_your_password'); ?></a>
                                </div>
                                <div class="header_menu_remeber_me">
                                    <label><input type="checkbox" name="val[remember_me]" value="" checked="checked" tabindex="4" /> <?php echo Phpfox::getPhrase('user.keep_me_logged_in'); ?></label>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="header_menu_login_button">
                                <input type="submit" value="<?php echo Phpfox::getPhrase('user.login_singular'); ?>" tabindex="3" />												
                            </div>
                        
</form>

<?php if (isset ( $this->_aVars['bCustomLogin'] )): ?>
                    </div>									
                    <div id="header_menu_login_custom">										
                        <div class="header_login_block"><?php echo Phpfox::getPhrase('user.or_login_with'); ?>: </div>										
<?php if (Phpfox ::isModule('facebook') && Phpfox ::getParam('facebook.enable_facebook_connect')): ?>
                        <div class="header_login_block">
                            <fb:login-button scope="publish_stream,email,user_birthday" v="2"></fb:login-button>
                        </div>
<?php endif; ?>
<?php if (Phpfox ::isModule('janrain') && Phpfox ::getParam('janrain.enable_janrain_login')): ?>
                        <div class="header_login_block">
                            <a class="rpxnow" onclick="return false;" href="<?php echo $this->_aVars['sJanrainUrl']; ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/janrain-icons.png')); ?></a>
                        </div>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('user.template.login_header_custom')) ? eval($sPlugin) : false); ?>
                    </div>
                    <div class="clear"></div>
<?php endif; ?>
                </li>
            </ul>


        </li>
    </ul>
</div>





<script type="text/javascript">
    <?php echo '
    $Behavior.focusOnLogin = function()
    {
        $(\'.header_menu_login_input:first\').focus();
        
        $("#loginbtn").unbind();
        $("#loginbtn").click(function(evt) {
            evt.preventDefault();
            
            var $this = $(this);
            var $parent = $this.parent();
            
            $parent.find("#header_menu_login").show();
            $parent.parent().find(".active").removeClass("active");
            $this.addClass("active");

            return false;
        });
        
        $("body").click(function(evt) {
            if($("#loginbtn").parent().find("#header_menu_login").is(":visible")) {
                var $cObj = $("#header_menu_login");
                
                var outWidth = $cObj.outerWidth();
                var outHeight = $cObj.outerHeight();
                var objPosX = getX($cObj.get(0));
                var objPosY = getY($cObj.get(0));
                
                var clientX = evt.clientX;
                var clientY = evt.clientY;
                //objPosX <= clientX && clientX <= (objPosX + outWidth) && objPosY <= clientY && clientY <= (objPosY + outHeight)
                if(!(objPosX <= clientX && clientX <= (objPosX + outWidth) && objPosY <= clientY && clientY <= (objPosY + outHeight))) {
                    $cObj.hide();
                }
                
                $("#loginbtn").addClass("active");
            }
        });
    }
    function getX( oElement )
    {
        var iReturnValue = 0;
        while( oElement != null ) {
            iReturnValue += oElement.offsetLeft;
            oElement = oElement.offsetParent;
        }
        return iReturnValue;
    }
    function getY( oElement )
    {
        var iReturnValue = 0;
        while( oElement != null ) {
            iReturnValue += oElement.offsetTop;
            oElement = oElement.offsetParent;
        }
        return iReturnValue;
    }
    $Core.loadInit();
    '; ?>

</script>

<?php endif; ?>
