<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

?>
{literal}
<style type="text/css">
    a.progressCancel
    {
        background:url({/literal}{$core_path}{literal}module/emailsystem/static/image/cancelbutton.gif) no-repeat;
    }
.table_left{
    width: 135px;
}
.table_right{
    margin-left: 140px;
}    
</style>
{/literal}
{$sCreateJs}
{if isset($sMessage)}
<div class="message">{$sMessage}</div>
{else}
<form method="post" action="{url link='admincp.emailsystem.add'}">
    <input type="hidden" name="val[type_id]" id="type_id" value="2"/>
	<div class="table_header">
		{phrase var='emailsystem.emailsystem'}
	</div>
    <!--
	<div class="table">
		<div class="table_left">
			{required}{phrase var='emailsystem.emailsystem_type'}:
		</div>
		<div class="table_right">
		    <select name="val[type_id]" id="type_id" onchange="Phpfox.EmailSystem.toggleType(this.value)">
				<option value="">{phrase var='emailsystem.select'}:</option>
				<option value="1"{value type='select' id='type_id' default='1'}>{phrase var='emailsystem.internal_pm'}</option>
				<option value="2"{value type='select' id='type_id' default='2'}>{phrase var='emailsystem.external_email'}</option>
			</select>
		</div><div class="clear"></div>
	</div>
    -->
        <div class="table">
        <div class="table_left">
            {required}Email System Name: 
        </div>
        <div class="table_right">
            <input type="text" name="val[emailsystem_name]" value="{value type='input' id='emailsystem_name'}" id="emailsystem_name" size="50" maxlength="150"  />   
        </div><div class="clear"></div>
    </div>
	<!--<div class="table">
		<div class="table_left">
			{phrase var='emailsystem.archive'}:
		</div>
		<div class="table_right">
			<input type="checkbox" name="val[archive]" value="1" {if isset($aForms.archive) && $aForms.archive == 1}checked="checked"{/if}>
		</div>
		<div class="clear"></div>
	</div>-->
	<div class="table" id="js_privacy" {if isset($aForms.type_id) && $aForms.type_id == 1} style="display:none"{/if}>
		<div class="table_left"> {phrase var='emailsystem.override_privacy'}:</div>
		<div class="table_right">
			<input type="checkbox" name="val[privacy]" value="1" {if isset($aForms.privacy) && $aForms.privacy == 1}checked="checked"{/if}>
		</div>
		<div class="clear"></div>
	</div>
    
    <div class="table">
        <div class="table_left">
            Duration: 
        </div>
        <div class="table_right">
            <select name="val[weekly_email]" id="type_id" >
                <option value="0" {if isset($editLetter) && $editLetter.weekly_email eq 0}selected="selected"{/if}>One Time</option>
                <option value="1" {if isset($editLetter) && $editLetter.weekly_email eq 1}selected="selected"{/if}>Daily Email</option>
                <option value="2" {if isset($editLetter) && $editLetter.weekly_email eq 2}selected="selected"{/if}>Weekly Email</option>
                <option value="3" {if isset($editLetter) && $editLetter.weekly_email eq 3}selected="selected"{/if}>Monthly Email</option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
	<div class="table_header">
		{phrase var='emailsystem.audience'}
	</div>
	<div class="table">
		<div class="table_left">
			{phrase var='emailsystem.user_groups'}:
		</div>
		<div class="table_right">
			<select name="val[is_user_group]" id="js_is_user_group">
				<option value="1"{if isset($editLetter) && $editLetter.is_user_group === false}selected{/if}>{phrase var='emailsystem.all_user_groups'}</option>
				<option value="2"{if isset($editLetter) && $editLetter.is_user_group !== false}selected{/if}>{phrase var='emailsystem.selected_user_groups'}</option>
			</select>
			<div class="p_4" style="display:none;" id="js_user_group">
				{foreach from=$aUserGroups item=aUserGroup}
				<div class="p_4">
					<label><input type="checkbox" name="val[user_group][]" value="{$aUserGroup.user_group_id}"{if !isset($editLetter) || (isset($editLetter) && $editLetter.is_user_group==false)}checked="checked"{else}{if in_array($aUserGroup.user_group_id,$editLetter.user_group_id)}checked="checked"{/if}{/if}/> {$aUserGroup.title|convert|clean}</label>
				</div>
				{/foreach}
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
			{phrase var='emailsystem.location'}:
		</div>
		<div class="table_right">
			{select_location value_title='phrase var=core.any'}
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
			{phrase var='emailsystem.gender'}:
		</div>
		<div class="table_right">
            {if !isset($editLetter)}  
			    {select_gender value_title='phrase var=core.any'}
            {else}
                <select name="val[gender]" id="gender">
                     <option value="0" {if $editLetter.gender_email eq 0}selected{/if}>{phrase var='core.any'}</option>
                     <option value="1" {if $editLetter.gender_email eq 1}selected{/if}>{phrase var='profile.male'}</option>
                     <option value="2" {if $editLetter.gender_email eq 2}selected{/if}>{phrase var='profile.female'}</option>
                </select>
                
            {/if}
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
			{phrase var='emailsystem.age_group_between'}:
		</div>
		<div class="table_right">
			<select name="val[age_from]" id="age_from">
				<option value="">{phrase var='emailsystem.any'}</option>
				{foreach from=$aAge item=iAge}
				<option value="{$iAge}"{value type='select' id='age_from' default=$iAge}>{$iAge}</option>
				{/foreach}
			</select>
			<span id="js_age_to">
				{phrase var='emailsystem.and'}
				<select name="val[age_to]" id="age_to">
					<option value="">{phrase var='emailsystem.any'}</option>
					{foreach from=$aAge item=iAge}
					<option value="{$iAge}"{value type='select' id='age_to' default=$iAge}>{$iAge}</option>
					{/foreach}
				</select>
			</span>
		</div>
		<div class="clear"></div>
	</div>  <!--
	<div class="table">
		<div class="table_left">
			{phrase var='emailsystem.how_many_per_round'}:
		</div>
		<div class="table_right">
			<input type="text" name="val[total]" value="{value type='input' id='total' default='50'}" id="total" size="40" maxlength="150" />
		</div>
		<div class="clear"></div>
	</div>
                -->
    <input name="val[total]" value="50" type="hidden"/>
    <div class="table">
        <div class="table_left">
            Include Non-Registered Users:
        </div>
        <div class="table_right">
            <label><input type="checkbox" name="val[include_non_user]" value="1" {if isset($editLetter) && $editLetter.include_none_user == 1}checked="checked"{/if}/></label>
        </div>
        <div class="clear"></div>
    </div>
	<div class="table_header">
		{phrase var='emailsystem.content'}
	</div>
	<div class="table">
        <div class="table_left">
            Template
        </div>
        <div class="table_right">
        		<select name="val[template_id]" id="template_id" onchange="$Core.EmailSystem.loadTemplate(this.value)">
           {* <select name="val[template_id]" id="template_id" onchange="$Core.EmailSystem.loadTemplate(this.value)"> *}
                    <option value="-1">No Use Template</option>
                {foreach from=$emList item=tmpl}
                    <option value="{$tmpl.template_id}"{if isset($editLetter)}{if $tmpl.template_id eq $editLetter.template_id}selected{/if}{/if}>{$tmpl.template_name}</option>
                {/foreach}
            </select>
            <span id="load_template_id"></span>
        </div>
        <div class="clear" style="margin-bottom: 5px;"></div>   
		<div class="table_left">
			{required}{phrase var='emailsystem.subject'}:
		</div>
		<div class="table_right">
			<input type="text" name="val[subject]" value="{value type='input' id='subject'}" id="subject" size="50" maxlength="150"  />
		</div>
        <div class="clear" style="margin-bottom: 5px;"></div>   
		<div class="table_left" id="lbl_html_text">
			{phrase var='emailsystem.html_text'}:
		</div>
		<div class="table_right">
			{editor id='text' rows='25' cols='60' name='text_html' onchange="javascript:change()"}
		</div>                      
        <div class="clear" style="margin-bottom: 5px;"></div>   
        <div id="update_template_mail" {if !isset($editLetter) || (isset($editLetter) && $editLetter.template_id <=0) }style="display:none"{/if}>
        <div class="table_left">
            Update Template Mail:
        </div>
        <div class="table_right">
            <input type="checkbox" name="update_template_mail_check" value="1" {if isset($editLetter) && $editLetter.template_id >0 }{/if} id="update_template_mail_check">  
        </div>
        </div>
		<div class="clear" style="margin-bottom: 5px;"></div>   
        <div class="table_left">
            Attachment Files:
        </div>
        <div class="table_right">
            <div class="fieldset_none flash_none" id="fsUploadProgress">
                {if isset($editLetter)}
                {if isset($editLetter.attach) && count($editLetter.attach) > 0}
                    {foreach from=$editLetter.attach key=index_a item=att}
                    <div class="progressWrapper" id="att_id_{$index_a}" style="opacity: 1;" >
                        <div class="progressContainer blue">
                            <a class="progressCancel" href="javascript:void(0)" style="visibility: visible;" onclick="$Core.EmailSystem.deleteAttachment({$att.attachment_id},{$index_a})"> </a>
                            <div class="progressName"><a href="{$urlDownload}{$att.attachment_id}" title="Click here to download attachment File">{$att.file_name}</a></div>
                        </div>
                    </div>
                    {/foreach}
                {/if}
                {/if}
            </div>
        <div id="divStatus" style="display: none;">0 Files Uploaded</div>
            <div>
                <span id="spanButtonPlaceHolder"></span>
                <input id="btnCancel" type="button" value="Cancel all" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;display: none;" />
            </div>
        </div>
	</div>
	
	<div class="table_clear">
        {if isset($aForms.emailsystem_id) && $aForms.emailsystem_id >0 }
            <input type="hidden" value="{$aForms.emailsystem_id}" name="val[emailsystem_id]" id="emailsystem_id"/>
        {/if}
        <div id="div_attachment_files_id">
             {if isset($editLetter)}
                {if isset($editLetter.attach) && count($editLetter.attach) > 0}
                    {foreach from=$editLetter.attach key=index_a item=att}
                           <div id="div_in_att_0_{$index_a}"><input type="hidden" value="{$att.attachment_id}" name="attach[div_in_att_0_{$index_a}]"></div>
                    {/foreach}
                {/if}
                {/if}
            
        </div>
         <input type="hidden" value="0" name="is_create_new_templ_from" id="is_create_new_templ_from"/>
         <input type="hidden" value="0" name="is_update_template" id="is_update_template"/>
         <input type="hidden" value="" name="name_template_mof" id="name_template_mof"/>
		<!--<input type="button" value="{phrase var='emailsystem.show_plain'}" class="button js_txtPlain" onclick="Phpfox.EmailSystem.showPlain();">-->
        <input type="button" value="Preview" class="button js_txtPlain" onclick="$Core.EmailSystem.Preview();return false;">
		<input type="submit" value=" {if !isset($editLetter.emailsystem_id)}Add to Sending Queue{else}Update Email{/if}" class="button" onclick="return confirmTemplate();">
	</div>
	<div class="table_clear"></div>
</form> 
{/if}
     
{literal}

<script type="text/javascript">
$(document).ready(function() {
    var html  = "{/literal}{$sJsHtmlCode}{literal}";
    $('#js_editor_menu_text').prepend(html);
    //$('#text').attr("onChange","changeTemplate()");
    $("#text").change( function() {
        changeTemplate();
       
    });
    $('#js_editor_menu_text').hide();
    $("#text_html_event_toolbar1").hide(); 
    
});

var change_template = false;
function changeTemplate()
{
    
     change_template = true;
     var id = $('#template_id').val();     
     if(id >0)
     {
         $('#update_template_mail').show();
         //$('#update_template_mail_check').attr('checked','checked');
        
     }
     else
     {
         $('#update_template_mail').hide();     
         //$('#update_template_mail_check').removeAttr('checked');
     }
     


}
function confirmTemplate()
{
    //alert(change_template);
    var id = $('#template_id').val();
    var from_owner_template = false;
    if(id >0)
    {
        from_owner_template = true;
    }
   
    if(from_owner_template == true)
    {
        if($('#update_template_mail_check').is(':checked'))
        {
            $('#is_update_template').val(1); 
            
            return true;
        }
    }
    else
    {
       
            if(confirm('Do you want to create new template mail from this email content?'))
            {
                $('#is_create_new_templ_from').val(1);
                
                var answer = "";
                while(answer == "") 
                {
                   
                   answer = prompt ("Please input the name of template","Unknow Template"); 
                }
                if(answer == null)
                {
                   $('#is_create_new_templ_from').val(0); 
                }
                else
                {
                    $('#name_template_mof').val(answer);
                    
                }
                
                return true;
            }
            else
            {
                 $('#is_create_new_templ_from').val(0);
            }    
       
    }
    
    
    return true;
}
</script>

{/literal}
<!--Upload attachemnt -->
 
<script type="text/javascript">
var limit_song_number_upload = 5;
var max_file_size_upload_mb = 8;
var downloadlink = '{$urlDownload}';
 var swfu; 
{literal}                                         
       window.onload = function() {
            var settings = {
                flash_url : "{/literal}{$core_path}{literal}module/emailsystem/static/swf/swfupload.swf",
                upload_url: "{/literal}{$sUrlUpload}{literal} ",
               
                file_size_limit :0.1,
                file_types : "*.*",
                file_types_description : "Attachment Files",
                //file_upload_limit : 100,
                //file_queue_limit : 0,
                custom_settings : {
                    progressTarget : "fsUploadProgress",
                    cancelButtonId : "btnCancel"
                },
                debug: false,

                // Button settings
                button_image_url : '{/literal}{$core_path}{literal}module/emailsystem/static/image/XPButtonUploadText_61x22.png',
                button_width: "61",
                button_height: "22",
                button_placeholder_id: "spanButtonPlaceHolder",
                //button_text: '<span class="theFont">Attach Files</span>',
                //button_text_style: ".theFont { font-size: 16; }",
                button_text_left_padding: 12,
                button_text_top_padding: 3,               
                
                // The event handler functions are defined in handlers.js
                file_queued_handler : fileQueued,
                file_queue_error_handler : fileQueueError,
                file_dialog_complete_handler : fileDialogComplete,
                upload_start_handler : uploadStart,
                upload_progress_handler : uploadProgress,
                upload_error_handler : uploadError,
                upload_success_handler : uploadSuccess,
                upload_complete_handler : uploadComplete
                //queue_complete_handler : queueComplete    // Queue plugin event
            };

            swfu = new SWFUpload(settings);
         }; 

</script>
{/literal}

<!-- END -->


<script type="text/javascript" src="{$core_path}module/emailsystem/static/jscript/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
{literal}
<script type="text/javascript">

</script> 
 <script type="text/javascript">
// Creates a new plugin class and a custom listbox
tinymce.create('tinymce.plugins.ExamplePlugin', {
        createControl: function(n, cm) {
                switch (n) {
                        case 'mymenubutton':
                                var c = cm.createMenuButton('mymenubutton', {
                                        title : 'My menu button',
                                        image : '{/literal}{$core_path}{literal}module/emailsystem/static/image/email.png',
                                        icons : false
                                });
                                
                                c.onRenderMenu.add(function(c, m) {
                                        var sub;
                                        {/literal}{foreach from=$lstVars item=v key=iv}{literal} 
                                        m.add({title : '{/literal}[{$v.var_display}]{literal}', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '{/literal}[{$v.var_display}{if $v.var_display eq "unsubscribe_url"} display=\'title\'{/if}]{literal}');
                                        }});
                                        
                                        {/literal} {/foreach} {literal}
                                        sub = m.addMenu({title : 'Events Vars'});

                                        sub.add({title : '[event-start]', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[event-start]');
                                        }});

                                        sub.add({title : '[event-end]', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[event-end]');
                                        }});
                                         sub.add({title : '[event total]', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[event total]');
                                        }});
                                         sub.add({title : '[event image]', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[event image]');
                                        }});
                                        sub.add({title : '[event content]', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[event content]');
                                        }});
                                        sub.add({title : '[event owner]', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[event owner]');
                                        }});
                                        sub.add({title : '[event starttime]', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[event starttime]');
                                        }});
                                         sub.add({title : '[event endtime]', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[event endtime]');
                                        }});
                                         sub.add({title : '[event address]', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[event address]');
                                        }});
                                          sub.add({title : '[event title]', onclick : function() {
                                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[event title]');
                                        }});
                                        
                                });

                                // Return the new menu button instance
                                return c;
                }

                return null;
        }
});

// Register plugin with a short name
tinymce.PluginManager.add('example', tinymce.plugins.ExamplePlugin);

// Initialize TinyMCE with the new plugin and menu button
tinyMCE.init({
        plugins : '-example,autolink,lists,spellchecker,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template', // - tells TinyMCE to skip the loading of the plugin
        mode : "textareas",
        theme : "advanced",
        theme_advanced_buttons1 : "mymenubutton,save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver"
});   
</script>

{/literal}
