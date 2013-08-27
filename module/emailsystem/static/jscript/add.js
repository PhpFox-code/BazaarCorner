$Core.EmailSystem = {
	showPlain : function()
	{		
		if (function_exists(Editor.sEditor + '_emailsystem_show_plain'))		
		{
			eval('' + Editor.sEditor + '_emailsystem_show_plain();');
		}
		var sText = $('#text').attr('value');
		$.ajaxCall('emailsystem.showPlain', 'sText='+sText);
	},
	toggleType : function(iType)
	{
		if (iType == 1)
		{
			$('.js_txtPlain').hide();
			$('#lbl_html_text').html('Text:');
			$('#js_privacy').hide();
		}
		else
		{
			$('.js_txtPlain').show();
			$('#lbl_html_text').html('HTML Text:');
			$('#js_privacy').show();
		}
	},
    Preview : function(id)
    {
        
        if(!id)
        {
            if(tinyMCE.activeEditor)
            {
                tinyMCE.activeEditor.execCommand('mcePreview');
            }
            
        }
        else
        {
           $Core.box('Template Preview',$.ajaxBox('emailsystem.previewTemplate','height=500&width=500&template_id='+id));
        }
        
    },
    SelectVars: function(text)
    {
        
        tb_show('Vars Collection', $.ajaxBox('emailsystem.viewVars', 'height=400&width=400&idEditor='+text ));
    },
    Edit :function(template_id)
    {
        $.ajaxCall('emailsystem.editTemplate','template_id='+template_id); 
    },
    loadTemplate: function(template_id)
    {
        $('#load_template_id').html($.ajaxProcess(''));
        $.ajaxCall('emailsystem.loadTemplate','template_id='+template_id);
        changeTemplate();
    },
    InsertVar :function (idEditor,code)
    {
        var txtArea = document.getElementById(idEditor);
        if(txtArea)
        {
            var offset = txtArea.selectionStart;
            var preString = (txtArea.value).substring(0,offset);
            
            var postString = (txtArea.value).substring(offset);
            txtArea.value = preString + code + postString;
            txtArea.selectionStart = offset + code.length;
            txtArea.selectionEnd = offset + code.length;
            txtArea.focus();
        }
        else
        {
            alert('Invalid Editor Content');
        }
            
    },
    deleteAttachment : function(fileid,index) 
    {
        var div = "#att_id_"+index;
        var file = "#div_in_att_0_"+index;
        $(div).fadeOut();
        if($(file))
        {
            $(file).html("");
        }          
    }
}

$(function()
{
	$('.end_option').change(function()
	{
		if (this.value == 1)
		{
			$('#js_end_option').show();			
		}
		else
		{
			$('#js_end_option').hide();
		}
		
		return true;
	});
	
	$('#view_unlimited').change(function()
	{
		if (this.checked)
		{
			$('#total_view').attr('disabled', true).addClass('disabled');
		}
		else
		{
			$('#total_view').attr('disabled', false).removeClass('disabled').focus();
		}
	});
	
	$('#click_unlimited').change(function()
	{
		if (this.checked)
		{
			$('#total_click').attr('disabled', true).addClass('disabled');
		}
		else
		{
			$('#total_click').attr('disabled', false).removeClass('disabled').focus();
		}
	});	

	$('#age_from').change(function()
	{
		if (!empty(this.value) && $('#age_to option:selected').val() != '' && this.value > $('#age_to option:selected').val())
		{
			alert(oTranslations['emailsystem.min_age_cannot_be_higher_than_max_age']);
			$(this).val('');
		}
	});

	$('#age_to').change(function(){
		if (!empty(this.value) && $('#age_from option:selected').val() && $(this).val() < $('#age_from option:selected').val())
		{
			alert(oTranslations['emailsystem.max_age_cannot_be_lower_than_the_min_age']);
			$(this).val('');
		}
	});
	
	$('#type_id').change(function()
	{
		$('.js_add_hidden').hide();
		
		if (this.value == 1)
		{
			$('#js_type_image').show();
			$('#js_total_click').show();
			$('#js_type_image_link').show();
		}
		else if (this.value == 2)
		{
			$('#js_type_html').show();
			$('#js_total_click').hide();
			$('#js_type_image_link').hide();
		}
	});
	
	$('#js_is_user_group').change(function()
	{
		if (this.value == 1)
		{
			$('#js_user_group').hide();
		}
		else if (this.value == 2)
		{
			$('#js_user_group').show();
		}
	});
	
	$('.end_option').each(function()
	{
		if (this.value == 1 && this.checked === true)
		{
			$('#js_end_option').show();
		}
	});
	
	if ($('#type_id').val() == 1)
	{
		$('#js_type_image').show();
		$('#js_total_click').show();
		$('#js_type_image_link').show();		
	}
	else if ($('#type_id').val() == 2)
	{
		$('#js_type_html').show();
		$('#js_total_click').hide();
		$('#js_type_image_link').hide();		
	}
	
	if ($('#js_is_user_group').val() == 2)
	{
		$('#js_user_group').show();
	}
	
		
});