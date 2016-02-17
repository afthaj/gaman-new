<!-- Le javascript =================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="js/jquery.js"></script>
  
<script src="js/bootstrap.js"></script>

<script src="js/typeahead.js"></script>    

<script src="js/application.js"></script>
<script src="js/holder.js"></script>
<script src="js/html5shiv.js"></script>
<script src="js/prettify.js"></script>

<script defer src="./js/jquery.flexslider.js"></script>
<script defer src="./js/responsiveslides.js"></script>

<script type="text/javascript">
	$(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
</script>
    
<script>
// You can also use "$(window).load(function() {"
$(function () {

  /* Slideshow 4 */
  $("#responsive_slider").responsiveSlides({
    auto: false,
    pager: false,
    nav: true,
    speed: 500,
    namespace: "callbacks",
    before: function () {
      $('.events').append("<li>before event fired.</li>");
    },
    after: function () {
      $('.events').append("<li>after event fired.</li>");
    }
  });
});
</script>