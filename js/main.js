//Map
$(document).ready(function myMap() {
	var myCenter = new google.maps.LatLng(55.6605141, 37.4857503);
	var mapCanvas = document.getElementById("map");
	var mapOptions = {center: myCenter, zoom: 15};
	var map = new google.maps.Map(mapCanvas, mapOptions);
	var marker = new google.maps.Marker({position:myCenter});
	marker.setMap(map);
});
$(document).ready(function(){
	setInterval(function(){
		$('#time').load('time.php')
	},1000);
});
