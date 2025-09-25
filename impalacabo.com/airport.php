<?php
require_once __DIR__ . '/config.php';
$formSubmission = false;
$errors = [];
$lines = [];

if (!empty($_POST)) {
  require_once __DIR__ . '/vendor/autoload.php';

  $formSubmission = true;
  if (isset($_POST['op'])
    && ($_POST['op'] === "Yes" || $_POST['op'] === "No")) {
    $lines[] = "Attending to a wedding: " . $_POST['op'];
  } else {
    $errors[] = "Invalid op field.";
  }

  if (!empty($_POST['name']) && sizeof($_POST['name']) < 100) {
    $lines[] = "Full Name: " . strip_tags($_POST['name']);
  } else {
    $errors[] = "Invalid name field.";
  }

  if (!empty($_POST['email'])
    && sizeof($_POST['email']) < 100
    && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $lines[] = "Email: " . strip_tags($_POST['email']);
  } else {
    $errors[] = "Invalid email.";
  }

  if (!empty($_POST['phone'])
    && sizeof($_POST['phone']) < 20) {
    $lines[] = "Phone: " . strip_tags($_POST['phone']);
  } else {
    $errors[] = "Invalid phone.";
  }

  if (!empty($_POST['stay'])
    && sizeof($_POST['stay']) < 1000) {
    $lines[] = "Stay: " . strip_tags($_POST['stay']);
  } else {
    $errors[] = "Invalid stay.";
  }

  if (!empty($_POST['arival_date'])
    && sizeof($_POST['arival_date']) < 10) {
    $lines[] = "Arival date: " . strip_tags($_POST['arival_date']);
  } else {
    $errors[] = "Invalid arrival date.";
  }

  if (!empty($_POST['ariv_time'])
    && sizeof($_POST['ariv_time']) < 10) {
    $lines[] = "Arival time: " . strip_tags($_POST['ariv_time']);
  } else {
    $errors[] = "Invalid arival time.";
  }

  if (!empty($_POST['ariv_info'])
    && sizeof($_POST['ariv_info']) < 1000) {
    $lines[] = "Arival time: " . strip_tags($_POST['ariv_info']);
  } else {
    $errors[] = "Invalid arival info.";
  }

  if (!empty($_POST['dep_day'])) { // optional
    if (sizeof($_POST['dep_day']) < 50) {
      $lines[] = "Departure day: " . strip_tags($_POST['dep_day']);
    } else {
      $errors[] = "Invalid departure day.";
    } 
  }

  if (!empty($_POST['dep_time'])) { // optional
    if (sizeof($_POST['dep_time']) < 50) {
      $lines[] = "Departure time: " . strip_tags($_POST['dep_time']);
    } else {
      $errors[] = "Invalid departure time.";
    } 
  }

  if (!empty($_POST['dep_info'])) { // optional
    if (sizeof($_POST['dep_info']) < 1000) {
      $lines[] = "Departure flight information: "
        . strip_tags($_POST['dep_info']);
    } else {
      $errors[] = "Invalid departure flight information.";
    } 
  }

  if (!empty($_POST['dep_trip'])
    && sizeof($_POST['dep_trip']) < 20) {
    $lines[] = "Type of service: " . strip_tags($_POST['dep_trip']);
  } else {
    $errors[] = "Invalid type of service.";
  }

  if (!empty($_POST['adult'])
    && sizeof($_POST['adult']) < 20) {
    $lines[] = "Adults: " . strip_tags($_POST['adult']);
  } else {
    $errors[] = "Invalid adult number.";
  }

  if (!empty($_POST['child'])) { // optional
    if (sizeof($_POST['child']) < 20) {
      $lines[] = "Adults: " . strip_tags($_POST['child']);
    } else {
      $errors[] = "Invalid children number.";
    } 
  }

  if (!empty($_POST['count'])
    && sizeof($_POST['count']) < 100) {
    $lines[] = "Country: " . strip_tags($_POST['count']);
  } else {
    $errors[] = "Invalid country.";
  }

  if (!empty($_POST['comment'])
    && sizeof($_POST['comment']) < 2000) {
    $lines[] = "Comment: " . strip_tags($_POST['comment']);
  } else {
    $errors[] = "Invalid comment.";
  }

  $recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecretKey);
  if (empty($_POST['g-recaptcha-response'])
    || sizeof($_POST['g-recaptcha-response']) > 500
    || !$recaptcha
    ->setExpectedHostname($_SERVER['SERVER_NAME'])
    ->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'])
    ->isSuccess()) {
    $errors[] = "ReCaptcha validation error.";
  }

  if (empty($errors)) {
    if (!mail($mailTo,
      'impalacabo.com quote request',
      implode("\n", $lines))) {
      $errors[] = "An error was found while sending the contact form. Please try again or contact by phone or email.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-100955752-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-100955752-1');
  </script>
  <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '418884812810788');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=418884812810788&ev=PageView&noscript=1"/>
    </noscript>
  <!-- End Facebook Pixel Code -->
  <title>Impalacabo - Cabo Transportations Service</title>
  <meta charset="UTF-8">
  <meta name="description"
    content="Impala Cabo. Passionate and savvy travel specialists since 2004. We design travel solutions inspired by your travel needs. Experience the difference of our exclusive access, powerful industry recognition and obsession with customer service.">
  <meta name="keywords"
    content="Cabo,Los Cabos,Los Cabos Airport Shuttle,Shuttle,Taxi San Jose del Cabo,Taxi in Cabo,Los Cabos Aiport Transportation,Weddings in Los Cabos,Wedding Cabo,Trips in Los Cabos,Visit Los Cabos,Travel to Cabo,Private transportation,Los Cabos Group Transportation,Group transportation in Cabo,Wedding Transportation in Los Cabos,Deluxe Transportation in Los Cabos,Activities in Los Cabos,Luxury Transportation in Cabo,SJD Aiport transportation to,Airport Transportation to">
  <meta name="author" content="John Doe">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="msvalidate.01" content="7D1FFF2033486E3BB27911FF4E131225" />

  <link rel="apple-touch-icon" sizes="180x180" href="fav/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="fav/favicon-16x16.png">
  <link rel="manifest" href="fav/site.webmanifest">
  <link rel="mask-icon" href="fav/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">


  <link rel="stylesheet" href="include\w3.css">
  <link rel="stylesheet" href="include\own.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
  <link href="include/style.css" type="text/css" rel="stylesheet" media="all" />
</head>

<body>
  <div id="header" class="w3-top" style="background-Color: rgba(33,29,21,0.0)">




    <div class="own-center">
      <!-- top nav -->

      <div class="w3-display-container own-hide-1200">

        <a href="index.html"><img src="img\Logo.png" style="max-width: 12%; padding-top: 20px;"></a>



        <div class="footer-title w3-display-bottomright" style="padding: 0;">
          <a href="https://www.facebook.com/ImpalaGroundServices" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
          <a href="https://x.com/impala_cabo" target="_blank" class="social-icon"><i class="fab fa-x"></i></a>
          <a href="https://www.instagram.com/impalacabo/" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>


        </div>
      </div>





      <div class="w3-row">

        <div class="nav-container own-hide-1200" style="padding: 0.5em 0 0.3em 0;">

          <a href="index.html" class="nav-item">Home</a>
          <a href="about.html" class="nav-item">About Us</a>
          <a href="group.html" class="nav-item">Group Transportation</a>
          <a href="wedding.html" class="nav-item">Wedding Transportation</a>
          <a href="airport.php" class="nav-item">Airport Transportation</a>
          <a href="contact.html" class="nav-item">Contact Us</a>
        </div>
      </div>
    </div>

    <div id="header2" style="position: fixed; top: 0; right: 0; width:100%;">
      <div class="w3-row" style="width: 100%;">
        <img id="logo" src="img\Logo.png" class="own-hide-nav" style="width:10.5vmin; position: absolute; top:5vmin; left: 5vmin">
        <a class="own-hide-nav w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i style="padding: 0.85em; font-size: 6.5vmin;" class="fa fa-bars nav-item"></i></a>
      </div>
      <div class="w3-row">
        <!-- nav mobile -->
        <div id="navDemo" class="w3-bar-block w3-hide w3-animate-top own-hide-nav" style="width: 100%; text-align:center;">
          <a href="index.html" class="nav-item own-border-bt" onclick="myFunction()">Home</a><br>
          <a href="about.html" class="nav-item own-border-bt" onclick="myFunction()">About Us</a><br>
          <a href="group.html" class="nav-item own-border-bt" onclick="myFunction()">Group Transportation</a><br>
          <a href="wedding.html" class="nav-item own-border-bt" onclick="myFunction()">Wedding Transportation</a><br>
          <a href="airport.html" class="nav-item own-border-bt" onclick="myFunction()">Airport Transportation</a><br>
          <a href="contact.html" class="nav-item own-border-bt" onclick="myFunction()">Contact Us</a><br>
        </div>
      </div>
    </div>

  </div>

  <div class="own-color-dark con-paraRest" style="background-image:linear-gradient(rgba(37, 24, 5, 0.7), rgba(162, 146, 88, 0.19)), url('img/contentH.jpg')"></div>


  <div class="own-center">
    <div class="w3-display-container">
      <div class="text-reservationTitle">Airport Transportation Services</div>
    </div>
  </div>

  <div class="own-color-dark">
    <div class="own-center">
      <div class="w3-row">
        <div class="w3-col m6">
          <div class="own-text" style="padding-right: 2em;">We offer shuttles, VIP and private transportation! Including longer distances to towns like Todos Santos. Our drivers speak both Spanish and English, which we believe is an excellent
            advantage to help you minimise misunderstandings. Our vehicles are available for complete or hourly rates for all of your transportation needs, such as shopping or nightlife rides!
          </div>
        </div>
        <div class="w3-col m6"><img src="img\airport.jpg" style="width: 100%; padding: 1.4em 0"></div>
      </div>
    </div>
  </div>


  <div class="container mb-4">
    <div class="row">
      <div class="col-lg-12 mt-5">
        <h2 class="text-yellow">Get a Quote</h2>
      </div>
      <div class="col-lg-12 mt-3">
        <p><a href="https://www.impalacabo.net" class="custom-text">To Fill in your wedding guest reservation, click here</a></p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <form method="post" id="qut_form" action="#submission-result">
          <div class="form-group">
          <div id="select_option">
              <div class="row">
                  <div class="col-lg-12">
                      <label class="custom-text-main">Are you attending to a wedding? <span class="text-danger ml-1">*</span></label>
                  </div>
              </div>
            <input type="radio" id="test1" name="op" class="no" value="No" />
            <label for="test1" class="custom-text-main">No</label>
            <input type="radio" id="test2" name="op" class="yes" value="Yes" />
            <label for="test2" class="custom-text-main">Yes</label>
          </div>
        </div>
        <div class="form-group">
          <label class="custom-text-main">Full Name <span class="text-danger ml-1">*</span></label>
          <input type="text" name="name" class="form-control custom-text-main full_name" />
        </div>
        <div class="form-group">
          <label class="custom-text-main">Email Address <span class="text-danger ml-1">*</span></label>
          <input type="text" name="email" class="form-control custom-text-main userEmail" />
        </div>
        <div class="form-group">
          <label class="custom-text-main">Phone Number</label>
          <input type="text" name="phone" class="form-control custom-text-main phone_number" />
        </div>
        <div class="form-group">
          <label class="custom-text-main">Where are you staying</label>
          <input type="text" name="stay" class="form-control custom-text-main staying-address" />
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label class="custom-text-main">Arival Day: </label>
              <input type="text" id="adate" name="arival_date" class="form-control custom-text-main" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label class="custom-text-main">Arrival Time</label>
              <input type="time"  name="ariv_time" class="form-control custom-text-main a_time" />
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="custom-text-main">Arrival Flight Information <span style="color: var(--orange_red);">(AA, CO, AS, UN, FR & Number)</span> </label>
          <input type="text" name="ariv_info" class="form-control custom-text-main a_flight_time" />
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label class="custom-text-main">Departure Day:</label>
              <input type="text" id="dDate" name="dep_day" class="form-control custom-text-main d_day" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label class="custom-text-main">Departure Time:</label>
              <input type="time" name="dep_time" class="form-control custom-text-main d_time" />
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="custom-text-main">Departure Flight Information <span style="color: var(--orange_red);">(AA, CO, AS, UN, FR & Number)</span> </label>
          <input type="text" name="dep_info" class="form-control custom-text-main d_flight_info" />
        </div>
        <div class="row">
          <div class="col-lg-4">
            <p class="custom-text-main">Type of Service</p>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
                <select class="form-control custom-text" name="dep_trip">
                    <option value="-">Select Your Trip</option>
                    <option value="One Way Trip">One Way Trip</option>
                    <option value="Round Trip">Round Trip</option>
                </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label class="custom-text-main">Adults: </label>
              <input type="text" name="adult" class="form-control custom-text-main Adults" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label class="custom-text-main">Child</label>
              <input type="text" name="child" class="form-control custom-text-main child" />
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="custom-text-main">Your Country<span class="text-danger ml-1">*</span> </label>
          <select class="form-control country_name custom-text" name="count">
            <option value="0">Select your Country</option>
            <option value="USA">USA</option>
            <option value="CAN">CAN</option>
            <option vlaue="MEX">MEX</option>
            <option value="UK">UK</option>
            <option value="Australia">Australia</option>
          </select>
        </div>
        <div class="form-group">
          <label class="custom-text-main">Comment</label>
          <textarea class="form-control comment custom-text" name="comment" style="resize: none;"></textarea>
        </div>
        <div class="form-group">
          <div class="g-recaptcha captchablock"
              data-sitekey="<?= $recaptchaSiteKey ?>">
          </div>
        </div>
        <div class="form-group">
          <input type="submit" name="qutBTN" id="submitQT" class="btn btn-main sendData" value="Submit Quote" />
        </div>
        </form>
          </div>
        </div>
        <div id="submission-result"
            class="row">
          <div class="col-lg-12 custom-text-main">
          <?php
if ($formSubmission === true) {
  if (empty($errors)) {
    echo "Form submitted sucessfuly";
  } else {
    echo implode("<br>\n", $errors);
    echo "<br>\nPlease try again or contact us through email or phone";
  }
}
?>
          </div>
        </div>
      </div>


  <div class="main-paraB main-paraB-fix" style="background-image:linear-gradient(rgba(25, 20, 4, 0.7), rgba(43, 39, 24, 0)), url('img/contentG.jpg')"></div>


  <div class="own-center ">
    <div class="nav-container" style="padding: 1.25em 0 1.25em 0;">

      <div style="background-image: linear-gradient(rgba(78, 58, 40, 0.43), rgba(78, 58, 40, 0.43)),  url('img/miniC.jpg');" class="linkBox w3-card">
        <a href="group.html" class="linkBoxC">Group Transportation</a>
      </div>

      <div style="background-image: linear-gradient(rgba(78, 58, 40, 0.43), rgba(78, 58, 40, 0.43)),  url('img/miniA.jpg');" class="linkBox w3-card">
        <a href="wedding.html" class="linkBoxC">Wedding Transportation</a>
      </div>

      <div style="background-image:linear-gradient(rgba(78, 58, 40, 0.43), rgba(78, 58, 40, 0.43)),  url('img/miniB.jpg');" class="linkBox w3-card">
        <a href="airport.html" class="linkBoxC">Airport Transportation</a>
      </div>
    </div>
  </div>

  <div class="main-paraB" style="background-image:linear-gradient(rgba(25, 20, 4, 0.7), rgba(43, 39, 24, 0)), url('img/contentG.jpg')"></div>




  <div class="own-color-dark">






    <div class="own-center">
      <div class="nav-container" style="padding-bottom: 2em;">

        <div class="flex-footer">
          <div class="footer-title">About Us</div>
          <div class="footer-text">
            Impala Cabo Transportation Services<br>
            San Jose del Cabo Airport<br>
            23410 San Jose del Cabo<br>
            Baja California Sur, Mexico
          </div>
        </div>

        <div class="flex-footer">
          <div class="footer-title">Contact Us</div>
          <div class="footer-text">+52 624 173 1476<br>
            <a href="mailto:info@impalacabo.com" target="_top">info@impalacabo.com</a></div>
        </div>

        <!-- Begin Mailchimp Signup Form -->
        <link href="//cdn-images.mailchimp.com/embedcode/classic-071822.css" rel="stylesheet" type="text/css">

        <style type="text/css">
          #mc_embed_signup{background:#211d15; clear:left;}
          /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
            We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
        </style>

        <div class="flex-footer" id="mc_embed_signup">
          <form action="https://impalacabo.us14.list-manage.com/subscribe/post?u=953333a2fdd981a2a505101da&amp;id=4ab75d107f&amp;f_id=008fa0e0f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" style="margin: 0;" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
              <div class="footer-title">Subscribe to our Newsletter</div>
              
              <div class="mc-field-group" style="width: 100%">
                <label for="mce-EMAIL" style="font-size: .7em; margin-bottom: 0;">Email Address <span class="asterisk">*</span></label>
                <input type="email" class="own-form required" style="height: 30px; font-size: .7em;" value="" name="EMAIL" id="mce-EMAIL" placeholder="example@email.com" required>
                <!--<span id="mce-EMAIL-HELPERTEXT" class="helper_text">hOLA</span>-->
              </div>

              <div id="mce-responses" class="clear foot">
                <div class="response" id="mce-error-response" style="display:none"></div>
                <div class="response" id="mce-success-response" style="display:none"></div>
              </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->

              <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_953333a2fdd981a2a505101da_4ab75d107f" tabindex="-1" value=""></div>
              
              <div class="optionalParent">
                <div class="clear foot" style="display: block; width: 100%;">
                  <button type="submit" class="own-button" style="margin: .6em 0; width: 100%; font-size: .7em; padding: 3.5px 0;" value="Subscribe" name="subscribe" id="mc-embedded-subscribe">Subscribe!</button>
                </div>
              </div>
            </div>
          </form>
        </div>

        <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
        <!--End mc_embed_signup-->

      </div>
    </div>



    <div class="w3-center">
      <div style="padding: 1em 0px;">
        <div class="footer-title">Follow us
          <a href="https://www.facebook.com/ImpalaGroundServices" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
          <a href="https://x.com/impala_cabo" target="_blank" class="social-icon"><i class="fab fa-x"></i></a>
          <a href="https://www.instagram.com/impalacabo/" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <img src="img\IMPALA_SOLO.png" style="max-width:8%; padding-bottom:2em" alt="Impala Cabo Logo">
    </div>
  </div>


  <div class="own-color-light">
    <div class="legal-text w3-center" style="padding: 20px;"><a href="policy.html#policy">Terms and Conditions</a> / <a href="policy.html#privacy">Privacy Policy</a><br>© 2019 IMPALA CABO TRANSPORTATION SERVICES</div>
  </div>

  <div class="wp-button">
	<a href="https://wa.me/message/W25XUKYYNFL7D1" class="wp-bg">               
		<i class="fab fa-whatsapp"></i> 
    </a>
  </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
  <script src="js/valid.js"></script>

  <script>
    // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
      var x = document.getElementById("navDemo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else {
        x.className = x.className.replace(" w3-show", "");
      }

      document.getElementById("header").style.backgroundColor = 'rgba(33,29,21,' + 1.0 + ')';
      document.getElementById("header2").style.backgroundColor = 'rgba(33,29,21,' + 0.95 + ')'
      document.getElementById("header").style.boxShadow = '0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)';
      document.getElementById("header2").style.boxShadow = '0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)';

    }


    window.onscroll = function() {
      scrollFunction()
    };

    window.onresize = function() {
      scrollFunction()
    }
    /*
    function scrollFunction() {
       var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
      //var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      var scrolled = winScroll;
    scrolled = scrolled > 750 ? 750 : scrolled;
    scrolled = 1.0-Math.pow( (scrolled/750)-1.0,2);

    //console.log(scrolled);
        document.getElementById("header").style.backgroundColor = 'rgba(33,29,21,' + scrolled + ')';
        var x = document.getElementsByClassName("nav-item");
        for (i = 0; i < x.length; i++){
          x[i].style.fontSize = 12 +  (scrolled*2) + 'px';
          //  x[i].style.color = 'hsl(34,' + 141*scrolled + '%,' +  (100-(51*scrolled)) + '%)';
    }
    */
    function scrollFunction() {
      if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {

        //  if(window.innerWidth >= 1200){
        document.getElementById("header").style.backgroundColor = 'rgba(33,29,21,' + 1.0 + ')';
        document.getElementById("header2").style.backgroundColor = 'rgba(33,29,21,' + 0.95 + ')'
        document.getElementById("header").style.boxShadow = '0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)';
        document.getElementById("header2").style.boxShadow = '0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)';
        //  }
        //  document.getElementById("logo").style.display = 'none';
        //    document.getElementById("navDemo").style.backgroundColor = 'rgba(33,29,21,' + 0.85 + ')';

        //  document.getElementById("textcall").style.display = 'block';
        var x = document.getElementsByClassName("nav-item");
        for (i = 0; i < x.length; i++) {
          //x[i].style.fontSize = "14px"
          x[i].style.color = "rgb(255, 177, 36)";
        }
        var x = document.getElementsByClassName("social-icon");
        for (i = 0; i < x.length; i++) {
          //x[i].style.fontSize = "14px"
          x[i].style.backgroundColor = "rgb(255, 177, 36)";
        }

        var x = document.getElementsByClassName("text-reservation");
        for (i = 0; i < x.length; i++) {
          //x[i].style.fontSize = "10px"
          x[i].style.fontSize = "1em";
        }
      } else {
        document.getElementById("header").style.backgroundColor = 'rgba(33,29,21,' + 0.0 + ')';
        document.getElementById("header2").style.backgroundColor = 'rgba(33,29,21,' + 0.0 + ')'
        //document.getElementById("navDemo").style.backgroundColor = 'rgba(33,29,21,' + 0.85 + ')';
        document.getElementById("header").style.boxShadow = '0 0px 0px 0 rgba(0, 0, 0, 0.0), 0 0px 0px 0 rgba(0, 0, 0, 0.0)';
        document.getElementById("header2").style.boxShadow = '0 0px 0px 0 rgba(0, 0, 0, 0.0), 0 0px 0px 0 rgba(0, 0, 0, 0.0)';
        //  document.getElementById("logo").style.display = 'block';

        //document.getElementById("textcall").style.display = 'none';
        var x = document.getElementsByClassName("nav-item");
        for (i = 0; i < x.length; i++) {
          //x[i].style.fontSize = "10px"
          x[i].style.color = "#fff9e0";
        }

        var x = document.getElementsByClassName("social-icon");
        for (i = 0; i < x.length; i++) {
          //x[i].style.fontSize = "10px"
          x[i].style.backgroundColor = "#fff9e0";
        }

        var x = document.getElementsByClassName("text-reservation");
        for (i = 0; i < x.length; i++) {
          //x[i].style.fontSize = "10px"
          x[i].style.fontSize = "1.25em";
        }

      }


    }
  </script>

  <!--<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();

    (function() {

      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];

      s1.async = true;

      s1.src = 'https://embed.tawk.to/5894c92370e5360a6a1b7b19/default';

      s1.charset = 'UTF-8';

      s1.setAttribute('crossorigin', '*');

      s0.parentNode.insertBefore(s1, s0);

    })();
  </script>-->

  <script>
    var x, i, j, selElmnt, a, b, c;
    /* Look for any elements with the class "custom-select": */
    x = document.getElementsByClassName("custom-select");
    for (i = 0; i < x.length; i++) {
      selElmnt = x[i].getElementsByTagName("select")[0];
      /* For each element, create a new DIV that will act as the selected item: */
      a = document.createElement("DIV");
      a.setAttribute("class", "select-selected");
      a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
      x[i].appendChild(a);
      /* For each element, create a new DIV that will contain the option list: */
      b = document.createElement("DIV");
      b.setAttribute("class", "select-items select-hide");
      for (j = 1; j < selElmnt.length; j++) {
        /* For each option in the original select element,
        create a new DIV that will act as an option item: */
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function(e) {
          /* When an item is clicked, update the original select box,
          and the selected item: */
          var y, i, k, s, h;
          s = this.parentNode.parentNode.getElementsByTagName("select")[0];
          h = this.parentNode.previousSibling;
          for (i = 0; i < s.length; i++) {
            if (s.options[i].innerHTML == this.innerHTML) {
              s.selectedIndex = i;
              h.innerHTML = this.innerHTML;
              y = this.parentNode.getElementsByClassName("same-as-selected");
              for (k = 0; k < y.length; k++) {
                y[k].removeAttribute("class");
              }
              this.setAttribute("class", "same-as-selected");
              break;
            }
          }
          h.click();
        });
        b.appendChild(c);
      }
      x[i].appendChild(b);
      a.addEventListener("click", function(e) {
        /* When the select box is clicked, close any other select boxes,
        and open/close the current select box: */
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
      });
    }

    function closeAllSelect(elmnt) {
      /* A function that will close all select boxes in the document,
      except the current select box: */
      var x, y, i, arrNo = [];
      x = document.getElementsByClassName("select-items");
      y = document.getElementsByClassName("select-selected");
      for (i = 0; i < y.length; i++) {
        if (elmnt == y[i]) {
          arrNo.push(i)
        } else {
          y[i].classList.remove("select-arrow-active");
        }
      }
      for (i = 0; i < x.length; i++) {
        if (arrNo.indexOf(i)) {
          x[i].classList.add("select-hide");
        }
      }
    }



    function onClick(element) {
      document.getElementById("id01").style.display = "none";
    }

    /* If the user clicks anywhere outside the select box,
    then close all select boxes: */
    document.addEventListener("click", closeAllSelect);
  </script>



</body>

</html>