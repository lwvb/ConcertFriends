$(function() {
	if($( "#map" ).length === 0) {
		return;
	}

	var map = L.map('map').setView([52.162, 5.095], 8);
	var params={};window.location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(str,key,value){params[key] = value;});
	var greenIcon = L.icon({
        iconUrl: '/images/marker.png',
        // shadowUrl: '/images/marker-shadow.png',
    
        iconSize:     [25, 41], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [12, 40], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [0, -33] // point from which the popup should open relative to the iconAnchor
    });
    
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
        maxZoom: 18,
        id: 'pbredewold.p74hj116',
        accessToken: 'pk.eyJ1IjoicGJyZWRld29sZCIsImEiOiJ6V2NGajNBIn0.37Amj6Jg93KOTbvtvPthog'
	}).addTo(map);
    
	function addMarker(data) {
		if(data.location[0] === null || data.location[1] === null){
			return;
		}
		var popupContent = '<a href="concert/'+data.id+'">'+data.name+'<br>'+data.date+'</a>';
        L.marker([data.location[0],data.location[1]],{icon: greenIcon}).addTo(map).bindPopup(popupContent);
	}

	$.ajax('/api/markers?q='+(params.q ? params.q : ''), {
		success: function(data) {
			data.forEach(addMarker);
		}
	});
});

