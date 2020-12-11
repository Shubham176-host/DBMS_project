<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

 <?php

    $_SESSION['loggedin'] = false;

   $showError =false;
   $showAlert = false;

   $showErrorMess = "";
   $showAlertMess = "";

   if($_SERVER["REQUEST_METHOD"]=="POST")
   {
     include 'Serverlink.php';
     $emailid = $_POST["emailid"];
     $password = $_POST["password"];
     $sql = "SELECT * FROM `admin_signup` WHERE `emailid` ='$emailid' AND `password` = '$password'"; 
     $result = mysqli_query($conn,$sql);
     $num = mysqli_num_rows($result);
     if($num >0 )
     {
          $showAlert = true;
          $showAlertMess = "Login Success";
          session_start();
          $_SESSION['admin'] = true;
          $_SESSION['loggedin'] = true;
          $_SESSION['emailid'] = $emailid;
          header("location: Adminpanel.php");
         
     }
      
     else
     {
        $showError = true;
        $showErrorMess = "Invalid credentials";         
     }
   }

?>


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
                <form class="form-horizontal" method="post" action="Adminlogin.php">
                    <div class="form-group">
                        <label for="email" class="cols-sm-2 control-label">Your Email</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="email" class="form-control" name="emailid" id="email" placeholder="Enter your Email" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="cols-sm-2 control-label">Password</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Login</button>
                    </div>
                    <div class="login-register">
                        <a href="Adminsignup.php">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
</body>
</html>