<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Bazaar Corner Website</title>
  <link rel="stylesheet" href="css/normalize.min.css" />
  <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/default.css" />
  <link rel="stylesheet" href="css/style.min.css" />
  <!--<link rel="stylesheet" href="css/style.min.css" />-->
  <link rel="stylesheet" href="css/app.css" />
  <link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.min.css" media="all" />
  <link rel="stylesheet" href="css/etalage/etalage.min.css">
  
</head>
<body>
<!--HEADER START-->
<?php include_once 'header.html';?>
<!--HEADER END-->

<div class="row" style="margin-top: 20px">
    <div class="three columns">
        <!--BAZAAR COLLECTION AND PAGES START-->
        <?php include_once 'collection_pages.html';?>
        <!--BAZAAR COLLECTION AND PAGES END-->
    </div>
    <div class="six columns">
        <!--SEARCH START-->
        <?php include_once 'search.html';?>
        <!--SEARCH END-->
    </div>
    <div class="three columns">
        <!--CLICK TO SELL START-->
        <?php include_once 'click_to_sell.html';?>
        <!--CLICK TO SELL END-->
    </div>
</div>
<!--HEADER END-->

<div class="row" style="margin-top: 20px">
    <div class="three columns">
        <!--USER DETAILS START-->
        <?php include_once 'user_details.html';?>
        <!--USER DETAILS END-->
        
        <!--RANKINGS START-->
        <?php include_once 'rankings.html';?>
        <!--RANKINGS END-->
        
        <!--RANKINGS START-->
        <?php include_once 'feedbacks.html';?>
        <!--RANKINGS END-->
    </div>
    <div class="nine columns">
        <!--COVER PHOTO START-->
        <?php include_once 'cover_photo.html';?>
        <!--COVER PHOTO END-->

        <!--CONTENT START-->
        <?php include_once 'content_user.html';?>
        <!--CONTENT END-->
        <br />
    </div>
</div>



<div class="row"><div style="margin: 100px 0px 20px 0px;"><hr /></div></div>

<!--FOOTER START-->
<?php include_once 'footer.html';?>
<!--FOOTER END-->

<!--FOOTER START-->
<?php include_once 'user_modal.html';?>
<!--FOOTER END-->


<!--FOOTER START-->
<?php include_once 'js_script_user.html';?>
<!--FOOTER END-->
  
</body>
</html>