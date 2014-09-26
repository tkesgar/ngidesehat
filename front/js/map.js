(function() {

	'use strict';
	
	// create map object using HTML5 location
	// TODO add error handling: use a default location in Bandung
	function initialize() {
	
		var mapOptions = {
			center: new google.maps.LatLng(-6.9148644, 107.6082421),
			zoom: 13
		};
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				var infowindow = new google.maps.InfoWindow({
					map: map,
					position: pos,
					content: 'Anda berada di sini.'
				});
				map.setCenter(pos);
			}, function() {
				if (errorFlag) {
					alert('Error: The Geolocation service failed.');
				} else {
					alert('Error: Your browser doesn\'t support geolocation.');
				}
			});
		}
		
		var directionsService = new google.maps.DirectionsService();
		var directionsDisplay = new google.maps.DirectionsRenderer();
		directionsDisplay.setMap(map);
		
		$.get("http://localhost/ngidesehat/index.php/facility/locations", function(loc) {
			
			// generate map markers from facilities
			var markers = [];
			for (var i = 0; i < loc.length; i++)
			{
				var marker = new google.maps.Marker({
					id: loc[i].id,
					name: loc[i].name,
					position: new google.maps.LatLng(loc[i].lat, loc[i].lng),
					map: map
				});
				markers.push(marker);
				
				// add click event to created marker
				// TODO change DOM on click
				google.maps.event.addListener(marker, 'click', function() {
					$.get("http://localhost/ngidesehat/index.php/facility/get/" + this.id, function(data) {
						$("#info_name").text(data.name);
						$("#info_type").text(data.type);
						$("#info_address").text(data.address);
						$("#info_tel").text(data.tel);
						$("#info_class").text(data['class']);
						$("#info_kec").text(data.kec);
					});

					var request = {
						origin: map.getCenter(),
						destination: marker.position,
						travelMode: google.maps.TravelMode.DRIVING
					};
					directionsService.route(request, function(result, status) {
						if (status == google.maps.DirectionsStatus.OK) {
							directionsDisplay.setDirections(result);
						}
					});
				});
			}
			
		});
		
	}
	google.maps.event.addDomListener(window, 'load', initialize);

}());