<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
    
        <?php
               session_start();
        if (!empty($_POST['username']) || !empty($_POST['password'])||(!empty($_POST['vercode1']))) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            try {
                        
      if ($_POST['vercode1'] != $_SESSION['vercode'] OR $_SESSION['vercode']=='')
      {$msg= 'please enter right code';
header('Location:aalogin.php');
                    
          
      } else {
          
      
                $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=php', 'root', '');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $query = $dbhandler->query('select firstname from login where username=' . '"' . $username . '"' . 'and password=' . '"' . md5($password) . '"');
                
                $r=$query->fetch();
                $x = $query->rowCount();
                if ($x == 1) {
                    
                    $firstname=$r['firstname'];
                    $_SESSION['username']=$username;
                    $_SESSION['firstname']=$firstname;
                    setcookie('username', $username, time() + (86400 * 30), "/");
                    setcookie('firstname', $firstname, time() + (86400 * 30), "/");
          
                    header('location:educature/home.php');
                }
                if ($x != 1) {
                    echo 'invalid username or password';
      }}
      
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }
        ?>
    
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

                            <form class="login100-form validate-form" method="post" action="">
					<span class="login100-form-title">
						Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid username is required">
						<input class="input100" type="text" name="username" placeholder="username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                                Enter Code <img src="captcha.php">
                                           
					<div class="wrap-input100 validate-input" data-validate = "captch is required">
						<input class="input100" type="text" name="vercode1" placeholder="captch" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                                <h3>Captcha is wrong</h3>
                                 <div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>


					<div class="text-center p-t-136">
						<a class="txt2" href="registration.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a><br>
                                                <a class="txt2" href="admin/adminlogin.php">
							admin<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>