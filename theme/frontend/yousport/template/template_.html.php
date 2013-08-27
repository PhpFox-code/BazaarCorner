
{if !PHPFOX_IS_AJAX_PAGE}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{$sLocaleDirection}" lang="{$sLocaleCode}">
	<head>
    <link type="text/css" href="/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8">
<script type="text/javascript" src="/cometchat/cometchatjs.php" charset="utf-8"></script>
		<title>{title}</title>	
		
		
		
				
		
		{header}
		
<!-- added header stuff - start-->		
<?php include 'site_path.php'; ?>		

  <link rel="stylesheet" href="<?=$host_?>/theme/frontend/yousport/template/css/normalize.min.css" />
  <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?=$host_?>/theme/frontend/yousport/template/css/default.min.css" />
  <link rel="stylesheet" href="<?=$host_?>/theme/frontend/yousport/template/css/style.css" />
  <link rel="stylesheet" href="<?=$host_?>/theme/frontend/yousport/template/css/app.css" />
  <link rel="stylesheet" type="text/css" href="<?=$host_?>/theme/frontend/yousport/template/css/jquery.jscrollpane.css" media="all" />
<!-- added header stuff - end-->		
		
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
						<!--+ed commenting old logo -start -->
						<!--
						<div style="float:left; width:331px; height:133px; ">
							<a href="http://localhost/bazaarcorner.com/index.php?do=/#_=_">
							<img src="http://www.bazaarcorner.com/images/logo.png" width="310" height="103" border="0" align="BazaarCorner" />
							</a>
						</div>
						-->
						
<!--+ed HEADER START-->
<?php include $theme_path.'header.html';?>
<!--HEADER END-->						
						
						
												<!--+ed commenting old logo -end -->
						
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
											<!-- +ed login form -start -->
											{if isset($spage)&&$spage != 'visitor index'}
											{error}
											
											{block location='2'}
											
											{/if}												<!-- +ed if visitor index - start -->
												<!-- cover: commented block loc=2 and filled-in the new design -->	
												
							<!-- ++ed -->		{if isset($spage)&&$spage == 'visitor index'} <!-- ++ed -->	
												<div class="{if isset($spage)&&$spage == 'visitor index'}younetblog{/if}">													<!-- orig - start -->
													<!-- {block location='2'} -->
													<!-- orig - end -->
													
													
													<!-- new index -start -->
													<div id="divWrapper">													
														<div class="row" style="margin-top: 20px">
															<div class="three columns">
																<!--BAZAAR COLLECTION AND PAGES START-->
																<?php include $theme_path.'collection_pages.html';?>
																<!--BAZAAR COLLECTION AND PAGES END-->
															</div>
															<div class="six columns">
																<!--SEARCH START-->
																<?php include $theme_path.'search.html';?>
																<!--SEARCH END-->
															</div>
															<div class="three columns">
																<!--CLICK TO SELL START-->
																<?php include $theme_path.'click_to_sell.html';?>
																<!--CLICK TO SELL END-->
															</div>
														</div>
														<!--HEADER END-->


														<div class="row" style="margin-top: 20px">
														<!--MENU, BANNER, FEATURED START-->
															<div class="three columns">
																<!--MENU START-->
																<?php include $theme_path.'menu.html';?>
																<!--MENU END-->
															</div>
															<div class="six columns">
																<!--BANNERSLIDE START-->
																<?php include $theme_path.'bannerslide.html';?>
																<!--BANNERSLIDE END-->
															</div>
															<div class="three columns">
																<!--BANNERSLIDE START-->
																<?php include $theme_path.'featured_merchant.html';?>
																<!--BANNERSLIDE END-->
															</div>
														<!--MENU, BANNER, FEATURED END-->
														</div>

														<div class="row">
															<div class="nine columns">
																<!--RECENTLY ADDED STUFF START-->
																<?php include $theme_path.'recently_added.html';?>
																<!--RECENTLY ADDED STUFF END-->
																
																<!--HALF THE TAG PRICE START-->
																<?php include $theme_path.'half_tag_price.html';?>
																<!--HALF THE TAG PRICE END-->
															</div><br /><br /><br />

															<div class="three columns">
																<!--MOST BOUGHT START-->
																<?php include $theme_path.'most_bought.html';?>
																<!--MOST BOUGHT END-->
																<!--BRANDS START-->
																<?php include $theme_path.'brands.html';?>
																<!--BRANDS STUFF END-->
															</div>
														</div>

														<div class="row"><div style="margin: 100px 0px 20px 0px;"><hr /></div></div>

														<!--FOOTER START-->
														<?php include $theme_path.'footer.html';?>
														<!--FOOTER END-->

														<!--FOOTER START-->
														<?php include $theme_path.'video_modal.html';?>
														<!--FOOTER END-->


														<!--FOOTER START-->
														<?php include $theme_path.'_js_script.html';?>
														<!--FOOTER END-->
													</div>
														<!-- new index -end -->												</div>
												
												 {/if} 												<!-- +ed if visitor index - end -->
                                                                                      													<!--orig start-->
													{content}													<!--orig end -->
													
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
			</div>		<!-- --ed commenting old footer - start -->
<!--
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
-->			<!-- --ed commenting old footer - end -->

		</div>
        
	</body>
</html>
{/if}

