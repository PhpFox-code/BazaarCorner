{if $aRecentListing}
{if !$bIsAjax}
<div id="fb-root"></div>
{literal}
<style>
#content_holder{
	background-color:transparent;}
	#main_footer_holder{
    display:none;
}
a {
    color:#35BFFF;
	text-decoration:none;
}
a:hover, a:active{
	color:#91DCFF;
}
#backlinks{
	float:right;
	padding:0 20px;
	line-height:22px;
	font-weight:bold;
	font-size:13px;
}

#backlinks a{
	text-align:right;
	display:block;
}

.title {
	display:none;
}

/* Footer */
#breadcrumb_content{
	display:none;}
#breadcrumb_holder{
	display:none;}
#holder_notify{
	display:none;}
/* clearfix */
.clearfix {
	clear:both;
}
/* wrapper css */
#wrapper{
	margin-top:70px;
	width:100%;
}
#wrapper hgroup{
	text-align:center;
}
#wrapper h2{
	margin:5px 0;
	color:#FF6D99;
	text-shadow:1px 1px 2px #A50031;
	font-size:33px;
	font-family:Arial Narrow, Arial, sans-serif;
}

#wrapper h3{
	font-style:italic;
	font-weight:normal;
	font-size:18px;
	text-shadow:1px 1px 0 #fff;
	color:#888;
	margin:5px 0;
}
#container{
	position:relative;
	width:1100px;	
    top: -33px;
	margin-bottom: 25px;
    margin-left: -75px;
    margin-right: auto;
    margin-top: 0;
	padding-bottom: 10px;
    clear: both;
}

.grid{
	width:210px;
	min-height:100px;
	background:#fff;
	margin:8px;
	font-size:12px;
	float:left;
	box-shadow: 0 1px 3px rgba(34,25,25,0.4);
	-moz-box-shadow: 0 1px 3px rgba(34,25,25,0.4);
	-webkit-box-shadow: 0 1px 3px rgba(34,25,25,0.4);
	-webkit-transition: top 1s ease, left 1s ease;
	-moz-transition: top 1s ease, left 1s ease;
	-o-transition: top 1s ease, left 1s ease;
	-ms-transition: top 1s ease, left 1s ease;
	border-top:5px solid #d115aa;
	margin:5px;/*Newly added css*/
	-webkit-box-shadow:  3px 3px 5px 0px #000;/*Newly added css*/
	box-shadow:  3px 3px 5px 0px #000;/*Newly added css*/
}

.grid strong {
	border-bottom:1px solid #ccc;
	margin:10px 0;
	display:block;
	padding:0 0 5px;
	font-size:17px;
}

.grid .meta{
	text-align:right;
	color:#777;
	font-style:italic;
}
/*@ Newle added css*/
.grid .grid-inner-block{
		padding: 15px;
}
.grid .add-comment{
	width:100%;
	height:26px;
	line-height:26px;
	background:#a0afd0;
	text-align:right;

}
.grid .add-comment a{
	color:#fff;
	padding-right:5px;
}
.grid .f-share-btn{
	float:right;
}
.grid .imgholder{
	position:relative;
}
.grid .imgholder img{
	max-width:100%;
	background:#ccc;
	display:block;

}
/*@ end of Newle added css*/

@media screen and (max-width : 1240px) {
	body{
		overflow:auto;
	}
}

@media screen and (max-width : 900px) {
	#backlinks{
		float:none;
		clear:both;
	}

	#backlinks a{
		display:inline-block;
		padding-right:20px;
	}

	#wrapper{
		margin-top:90px;
	}
}

#left{
	display:none;
	}

#content{
	left: -160px;
	}

#wrapper{

	margin-top: 0;

	}
.grid .fb-like{
	float:left;
}

.box {
  margin: 0px;
  padding: 0px;
  background: #D8D5D2;
  font-size: 11px;
  line-height: 1.4em;
  float: left; 
  width: 220px; 
}

.grid .icons-order-list{
	width:100%;
	padding:10px 0;
}

.grid .icons-order-list li{
	float:left;
	display:inline;
	background:url(http://bazaarcorner.com/module/advancedmarketplace/static/image/default/icons-pic.jpg) no-repeat 0 -14px;
	margin-right: 5px;
    text-align: right;
    width: 35px;
	font-style:normal;
}
.grid .icons-order-list li.heart{
	background-position:0 1px;
	width:25px;
}
.grid .icons-order-list li.comment{
	background-position:0 -29px;
	width:25px
}
.grid .icons-order-list li.buyit{
	background:none;
	padding-left:5px;
}
.grid .icons-order-list li.buyit a{
	color:#df1602;
	font-style:normal;
}

#wrapper { /*width:1440;*/ /*margin-left:auto; margin-right:auto; */}
	

	#mnu { width:100%; top:0; }
	#social-contents { margin-top:20px; margin-left:auto; margin-right:auto; width:1308px; }
	#mnu-static { z-index:2; top:120px; }
	#footer-cont { position:fixed; bottom:-7px; left: 50%;
margin-left: -50%;}
	
	.sticky #mnu-static {
		position:fixed;
		top:0;
		left:0;
		width:100%;
}

.sticky #mnu-static {
    margin:0 auto;
}
#menutop{
    background-attachment: scroll;
    background-clip: border-box;
    background-color: #EFE3E5;
    background-image: none;
    background-origin: padding-box;
    background-position: 0 0;
    background-repeat: repeat;
    background-size: auto auto;
    height: 63px;
    left: -217px;
    position: absolute;
    top: -115px;
    width: 1351px;
}

#menutop select {
    position: absolute;
    left: 540px;
}

.pager_view_more_link a {background:none;border:0px;}
.js_feed_comment_form textarea {width:152px;}
.report_this_item {display:none;}
.comment_mini_action {display:none;}

.left {float: left;}
.right {float: right;}

.clear,.clearer {clear: both;}
.column {	
	width: 210px;
	margin-right: 10px;
}
.column.first {margin-left: 0;}
.clearer {
	display: block;
	font-size: 0;
	height: 0;
	line-height: 0;
}
.sortable-list {	
	list-style: none;
	margin: 0;	
	padding: 0px;
}
.sortable-item {	
	display: block;	
	margin-bottom: 10px;
	padding: 0px;	
	width:210px;
	position:relative;
}

</style>

<script language="javascript" type="text/javascript">
	var sCategory = "{/literal}{$sCategory}{literal}";
	var sText = "{/literal}{$sText}{literal}";
	var sSearchUrl = "{/literal}{url link='advancedmarketplace.search'}{literal}";
    $Behavior.initBlock = function(){
		$('#js_mp_id_0').val(sCategory);
		$('#search_text').val(sText);
        $('#js_mp_id_0').change(function()
        {
            location.href=sSearchUrl+$(this).val()+'/'+$('#js_mp_id_0 :selected').text();
        });

        $.ajaxCall('advancedmarketplace.viewMoreListing', 'page=1&bIsAjax=1', 'GET'); 
        
        
        /*
        $('#container').masonry({
            itemSelector: '.grid'
        });
        */
        
        /*
        var h = $('#container').height();
        $('.js_pager_view_more_link').css('position', 'relative');
        $('.js_pager_view_more_link').css('top', (h+50)+'px');
        */
    };    	
</script>
<script src="{/literal}{param var='core.path'}{literal}module/advancedmarketplace/static/jscript/masonry/jquery.masonry.min.js"></script>
{/literal}
<section id="wrapper">
<div id="menutop">
<form style="margin-bottom:5px; padding-bottom: 5px; border-bottom: 1px solid #DFDFDF;" action="{url link='advancedmarketplace.search'}" method="post">
    <div style=" float: right; margin-right: 291px; margin-top: 23px;">
    {$sCategories}    
    <input type="text" name="search[text]" id="search_text" /> 
    <a href="{url link='advancedmarketplace.search' sort='latest'}">New</a>  
    <a href="#">Tags</a> 
    <a href="{url link='advancedmarketplace.search' sort='most-liked'}">Popular</a>  
    <a href="{url link='advancedmarketplace'}">All</a>                          
    <em> follow us </em></div>
</form>
</div>

<div id="container">
{/if}  
    {*
    {foreach from=$aRecentListing key=iKey item=aListing}
        {template file='advancedmarketplace.block.listing-entry'}
    {/foreach}   
    *}
    <div class="clear"></div>
    {pager}
{if !$bIsAjax}</div>{/if}
{if !$bIsAjax}</section>{/if}
{/if}