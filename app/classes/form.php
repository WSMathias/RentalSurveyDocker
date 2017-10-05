<?php

class Surveyform {

    private $fields = array();

    function __construct($fields) {
        $this->$fields = $fields;
    }

    public function render() {
        $lastLocation = $_SESSION["location"];
        $lastArea = $_SESSION["area"];
        $lastPrice = $_SESSION["price"];
        $lastDeposit = $_SESSION["deposit"];
        $lastLease = $_SESSION["lease"];
        $fields ='
        <form action="surveyEntry.php" method="POST" oknsubmit="return checkInputValid();">
        <div class="form-group">
        <label>Location </label>
        <input type="text" class="form-control" id="location" name="place" placeholder="" value ="'.$lastLocation.'">
        </div>
        <div class="form-group">
        <label>Area (sqft)</label>
        <input type="range"  step="200" class="form-control" id="areaSlider" max="1000000" onchange="updateInput(this,areaInput)" min="300" value="'.$lastArea .'" >
        <input type="number" class="form-control" id="areaInput" max="1000000" min="300"  name="area" onkeyup="updateInput(this,areaSlider)" value="'.$lastArea .'" >
        </div>
        <div class="form-group">
        <label>Price (Rs) </label>
        <input type="range"  step="10000" class="form-control" id="priceSlider" max="10000000" min="10000" onchange="updateInput(this,priceInput)" value="'.$lastPrice .'">
        <input type="number" class="form-control" id="priceInput" max="10000000" min="10000" oninput="updateInput(this,priceSlider)" name="price" value="'.$lastPrice .'">
        </div>
        <div class="form-group">
        <label>Deposit (Rs) </label>
        <input type="range"  step="100000" class="form-control" id="depositSlider" max="1000000" min="300" onchange="updateInput(this,depositInput)" value="'.$lastDeposit .'" >
        <input type="number" class="form-control" id="depositInput" max="1000000" min="300" oninput="updateInput(this,depositSlider)" name="deposit" value="'.$lastDeposit .'" >
        </div>
        <div class="form-group">
        <label>Lease period(month) :</label>
        <input type="range"  step="6" class="form-control" id="leaseSlider" max="36" min="3" onchange="updateInput(this,leaseInput)" value="'.$lastLease .'" >
        <input type="number" class="form-control" id="leaseInput" max="36" min="3" oninput="updateInput(this,leaseSlider)" name="lease" value="'.$lastLease .'" >
        </div>
        <div class="text-center">
        <input type="submit" value="Submit" name="submit" class="submit_button col-md-offest-4  mol-md-offset-4 btn btn-primary" onsubmit="checkInputValid(this.value);">
        </div>
        </form>
        ';
        return $fields;
    }


    public function validate(){  
        /**
        * Checks if parameters are completely validated.
        * return {boolean}
        */
        function isValidated(){
            if(!isEmpty()) {
                if( validateString($_SESSION["location"]) && 
                validateNumber("deposit",$_SESSION["deposit"],300,900300) &&
                validateNumber("Lease Period",$_SESSION["lease"],3,33) && 
                validateNumber("Area",$_SESSION["area"],300,999900) &&
                validateNumber("Price",$_SESSION["price"],10000,10000000)){
                    //echo "form validated  successfully </br>";
                    return true;
                }
            }else {
                //echo "form validation failed </br>";
                return false;}
        }
        
        /**
        * Check if the parameters are empty.
        * return {boolean}
        */
        function isEmpty() {
            if ($_SESSION["location"] == "" || $_SESSION["deposit"] == 0 || $_SESSION["price"] == 0 || $_SESSION["deposit"] == 0 || $_SESSION["lease"]==0){
                $_SESSION["statusMessage"] .= "Fields cannot be empty.<br>"; 
                return true;
            }
            else{
                return false;
            }
        }
        /**
        * Validates for any special characters.
        * return {boolean}
        */
        function validateString($string) {
            /**
            * regular expression to check for special characters to avoid sql injection
            */
            if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $string))
            {
                $_SESSION["statusMessage"] .= $string." : special characters are not allowed<br>"; 
                return false;
            }
            else if (strpos(strtoupper($string), 'INDIA') == false) {
                $_SESSION["statusMessage"] .= $string." : invalid place name <br>"; 
                return false;
            }
            else
                return true;
        }

        /**
        * Checks if parameters are validated.
        * return {boolean}
        */
        function validateNumber($field,$number,$min=0,$max=10000000000) {
            echo "$field </br>";
            if(is_integer($number)) {
                if($number >= $min && $number <= $max){
                    echo gettype($number)." $field "." comp</br>";
                    return true;
                }            
                else{
                    echo "$field must be between $min and $max</br>"; 
                    return false ; //$errorMessage[] = [$field => "$field must be between $min and $max"];
                }
            }
            else {
                //echo gettype($number)."</br> 3";
                echo "$field is not a number ($number)</br>";
                return false; //$errorMessage[] = [$field => "$field is not a number"];
            }

        }

        return isValidated();
    }

    public function submit() {

        $location = $_SESSION["location"];
        $area = $_SESSION["area"];
        $price = $_SESSION["price"];
        $deposit = $_SESSION["deposit"];
        $lease = $_SESSION["lease"];   
            require_once("dbConnectPDO.php");
            $location = strtoupper($location);
            $sqlCheck="select id from places where location ='$location'";
            $stmt = $dbh->prepare($sqlCheck);
            $stmt->execute();
            if($stmt->rowCount()>0) {
                $lid=($stmt->fetchAll( PDO::FETCH_ASSOC ))[0]["id"];
                $sql = "insert into details(area,price,deposit,lease_period,lid) values($area,ROUND($price/$area,2),$deposit,$lease,$lid)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
                    unset($_SESSION["location"]);
                    unset($_SESSION["area"]);
                    unset($_SESSION["price"]);
                    unset($_SESSION["deposit"]);
                    unset($_SESSION["lease"]);
                    return true;
                }
            }
            else{
                $sqlPlaces ="insert into places(location) values('$location')";
                $sqlDetails ="insert into details(area,price,deposit,lease_period,lid) values($area,ROUND($price/$area,2),$deposit,$lease,LAST_INSERT_ID())";
                if($dbh->query($sqlPlaces) && $dbh->query($sqlDetails)){
                        unset($_SESSION["location"]);
                        unset($_SESSION["area"]);
                        unset($_SESSION["price"]);
                        unset($_SESSION["deposit"]);
                        unset($_SESSION["lease"]);
                        return true;
                    }
                else
                    return false;
            }
        

    }


}
?>