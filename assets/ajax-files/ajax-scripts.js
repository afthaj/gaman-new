// init calls and other callbacks

// main typeahead on home page to search for bus routes
$(document).ready(function() {
  $('.typeahead').typeahead({
    name: 'name',
    prefetch: './ajax-files/get-stops.php',
    limit: 5
  });
});


// flexslider
$(window).load(function(){
  $('.flexslider').flexslider({
    animation: "slide",
    start: function(slider){
      $('body').removeClass('loading');
    }
  });
});


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


$(window).load(function(){
  $('.flexslider').flexslider({
    animation: "slide",
    start: function(slider){
      $('body').removeClass('loading');
    }
  });
});


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




// functions for ajax calls

function change_object_type(str, related_object) {

	if (str == "") {
		related_object.innerHTML = "<p>nothing</p>";
		return;
		}

	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		request = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			request = new ActiveXObject("Microsoft.XMLHTTP");
			}

	request.onreadystatechange = function() {

		if (request.readyState == 4 && request.status == 200) {
			related_object.innerHTML = request.responseText;
			}

		}

	request.open("GET","assets/ajax-files/get-object-types.php?q=" + str, true);

	request.send();

	}


function findBusRoute(from, to, search_results) {
	var from_encoded = encodeURI(from.value);
	var to_encoded = encodeURI(to.value);
	var search_url = "assets/ajax-files/search-for-stops.php?f=";
		search_url += from_encoded;
		search_url += "&t=";
		search_url += to_encoded;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		request = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			request = new ActiveXObject("Microsoft.XMLHTTP");
			}
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			search_results.innerHTML = request.responseText;
			}
		}
	request.open("GET",search_url, true);
	request.send();
}


function change_related_object_type_and_id(str, related_object_type, related_object_id) {

    if (str == "") {
        related_object_id.innerHTML = "";
        return;
    }

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        request = new XMLHttpRequest();
        request2 = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            request = new ActiveXObject("Microsoft.XMLHTTP");
            request2 = new ActiveXObject("Microsoft.XMLHTTP");
            }

    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            related_object_id.innerHTML = request.responseText;
            }

        }

    request2.onreadystatechange = function() {

        if (request2.readyState == 4 && request2.status == 200) {
            related_object_type.innerHTML = request2.responseText;
            }

        }

    request.open("GET","assets/ajax-files/get-objects-to-create-complaint.php?q=" + str, true);

    request.send();

    request2.open("GET","assets/ajax-files/get-object-types-to-create-complaint.php?q=" + str, true);

    request2.send();

}

function change_related_object_id(str, related_object_id) {
	if (str == "") {
		related_object_id.innerHTML = "";
		return;
		}
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		request = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			request = new ActiveXObject("Microsoft.XMLHTTP");
			}
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			related_object_id.innerHTML = request.responseText;
			}
		}
	request.open("GET","assets/ajax-files/get-objects-to-create-feedback.php?q=" + str, true);
	request.send();
}
