// init calls and other callbacks

// main typeahead on home page to search for bus routes
$(document).ready(function() {
  $('.typeahead').typeahead({
    name: 'name',
    prefetch: './assets/ajax-files/get-stops.php',
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

	request.open("GET","./assets/ajax-files/get-object-types.php?q=" + str, true);

	request.send();

	}


function findBusRoute(from, to, search_results) {
	var from_encoded = encodeURI(from.value);
	var to_encoded = encodeURI(to.value);
	var search_url = "./assets/ajax-files/search-for-stops.php?f=";
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

    request.open("GET","./assets/ajax-files/get-objects-to-create-complaint.php?q=" + str, true);

    request.send();

    request2.open("GET","./assets/ajax-files/get-object-types-to-create-complaint.php?q=" + str, true);

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
	request.open("GET","./assets/ajax-files/get-objects-to-create-feedback.php?q=" + str, true);
	request.send();
}







// Google Charts

$(document).ready(function() {
  google.charts.load('current', {packages: ['corechart']});
  google.charts.setOnLoadCallback(drawChart1);
  google.charts.setOnLoadCallback(drawChart2);
  google.charts.setOnLoadCallback(drawChart3);
  google.charts.setOnLoadCallback(drawChart4);
});

function drawChart1() {
  var data = google.visualization.arrayToDataTable([
    ['Bus Stop', 'Boarded', 'Alighted', 'On Board'],
    ['Kolpetty - Railway Station', 11, 0, 11],
    ['Kolpetty - Supermarket', 10, 0, 21],
    ['Kolpetty - Alwis Place', 7, 0, 28],
    ['Colombo Public Library', 3, 6, 25],
    ['SLTA', 0, 2, 23],
    ['Colombo National Museum', 1, 0, 24],
    ['Nelum Pokuna Theater', 2, 2, 24],
    ['Alexandra Roundabout', 5, 0, 29],
    ['Central', 2, 1, 30],
    ['Wijerama', 4, 0, 34],
    ['Borella - Horton Place', 2, 5, 31],
    ['Devi Balika', 1, 1, 31],
    ['Castle Street', 1, 0, 32],
    ['Ayurveda', 2, 6, 28],
    ['Rajagiriya', 25, 5, 48]
  ]);

  var options = {
    title: 'Passenger Load Data',
    height: 600,
    vAxis: { title: 'No. of Passengers', gridlines: {color: '#000000', count: 8} }
  };

  var chart = new google.visualization.LineChart(document.getElementById('chart_line'));
  chart.draw(data, options);
}

function drawChart2() {
  var data = google.visualization.arrayToDataTable([
    ['Bus Stop', 'Loiter Time'],
    ['Kolpetty - Railway Station', 0],
    ['Kolpetty - Supermarket', 1],
    ['Kolpetty - Alwis Place', 0],
    ['Colombo Public Library', 1],
    ['SLTA', 1],
    ['Colombo National Museum', 0],
    ['Nelum Pokuna Theater', 1],
    ['Alexandra Roundabout', 0],
    ['Central', 0],
    ['Wijerama', 0],
    ['Borella - Horton Place', 1],
    ['Devi Balika', 0],
    ['Castle Street', 0],
    ['Ayurveda', 1],
    ['Rajagiriya', 6]
  ]);

  var options = {
    title: 'Loiter Time',
    height: 600,
    vAxis: { title: 'Minutes', gridlines: {color: '#000000', count: 8} }
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_column'));
  chart.draw(data, options);
}

function drawChart3() {
  var jsonData = $.ajax({
      url: "../../assets/ajax-files/getData.php",
      dataType:"json",
      async: false
      }).responseText;

  // Create our data table out of JSON data loaded from server.
  var data = new google.visualization.DataTable(jsonData);

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.PieChart(document.getElementById('chart_pie'));
  chart.draw(data, {width: 800, height: 480, title: 'Breakdown of Vegies'});
}

function drawChart4() {
  // Define the chart to be drawn.
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Element');
  data.addColumn('number', 'Percentage');
  data.addRows([
    ['Nitrogen', 0.78],
    ['Oxygen', 0.21],
    ['Other', 0.01]
  ]);

  // Instantiate and draw the chart.
  var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
  chart.draw(data, {width: 800, height: 480, title: 'Atomospheric Composition'});
}
