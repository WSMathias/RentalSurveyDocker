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
                if (places.length == 0)
                    return;
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) 
                    return;
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
    const list = document.getElementsByClassName('pac-item');
    const listLength = list.length;
    if (listLength==0){
        alert('invalid place');
        document.getElementById('location').value="";
        return false;
    } else {
        let i;
        let text = "";
        for (i in list) {
            let span = list[i].childNodes;
            if (span[2] != undefined)
                {
                    if (span[2].textContent != "") {
                        text = span[1].textContent + span[2].textContent;
                        document.getElementById('location').value=text;
                        return true;
                    }
                } 
            else     
            return false;          
        }
        return false;
    }
  }