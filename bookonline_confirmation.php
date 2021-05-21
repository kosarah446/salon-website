<?php

// Required fields 
if ( !isset($_POST['fname']) || 
  empty($_POST['fname']) || 
  !isset($_POST['lname']) || 
  empty($_POST['lname']) || 
  !isset($_POST['email']) || 
  empty($_POST['email']) || 
  !isset($_POST['location_id']) || 
  empty($_POST['location_id']) || 
  !isset($_POST['category_id']) || 
  empty($_POST['category_id']) || 
  !isset($_POST['service_id']) || 
  empty($_POST['service_id']) ) {

  $error = "Please fill out all required fields.";

} else {

  require "config/config.php";

  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
  }

$mysqli->set_charset('utf8');

// DB Connection.


// Optional fields
 if ( isset($_POST['comment']) && !empty($_POST['comment']) ) {
      $comment =  $_POST['comment'] ;
    } else {
      $comment = null;
    }

$sql_prepared = "INSERT INTO appointments (fname, lname, email, location_id, category_id, service_id, comment) VALUES (?, ?, ?, ?, ?, ?, ?);";

    $statement = $mysqli->prepare($sql_prepared);
    // First parameter is data types, the rest are variables that will fill in the ? placeholders
    $statement->bind_param("sssiiis", $_POST["fname"], $_POST["lname"], $_POST["email"], $_POST["location_id"], $_POST["category_id"], $_POST["service_id"], $_POST["comment"],);
    $executed = $statement->execute();
    // execute() will return false if there's an error
    if(!$executed) {
      echo $mysqli->error;
    }
    // affected_rows returns how many records were affected (updated/deleted/inserted)
    if( $statement->affected_rows == 1 ) {
      $isInserted = true;
    }
    $statement->close();

  // $mysqli->close();

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Overpass:100,400,700,800,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="hairsalon.css">
<!--   <script src="home.js"></script> -->
  <title>Book Online| Jean Clement</title>
  <script src="https://cdn.firebase.com/js/client/2.4.0/firebase.js"></script>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark">
<a id="navbar-title" href="hairsalonhome.html">JEAN CLEMENT<span class="sr-only">(current)</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 justify-content-end">
      <li class="nav-item ">
      <a class="nav-link und" href="salon.html">SALON</a>
      </li>
       <li class="nav-item ">
      <a class="nav-link und" id = "und-services" href="services.html">SERVICES</a>
      </li>
   <li class="nav-item">
      <a class="nav-link und" id = "und-gallery" href="gallery.html">GALLERY</a>
      </li>
          <li class="nav-item">
      <a class="nav-link und" id = "und-locations" href="locations.html">LOCATIONS</a>
    </li>
       <li class="nav-item">
      <a class="nav-link und active" id = "und-bookonline" href="bookonline.php">BOOK ONLINE<span class="sr-only">(current)</span></a>
    </li>
    </ul>
  </div>
</nav>

<form id="msform">

  <!-- progressbar -->
  <ul id="progressbar">
    <li>Personal Details</li>
    <li>Request an appointment</li>
    <li class="active">Confirmation</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>

    <h2 class="fs-title">Confirmation</h2>
      <div class="col-12 text-danger">
      </div>
<div class="row mt-3">
      <div class="col-4 text-right labels">First name:</div>
      <div class="col-8">
         <?php

        if(isset($_POST["fname"]) && !empty($_POST["fname"])){
          echo $_POST["fname"];
        }
        else {
          echo "<div class = 'text-danger'>Not provided</div>";
        }

        ?>
      </div>
    </div> <!-- .row -->

    <div class="row mt-3">
      <div class="col-4 text-right labels">Last name:</div>
      <div class="col-8">
        <!-- PHP Output Here -->
        <?php

        if(isset($_POST["lname"]) && !empty($_POST["lname"])){
          echo $_POST["lname"];
        }
        else {
          echo "<div class = 'text-danger'>Not provided</div>";
        }

        ?>
      </div>
    </div> <!-- .row -->

    <div class="row mt-3">
      <div class="col-4 text-right labels">Email:</div>
      <div class="col-8">
        <!-- PHP Output Here -->
        <?php

        if(isset($_POST["email"]) && !empty($_POST["email"])){
          echo $_POST["email"];
        }
        else {
          echo "<div class = 'text-danger'>Not provided</div>";
        }

        ?>
      </div>
    </div> <!-- .row -->

    <div class="row mt-3">
      <div class="col-4 text-right labels">Location:</div>
      <div class="col-8">
                <!-- PHP Output Here -->
      <?php

        if(isset($_POST["location_id"]) && !empty($_POST["location_id"])){

          $sql_locations = "SELECT * FROM locations WHERE locations.id = " . $_POST["location_id"];
          $results_locations = $mysqli->query($sql_locations);
          if ( $results_locations == false ) {
            echo $mysqli->error;
            exit();
          }


          echo $results_locations->fetch_assoc()['location'];
        }
        else {
          echo "<div class = 'text-danger'>Not provided</div>";
        }

        ?>
      </div>
    </div> <!-- .row -->

    <div class="row mt-3">
      <div class="col-4 text-right labels">Category:</div>
      <div class="col-8">
        <!-- PHP Output Here -->

            <?php

        if(isset($_POST["category_id"]) && !empty($_POST["category_id"])){

            $sql_categories = "SELECT * FROM categories WHERE categories.id = " . $_POST["category_id"];;
            $results_categories = $mysqli->query($sql_categories);
            if ( $results_categories == false ) {
              echo $mysqli->error;
              exit();
            }


          echo $results_categories->fetch_assoc()['category'];
        }
        else {
          echo "<div class = 'text-danger'>Not provided</div>";
        }

        ?>

  

      </div>
    </div> <!-- .row -->


    <div class="row mt-3">
      <div class="col-4 text-right labels">Service:</div>
      <div class="col-8">
        <!-- PHP Output Here -->
                    <?php

        if(isset($_POST["service_id"]) && !empty($_POST["service_id"])){

            $sql_services = "SELECT * FROM services WHERE services.id = " . $_POST["service_id"];;
            $results_services = $mysqli->query($sql_services);
            if ( $results_services == false ) {
              echo $mysqli->error;
              exit();
            }

          echo $results_services->fetch_assoc()['service'];
        }
        else {
          echo "<div class = 'text-danger'>Not provided</div>";
        }

        ?>

      </div>
    </div> <!-- .row -->

    <div class="row mt-3">
      <div class="col-4 text-right labels">Comments:</div>
      <div class="col-8">
        <!-- PHP Output Here -->
        <?php

        if(isset($_POST["comment"]) && !empty($_POST["comment"])){
          echo $_POST["comment"];
        }
        else {
          echo "<div class = 'text-danger'>Not provided</div>";
        }

        ?>
      </div>
    </div> <!-- .row -->
    <br>
    <?php if ( isset($error) && !empty($error) ) : ?>

    <div class="text-danger">
      <?php echo $error; ?>
    </div>

  <?php else : ?>

    <h3 class="fs-subtitle">
    We have received your request. We will contact you via email in 2 business days.</h3>

  <?php endif; ?>

  </fieldset>
</form> 

  <div id="bookonline-div">
      <div class="services-banner">
        <img src="images/homebanner.JPG" class="d-block w-100" alt="homebanner">
      </div>
  </div>


<div class="footer-bookonline">Copyright © Jean Clement 2019</div>


<script>
  
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
  if(animating) return false;
  animating = true;
  
  current_fs = $(this).parent();``
  next_fs = $(this).parent().next();
  
  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
  
  //show the next fieldset
  next_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
      next_fs.css({'left': left, 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});

$(".previous").click(function(){
  if(animating) return false;
  animating = true;
  
  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();
  
  //de-activate current step on progressbar
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
  
  //show the previous fieldset
  previous_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale previous_fs from 80% to 100%
      scale = 0.8 + (1 - now) * 0.2;
      //2. take current_fs to the right(50%) - from 0%
      left = ((1-now) * 50)+"%";
      //3. increase opacity of previous_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({'left': left});
      previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});

$(".submit").click(function(){
  return false;
})


</script>
</body>
</html>
