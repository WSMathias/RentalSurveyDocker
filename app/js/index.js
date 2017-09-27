    /**
     * Hides/displays the advanced search forms inputs.
     */
    const url1="autocomplete.php";
    function toggleAdvancedOptions() {
        document.getElementById('suggestion').innerHTML="";    
        const advancedSearchBtn = document.getElementsByClassName('advancedSearch')[0];
        const advancedSearchOptions = document.getElementsByClassName('advanced_option')[0];
        if (advancedSearchOptions.style.display == "none") 
            advancedSearchOptions.style.display="block";
        else {
            document.getElementById('area').value="--";
            document.getElementById('deposit').value="--";
            document.getElementById('lease').value="--";
            advancedSearchOptions.style.display="none";
        }
    }
    /**
     * Select the suggested places from suggestion list 
     * @param {String} value 
     */
    function selectSuggestion(value) {
        document.getElementById('searchTxt').value = value; 
        document.getElementById('suggestion').innerHTML="";    
    }

    /**
     * Check if improper input is entered in the search bar.
     * Restricts search submision
     */
    function inputCheck() {
        const searchTxt = document.getElementById('searchTxt').value;
        if (searchTxt == "") {
            alert("Fields cannot be empty");
            return;
        }
        const request = new HttpClient(url1);
        request.get("?q="+searchTxt).then(function(response) {
                if (response != "") {
                    console.log(true);  
                    document.getElementById('search_box').submit();
                    return;
                } 
            console.log(false);
            alert("Place not available.");
            return false;
        });
    }

    /**
     * Suggests places based on query.
     * also shows the complete list of places on click.
     */
    function suggestPlaces() {
        const searchTxt = document.getElementById('searchTxt').value;
        if (searchTxt!="") {
            const suggestionBox = document.getElementById('suggestion');
            const request = new HttpClient(url1);
            request.get("?q="+searchTxt).then(function(response) {
                suggestionBox.innerHTML = "";
                for (i in response) {
                    suggestionBox.innerHTML += '<span onclick="selectSuggestion(this.innerHTML)">' + response[i].location + '</span>'; 
                }
            });
        }
        else {
            document.getElementById('suggestion').innerHTML="";    
        }

    }
