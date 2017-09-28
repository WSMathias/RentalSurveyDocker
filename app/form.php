<?php session_start(); 
/**
*  Accepts the input for form entry.
*/
$_SESSION["statusMessage"] = "";
$errorMessage = [];
$location = $_POST["place"];
$area = (int)$_POST["area"];
$price = (int)$_POST["price"];
$deposit = (int)$_POST["deposit"];
$lease = (int)$_POST["lease"];
$lid;

$_SESSION["location"] = $location;
$_SESSION["area"] = ($area==0)?"":$area;
$_SESSION["price"] = ($price==0)?"":$price;
$_SESSION["deposit"] = ($deposit==0)?"":$deposit;
$_SESSION["lease"] = ($lease==0)?"":$lease;

/**
*  Redirects to index.php if any errors.
*/
function onError(){
    global $errorMessage; 
    $_SESSION["errorMessage"] = serialize($errorMessage);
    header("Location: surveyEntry.php");
}
/**
* Sets statusMessage session on success of the entry.
*/
function onSuccess(){
    $_SESSION["statusMessage"] .= "<br>success<br>";
    $_SESSION["location"] = "";
    $_SESSION["area"] = "";
    $_SESSION["price"] = "";
    $_SESSION["deposit"] = "" ;
    $_SESSION["lease"] = "";
    header("Location: surveyEntry.php");
}
/**
* Check if the parameters are empty.
* return {boolean}
*/
function isEmpty() {
    global $area,$location,$lease,$deposit,$price; 
    if ($location == "" || $area == 0 || $price == 0 || $deposit == 0 || $lease==0){
        $_SESSION["statusMessage"] .= "Fields cannot be empty.<br>"; 
        //echo " is empty </br>";
        return true;
    }
    else{
        //echo "is not empty </br>";
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
    else
        return true;
}

/**
* Checks if parameters are validated.
* return {boolean}
*/
function validateNumber($field,$number,$min=0,$max=10000000000) {
    if(is_integer($number)) {
        if($number >= $min && $number <= $max){
            //echo "$field $number good no </br>";            
            return true;
        }            
        else{
            //echo "$field $number bad no $field must be between $min and $max</br>"; 
            return $errorMessage[] = [$field => "$field must be between $min and $max"];}
    }
    else {
        //echo "$field $number bad no $field is not a number </br>";
        return $errorMessage[] = [$field => "$field is not a number"];}

}


/**
* Checks if parameters are completely validated.
* return {boolean}
*/
function isValidated(){
    global $area,$location,$lease,$deposit,$price;
    if(!isEmpty()) {
        if( validateString($location) && validateNumber("deposit",$deposit) &&
         validateNumber("Lease Period",$lease) && validateNumber("Area",$area) &&
         validateNumber("Price",$price)){
             echo "form validated  successfully </br>";
            return true;
        }
    }else {
        echo "form validation failed </br>";
        return false;}
}
/**
* Inserts the data to the database if validated.
*/
if (!isValidated()) {
    onError();
} else {
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
            onSuccess();
        }
    }
    else{
        $sqlPlaces ="insert into places(location) values('$location')";
        $sqlDetails ="insert into details(area,price,deposit,lease_period,lid) values($area,ROUND($price/$area,2),$deposit,$lease,LAST_INSERT_ID())";
        if($dbh->query($sqlPlaces) && $dbh->query($sqlDetails))
            onSuccess();
        else
            onError();
    }
}

?>
