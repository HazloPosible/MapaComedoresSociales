$
if (typeof(marker_final) != "undefined" && marker_final !== null) {
	google.maps.event.addListener(marker_final, 'dragend', function() { updatePantryLatLang(marker_final); });
}

function updatePantryLatLang(marker)
{
	$('#mapacomedoressociales_pantrybundle_pantrytype_latitude').val(marker_final.getPosition().lat());
	$('#mapacomedoressociales_pantrybundle_pantrytype_longitude').val(marker_final.getPosition().lng());
}