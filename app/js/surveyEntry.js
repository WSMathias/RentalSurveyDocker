var a;
/**
 * Google places api function
 * generates list of places in India.
 */
function initAutocomplete() {
    var input = document.getElementById('location');
    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(20.5937, 78.9629));
        var searchBox = new google.maps.places.SearchBox(input, {bounds: defaultBounds});
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
            }
                console.log(places);
            
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
            }
        });
    });
  }
  /**
   * Update the input and Slider simultaneously
   * @param {source,destination}
   */
  function updateInput(source,destination) {
    let sourceMax = Number(source.getAttribute("max"));
    let sourceMin = Number(source.getAttribute("min"));
    let sourceVal = Number(source.value);
    if (sourceVal > sourceMax || sourceVal==""){
            sourceVal = sourceMax;
            source.value = sourceMax;
    
    }
    console.log(sourceVal > sourceMin || sourceVal == "");        
    if (sourceVal < sourceMin){
        sourceVal = sourceMin;
        source.value = sourceMin;        
    }
    destination.value = sourceVal;
  }  
  /**
   * Restrict from entering invalid character ,which is not available in places api response
   */
  function checkInputValid(value) {
    const listLength = document.getElementsByClassName('pac-item-query').length;
    if (listLength==0)
        document.getElementById('location').value="";
    return true;
  }