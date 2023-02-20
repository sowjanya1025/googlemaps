<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
var map;

function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(53.220835, -1.845703),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);

  var points = [{
    "latitude": 53.146770,
    "longitude": -2.296143
  }, {
    "latitude": 53.501117,
    "longitude": -1.524353
  }, {
    "latitude": 52.961875,
    "longitude": -0.983276
  }];
  for (i = 0; i < points.length; i++) {
    var myLatLng = new google.maps.LatLng(points[i].latitude, points[i].longitude);
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map
    });
    marker.setAnimation(google.maps.Animation.DROP)
    google.maps.event.addListener(marker, 'click', function() {
      alert(this.getPosition());
    });
  }
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<style type="text/css">
      html, body, #map-canvas {
          margin: 0;
          padding: 0;
          height: 100%;
      }
	  </style>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1UN-uHoH1Gxz5VkxNKiJBvyg69qWX2GQ"
      defer
    ></script></head>

<body>
<div id="map-canvas"></div>
</body>
</html>
