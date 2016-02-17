	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- CSS -->
  <link href="css/bootswatch-flatly/bootstrap.css" rel="stylesheet">
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
  <link href="css/prettify.css" rel="stylesheet">
  <link href="css/bootswatch-flatly/docs.css" rel="stylesheet">
  <link href="css/bootswatch-flatly/gaman-styles.css" rel="stylesheet">

  <link href="css/flexslider.css" rel="stylesheet" />
  <link href="css/responsiveslides.css" rel="stylesheet" />
  <link href="css/footer-styles.css" rel="stylesheet" />

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="./ico/favicon.ico">

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
