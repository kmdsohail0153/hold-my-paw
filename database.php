<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);


if (isset($_POST['submit'])) {
	
	$name=$_POST['name'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];

	$sql = "INSERT INTO customer(Name,Email,Subject,Message)
	VALUES ('$name','$email','$subject','$message')";
	
	if ($conn->query($sql) === TRUE) {
  			echo "Thank YOu";
		} 
	else {
  			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	$html="<table><tr><td>Name:</td><td>$name</td></tr><tr><td>Email:</td><td>$email</td></tr><tr><td>Subject:</td><td>$subject</td></tr><tr><td>Message:</td><td>$message</td></tr></table>";
	
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="lcnirajan47@gmail.com";
	$mail->Password="project@45";
	$mail->SetFrom("lcnirajan47@gmail.com");
	$mail->addAddress("lcnirajan47@gmail.com");
	$mail->IsHTML(true);
	$mail->Subject="New Contact Us";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		//echo "Mail send";
	}else{
		//echo "Error occur";
	}




}

	

$conn->close();
/*

	$con = mysqli_connect('localhost','root');
    
	if($con){
		echo "Connection sucessful";
	}
	else{
		echo "No connection";
	}	
	mysqli_select_db($con, 'hello');
	$user = $_POST['name'];
	$email = $_POST['email'];
	$email = $_POST['subject'];
	$message = $_POST['message'];
	
	$query = " insert into customer (Name,Email,Subject,Message)
	value ('$user', '$email','$subject','$message')";
	
	echo "$query";
	
	mysqli_query($con, $query);
	*/
?>