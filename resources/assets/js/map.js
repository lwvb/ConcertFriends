var map = L.map('map').setView([52.162, 5.095], 9);
    
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18,
    id: 'pbredewold.p74hj116',
    accessToken: 'pk.eyJ1IjoicGJyZWRld29sZCIsImEiOiJ6V2NGajNBIn0.37Amj6Jg93KOTbvtvPthog'
}).addTo(map);