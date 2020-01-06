
	 var geodecoder = {
		        geocoder: new google.maps.Geocoder(),
				
			       deCodeLatLong: function (lati, lngo) {
					  var latlng = {lat: lati, lng: lngo};	
				        this.geocoder.geocode({'location': latlng}, function(results, status) {
				        if (status === 'OK') {
				        	console.log(results[0].formatted_address);
				        	
				        }	       
				      });
				               
				 }
		
		}

