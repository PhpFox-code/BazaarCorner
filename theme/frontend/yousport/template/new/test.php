<script>
  document.write('<script src=js/vendor/' +
  ('__proto__' in {} ? 'zepto.min' : 'jquery') +
  '.js><\/script>')
  </script>
  <script src="js/jquery.js"></script>
  <script src="js/default.min.js"></script>
  <script src="js/default4.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="js/jquery.default.reveal.min.js"></script>
  <script src="js/jquery.default.forms.min.js"></script>
  <script>
    $(document).foundation();
  </script>
    <!-- Initialize JS Plugins -->
  <script src="js/app.js"></script>

  <!--DROP DOWN MENU START-->
  <script src="js/vendor/custom.modernizr.js"></script>
  <script src="js/jquery.hoverIntent.min.js"></script>
  <script type="text/javascript" charset="utf-8">
//<![CDATA[
    $(document).ready(function() {
      
      function addMega(){
        $(this).addClass("hovering");
        }

      function removeMega(){
        $(this).removeClass("hovering");
        }

    var megaConfig = {
         interval: 100,
         sensitivity: 4,
         over: addMega,
         timeout: 100,
         out: removeMega
    };
    $("li.mega").hoverIntent(megaConfig)
    });
    //]]>
    </script>
    <!--DROP DOWN MENU END-->
    
    
  <!--VIDEO MODAL SCRIPT START-->
  <script type="text/javascript">
  $(document).ready(function() {
    $("#buttonForModal").click(function() {
      $("#myModal").reveal();
    });
  });
  </script>
  <!--VIDEO MODAL SCRIPT END-->



<!--RECENT FEEDBACKS START-->
<script>
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
</script>
<!--RECENT FEEDBACKS END-->

<!--FACESCROLL START-->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/facescroll/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="js/facescroll/facescroll.js">
/***********************************************
* FaceScroll custom scrollbar (c) Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/
</script>

<script type="text/javascript">
	$(document).ready(function(){ // on page DOM load
		$('.feedback-scroll').alternateScroll({ 'vertical-bar-class': 'styled-h-bar', 'hide-bars': false });	
	})
</script>
<!--FACESCROLL END-->


<script src="js/etalage/jquery.etalage.js"></script>
<script>
        $(document).ready(function(){

                $('#example3').etalage({
                        smallthumbs_position: 'left'
                });

        });
</script>