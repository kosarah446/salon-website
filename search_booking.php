
<?php

  require "config/config.php"; 

  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
  }

  $mysqli->set_charset('utf8');

  $sql_categories = "SELECT * FROM categories;";
  $results_categories = $mysqli->query($sql_categories);
  if ( $results_categories == false ) {
    echo $mysqli->error;
    exit();
  }

  $sql_services = "SELECT * FROM services;";
  $results_services = $mysqli->query($sql_services);
  if ( $results_services == false ) {
    echo $mysqli->error;
    exit();
  }

  $sql_locations = "SELECT * FROM locations;";
  $results_locations = $mysqli->query($sql_locations);
  if ( $results_locations == false ) {
    echo $mysqli->error;
    exit();
  }
// Close DB Connection.
$mysqli->close();


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
  <title>Locate a Booking| Jean Clement</title>
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

<form id="msform" form action="search_results.php" method="GET">
  <!-- progressbar -->
  <ul id="progressbar" class = "locatepb" >
    <li class="active">Search</li>
    <li>Booking</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Locate a Booking</h2>
    <h3 class="fs-subtitle">All fields are required</h3>
    <input id = "fname" type="text" name="fname" placeholder="First Name" />
    <input id ="lname" type="text" name="lname" placeholder="Last Name" />
    <input id = "email" type="text" name="email" placeholder="Email" />


     <div class="form-group row">
        <label for="location-id" class="col-sm-3 col-form-label text-sm-right labels">Location:</label>
        <div class="col-sm-9">
          <select name="location_id" id="location-id" class="form-control">
            <option value="" selected disabled>-- Select One --</option>

            <!-- PHP Output Here -->

            <?php

            while($row = $results_locations->fetch_assoc())
            {
              echo "<option value='".$row["id"]."'>" . $row["location"]. "</option>";
            }

            ?> 

          </select>
        </div>
      </div> <!-- .form-group -->


        <div class="form-group row">
        <label for="service-id" class="col-sm-3 col-form-label text-sm-right labels">Service:</label>
        <div class="col-sm-9">
          <select name="service_id" id="service-id" class="form-control">
            <option value="" selected disabled>-- Select One --</option>

            <!-- PHP Output Here -->
           <?php

            while($row = $results_services->fetch_assoc())
            {
              echo "<option value='".$row["id"]."'>" . $row["service"]. "</option>";
            }

            ?>


          </select>
        </div>
      </div> <!-- .form-group -->

    
    <input type="submit" name="next" class="next action-button" value="Search" />
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
  
  current_fs = $(this).parent();
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
