
{if !PHPFOX_IS_AJAX_PAGE}

<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<?php
	include 'site_path.php';
?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Bazaar Corner Website</title>
  <link rel="stylesheet" href="<?=$host_?>/theme/frontend/yousport/template/css/normalize.min.css" />
  <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?=$host_?>/theme/frontend/yousport/template/css/default.min.css" />
  <link rel="stylesheet" href="<?=$host_?>/theme/frontend/yousport/template/css/style.css" />
  <link rel="stylesheet" href="<?=$host_?>/theme/frontend/yousport/template/css/app.css" />
  <link rel="stylesheet" type="text/css" href="<?=$host_?>/theme/frontend/yousport/template/css/jquery.jscrollpane.css" media="all" />
</head>
<body>
<!--HEADER START-->
<?php include $theme_path.'header.html';?>
<!--HEADER END-->

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
<?php include $theme_path.'js_script.html';?>
<!--FOOTER END-->
  
</body>
</html>

{/if}