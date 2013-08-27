{if !PHPFOX_IS_AJAX_PAGE}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{$sLocaleDirection}" lang="{$sLocaleCode}">
	<head>
		<title>{title}</title>	
		<!-- added header stuff - start-->		
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/normalize.min.css" />
		<link rel="stylesheet"  type='text/css' href="http://fonts.googleapis.com/css?family=PT+Sans"/>
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/default.css" />
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/style.css" />
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/app.css" />
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/jquery.jscrollpane.css"/>
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/jquery.jscrollpane.min.css"/>
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/etalage/etalage.min.css">
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/jcarousel/skins/tango/skin.css" />
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/jcarousel/skins/ie7/skin.css" />
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/jcarousel/skins/custom/mostbought.css" />
		<link rel="stylesheet"  type='text/css' href="/theme/frontend/yousport/template/new/css/jcarousel/skins/custom/halftagprice.css" />
		<!-- generated header-->
		{header}
	</head>
	
	<body class="{$spage}">
		{body}	
		{block location='9'}
		
		<div id="header">
				{block location='10'}
				<div class="row" style="margin-top: 10px;">
				    <div class="three columns" style="margin-top: 10px;">
				        <a href="#"><img src="/theme/frontend/yousport/template/new/images/modules/inside-bazaar.png"></a>
				    </div>
				    <div class="six columns">
				        <div class="row">
				            <div class="eight columns centered">
				                <a href="#"><img src="/theme/frontend/yousport/template/new/images/bazaar-corner-logo.png"></a><br>
				            </div>
				        </div>
				    </div>
				    <div class="three columns">
				        <div class="row" style="margin-top: 15px">
				        	{if !Phpfox::isUser()}
							<div class="offset-by-six six columns">
								<a href="/user/login/" style="text-decoration: underline;">SIGN IN</a>
								/ <a href="/user/register/" style="text-decoration: underline;">JOIN US</a>
							</div>
							{/if}
				        </div>
				        <div class="row" style="margin-top: 15px">
				            <div class="six columns">
				                <div class="twelve columns centered">
				                    <img src="/theme/frontend/yousport/template/new/images/icons/wishlist-icon.png">&nbsp;<a href="#">MY WISHLIST</a>
				                </div>
				            </div>
				            <div class="six columns">
				                <div class="twelve columns centered">
				                <img src="/theme/frontend/yousport/template/new/images/icons/cart-icon.png">&nbsp;<a href="#" style="position: relative; top: -3px">MY CART</a>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>
				<div class="row" style="margin-top: 20px">
					<div class="three columns">
					    <!--BAZAAR COLLECTION AND PAGES START-->
					    <ul id="menu">
					    <li class="mega">
					          <a href="#"><span class="span2">Bazaar Collection and Pages:&nbsp;&nbsp;<img src="/theme/frontend/yousport/template/new/images/icons/arrow-down.png"></span></a>
					      <div id="menu-container">
					          <div style="background-color: #cc0033; width: 100%; height:6px"></div>
					          <div class="row">
					              <div class="three columns" style="border-right: #cecece 1px solid">
					                  <ul class="menu-category">
					                      <li><a href="#">Fashion</a></li>
					                      <li><a href="#">Homewares</a></li>
					                      <li><a href="#">Art and Media</a></li>
					                      <li><a href="#">DIY</a></li>
					                      <li><a href="#">Gadgets</a></li>
					                      <li><a href="#">Travel and Tours</a></li>
					                  </ul>
					              </div>
					              <div class="four columns">
					                  <ul class="menu-other" style="margin-top: 10px">
					                      <li>
					                          <span class="span3">Featured:</span><br>
					                          <a href="#">Products</a>&nbsp;&nbsp;&nbsp;<a href="#">Merchants</a>
					                      </li><br>
					                      <li>
					                          <span class="span3">Big Discounts:</span><br>
					                          <a href="#">Half the tag price</a>&nbsp;&nbsp;&nbsp;<a href="#">Most Bought</a>
					                      </li><br>
					                      <li>
					                          <span class="span3">Latest:</span><br>
					                          <a href="#">Products</a>&nbsp;&nbsp;&nbsp;<a href="#">Merchants</a>
					                          <a href="#">Articles</a>&nbsp;&nbsp;&nbsp;<a href="#">News &amp; Updates</a>
					                      </li><br>
					                  </ul>
					                  <a href="#" data-reveal-id="videoModal"><div id="how-it-works-menu" style="position: relative;left: 25px">See how BazaarCorner works</div></a>
					              </div>
					              <div class="five columns">
					                  <div style="z-index: 2;width:400px;height:317px; position: relative;bottom:9px">
					                      <a href="#"><img src="/theme/frontend/yousport/template/new/images/modules/inside-bazaar-model.png" style="width:400px;height:317px"></a>
					                  </div>
					              </div>
					        </div>
					      </div>
					    </li>
					  </ul>        
					  <!--BAZAAR COLLECTION AND PAGES END-->
					</div>
				    <div class="six columns">

		        	<!--SEARCH START-->
		            <div class="row collapse">
		              <div class="ten columns">
		              	<form method="post" id='header_search_form' action="{url link='search'}">
			                <input type="text" placeholder="Clothing, Decor, Travel, etc." style="font-style:italic">
			                <a href="#" onclick='$("#header_search_form").submit(); return false;' id="header_search_button">{phrase var='core.search'}</a>
		            	</form>
		              </div>
		            </div>
		            <!--SEARCH END-->
				    </div>
				    <div class="three columns">
				        <!--CLICK TO SELL START-->
					        <div class="seven columns" style="width:60%">
					            <span style="font-size:10px">GOT SOME COOL THINGS TO</span>
					            <h2 class="subheader" style="top: -11px;text-decoration: underline;"><a href="#">CLICK TO SELL</a></h2>
					        </div>
					        <div class="five columns">
					            <img src="/theme/frontend/yousport/template/new/images/icons/click-to-sell.png" style="position:relative; bottom: 54px;left:-14px">
					        </div>        
				        <!--CLICK TO SELL END-->
				    </div>
				</div>
				{block location='6'}

				{if Phpfox::isUser()}
				<div id="header_menu_page_holder">	
					<div class="row">
						<div id="header_menu">				
							{menu}
							<div class="clear"></div>
						</div>		
					</div>			
				</div>	
				{/if}
		</div>

		<div id="{if Phpfox::isUser()}main_core_body_holder{else}main_core_body_holder_guest{/if}">
		<!--{block location='11'} -->
		<div id="main_content_holder" class="row">
			<div {holder_name}>
					{module name='profile.logo'}
					<div id="content_holder">

						{block location='7'}				
						{if !defined('PHPFOX_IS_USER_PROFILE') && !defined('PHPFOX_IS_PAGES_VIEW')}
							{breadcrumb}
							{block location='12'}
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
									{block location='12'}
									{module name='profile.header'}							
								{/if}

								{if defined('PHPFOX_IS_PAGES_VIEW')}
									{block location='12'}
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
										{block location='2'}
										{content}
										{block location='4'}
										{block location='11'}

										{if isset($spage)&&$spage == 'visitor index'}	
											<div class="row" style="margin-top: 20px">
												{module name='advancedmarketplace.homecategory'}
												<div class="six columns">
                                                	<!--BANNERSLIDE START-->
													<div class="rslides_container panel-shadow">
													   <ul class="rslides" id="slider1">
															<li><img src="/theme/frontend/yousport/template/new/images/banner/women-fashion-collection.jpg" /></li>
															<li><img src="/theme/frontend/yousport/template/new/images/banner/gadgets-collection.jpg" /></li>
															<li><img src="/theme/frontend/yousport/template/new/images/banner/letters-earring-banner.jpg" /></li>
															<li><img src="/theme/frontend/yousport/template/new/images/banner/homeware-collection.jpg" /></li>
													   </ul>
													</div>
                                                    <!--BANNERSLIDE END-->				
                                                </div>
												
												{module name='advancedmarketplace.featuredmerchant'}
											</div>
										{/if}
									
									</div>

									{if !$bUseFullSite && (count($aBlocks3) || count($aAdBlocks3))}
										<div id="right">								
											{block location='3'}
										</div>
									{/if}
									<div class="clear"></div>

									{block location='8'}
						
									{if isset($spage)&&$spage == 'visitor index'}
									<div class="row">
								    	<div class="nine columns">
									        <!--RECENTLY ADDED STUFF START-->
									        {module name='advancedmarketplace.recentstuff'}
											<!--RECENTLY ADDED STUFF END-->
									        
									        <!--HALF THE TAG PRICE START-->
									        {module name='advancedmarketplace.halfpricetag'}
											<!--HALF THE TAG PRICE END-->
									    </div>
									    <div class="three columns">

									        <!--MOST BOUGHT START-->
									        {module name='advancedmarketplace.mostbought'}
											<br><br>
									        <!--MOST BOUGHT END-->

									        <!--BRANDS START-->
									        {module name='advancedmarketplace.topbrands'}
											<!--BRANDS STUFF END-->
									    </div>
									</div>
									{/if}
									<div class="row"><div style="margin: 100px 0px 20px 0px;"></div></div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
			</div>
		</div>
		{block location='5'}
		</div>
		
		<!--New Footer start -->
		<div id="footer">
				<div class="row"><div style="margin: 20px 0px 20px 0px;"><hr /></div></div>
				<div class="row" style="margin-bottom: 20px">
					<div class="three columns">
						<a href="#"  data-reveal-id="videoModal"><div id="how-it-works">See how BazaarCorner works</div></a>
					</div>
					<div class="two columns">
						<div><span class="span2">Stay Connected:</span></div><br />
						<div style="margin-bottom: 10px"><a href="https://www.facebook.com/BazaarCorner2012" target="_blank"><img src="/theme/frontend/yousport/template/new/images/icons/facebook.png" style="position: relative; top: 10px" /> bazaarcorner</a></div>
						<div><img src="/theme/frontend/yousport/template/new/images/icons/twitter.png" style="position: relative; top: 10px" /> #bazaarcorner</div>
					</div>
					<div class="five columns">
						<div><span class="span2">Get updates direct to your EMAIL:</span></div><br />
						<div class="row collapse" style="margin-bottom: 30px">
						  <div class="seven columns">
							<input type="text" placeholder="Enter your email here..." style="font-style:italic"/>
						  </div>
						  <div class="three columns">
							<span class="postfix">Subscribe</span>
						  </div>
							<div class="offset-by-two columns"></div>
						</div>
						<div><span class="span2">Type of Payment</span></div><br />
						<img src="/theme/frontend/yousport/template/new/images/icons/paypal.png" />
						<img src="/theme/frontend/yousport/template/new/images/icons/visa.png" />
						<img src="/theme/frontend/yousport/template/new/images/icons/mastercard.png" />
						<img src="/theme/frontend/yousport/template/new/images/icons/amex.png" />
					</div>
					<div class="two columns">
						<span class="span2">2013 BazaarCorner.com<br />All Rights Reserved</span><br /><br />
						<ul id="no-bullets">
							<li><a href="#">About Us</a></li>
							<li><a href="#">Get Help</a></li>
							<li><a href="#">Returns and Shipping</a></li>
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">Terms and Conditions</a></li>
							<li><a href="#">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<!--New Footer end -->		
				
				<!--VIDEO MODAL START-->
				<!--
				<div id="videoModal" class="reveal-modal large">
				  <h2>This modal has video</h2>
				  <div class="flex-video">
					<iframe width="800" height="315" src="http://www.youtube.com/embed/IkOQw96cfyE" frameborder="0"></iframe>
				  </div>
				  <a class="close-reveal-modal">&#215;</a>
				</div>
				-->
				<!--VIDEO MODAL END-->


				{literal}
				<!--JS SCRIPT start-->
				<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
				<script src="/theme/frontend/yousport/template/new/js/default.min.js"></script>
				<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
				<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>

				<!-- Initialize JS Plugins -->
				<script src="/theme/frontend/yousport/template/new/js/app.js"></script>
				<script src="/theme/frontend/yousport/template/new/js/default4.min.js"></script>
				<script src="/theme/frontend/yousport/template/new/js/jquery.default.reveal.min.js"></script>
				<script src="/theme/frontend/yousport/template/new/js/jquery.default.forms.min.js"></script>

				<script src="/theme/frontend/yousport/template/new/js/bannerslides.mini.js"></script>
				<script src="/theme/frontend/yousport/template/new/js/etalage/jquery.etalage.min.js"></script>

				<!--FACESCROLL START-->
				<script type="text/javascript" src="/theme/frontend/yousport/template/new/js/facescroll/jquery.ui.touch-punch.min.js"></script>
				<script type="text/javascript" src="/theme/frontend/yousport/template/new/js/facescroll/facescroll.min.js"></script>

				<!--DROP DOWN MENU START-->
				<script src="/theme/frontend/yousport/template/new/js/vendor/custom.modernizr.js"></script>
				<script src="/theme/frontend/yousport/template/new/js/jquery.hoverIntent.min.js"></script>
				<script src="/theme/frontend/yousport/template/new/js/foundation.min.js"></script>
				<script src="/theme/frontend/yousport/template/new/js/jquery.jcarousel.min.js"></script>
				
				
				<!-- Check for Zepto support, load jQuery if necessary -->
			  	<script type="text/javascript">
				  document.write('<script src=/theme/frontend/yousport/template/new/js/vendor/'
				    + ('__proto__' in {} ? 'zepto.min' : 'jquery')
				    + '.js><\/script>');

				  	$(document).ready(function(){
				  		
				  		$(document).foundation();

				  		$('#mostbought').jcarousel({
				  			scroll: 1,
				  			wrap: 'circular'
				  		});

				  		$('#halfpricetag').jcarousel({
				  			scroll: 4,
				  			wrap: 'circular'
				  		});

						var megaConfig = {
							 interval: 100,
							 sensitivity: 4,
							 over: $(this).addClass("hovering"),
							 timeout: 100,
							 out: $(this).removeClass("hovering")
						}
						$("li.mega").hoverIntent(megaConfig);

						$("#buttonForModal").click(function() {
						  $("#myModal").reveal();
						});

						$(function(){
					        $("div.divfeedbacks").slice(0, 10).show(); // select the first ten
					        $("#load").click(function(e){ // click event for load more
					            e.preventDefault();
					            $("div.divfeedbacks:hidden").slice(0, 5).show(); // select next 10 hidden divs and show them
					            if($("div.divfeedbacks:hidden").length == 0){ // check if any hidden divs still exist
					                //alert("No more divs"); // alert if there are none left
					                $("div.alert-box:hidden").show(); // select next 10 hidden divs and show them
					                $("#load").hide(); // select next 10 hidden divs and show them
					            }
					        });
					    });

						$('.feedback-scroll').alternateScroll({ 'vertical-bar-class': 'styled-h-bar', 'hide-bars': false });

						$('#example3').etalage({
		                        smallthumbs_position: 'left'
		                });

		                $('#etalage').etalage({
		                        zoom_element: '#custom_zoom_element',
		                        // zoom_area_width: 200,
		                        // zoom_area_height: 200
		                });

		                $(function () {

						  // Slideshow 1
						  $("#slider1").responsiveSlides({
							//auto: false,
							pager: true,
							nav: true,
							speed: 500,
							maxwidth: 800,
							namespace: "centered-btns"
						  });

						  // Slideshow 2
						  $("#slider2").responsiveSlides({
							auto: false,
							pager: true,
							nav: true,
							speed: 500,
							maxwidth: 800,
							namespace: "transparent-btns"
						  });

						  // Slideshow 3
						  $("#slider3").responsiveSlides({
							auto: false,
							pager: false,
							nav: true,
							speed: 500,
							maxwidth: 800,
							namespace: "large-btns"
						  });

						});
						

				  	});
				</script>
				{/literal}
		{footer}
		</div>
		<!--New Footer end -->
</body>
</html>
{/if}
