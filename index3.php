<div id="webkulMap" style="height: 280px;"></div>
<input type="text" name="latitude" value="" placeholder="latitude" id="latitude"/>
<input type="text" name="longitude" value="" placeholder="longitude" id="longitude"/>
<input type="text" name="city" value="" placeholder="City" id="input-city"/>
<input type="text" name="postcode" value="" placeholder="Post Code" id="input-postcode"/>
<input type="text" name="country_id" value="" placeholder="country" id="input-country"/>
<input type="text" name="zone_id" value="" placeholder="zone" id="input-zone"/>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyD1UN-uHoH1Gxz5VkxNKiJBvyg69qWX2GQ">

</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>

<script type="text/javascript">
    var  map;
	 var  marker;
	  var  myLatlng = new google.maps.LatLng(12.972442, 77.580643);
	   var  geocoder = new google.maps.Geocoder();
	    var  infowindow = new google.maps.InfoWindow();
		 function  initialize()
		  { 
		  var  mapOptions = {
        zoom: 3,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        map = new google.maps.Map(document.getElementById("webkulMap"), mapOptions);
		//alert(map);
        marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            draggable: true
        });

        google.maps.event.addListener(marker, 'click', function () {
            geocoder.geocode({'latLng': marker.getPosition()}, function ( results , status ) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0])
					 { 
					 var  address_components = results[0].address_components; 
					 var  components={};
                        jQuery.each(address_components, function ( k , v1 ) 
						{
						jQuery.each(v1.types, function ( k2 , v2 )
						{
						components[v2]=v1.long_name});});
						 var  city; var  postal_code; var  state; var  country;

                        if(components.locality) {
                            city = components.locality;
                        }
						//alert(city);

                        //if(!city) {
                           // city = components.administrative_area_level_1;
                        //}
						//alert(city);

                        if(components.postal_code) {
                            postal_code = components.postal_code;
                        }

                        if(components.administrative_area_level_1) {
                            state = components.administrative_area_level_1;
                        }

                        if(components.country) {
                            country = components.country;
                        }
                        
                        $.ajax({
                            url : 'url',
                            data: {state : state, country : country},
                            type: 'POST',
                            success: function ( data ) {
                                $('#input-country').val(data['country']);
                                $('#input-zone').val(data['zone']);
                            }
                        });

                        $('#input-city').val(city);
						//alert($('#input-city').val(city));
                        $('#input-postcode').val(postal_code);
                        $('#latitude').val(marker.getPosition().lat());
                        $('#longitude').val(marker.getPosition().lng());
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    }
                }
            });
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>