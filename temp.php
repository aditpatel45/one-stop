<!DOCTYPE html>
<html lang="en">
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 ?>
<?php
 session_start();
 if(isset($_SESSION['uname']))
{
 $abc=$_SESSION['uname'];
 //$abc1=$_SESSION['cartid'];
}
 ?>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>About Us</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- ##### Preloader ##### -->
    <div id="preloader">
        <i class="circle-preloader"></i>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header">
			<h1 style="color:#228B22;"><center><u><b>One Stop Shop For Engineer'S</b></u></center></h1>
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 h-100">
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="academy-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="academyNav">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.php">Home</a></li>                                    
                                    <li><a href="#">Book Details</a>
                                        <div class="megamenu">
                                            <ul class="dropdown">                                                
                                                <li><a href="book.php">Computer Eng.</a></li>                            
                                                <li><a href="mech.php">Mechanical Eng.</a></li>
                                                <li><a href="#">Electronics Eng.</a></li>
												<li><a href="#">Chemical Eng.</a></li>
												<li><a href="#">Civil Eng.</a></li>
                                            </ul>                                                                                       
                                        </div>
                                    </li>
									
                                    <li><a href="aboutus.php">About Us</a></li>                                  
                                    <li><a href="contact.php">Contact Us</a></li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>

                        <!-- Calling Info -->
                        <div class="calling-info">
                            <div class="call-center">
                                <B>
                                <div class="megamenu">
                                    <ul class="dropdown">   
                                 <?php  
                                if(isset($_SESSION['uname']))
                                    {echo "welcome ".$abc;
                                }else{ echo "<a href='login1.php'></i> <span>Login / Sign Up</span></a>";}
                                 ?></B><li>Logout</li></ul></div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
     <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="bradcumbContent">
            <h2>Checkout</h2>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    </body>
    </html>






<?php
         $nameErr = $emailErr = $passErr = $websiteErr = "";
       $name = $email = $gender = $comment = $website = "";
       $pas=$mobile= "";

 
//session_start();
if(isset($_POST['submit']))
{
$cartid=$_SESSION['cartid'];
  $con=mysqli_connect("localhost","root","","reg");

   $query = "SELECT * FROM `$cartid`";
  $result = mysqli_query($con,$query);
  //$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result))
  {
    $query1 = "SELECT * FROM bookcp where id=".$row['id'];
    $result1 = mysqli_query($con,$query1);
   while( $result2 = mysqli_fetch_assoc($result1))
   {
    //$pic=<img style="width=100px;height=100px;" src="aditimg/'.$row['img'].'">;
    $a=$result2['quant'];
    $a=$a-1;
    if($a<=0)
    {
    $query2 = "UPDATE bookcp SET quant='OUT OF STOCK' WHERE id=".$row['id'];
        }
    else
    {
    $query2 = "UPDATE bookcp SET quant=$a WHERE id=".$row['id'];
    }
    $s=mysqli_query($con,$query2);

    $a1=1;
    

    $query31 = "UPDATE `$cartid` SET `checkout`=$a1 WHERE id=".$row['id'];
    $s1=mysqli_query($con,$query31);
   $query32 = "UPDATE `cartid` SET `due`=date('YYYY-MM-DD') WHERE id=".$row['id'];
    $s2=mysqli_query($con,$query32);
      
  }

}

   if (empty($_POST["name"])) {
               $nameErr = "Name is required";
            }
  
        else
            {  
                       $name=$_POST['name'];
            }
            
           
            if (empty($_POST["pass"])) {
               $passErr = "Password is required";
            }
          
            else
                {  
                 if((strlen($_POST["pass"]))<5)
                {
                $passErr = "enter more than 5 letters";
                }
                else
                {
                    $pas =  $_POST["pass"];
                }
            }
  
        
            
            if (empty($_POST["email"])) {
               $emailErr = "Email is required";
            }else {
               
               if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format"; 
               }
               else
               {
               $email = $_POST["email"];
               }
            }
            
            if (!preg_match('/^[0-9]{10}+$/', $_POST['number'])) {
               $websiteErr = "Enter Valid mobile number";
            }
            else {
               $mobile=$_POST['number'];
            }
            
              
            
         
         
         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
               
         if(($passErr=="")&&($emailErr=="")&&($websiteErr==""))
         {
        $_SESSION['cartid']=$mobile."255";
        $a=$_SESSION['cartid'];
        //$abc="INSERT INTO login(name,number,email,password,cartid) VALUES ('$name','$mobile','$email','$pas','$a')";
		 }



$due=strtotime("+1 Months");
$due1 =date("Y-m-d", $due);
$email = $_POST["email"];
                require 'PHPMailer/src/Exception.php';
                require  'PHPMailer/src/PHPMailer.php';
                require 'PHPMailer/src/SMTP.php';

                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    // $mail->isSMTP();                                      // Set mailer to use SMTP
                    // $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
                    // $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    // $mail->Username = 'user@example.com';                 // SMTP username
                    // $mail->Password = 'secret';                           // SMTP password
                    // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    // $mail->Port = 587;                                    // TCP port to connect to

                    // //Recipients
                    //$mail->setFrom('from@example.com', 'Mailer');
                include('connect.php');
                    $mail->addAddress($email,$name);     // Add a recipient
                   // $mail->addAddress('ellen@example.com');               // Name is optional
                    //$mail->addReplyTo('info@example.com', 'Information');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');

                    // //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'one stop shop for engineers';
                    $mail->Body    = "due date is $due1";
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
                          
}

   




//header("Location:temp2.php");
?>

 

<!DOCTYPE html>
<html>
<head>
  <title>checkout</title>
</head>
<body>
     <form action="<?php $_PHP_SELF ?>" style="border:1px solid #ccc" method="post">
  <div class="container">
  <br>
  <br>
  <br>
  
     <table>
     <tr><td>
  <label for="name"><b>Name</b></label></td><td>
  <input type="text" placeholder="Enter Name" name="name" required></td></tr>
  
  

  
  
  <tr><td>
    <label for="number"><b>Email</b></label></td><td>
  <input type="text" placeholder="Enter Email" name="email"  required></td><td><span class = "error">* <?php echo $emailErr;?></span></td></tr>
    
    <tr><td>
  <label for="number"><b>Mobile Number</b></label></td><td>
  <input type="text" placeholder="Enter Mobile Number" name="number" required></td><td><span class = "error"> *<?php echo $websiteErr;?></td></tr>

  	<tr><td>
  <label for="number"><b>Address</b></label></td><td>
  <textarea name="bookabc" height="100" rows="5" placeholder="enter address" required></textarea></td><td><span class = "error"> *<?php echo $websiteErr;?></td></tr>


  	
<tr><td><label for="number"><b>Books</b></label></td><td>
  	<textarea name="bookabc" cols="50" rows="5"> 
	<?php 
   $con=mysqli_connect("localhost","root","","reg");
$cartid=$_SESSION['cartid'];
   $query = "SELECT * FROM `$cartid`";
  $result = mysqli_query($con,$query);
  //$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result))
  {

    $query1 = "SELECT * FROM bookcp WHERE 'checkout'=0 AND id=".$row['id'];
    $result1 = mysqli_query($con,$query1);
   while( $result2 = mysqli_fetch_array($result1))
   {
    //if($result['checkout']==0)
	//{
		echo $result2['bname'].'<br />';

//	}

}
}
    ?>
	</textarea></td></tr>
   
     </table>
    <div class="clearfix">
    
    <h3><input type="submit" class="signupbtn" placeholder="register" name="submit" ></h3>
    
    </div>
  </div>
</form>
</body>
</html>

  <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="main-footer-area section-padding-100-0">
            <div class="container">
                <div class="row">
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                <div class="widget-title">
                                <h6>Developers</h6>
                            </div>
                            </div>
                            <p>Adit Patel (16IT666)</p>
							<p>Yash Sohagia (16IT470)</p>
							<p>Smit Kakadiya (16IT474)</p>
                            <div class="footer-social-info">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                
                            </div>
                            <nav>
                                <ul class="useful-links">
                                    
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            
                        </div>
                    </div>
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                <h6>Contact</h6>
                            </div>
                            <div class="single-contact d-flex mb-30">
                                <i class="icon-placeholder"></i>
                                <p>Information Technology Department, BVM Engineering College, Vallabh Vidhyanagar, Anand</p>
                            </div>
                            <div class="single-contact d-flex mb-30">
                                <i class="icon-telephone-1"></i>
                                <p>Main: 96015-51022 <br>Office: 98982-42240 </p>
                            </div>
                            <div class="single-contact d-flex">
                                <i class="icon-contract"></i>
                                <p>bookrentalsystem@bvmengineering.ac.in</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>

