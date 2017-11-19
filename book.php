<?php 

	$error = "";  
       if (array_key_exists("submit", $_POST)) {
        
        include("connection.php");
        $query = "INSERT INTO `book` (`email`, `name`, `gender`, `date`, `time`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['name'])."','".mysqli_real_escape_string($link, $_POST['gender'])."', '".mysqli_real_escape_string($link, $_POST['date'])."', '".mysqli_real_escape_string($link, $_POST['time'])."')";
        if (!mysqli_query($link, $query)) {

            $error = "<p>Server is busy - please try again later.</p>";

        } else {

        	$emailTo = $_POST['email'];
            $subject = "Appointment for barber.";
            $body = "Sir, your appointment for BShop is on ".$_POST['date'].". Timing is ".$_POST['time'];
            $header = "shhbhmnagar@outlook.com";
          	$body1 = "Customer: Name-> ".$_POST['name']."   Date-> ".$_POST['date']."   Timing-> ".$_POST['time'];
            $var = mail($emailTo, $subject, $body, $header);
          	$var1 = mail($header, $subject, $body1, $emailTo);
            if($var== true){
                echo '<center><div class="alert alert-success" role="alert" style="width:300px;margin-top:100px;">Booking Successful...</div></center>';
            } 
            else
            {
                echo '<center><div class="alert alert-danger" role="alert" style="width:300px;margin-top:100px;">Booking Unsuccessful ...</div></center>';
            }
           
        	
        }
       }

?>
<!doctype html>
<html lang="en">
  <head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>Booking</title>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    	
      <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
  	<link rel="stylesheet" href="css/component.css">
	
    <link rel="stylesheet" href="css/owl.theme.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/vegas.min.css">
	<link rel="stylesheet" href="css/style.css">

	  <script>

	  	var dateToday = new Date(); 
		$(function() {
		    $( "#datepicker" ).datepicker({
		        numberOfMonths: 1,
		        showButtonPanel: true,
		        minDate: dateToday
		    });
		});

	  </script>

	</head>
  	<body>
      

    <!-- Preloader section -->

    <div class="preloader">
         <div class="sk-spinner sk-spinner-pulse"></div>
    </div>


    <!-- Navigation section  -->

      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">

          <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon icon-bar"></span>
              <span class="icon icon-bar"></span>
              <span class="icon icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand smoothScroll">BShop</a>
          </div>
            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php" class="smoothScroll"><span>Home</span></a></li>

              </ul>
           </div>

        </div>
      </div>
  	<div class="container" style="width:400px;margin-top:100px;">
	    <form method="post">

		 	<fieldset class="form-group">

	            <input class="form-control" type="text" name="name" placeholder="Enter Full Name..." required="true">

	        </fieldset>

	        <fieldset class="form-group">

	            <input class="form-control" type="email" name="email" placeholder="Enter Your Email..." required="true">

	        </fieldset>

	        <fieldset class="form-group">

	        	<div class="row"><div class="col-lg-4"><input type="radio" value="male" name="gender"><span>  Male</span></div></div>
	            
	            <div class="row"><div class="col-lg-4"><input type="radio" value="female" name="gender"><span>  Female</span></div></div>

	            <div class="row"><div class="col-lg-4"><input type="radio" value="kids" name="gender"><span>  Kids</span></div></div>

	        </fieldset>



	        <fieldset class="form-group">

            <input class="form-control" id="datepicker" type="text" name="date" placeholder="mm/dd/yyyy">

        	</fieldset>
        	<fieldset class="form-group">
        		
        		<SELECT class="form-control" name="time">
        		<option disabled="true" hidden="true" selected="true">TIME</option>
        		<OPTION value="10:30 AM - 11:00 AM">10:30 AM - 11:00 AM</OPTION>
        		<OPTION value="11:00 AM - 11:30 AM">11:00 AM - 11:30 AM</OPTION>
        		<OPTION value="11:30 AM - 12:00 PM" >11:30 AM - 12:00 PM</OPTION>
        		<OPTION value="12:00 AM - 12:30 PM">12:00 AM - 12:30 PM</OPTION>
        		<OPTION value="01:30 PM - 02:00 PM">01:30 PM - 02:00 PM</OPTION>
        		<OPTION value="02:00 PM - 02:30 PM">02:00 PM - 02:30 PM</OPTION>
        		<OPTION value="02:30 PM - 03:00 PM">02:30 PM - 03:00 PM</OPTION>
        		<OPTION value="03:00 PM - 03:30 PM">03:00 PM - 03:30 PM</OPTION>

        	</SELECT>

        	</fieldset>        	

	        <fieldset class="form-group">

            <input class="btn btn-success" type="submit" name="submit" value="Book">

        	</fieldset>

        	

		</form>
	</div>
      <!-- Footer section -->

      <footer>
          <div class="container ">

              <div class="row" style="height:100px;">

                  <div class="col-md-12 col-sm-12">

                      <ul class="social-icon"> 
                          <li><a href="#" class="fa fa-facebook wow fadeInUp" data-wow-delay="0.2s"></a></li>
                          <li><a href="#" class="fa fa-twitter wow fadeInUp" data-wow-delay="0.4s"></a></li>
                          <li><a href="#" class="fa fa-linkedin wow fadeInUp" data-wow-delay="0.6s"></a></li>
                          <li><a href="#" class="fa fa-instagram wow fadeInUp" data-wow-delay="0.8s"></a></li>
                          <li><a href="#" class="fa fa-google-plus wow fadeInUp" data-wow-delay="1.0s"></a></li>
                      </ul>

                      <p class="wow fadeInUp"  data-wow-delay="1s" >Copyright &copy; 2017 | BShop
                     </p>

                  </div>

              </div>

          </div>
      </footer>
    <script src="js/modernizr.custom.js"></script>
    <script src="js/toucheffects.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>