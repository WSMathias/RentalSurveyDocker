<?php 
/**
* Generates the data for the searched location and stores it into and array.
*/
session_start();
$list = [];


if ($_GET["searchLocation"] != "") {
        $searchString = $_GET["searchLocation"];
        $area = $_GET["area"];
        if ($area != "--") {
            switch ($area)  {
                case "200-600" : {
                    $area = " and area > 199 and area < 601";
                    break;
                } 
                case "600-1100" : {
                    $area = " and area > 600 and area < 1101";
                    break;
                } 
                case "1100-1800" : {
                    $area = " and area > 1100 and area < 1801";
                    break;
                } 
                case "above 1800" : {
                    $area = " and area > 1800";
                    break;
                } 
            }
        } else{
            $area = "";
        }
        $deposit = $_GET["deposit"];
        if ($deposit != "--") {
            switch ($deposit)  {
                case "3000-70000" : {
                    $deposit = " and deposit > 2999 and deposit < 70001";
                    break;
                } 
                case "70000-120000" : {
                    $deposit = " and deposit > 69999 and deposit < 120001";
                    break;
                } 
                case "above 120000" : {
                    $deposit = " and deposit > 120000";
                    break;
                } 
            }
        } else{
            $deposit = "";
        }
        


        $lease = $_GET["lease"];
        if ($lease != "--") {
            switch ($lease)  {
                case "1-6" : {
                    $lease = " and lease_period > 0 and lease_period < 7";
                    break;
                } 
                case "6-15" : {
                    $lease = " and lease_period > 5 and lease_period < 16";
                    break;
                } 
                case "above 15" : {
                    $lease = " and lease_period > 14";
                    break;
                } 
            }
        } else{
            $lease = "";
        }
        require_once("./dbConnectPDO.php");
        $sql = "select * from places a,details b where a.id=b.Lid and  a.location='$searchString' $area $deposit $lease";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0) {
            $list = $stmt->fetchAll( PDO::FETCH_ASSOC );
        }
        else
            echo json_encode("");    
    }else {    
        header("Location: index.php");
}

?>
<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="css/main.css" rel="stylesheet">
        <link href="css/surveyResult.css" rel="stylesheet">
    </head>
<body>
<!-- Navbar -->
<div class="nav navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">Region Survey</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Search in a Location</a></li>
                    <li><a href="surveyEntry.php">Add My Place</a></li>
                    <li><a href="table.php">Show me all places</a></li>
                </ul>
            </div>
 </div>
<!-- Table with the list of location with details. -->
 <div class="container">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">           
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>LOCATION</th>
                    <th>AREA</th>
                    <th>DEPOSIT</th>
                    <th>LEASE PERIOD</th>
                </tr>
                </thead>
                <tbody id="tbrow">
                <?php
                /**
                * Displays the data stored in the array in the form of table .
                */
                foreach ($list as $row)
                {
                    
                    echo '<tr><td>'. $row["location"].'</td>
                    <td>'. $row["AREA"].'</td>
                    <td>'. $row["DEPOSIT"].'</td>
                    <td>'. $row["LEASE_PERIOD"].'</td><tr>';
                    
                }
                ?>
                </tbody>
            </table>
          </div>
        </div>    
 </div>
</body>
</html>
