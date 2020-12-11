<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

    <style>

        body, html {
            height: 100%;
            background-repeat: no-repeat;
            background-color: #d3d3d3;
            font-family: 'Oxygen', sans-serif;
        }

        .main {
            margin-top: 70px;
        }

        h1.title {
            font-size: 50px;
            font-family: 'Passion One', cursive;
            font-weight: 400;
        }

        hr {
            width: 10%;
            color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            margin-bottom: 15px;
        }

        input,
        input::-webkit-input-placeholder {
            font-size: 11px;
            padding-top: 3px;
        }

        .main-login {
            background-color: #fff;
            /* shadows and rounded borders */
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .main-center {
            margin-top: 30px;
            margin: 0 auto;
            max-width: 330px;
            padding: 40px 40px;
        }

        .login-button {
            margin-top: 5px;
        }

        .login-register {
            font-size: 11px;
            text-align: center;
        }

    </style>

  <?php 
	include 'Serverlink.php';
    $showAlert = false;
	$showError = false;
    $showAlertMess = "";
	$showErrorMess = "";
    
	 if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$firstname = $_POST["f_name"];
		$lastname = $_POST["l_name"];
		$password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
		$email = $_POST["emailid"];
		$phonenumber = $_POST["ph_number"];

		$exists = false;

        /*if(isset($_POST['login'])){
            header('location: Login.php');  
		}*/

        $sql = "SELECT * FROM `admin_signup` WHERE `ph_number` = '$phonenumber'";
        $result = mysqli_query($conn,$sql);
        $valu1 = mysqli_num_rows($result);
        if($valu1==0)
        {
            $sql = "SELECT * FROM  `admin_signup` WHERE `emailid` = '$email'";
            $result = mysqli_query($conn,$sql);
            $valu2 = mysqli_num_rows($result);
            if($valu2==0)
            {
                if($password==$cpassword) 
                {
		            $sql = "INSERT INTO `admin_signup` (`f_name` , `l_name` , `password` , `emailid` , `ph_number`  )
			        VALUES ('$firstname', '$lastname', '$cpassword' , '$email' , '$phonenumber ' )";       
                    $result = mysqli_query($conn,$sql);
                    if($result)
                    {
                        $showAlert = true;
                        $showAlertMess = "Your Registration is Success";
              
                    }
                    else
		            {
                        $showError = true;
                        $showErrorMess = "Server Error";
                       
		            }
                }
                else
	            {
                    $showError =true;
                    $showErrorMess = "Password dosent match";

                }
            }
            else
            {
                $showError = true;
                $showErrorMess = "Email already in use";
			}
            
        } 
        else
        {
            $showError = true;
            $showErrorMess = "User alreary Exists";

        }
    }
?>

    <!-- Website CSS style -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">

    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <title>Admin</title>
</head>
<body>

        <?php require 'Alertbox.php' ?>
        
        <?php require 'Errorbox.php' ?>

    <div class="container">
        <div class="row main">
                <div class="panel-title text-center">
                    <h1 class="title">Company Name</h1>
                    <hr />
                </div>
            <div class="main-login main-center">
                <form class="form-horizontal" method="post" action="Adminsignup.php">

                    <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">First Name</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" minlength="2" maxlength="20"  name="f_name" id="name" placeholder="Enter your First Name" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">Last Name</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" minlength="2" maxlength="20"  name="l_name" id="name" placeholder="Enter your Last Name" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="cols-sm-2 control-label">Email</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="email" class="form-control" name="emailid" id="email" placeholder="Enter your Email" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="cols-sm-2 control-label">Phone</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                <input type="phone" class="form-control" minlength="10" maxlength="10"  name="ph_number" id="phone" placeholder="Enter your phone number" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="cols-sm-2 control-label">Password</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password"  minlength="6" maxlength="15" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password"  minlength="6" maxlength="15" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm your Password" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <button type="submit" id="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                    </div>
                    <div class="login-register">
                        <a href="Adminlogin.php">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
</body>
</html>