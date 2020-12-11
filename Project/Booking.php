<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Vehicle Page</title>

    <?php
	include 'Serverlink.php';
    	session_start();

    $VehicleId =  $_GET['vehicleid'];

    $showAlert = false;
	$showError = false;
    $showAlertMess = "";
	$showErrorMess = "";
    
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
        $Vehicle_bid = $_POST['Vehicleid'];
		$Userid = $_POST['Userid'];
		$Booking_cost = $_POST["Vehicle_cost"];
        $fullname = $_POST["full_name"];
        $addressline1 = $_POST["address_line1"];
        $addressline2 = $_POST["address_line2"];
        $pincode = $_POST["pincode"];
        $pickuppoint = $_POST["pickup_point"];
		$date = date("Y-m-d");


		$sql1 = "INSERT INTO `booking` ( `Booking_id`,`Vehicle_bid` , `User_id` , `Booking_cost` , `Booking_date`)
        VALUES ('BKG0000','$Vehicle_bid' , '$Userid' , '$Booking_cost','$date')"; 
        $result1 = mysqli_query($conn,$sql1);
        $sql2 = "INSERT INTO `booking_details` (`full_name`, `address_line1`, `address_line2`, `pincode`, `pickup_point`)
        VALUES ('$fullname' , '$addressline1' , '$addressline2', '$pincode' , '$pickuppoint')"; 
        $result2 = mysqli_query($conn,$sql2);
        if($result1 && $result2)
        {
            $showAlert = true;
            $showAlertMess = "Boooking Successful";
            header("location: Bookingsuccess.php");
        } 
        else
        {
            $showError = true;
            $showErrorMess = "Error Please Try Again";

        }
    }
?>

    <style>
        #booking_form
        {
               text-align: center;
               margin: 30px;
		}
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

    <header>
        <h1 class="top_header">LOGO</h1>
    </header>
    <?php require 'Alertbox.php' ?>
        
        <?php require 'Errorbox.php' ?>

<?php require 'navigation_bar.php';
$User_id = $_SESSION['emailid'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
    header("location: login.php");
    exit;
}
?>

    <div class="row mb-3">
    
        <?php
          $result = mysqli_query($conn," SELECT * FROM vehicle WHERE Vehicle_id = '$VehicleId'");
          $row = mysqli_fetch_array($result);

          $Useremail = $_SESSION['emailid'];
          $sql = "SELECT user_id FROM `user_singup` WHERE emailid = '$Useremail'";
          $result1 = mysqli_query($conn,$sql);
          $row1 = mysqli_fetch_array($result1);
          $totalcost = ($row['Vehicle_Cost']*2)/100 + $row['Vehicle_Cost'];
          ?>
        
        <div class="col-md-6 themed-grid-col">
        
            <form  id="booking_form" action="Booking.php" method="post">
            <div class="form-group">
                <input required type="text" name="full_name" style="max-width: 80%" class="form-control" placeholder="Full name">
            </div>
            <div class="form-group">
                <input required type="text"  name="address_line1" class="form-control" id="inputAddress" placeholder="Address line 1">
            </div>
            <div class="form-group">
                <input required type="text"  name="address_line2" class="form-control" id="inputAddress2" placeholder="Address line 2">
            </div>
            <div class="form-group">
                <input required type="text" name="city" class="form-control" value="Mangalore" id="inputCity" disabled>
            </div>
            <div class="form-group">
                <input required type="text"  name="state" class="form-control" value="Karnataka" id="inputState" disabled>
            </div>
            <div class="form-group">
                 <input required type="text"  name="pincode" class="form-control" placeholder="Zipcode" id="inputZip">
            </div>
            
            <input class="text-muted"  value="<?php echo $totalcost;?>" name="Vehicle_cost" hidden/>
            <input class="text-muted" value="<?php echo $row['Vehicle_id'];?>" name="Vehicleid" hidden/>
            <input class="text-muted" value="<?php echo $row1['user_id'];?>" name="Userid" hidden/>

            <select class="custom-select " style="max-width: 70%" id="pickuppoint" name="pickup_point" required>
                 <option value="">Choose...</option>
                 <option value="first">One</option>
                 <option value="second">Two</option>
                 <option value="third">Three</option>
            </select>
                <button style="margin: 10px" name="vehicleid" id="vid" value="<?php echo $row['Vehicle_id'];?>" type="submit" class="btn btn-primary">Proceed To Payment</button>
        </form>
    </div>

        <div class="col-md-6 themed-grid-col">
        <?php 
           echo '<div class="s mb-4">
            <img id="product_img" style="border: 0 ;background: url(images/'.$row['Vehicle_image'].');  background-position: center;
        background-repeat: no-repeat;
        background-size: contain" width="80%" height="300"></img>
            <div class="card-body">
              <label class="text"><strong>'.$row['Vehicle_Name'].'</strong></label></br>
              <label class="text" style="margin:2px">'.$row['Vehicle_Company'].'</label></br>
              <label class="card-text" >Cost: Rs.'.$row['Vehicle_Cost'].'</label></br>
              <label class="text" >2% Tax</label></br>
              <label class="text-muted" name="Vehicle_cost">Total Cost: Rs.'.$totalcost.'</label>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
               </div>
              </div>
            </div>
          </div>
        </div>
    </div>';

    ?>
  <?php include 'footer.php' ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>