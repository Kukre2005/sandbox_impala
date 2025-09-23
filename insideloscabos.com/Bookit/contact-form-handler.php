<?php
$errors = '';
$myemail = 'paypal@insideloscabos.com';//<-----Put Your email address here.
if(empty($_POST['fullname']) || 
   empty($_POST['email']) || 
   empty($_POST['phone']) || 
   empty($_POST['stayingat']) || 
   empty($_POST['arrdate']) || 
   empty($_POST['arrinfo']) || 
     empty($_POST['adults']) || 
   empty($_POST['service']) || 
   empty($_POST['kids']) || 
   empty($_POST['country']) || 
   empty($_POST['comments']))
{
    $errors .= "\n Error: all fields are required";
}

//$name = $_POST['name']; 
//$email_address = $_POST['email']; 
//$message = $_POST['message']; 
$fullname=$_POST['fullname'];
$email_address = $_POST['email']; 
$phone=$_POST['phone'];
$stayingat=$_POST['stayingat'];
$arrdate=$_POST['arrdate'];
$arrinfo=$_POST['arrinfo'];
$depdate=$_POST['depdate'];
$depinfo=$_POST['deptinfo'];
$adults=$_POST['adults'];
$kids=$_POST['kids'];
$country=$_POST['country'];
$comments=$_POST['comments'];




if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Payment Booked Information";
	
	$email_body = "You have received a new message. ".
	" Here are Booking details:\n Full Name: $fullname \n Email: $email_address \n Phone No: $phone \n Where Staying: $stayingat \n Arrival Day: $arrdate \n Arrival Flight Information: $arrinfo
	\n departure Day: $depdate \n Departure Flight Information: $depinfo \n No. of Adults: $adults \n Kids: $kids \n Country: $country \n Message :$comments"; 


		
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: book-it-done.html');
} 


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Contact form handler</title>
</head>

<body>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>


</body>
</html>