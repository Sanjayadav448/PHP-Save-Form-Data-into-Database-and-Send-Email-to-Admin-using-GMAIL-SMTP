<?php
$con=mysqli_connect('localhost','root','','ecom');
$msg="";
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	$comment=mysqli_real_escape_string($con,$_POST['comment']);
    $time=date('y-m-d h:m:s');
	
	mysqli_query($con,"insert into contact_us(name,email,mobile,query,Date) values('$name','$email','$mobile','$comment',`$time`)");
	$msg="Submit Succesfully!!";
	
	$html="<h1>Thankyou for contact us!";
	$html1="<table><tr><td>Name: </td><td>$name</td></tr><tr><td>Email: </td><td>$email</td></tr><tr><td>Mobile: </td><td>$mobile</td></tr><tr><td>Comment: </td><td>$comment</td></tr>";
	

	// *************************Email for User****************
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="sanjayadav4489@gmail.com";
	$mail->Password="aaabpnsialcaqmri";
	$mail->SetFrom("sanjayadav4489@gmail.com");
	$mail->addAddress($email);
	// $mail->addAddress("imsanjayadav69@gmail.com");
	$mail->IsHTML(true);
	$mail->Subject="Thankyou!";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	$mail->send();

// Email for admin**************************

	$mail1=new PHPMailer(true);
	$mail1->isSMTP();
	$mail1->Host="smtp.gmail.com";
	$mail1->Port=587;
	$mail1->SMTPSecure="tls";
	$mail1->SMTPAuth=true;
	$mail1->Username="sanjayadav4489@gmail.com";
	$mail1->Password="aaabpnsialcaqmri";
	$mail1->SetFrom("sanjayadav4489@gmail.com");
	$mail1->addAddress("sanjayadav4489@gmail.com");
	$mail1->IsHTML(true);
	$mail1->Subject="New Contact us";
	$mail1->Body=$html1;
	$mail1->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	$mail1->send();
	echo $msg;
	
}
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Contact Form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	  <link href="style.css" rel="stylesheet">
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container contact">
         <div class="row">
            <div class="col-md-3">
               <div class="contact-info">
                  <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
                  <h2>Contact Us</h2>
                  <h4>We would love to hear from you !</h4>
               </div>
            </div>
            <div class="col-md-9">
               <form method="post" id="frmContactus">
					<div class="contact-form">
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="name">Name:</label>
						 <div class="col-sm-10">          
							<input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
						 </div>
					  </div>
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="email">Email:</label>
						 <div class="col-sm-10">
							<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
						 </div>
					  </div>
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="mobile">Mobile:</label>
						 <div class="col-sm-10">
							<input type="text" class="form-control" id="mobile" placeholder="Enter mobile" name="mobile" required>
						 </div>
					  </div>
					  
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="comment">Comment:</label>
						 <div class="col-sm-10">
							<textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
						 </div>
					  </div>
					  <div class="form-group">
						 <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default" name="submit" id="submit">Submit</button>
							<span style="color:red;" id="msg"><?= $msg ?></span>
						 </div>
					  </div>
				   </div>
			   </form>
            </div>
         </div>
      </div>
	  <!-- <script>
	  jQuery('#frmContactus').on('submit',function(e){
		jQuery('#msg').html('');
		jQuery('#submit').html('Please wait');
		jQuery('#submit').attr('disabled',true);
		jQuery.ajax({
			url:'submit.php',
			type:'post',
			data:jQuery('#frmContactus').serialize(),
			success:function(result){
				jQuery('#msg').html(result);
				jQuery('#submit').html('Submit');
				jQuery('#submit').attr('disabled',false);
				jQuery('#frmContactus')[0].reset();
			}
		});
		e.preventDefault();
	  });
	  </script> -->
   </body>
</html>