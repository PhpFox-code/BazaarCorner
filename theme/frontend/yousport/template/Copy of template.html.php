
{if !PHPFOX_IS_AJAX_PAGE}



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{$sLocaleDirection}" lang="{$sLocaleCode}">
	<head>
    <link type="text/css" href="/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8">
<script type="text/javascript" src="/cometchat/cometchatjs.php" charset="utf-8"></script>
		<title>{title}</title>	
		{header}
        {literal}
     <style>
     #main_core_body_holder{
		 height:96px;
		 }
 
     </style>
     
     
     {/literal}
      
    
  
     
     
	</head>
	<body class="{$spage}">
		{body}	
		{block location='9'}
		<div id="header">
                    {if Phpfox::getParam('user.hide_main_menu') && !Phpfox::isUser()}
			
			{else}
			<div id="header_menu_page_holder">	
				<div class="holder">
					<div id="header_menu">	
                    <div style="float:left; width:331px; height:133px; ">
						<a href="http://localhost/bazaarcorner.com/index.php?do=/#_=_">
                        <img src="http://www.bazaarcorner.com/images/logo.png" width="310" height="103" border="0" align="BazaarCorner" />
                        </a>
                        </div>
                        {if Phpfox::isUser()}
                        <div style="margin-top:5px; float: left;margin-top:11px;width: 216px;">
                        {menu}
                        </div>
                        
                        {/if}
                      
						
                                                <div id="header_menu_holder">
								{if Phpfox::isUser()}
                                <div style="background:#000; height: 55px;margin-top: 0px;">
                                <center>
                                
<strong style="color:#E117B8; font-size:16px;">Hi</strong> <span style="color:#FFF;font-size:16px;">{$sGlobalUserFullName}!</span>
</center>
								{menu_account}
                                
                                
								<div class="clear"></div>	
								{else}
								
								{/if}
                                </div>							
						</div>	
					</div>		
				</div>			
			</div>	
			{/if}
			<div class="holder">
				{block location='10'}
				<div id="header_holder" {if !Phpfox::isUser()} class="header_logo"{/if}>				
					
					<div id="header_right">
						<div id="header_top">
							
													
																			
						</div>
					</div>
                               <div id="menu_mini_nav">
                                   <div class="abc">
				<div id="navigation">
                                    <div id="right_nav">
					<ul id="menu_mini">
                                            <li class="header_menu_mini">
                                           {if !Phpfox::getUserBy('profile_page_id')}
                                            
                                            </div>	
                                            {/if}
                                            {if Phpfox::isUser() && !Phpfox::getUserBy('profile_page_id')}
							<div id="holder_notify">																	
								{notification}
								<div class="clear"></div>
							</div>
							{/if}
                                            </li>
                                        </ul>				
                                    </div>
				</div>
                                   </div>
                                </div>
					{block location='6'}
				</div>
			</div>
						
								
		</div>
		
		<div id="{if Phpfox::isUser()}main_core_body_holder{else}main_core_body_holder_guest{/if}">
		
			{block location='11'}

			<div id="main_content_holder">
			{/if}
				<div {holder_name}>		
					<div {is_page_view} class="holder">	
						<div id="content_holder">		
                                                    
							{block location='7'}				
							{if !defined('PHPFOX_IS_USER_PROFILE') && !defined('PHPFOX_IS_PAGES_VIEW')}
							{breadcrumb}
							{/if}
                                                      
							{if !$bUseFullSite && (count($aBlocks1) || count($aAdBlocks1)) || (isset($aFilterMenus) && is_array($aFilterMenus) && count($aFilterMenus))}					
							<div id="left">
								{menu_sub}
								{block location='1'}					
							</div>					
							{/if}

							<div id="main_content">
								{if !defined('PHPFOX_IS_USER_PROFILE') && !defined('PHPFOX_IS_PAGES_VIEW')}
								{search}
								{/if}
								<div id="main_content_padding">

									{if defined('PHPFOX_IS_USER_PROFILE')}
									{module name='profile.header'}							
									{/if}
									{if defined('PHPFOX_IS_PAGES_VIEW')}
									{module name='pages.header'}							
									{/if}							

									<div id="content_load_data">
										{if isset($bIsAjaxLoader) || defined('PHPFOX_IS_USER_PROFILE') || defined('PHPFOX_IS_PAGES_VIEW')}
										{search}
										{/if}								

										{if isset($aBreadCrumbTitle) && count($aBreadCrumbTitle)}
										<h1><a href="{$aBreadCrumbTitle[1]}">{$aBreadCrumbTitle[0]|clean|split:30}</a></h1>
										{/if}

										<div id="content" {content_class}>
											{error}
												<div class="{if isset($spage)&&$spage == 'visitor index'}younetblog{/if}">												
												{block location='2'}																							</div>
                                                                                        
											{content}
                                                                                        <div class="{if isset($spage)&&$spage == 'visitor index'}younetevent{/if}">
											{block location='4'}
                                                                                    </div>
										</div>

										{if !$bUseFullSite && (count($aBlocks3) || count($aAdBlocks3))}
										<div id="right">								
											{block location='3'}
										</div>
										{/if}

										<div class="clear"></div>							
									</div>												
								</div>				
							</div>
							<div class="clear"></div>	
                                                        
						</div>	
                                            <div class="content_holder_l">
                                                <div class="content_holder_r">
                                                    <div class="content_holder_m">&nbsp;
                                                     </div>
                                                </div>
                                            </div>
						{block location='8'}
					</div>							
				</div>			
			{if !PHPFOX_IS_AJAX_PAGE}
			</div>		
			<div id="main_footer_holder">
				<div class="holder">
					<div id="footer">		
						{menu_footer}					
						<div id="copyright">
							{copyright}
						</div>
						<div class="clear"></div>				
						{block location='5'}
					</div>				
				</div>			
			</div>		
			{footer}		
		</div>
        
	</body>
</html>
{/if}

