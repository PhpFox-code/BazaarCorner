<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');



?>
{literal}
<style type="text/css">
.table_left{
    width: 135px;
}
.table_right{
    margin-left: 140px;
}
</style>
{/literal}
<!-- 
<div class="table_header">
    Create New Var Template
</div>

<div>
<form action="{url link='admincp.emailsystem.mailtemplate'}" method="post">    
    <div class="table_left">
        {required}Vars Name:
    </div>
    <div class="table_right">
        <input type="text" value="" name="val[var_display]" id="var_display"  size="40"/>
    </div>
    <div class="clear"></div>
    <div class="table_left">
        Vars Content:
    </div>
    <div class="table_right">
        <textarea cols="50" rows="10" name="val[var_translate]"></textarea>
    </div>
    <div class="clear"></div>
        <div class="table_left">
        Vars Description:
    </div>
    <div class="table_right">
        <textarea cols="50" rows="10" name="val[var_description]"></textarea>
    </div>
    <div class="clear"></div>
    <div class="table_clear">
        <input type="submit" value="Create" class="button" name="createnewvars" id="b_s_t_1">
    </div>
</form>    
</div>
--> 
<div class="table_header">
    {if isset($is_edit)}
        Edit Mail Template
    {else}
        Create New Email Template
    {/if}
    
</div>
<div>
<form action="{url link='admincp.emailsystem.mailtemplate'}" method="post">    
    <div >
        <div class="table">
            <div class="table_left">
                {required}Template Name:
            </div>
            <div class="table_right">
                <input type="text" value="{if isset($is_edit)}{$template_edit.template_name}{/if}" name="val[template_name]" id="template_name"  size="40"/>
            </div>
        </div>
        <div class="table">
            <div class="table_left">
            {required}Template Subject:
            </div>
            <div class="table_right">
                <input type="text" value="{if isset($is_edit)}{$template_edit.template_subject}{/if}" name="val[template_subject]" id="template_subject"  size="40"/>
            </div>
        </div>
        <div class="clear"></div>
        <div class="table">
            <div class="table_left">
                Template Content:
            </div>
            <div class="table_right">
                {editor id='template_content' rows='25' name='text_html' cols='50'}
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="table_clear">
        {if isset($is_edit)}
              <input type="hidden" value="{$template_edit.template_id}" name="template_id" id="template_id"/>
              <input type="hidden" value="{$template_edit.template_type}" name="val[template_type]" id="template_type"/>
            <input type="button" value="Preview" class="button js_txtPlain" onclick="$Core.EmailSystem.Preview();">
            <input type="submit" value="Save Change" class="button" name="edittemplate" id="b_s_t"> 
        {else}
          
            <input type="hidden" value="" name="template_id" id="template_id"/>
            <input type="button" value="Preview" class="button js_txtPlain" onclick="$Core.EmailSystem.Preview();">
            <input type="submit" value="Create" class="button" name="createnew" id="b_s_t">
        {/if}
    </div>
</form>    
</div>
<div class="note" style="margin: 10px 10px 10px;">
    <span style="width: 20px;height:20px;background-color:#9DE580;">&nbsp;&nbsp;&nbsp;&nbsp;</span><span>: The default template for send mail using phpfox system.</span>
</div>  
<div class="table_header">
	Email Templates
</div>
<div>
	<table>
		<tr>
			<th style="width:20px;"></th>
			<th style="width:150px;">Template Name</th>
			<th>Template Content</th>
            <th style="width:90px">Preview</th>
			
		</tr>
		{foreach from=$emList item=template key=iKey name=tmp}
		<tr id="js_template_{$template.template_id}" class="checkRow{if is_int($iKey/2)} tr{/if}" {if $template.template_type == "register"}style="background-color:#9DE580;"{/if}>
			<td class="t_center">
				<a href="#" class="js_drop_down_link" title="Manage">{img theme='misc/bullet_arrow_down.png' alt=''}</a>
				<div class="link_menu">
					<ul>
						<li><a href="{url link='admincp.emailsystem.mailtemplate' edit={$template.template_id}" title="Edit">Edit</a></li>
                        {if $template.type_id <= 2}
						<li><div class="user_delete">
								<a href="{url link='admincp.emailsystem.mailtemplate' delete={$template.template_id}">Delete</a>
						</div></li>
                        {/if}
                        <li><a href="{url link='admincp.emailsystem.mailtemplate' register={$template.template_id}" title="Set default welcome new user template">Set default welcome new user template</a></li>           
					</ul>
				</div>
			</td>
			<td>
                {$template.template_name}
            </td>
            <td>
                <strong>{$template.template_subject|clean}</strong><br/><br/>
                {$template.template_content|clean|shorten:150:'...':false}
            </td>
            <td>
            	<a href="javascript:void(0)" onclick="$Core.EmailSystem.Preview({$template.template_id});">Preview</a>
               {* <a href="javascript:void(0)" onclick="$Core.EmailSystem.Preview({$template.template_id});">Preview</a> *}
            </td>
            
		</tr>
		{foreachelse}
		<tr>
			<td colspan="5">
				There are no templates mail.
			</td>
		</tr>
		{/foreach}
	</table>
</div>

{literal}

<script type="text/javascript">
$(document).ready(function() {
    var html  = "{/literal}{$sJsHtmlCode}{literal}";
    $('#js_editor_menu_template_content').prepend(html);
    $('#js_editor_menu_template_content').hide();
    $("#js_editor_menu_template_content").hide();
   
});

</script>
{/literal}

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
