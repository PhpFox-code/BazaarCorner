<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 8:49 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: controller.html.php 64 2009-01-19 15:05:54Z Raymond_Benc $
 */
 
 

?>
<div id="apps_developer_holder">
	<div class="apps_dev_menu">
		<ul>
			<li><a href="#" class="active js_apps_menu_click" rel=""><?php echo Phpfox::getPhrase('apps.introduction'); ?></a></li>
		</ul>
		<div class="apps_dev_menu_title">
<?php echo Phpfox::getPhrase('apps.api'); ?>
		</div>	
		<ul>
<?php if (count((array)$this->_aVars['aMethods'])):  foreach ((array) $this->_aVars['aMethods'] as $this->_aVars['aMethodModule']): ?>
			<li><a href="#" class="js_apps_menu_click" rel="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aMethodModule']['module']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aMethodModule']['module']); ?></a></li>
<?php endforeach; endif; ?>
		</ul>
	</div>

	<div class="apps_dev_info">
		<div class="apps_module_holder apps_module_holder_main" id="js_apps_module_">
			<div class="p_bottom_10">
<?php echo Phpfox::getPhrase('apps.as_a_developer_you_can_create_applications', array('site_name' => $this->_aVars['sSiteName'])); ?>
			</div>
			
			<div class="p_bottom_10">
				<h3><?php echo Phpfox::getPhrase('apps.setting_up_an_app'); ?></h3>
<?php echo Phpfox::getPhrase('apps.to_interact_with_site_name_your', array('site_name' => $this->_aVars['sSiteName'])); ?>
				<p>
<?php echo Phpfox::getPhrase('apps.when_you_add_an_application', array('link' => $this->_aVars['sAppLink'])); ?>
				</p>
			</div>
				
			<div class="p_bottom_10">
				<h3><?php echo Phpfox::getPhrase('apps.requesting_a_token'); ?></h3>
				<div class="p_bottom_10">
<?php echo Phpfox::getPhrase('apps.whenever_you_plan_on_using_our_api_you_must_first_request_a_token_in_order_to_request_a_token_you_need_a_unique_key_that_we_send_to_you_when_a_user_visits_your_app_from_an_iframe_on_our_site_we_pass_this_along_as_b_get_key_b'); ?>
				</div>
				<div class="p_bottom_10">
					<div class="p_bottom_5">
<?php echo Phpfox::getPhrase('apps.this_is_an_example_of_how_you_can_request_a_token'); ?>:
					</div>
					<div class="apps_method_response">	
<?php echo $this->_aVars['sTokenSampleCall']; ?>
					</div>					
				</div>
				<div class="p_bottom_5">
<?php echo Phpfox::getPhrase('apps.if_successful_you_will_get_a_json_response_like'); ?>:
				</div>
				<div class="apps_method_response">	
<?php echo $this->_aVars['sTokenResponse']; ?>
				</div>				
			</div>			
			
			<div class="p_bottom_10">
				<h3><?php echo Phpfox::getPhrase('apps.sending_a_request'); ?></h3>
				<div class="p_bottom_5">
<?php echo Phpfox::getPhrase('apps.now_that_you_have_a_valid_token_you_can_make_requests_to_our_server_with_each_request_you_must_pass_the_token_we_created_for_you'); ?>
				</div>
				<div class="p_bottom_5">					
<?php echo Phpfox::getPhrase('apps.an_example_call_to_our_api_server_would_look_like'); ?>:
				</div>
				<div class="apps_method_response">	
<?php echo $this->_aVars['sSampleCall']; ?>
				</div>
			</div>

			<div class="p_bottom_10">
				<h3><?php echo Phpfox::getPhrase('apps.understanding_an_api_response'); ?></h3>		
				<p>
<?php echo Phpfox::getPhrase('apps.for_methods_that_could_return_more_than_on'); ?>
				</p>
				<p>
<?php echo Phpfox::getPhrase('apps.to_the_left_you_will_find_a_list_of_the_modules_that_implement'); ?>
				</p>		
			</div>
		</div>
<?php if (count((array)$this->_aVars['aMethods'])):  foreach ((array) $this->_aVars['aMethods'] as $this->_aVars['aMethodModule']): ?>
		<div class="apps_module_holder" id="js_apps_module_<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aMethodModule']['module']); ?>">
			<div class="apps_module_title"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aMethodModule']['module']); ?></div>
<?php if (count((array)$this->_aVars['aMethodModule']['methods'])):  foreach ((array) $this->_aVars['aMethodModule']['methods'] as $this->_aVars['aMethod']): ?>
			<div class="apps_method_holder">
				<div class="apps_method_title">
<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aMethod']['call']); ?>
				</div>
				<div class="apps_method_type">
<?php echo $this->_aVars['aMethod']['type'];  if (isset ( $this->_aVars['aMethod']['url'] )): ?> <?php echo $this->_aVars['aMethod']['url'];  endif; ?>
				</div>
				<div class="apps_method_info">
<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aMethod']['detail']); ?>
				</div>	
<?php if (! empty ( $this->_aVars['aMethod']['response'] )): ?>
				<div class="apps_method_response_title">
<?php echo Phpfox::getPhrase('apps.response'); ?>
				</div>
				<div class="apps_method_response">					
<?php echo $this->_aVars['aMethod']['response']; ?>
				</div>
<?php endif; ?>
			</div>
<?php endforeach; endif; ?>
		</div>
<?php endforeach; endif; ?>
	</div>
</div>
