<?php 

	session_start();

    $error = "";  

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";  
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        
        header("Location: loggedinpage.php");
        
    }

       if (array_key_exists("submit", $_POST)) {
        
        include("connection.php");
      
      	/*if (!$_POST["name"]) {
          $error .= "Name is required<br>";
        } else {
  
          if (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])) {
            $error .= "Only letters and white space allowed"; 
          }
        }*/
      
        if (!$_POST['email']) {
            
            $error .= "An email address is required<br>";
            
        }
      
      	/*if (!$_POST['mobile']) {
          
          	$error .= "An mobile no. is required<br>";
          
        } else {
          
          	if(!preg_match('/^[0-9]{10}+$/', $_POST['mobile'])) {
              	
              	$error .= "A valid mobile no. is required<br>";
              
            }             
          
        }*/
        
        if (!$_POST['password']) {
            
            $error .= "A password is required<br>";
            
        }
      
      	/*if ($_POST['cpassword'] != $_POST['password']) {
          
          	$error .= "Password is not same<br>";         
          
        }*/
        
        if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            
        } else {
            
            if ($_POST['signUp'] == '1') {
            
                $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) > 0) {

                    $error = "That email address is taken.";

                } else {

                    $query = "INSERT INTO `users` (`email`, `name`, `mobile`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['name'])."','".mysqli_real_escape_string($link, $_POST['mobile'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

                    if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";

                    } else {

                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                        
                        $id = mysqli_insert_id($link);
                        
                        mysqli_query($link, $query);

                        $_SESSION['id'] = $id;

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", $id, time() + 60*60*24);

                        } 
                            
                        header("Location: loggedinpage.php");

                    }

                } 
                
            } else {
                    
                    $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                    $result = mysqli_query($link, $query);
                
                    $row = mysqli_fetch_array($result);
                
                    if (isset($row)) {
                        
                        $hashedPassword = md5(md5($row['id']).$_POST['password']);
                        
                        if ($hashedPassword == $row['password']) {
                            
                            $_SESSION['id'] = $row['id'];
                            
                            if ($_POST['stayLoggedIn'] == '1') {

                                setcookie("id", $row['id'], time() + 60*60*24);

                            } 

                            header("Location: loggedinpage.php");
                                
                        } else {
                            
                            $error = "That email/password combination could not be found.";
                            
                        }
                        
                    } else {
                        
                        $error = "That email/password combination could not be found.";
                        
                    }
                    
                }
            
        }
        
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">

  <title>BShop</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/component.css">
  
    <link rel="stylesheet" href="css/owl.theme.css">
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/vegas.min.css">
  <link rel="stylesheet" href="css/style.css">
  
  

  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300' rel='stylesheet' type='text/css'>
  <link href='css/b.css' rel='stylesheet' type='text/css'>
  
  <style>
  
    #img{
      
      height: 225px;
      width: 220px;
      
    }
    
    #homePageContainer {
              
            margin-top: 150px;
          
      }
          
          #containerLoggedInPage {
              
              margin-top: 60px;
              
          }
        
          #logInForm {
              
              display:none;
              
          }
          
          .toggleForms {
              
              font-weight: bold;
              
          }
    
  </style>
  
</head>
<body id="top" data-spy="scroll" data-offset="50" data-target=".navbar-collapse">

<div class="preloader">
     <div class="sk-spinner sk-spinner-pulse"></div>
</div>



  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">

      <div class="navbar-header">
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon icon-bar"></span>
          <span class="icon icon-bar"></span>
          <span class="icon icon-bar"></span>
        </button>
        <a href="#top" class="navbar-brand smoothScroll">BShop</a>
      </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#top" class="smoothScroll"><span>Home</span></a></li>
            <li><a href="#about" class="smoothScroll"><span>AboutUs</span></a></li>
            <li><a href="#gallery" class="smoothScroll"><span>Gallery</span></a></li>
            <li><a href="#contact" class="smoothScroll"><span>Contact</span></a></li>
            <li><a href="#0" class="smoothscrooll" data-toggle="modal" data-target="#Modal"><span>SignIn/SignUp</span></a></li>
          </ul>
       </div>

    </div>
  </div>
  

<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="error"><?php if ($error!="") {
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?>
        </div>
        <form method="post" id = "signUpForm">
    
        <p>Interested? Sign up now.</p>

        <fieldset class="form-group">

            <input class="form-control" type="text" name="name" placeholder="Full Name">

        </fieldset>

        <fieldset class="form-group">

            <input class="form-control" type="email" name="email" placeholder="Your Email">

        </fieldset>

        <fieldset class="form-group">

            <input class="form-control" type="text" name="mobile" placeholder="Mobile/Phone No.">

        </fieldset>

        <fieldset class="form-group">

            <input class="form-control" type="password" name="password" placeholder="Password">

        </fieldset>

        <fieldset class="form-group">

            <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password">

        </fieldset>

        <div class="checkbox">

            <label>

            <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in

            </label>

        </div>

        <fieldset class="form-group">

            <input type="hidden" name="signUp" value="1">

            <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">

        </fieldset>

        <p><a class="toggleForms">Log in</a></p>

    </form>

    <form method="post" id = "logInForm">

        <p>Log in using your username and password.</p>

        <fieldset class="form-group">

            <input class="form-control" type="email" name="email" placeholder="Your Email">

        </fieldset>

        <fieldset class="form-group">

            <input class="form-control"type="password" name="password" placeholder="Password">

        </fieldset>

        <div class="checkbox">

            <label>

                <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in

            </label>

        </div>

            <input type="hidden" name="signUp" value="0">

        <fieldset class="form-group">

            <input class="btn btn-success" type="submit" name="submit" value="Log In!">

        </fieldset>

        <p><a class="toggleForms">Sign up</a></p>

    </form>

          </div>

    <?php include("signfooter.php"); ?>

      </div>
    </div>
  </div>


<section id="home">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">

      <div class="col-md-offset-1 col-md-10 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
        <h1 class="wow fadeInUp" data-wow-delay="0.6s">Let's Get Your Hair Done</h1>
        <p class="wow fadeInUp" data-wow-delay="0.9s">Join Us<a rel="nofollow" href="#"> at BShop</a>. Thank you.</p>
        <a href="#about" class="smoothScroll btn btn-success btn-lg wow fadeInUp" data-wow-delay="1.2s">Learn more</a>
      </div>

    </div>
  </div>
</section>

<section id="about">
  <div class="container">
    <div class="row">

      <div class="col-md-9 col-sm-8 wow fadeInUp" data-wow-delay="0.2s">
        <div class="about-thumb">
          <h1>BShop</h1>
          <p>At BShop, we’re passionate about making our clients feel good and look great. Our goal: ensure every client leaves with a hairstyle that complements their unique features and personal style.Our skilled, creative staff draws inspiration from nature, art and fashion to advance their cutting and coloring techniques. Innate curiosity and ongoing education keep enthusiasm and skills high. The results keep clients coming back for more. We’re just as passionate about running an eco- friendly salon. Environmentally conscious choices in our interior design, daily practices and use of organic products from Aveda all speak to our mission to be a sustainable and environmentally responsible business. Our salons are located in LPU, INDIA. We welcome anyone who’s ready for a comfortable and consistently awesome salon experience.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-4 wow fadeInUp about-img" data-wow-delay="0.6s">
        <img src="images/about-img.jpg" class="img-responsive img-circle" alt="About">
      </div>

      <div class="clearfix"></div>

      <div class="col-md-12 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
        <div class="section-title text-center">
          <h1>SALON</h1>
          <h3>We provide salon for mens, women and kids.</h3>
        </div>
      </div>

      <div id="team-carousel" class="owl-carousel">

      <div class="item col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
        <a href="women.php">
        <div class="team-thumb">
          <div class="image-holder">
            <img src="images/team-img1.jpg" class="img-responsive img-circle" alt="Men">
          </div>
          <h2 class="heading">Women</h2>
          <p class="description">Click Here...</p>
        </div>
        </a>
      </div>

      <div class="item col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.6s">
        <a href="men.php">
        <div class="team-thumb">
          <div class="image-holder">
            <img src="images/team-img2.jpg" class="img-responsive img-circle" alt="Women">
          </div>
          <h2 class="heading">Men</h2>
          <p class="description">Click Here...</p>
        </div>
        </a>
      </div>

      <div class="item col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.8s">
        <a href="kid.php">
        <div class="team-thumb">
          <div class="image-holder">
            <img src="images/team-img3.jpg" id="img" class="img-responsive img-circle" alt="Kids">
          </div>
          <h2 class="heading">Kids</h2>
          <p class="description">Click Here...</p>
        
          </div>
        </a>	
    </div>
  </div>
</section>

<section id="contact">
   <div class="container">
    <div class="row">

       <div class="col-md-offset-1 col-md-10 col-sm-12">

        <div class="col-lg-offset-1 col-lg-10 section-title wow fadeInUp" data-wow-delay="0.4s">
          <h1>Send a message</h1>
        </div>

        <form action="#" method="post" class="wow fadeInUp" data-wow-delay="0.8s">
          <div class="col-md-6 col-sm-6">
            <input name="mname" type="text" class="form-control" id="name" placeholder="Name">
          </div>
          <div class="col-md-6 col-sm-6">
            <input name="memail" type="email" class="form-control" id="email" placeholder="Email">
          </div>
          <div class="col-md-12 col-sm-12">
            <textarea name="mmessage" rows="6" class="form-control" id="message" placeholder="Message"></textarea>
          </div>
          <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
            <input type="submit" class="form-control" value="SEND MESSAGE">
          </div>
        </form>

      </div>

    </div>
  </div>
</section>


<!-- Footer section -->

<footer>
  <div class="container">
    
    <div class="row">

      <div class="col-md-12 col-sm-12">
            
                <ul class="social-icon"> 
                    <li><a href="#" class="fa fa-facebook wow fadeInUp" data-wow-delay="0.2s"></a></li>
                    <li><a href="#" class="fa fa-twitter wow fadeInUp" data-wow-delay="0.4s"></a></li>
                    <li><a href="#" class="fa fa-linkedin wow fadeInUp" data-wow-delay="0.6s"></a></li>
                    <li><a href="#" class="fa fa-instagram wow fadeInUp" data-wow-delay="0.8s"></a></li>
                    <li><a href="#" class="fa fa-google-plus wow fadeInUp" data-wow-delay="1.0s"></a></li>
                </ul>                
      </div>
      
    </div>
        
  </div>
</footer>

<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/vegas.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/toucheffects.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>