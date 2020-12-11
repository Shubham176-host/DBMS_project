<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Forgot password</title>

    
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
     $phonenumber = $_POST["ph_number"];
     $sql = "SELECT * FROM `user_singup` WHERE `ph_number` ='$phonenumber'"; 
     $result = mysqli_query($conn,$sql);
     $num = mysqli_num_rows($result);
     if($num >0 )
     {
          $showAlert = true;
          $showAlertMess = "Account Found";
     }
      
     else
     {
        $showError = true;
        $showErrorMess = "Account Not Found";         
     }
   }


    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
   
</head>


<body>
<div class="user-select-none">
    <header class="user-select-none">
        <h1 class="top_header">LOGO</h1>
    </header>

    <?php require 'navigation_bar.php' ?>

    
    <div class="logintable">

        <form class="login_details" border="0" action="Forgotpassword.php" method="post">
            <table class="logintable1" border="0" align="center" cellspacing="14">

                <tr><th>Enter Registered Mobile Number</></tr>

                <?php require 'Alertbox.php' ?>
        
                <?php require 'Errorbox.php' ?>
                <tr>
                    <td>

                         <label class="inputlable" for="phone_number">Phone Number:</label><br />
                         <span style="color: black">+91</span><input minlength="10" maxlength="10"  class="inputdetails" required type="tel" name="ph_number" id="phonenumbe" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn btn-outline-primary" id="loginbtn" class="loginbtn" value="Forgot Password" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    

    <footer class="text-muted">
  <?php include 'footer.php' ?>

</footer>
</div>


</body>
</html>