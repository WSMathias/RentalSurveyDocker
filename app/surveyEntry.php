<?php session_start();
require_once('./classes/form.php');
if (isset($_POST["submit"])){
    $_SESSION["location"] = $_POST["place"];
    $_SESSION["area"] = (int)$_POST["area"];
    $_SESSION["price"] = (int)$_POST["price"];
    $_SESSION["deposit"] = (int)$_POST["deposit"];
    $_SESSION["lease"] = (int)$_POST["lease"];
    $_SESSION["statusMessage"] = "";
    if(SurveyForm::validate()){
        // echo "<h2>no Error</h2>";
        SurveyForm::submit();
        $_SESSION["statusMessage"] = "Successfully submitted";
    }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="css/main.css" rel="stylesheet">
        <link href="css/surveyEntry.css" rel="stylesheet">
    </head>
    <body>
    <!-- Navbar -->
        <div class="nav navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <li><a href="index.php" class="navbar-brand">RentalSurvey</a></li>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="index.php">Search in a Location</a></li>
                    <li class="active" ><a href="surveyEntry.php">Add My Place</a></li>
                    <li><a href="table.php">Show me all places</a></li>
                </ul> 
            </div>
        </div>
        </div>
        <!-- Form to entry details -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-offset-3 col-md-6 col-md-offset-3 form_box ">
                <?php
                    echo SurveyForm::render();
                ?>
                  <!-- <form action="form.php" method="POST"  onsubmit="return checkInputValid();">
                    <div class="form-group">
                    <label>Location </label>
                    <input type="text" class="form-control" id="location" name="place" placeholder="" <?php echo "value='".$_SESSION["location"] ."'"; ?> >
                    </div>
                    <div class="form-group">
                    <label>Area (sqft)</label>
                    <input type="range"  step="200" class="form-control" id="areaSlider" max="1000000" onchange="updateInput(this,areaInput)" min="300" name="area" <?php echo "value=".($_SESSION["area"]!="")?300:$_SESSION["area"]; ?>  >
                    <input type="number" class="form-control" id="areaInput" max="1000000" min="300"  name="area" onkeyup="updateInput(this,areaSlider)" <?php echo "value=".($_SESSION["area"]!="")?300:$_SESSION["area"]; ?>  >
                    </div>
                    <div class="form-group">
                    <label>Price (Rs) </label>
                    <input type="range"  step="10000" class="form-control" id="priceSlider" max="10000000" min="10000" onchange="updateInput(this,priceInput)" name="price" <?php echo "value=".($_SESSION["price"]!="")?300:$_SESSION["price"]; ?>>
                    <input type="number" class="form-control" id="priceInput" max="10000000" min="10000" oninput="updateInput(this,priceSlider)" name="price" <?php echo "value=".($_SESSION["price"]!="")?300:$_SESSION["price"]; ?>>
                    </div>
                    <div class="form-group">
                    <label>Deposit (Rs) </label>
                    <input type="range"  step="100000" class="form-control" id="depositSlider" max="1000000" min="300" onchange="updateInput(this,depositInput)" name="deposit" <?php echo "value=".($_SESSION["deposit"]!="")?300:$_SESSION["deposit"]; ?> >
                    <input type="number" class="form-control" id="depositInput" max="1000000" min="300" oninput="updateInput(this,depositSlider)" name="deposit" <?php echo "value=".($_SESSION["deposit"]!="")?300:$_SESSION["deposit"]; ?> >
                    </div>
                    <div class="form-group">
                    <label>Lease period(month) :</label>
                    <input type="range"  step="6" class="form-control" id="leaseSlider" max="36" min="3" onchange="updateInput(this,leaseInput)" name="lease" <?php echo "value=".($_SESSION["lease"]!="")?300:$_SESSION["lease"]; ?> >
                    <input type="number" class="form-control" id="leaseInput" max="36" min="3" oninput="updateInput(this,leaseSlider)" name="lease" <?php echo "value=".($_SESSION["lease"]!="")?300:$_SESSION["lease"]; ?> >
                    </div>
                    <div class="text-center">
                    <input type="submit" value="Submit" name="submit" class="submit_button col-md-offest-4  mol-md-offset-4 btn btn-primary" onsubmit="checkInputValid(this.value);">
                    </div>
                  </form> -->
                </div>
            </div>
        </div> 
        <!-- Alert Box -->
        <div class="container-fluid alert_box">
            <div class="row">
                <div class="col-md-offset-3 col-md-6 col-md-offset-3">
                  <div class="alert alert-info" style="<?php 
                /**
                * Displays the status message if any.
                */
                  if (!isset($_SESSION["statusMessage"]) || $_SESSION["statusMessage"] == "")
                    echo 'display:none;';
                  else
                    echo 'display:block;';
                   ?>">
                        <?php      
                        if (isset($_SESSION["statusMessage"]) || $_SESSION["statusMessage"] != "")
                            { echo $_SESSION["statusMessage"];
                                unset($_SESSION["statusMessage"]);
                            }
                                                  
                        ?>
                  </div>
                </div>
            </div>
        </div> 
           
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPX7xWTZQaFlNYvwP59-P0oElX32Jrl3s&libraries=places&callback=initAutocomplete"
         async defer></script>
         <script src="./js/surveyEntry.js"></script>
    </body>
</html>