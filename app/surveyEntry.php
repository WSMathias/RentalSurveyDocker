<?php session_start();
require_once('./classes/form.php');
// if (isset($_POST["submit"])){
    SurveyForm::onSubmit();
    // $_SESSION["location"] = $_POST["place"];
    // $_SESSION["area"] = (int)$_POST["area"];
    // $_SESSION["price"] = (int)$_POST["price"];
    // $_SESSION["deposit"] = (int)$_POST["deposit"];
    // $_SESSION["lease"] = (int)$_POST["lease"];
    // $_SESSION["statusMessage"] = "";
    // if(SurveyForm::validate()){
    //     SurveyForm::submit();
    //     $_SESSION["statusMessage"] = "Successfully submitted";
    // }
    
// }
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