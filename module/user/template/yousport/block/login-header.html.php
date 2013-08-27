{if Phpfox::getLib('module')->getFullControllerName() != 'user.login'}
<div id="login_links">
yawa
    <ul>
        {if Phpfox::isModule('invite') && Phpfox::getService('invite')->isInviteOnly()}
        {else}
        <li class="signup_link"><a href="{url link='user.register'}">{phrase var='yousport.signup'}</a></li>
        {/if}
        <li class="login_link"><a class="has_drop_down" id="loginbtn">{phrase var='yousport.login'}</a>
            {plugin call='user.template.login_header_set_var'}
            <ul id="header_menu_login">
                <li>
                    {if isset($bCustomLogin)}
                    <div id="header_menu_login_holder">
                        {/if}
                        <div class="header_menu_tit">Login</div>
                        <form method="post" action="{url link='user.login'}">
                            <div class="header_menu_login_left">
                                <div class="header_menu_login_label">{if Phpfox::getParam('user.login_type') == 'user_name'}{phrase var='user.user_name'}{elseif Phpfox::getParam('user.login_type') == 'email'}{phrase var='user.email'}{else}{phrase var='user.login'}{/if}:</div>
                                <div style="float:right"><input type="text" name="val[login]" value="" class="header_menu_login_input" tabindex="1" /></div>
                            </div>
                            <div class="clear"></div>
                            <div class="header_menu_login_right">
                                <div class="header_menu_login_label">{phrase var='user.password'}:</div>
                                <div ><input type="password" name="val[password]" value="" class="header_menu_login_input" tabindex="2" /></div>

                            </div>
                            <div class="clear"></div>
                            <div>
                                <div class="header_menu_forgot_pass">
                                    <a class="forgot_pass" href="{url link='user.password.request'}">{phrase var='user.forgot_your_password'}</a>
                                </div>
                                <div class="header_menu_remeber_me">
                                    <label><input type="checkbox" name="val[remember_me]" value="" checked="checked" tabindex="4" /> {phrase var='user.keep_me_logged_in'}</label>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="header_menu_login_button">
                                <input type="submit" value="{phrase var='user.login_singular'}" tabindex="3" />												
                            </div>
                        </form>
                        {if isset($bCustomLogin)}
                    </div>									
                    <div id="header_menu_login_custom">										
                        <div class="header_login_block">{phrase var='user.or_login_with'}: </div>										
                        {if Phpfox::isModule('facebook') && Phpfox::getParam('facebook.enable_facebook_connect')}
                        <div class="header_login_block">
                            <fb:login-button scope="publish_stream,email,user_birthday" v="2"></fb:login-button>
                        </div>
                        {/if}
                        {if Phpfox::isModule('janrain') && Phpfox::getParam('janrain.enable_janrain_login')}
                        <div class="header_login_block">
                            <a class="rpxnow" onclick="return false;" href="{$sJanrainUrl}">{img theme='layout/janrain-icons.png'}</a>
                        </div>
                        {/if}
                        {plugin call='user.template.login_header_custom'}
                    </div>
                    <div class="clear"></div>
                    {/if}
                </li>
            </ul>


        </li>
    </ul>
</div>

{*<div id="login_links">
    <ul>
        {if Phpfox::isModule('invite') && Phpfox::getService('invite')->isInviteOnly()}
        {else}
        <li class="signup_link"><a href="{url link='user.register'}">Signup</a>


        </li>
        {/if}
        <li class="login_link">
            <a href="javascript:void(0)" onclick="{literal}$('#header_menu_login').toggle('slow');$('.login_link a').toggle('slow');{/literal}">Login</a>
            <a href="javascript:void(0)" onclick="{literal}$('#header_menu_login').toggle('slow');$('.login_link a').toggle('slow');{/literal}" style="display:none;">Close</a>
        </li>

    </ul>
</div>*}



<script type="text/javascript">
    {literal}
    $Behavior.focusOnLogin = function()
    {
        $('.header_menu_login_input:first').focus();
        
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
    {/literal}
</script>

{/if}