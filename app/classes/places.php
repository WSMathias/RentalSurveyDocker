<?php

class Places {

    private $url = null;
    
    private $response = null;
    private function setAddress($address) {
        $this->url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&key=AIzaSyCPX7xWTZQaFlNYvwP59-P0oElX32Jrl3s";
        return $this->getResponse();
    }

    private function getResponse() {
        $response = file_get_contents($this->url);
        $response = json_decode($response, true);
        if ($response != null)
            if ($response["status"]== "OK" && $response["status"] != "ZERO_RESULTS") {
                $this->response = $response;
                return true;
            }
        return false;
    }

    public function test() {
        print_r($this->response["results"][0]["formatted_address"]);
        echo "<br>";
    }

    public function validatePlace($place) {
        $address = preg_replace("/, {1,}/", ",", $place);
        $address = preg_replace("/ {1,}/", "", $place);
        if ($this->setAddress($address))
            if ($place == $this->response["results"][0]["formatted_address"])
                return true;
            else
                return false;
        else
            return false;
    }
}
?>