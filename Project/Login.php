<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Page</title>

    
    <link rel="stylesheet" href="signup_styles.css" />

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
     $sql = "SELECT * FROM `user_singup` WHERE `emailid` ='$emailid' AND `password` = '$password'"; 
     $result = mysqli_query($conn,$sql);
     $num = mysqli_num_rows($result);
     if($num >0 )
     {
          $showAlert = true;
          $showAlertMess = "Login Success";
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['emailid'] = $emailid;
          header("location: Home.php");
         
     }
      
     else
     {
        $showError = true;
        $showErrorMess = "Invalid credentials";         
     }
   }

?>


    <style> 
        #login {
        background-color: blue;
        color: white;
		}
    </style>
    


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
   
</head>


<body>

    <header>
        <h1 class="top_header">LOGO</h1>
    </header>

    <?php require 'navigation_bar.php' ?>

    <div class="logintable">

        <form class="login_details" border="0" action="Login.php" method="post">
            <table class="logintable1" border="0" align="center" cellspacing="14">

                <tr><th>User Login</></tr>

                <?php require 'Alertbox.php' ?>
        
                <?php require 'Errorbox.php' ?>
                <tr>
                    <td>
                        <label class="inputlable" for="emailid">Email ID:</label><span>*</span><br />
                        <input class="inputdetails" require type="email" name="emailid" id="emailid" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="inputlable" for="password">Password:</label><span>*</span><br />
                        <input class="inputdetails"  minlength="6" maxlength="15" require type="password" name="password" id="password"/>
                    </td>
                </tr>
                <tr>
                    <td>
                    <input type="checkbox" onclick="myFunction()">Show Password
                    <script> 
                        function myFunction() {
                        var x = document.getElementById("password");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                        x.type = "password";
                        }
                        }
                        </script>
                    </td>

                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn btn-outline-primary" id="loginbtn" class="loginbtn" value="Login" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <footer class="text-muted">
  <?php include 'footer.php' ?>

</footer>


</body>
</html>


