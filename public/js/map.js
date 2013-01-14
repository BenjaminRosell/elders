/*
*Thanks to the Google map API -> https://developers.google.com/maps/
*/
jQuery.noConflict()(function($){
    $(document).ready(function() {
		$(function() {
			var infoMap = new google.maps.InfoWindow();
			var Mappos = new google.maps.LatLng(40.714353,-74.005973);
			var pictoMap = 'images/picto_map.png';
			var contentMap = '<div class="infoBulle" ><h4>Custom Google map !</h4><p>Area for you address or a description</p></div>';
			var options = {
				center: Mappos,
				zoom: 14,					
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: true,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
				},					
				navigationControl: true,
				navigationControlOptions: {					
					style: google.maps.NavigationControlStyle.SMALL
				}
			};			
			var carte = new google.maps.Map(document.getElementById("GoogleMaps"), options);
			var iconMap = new google.maps.Marker({
				position: Mappos,
				map: carte,
				icon : pictoMap});												
			google.maps.event.addListener(iconMap, 'click', function() {
				infoMap.setContent(contentMap);
				infoMap.open(carte, this);
				carte.panTo(Mappos);});		
			google.maps.event.addListener(carte, 'click', function() {
				carte.panTo(Mappos);infoMap.setContent(contentMap);infoMap.open(carte, iconMap);
			});	
		});
	});	
});