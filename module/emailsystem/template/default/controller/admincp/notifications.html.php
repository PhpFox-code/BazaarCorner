<?php
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
{if !isset($no_setttings)}
    <form method="post" action="{url link='admincp.emailsystem.notifications'}" id="admincp_emailsystem_form_3">
    <div class="table_header">
        Events Settings
    </div>
    <div class="table">
        <div class="table_left">
            Enable Auto Mailing:
        </div>
        <div class="table_right">
            <div class="item_is_active_holder">             
                <span class="js_item_active item_is_active"><input type="radio" name="val[auto_mailing]" value="1" {if $auto_m_event eq 1 } {value type='radio' id='is_active' default='1' selected='true'}{/if}/> {phrase var='admincp.yes'}</span>
                <span class="js_item_active item_is_not_active"><input type="radio" name="val[auto_mailing]" value="0" {if $auto_m_event eq 0 } {value type='radio' id='is_active' default='0' selected='true'}{/if}/> {phrase var='admincp.no'}</span>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="table">
        <div class="table_left">
            Template Email:
       </div>
        <div class="table_right">
            <select name="val[template_id]" id="template_id" onchange="Phpfox.EmailSystem.loadTemplate(this.value)" disabled='disabled'>
                <option value="-1">No Use Template</option>
                {foreach from=$emList item=tmpl}
                    <option value="{$tmpl.template_id}"{if $tmpl.template_id eq $eventsettings.template_id}selected{/if}>{$tmpl.template_name}</option>
                {/foreach}
            </select>
            <span id="load_template_id"></span>
        </div>
    </div>
    <div class="clear"></div>
    <div class="table">
        <div class="table_left">
            {required}{phrase var='emailsystem.subject'}:
        </div>
        <div class="table_right">
            <input type="text" name="val[subject]" value="{$eventsettings.template_subject}" id="subject" size="50" maxlength="150"  />
        </div>
    </div>
    <div class="table">
        <div class="table_left" id="lbl_html_text">
            {phrase var='emailsystem.html_text'}:
        </div>
        <div class="table_right">
            {editor id='text_html_event' rows='30' name='text_html_event' cols='60'}
        </div>
    </div>
    <div class="clear" style=""></div>
    
    <div class="table">
        <div class="table_left">
            Comming Events In:
       </div>
        <div class="table_right">
            <input type="text" value="{$eventsettings.params.comming_day}" name="val[comming_day]" size="10"/> Days
        </div>
        <div class="clear"></div>
    </div>
    <div class="table">
        <div class="table_left">
            Remind Events After:
       </div>
        <div class="table_right">
            <input type="text" value="{$eventsettings.params.remind_day}" name="val[remind_day]" size="10"/> Days
        </div>
        <div class="clear"></div>
    </div>
    <div class="table_clear">
        <input type="hidden" value="{$eventsettings.ems_notifications_id}" name="val[ems_notifications_id]"/>
        <input type="hidden" value="{$eventsettings.template_id}" name="val[template_id_edit]"/>
        <input type="submit" value="Save Change" class="button" name="save_events_settings"/>
        <input type="submit" value="Send Now" class="button" name="run_events_settings"/>
    </div>
</form>
{literal}

<script type="text/javascript">
var tmp = $('#subject').val();
$(document).ready(function() {
    var html  = "{/literal}{$sJsHtmlCode}{literal}";
    $('#js_editor_menu_text_html_event').prepend(html);
    $('#js_editor_menu_text_html_event').hide();
    $("#text_html_event_toolbar1").hide();
    
});

</script>
{/literal}
{/if}

<script type="text/javascript" src="{$core_path}module/emailsystem/static/jscript/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
{literal}
<script type="text/javascript">

</script> 
 <script type="text/javascript">
// Creates a new plugin class and a custom listbox
tinymce.create('tinymce.plugins.mailvarsbutton', {
        createControl: function(n, cm) {
                switch (n) {
                        case 'mymenubutton':
                                var c = cm.createMenuButton('mymenubutton', {
                                        title : 'Mail Template Vars',
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
tinymce.PluginManager.add('mailvarsbutton', tinymce.plugins.mailvarsbutton);

// Initialize TinyMCE with the new plugin and menu button
tinyMCE.init({
        plugins : '-mailvarsbutton,autolink,lists,spellchecker,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template', // - tells TinyMCE to skip the loading of the plugin
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
