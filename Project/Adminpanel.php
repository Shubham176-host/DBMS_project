<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Album example · Bootstrap</title>

    <?php
  
   include 'Serverlink.php'; 
   session_start();
   $User_id = $_SESSION['emailid'];

  if (isset($_POST['save'])) {
  $result1 = mysqli_query($conn,"SELECT * FROM `user_singup` WHERE `emailid` = '$User_id'");
  $row = mysqli_fetch_array($result1);
  $result2 = mysqli_query($conn,"SELECT * FROM `verification` WHERE `User/admin_id` = $row[user_id]");
  $row2 = mysqli_fetch_array($result2);
  	 $Profile_image = $_FILES['profile_image']['name'];

     if($Profile_image == null)
     {
        $Profile_image = $row['Profile_image'];
	 }

     $First_Name = $_POST['first_name'];
     $Last_Name = $_POST['last_name'];
  	 $target = "profile/".basename($Profile_image);
 
  	 $sql = "UPDATE `user_singup` SET `f_name`= '$First_Name' ,`l_name`= '$Last_Name', `Profile_image`= '$Profile_image' WHERE `emailid` = '$User_id'";
  	 $result = mysqli_query($conn, $sql);

     $Pan_num = $_POST['pan_num'];
     $Adhar_num = $_POST['adhar_num'];

     if($Pan_num != null & $Adhar_num != null)
     {
        $sql = "INSERT INTO `verification`(`Pan_number`, `Adhar_number`, `Verification_status`, `User/admin_id`) VALUES ('$Pan_num' , '$Adhar_num' , 'V' , $row[user_id])";
        $result = mysqli_query($conn, $sql);
	 }
  	 if($result)
     {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target)) 
        {
  		    $msg = "Image uploaded successfully";
  	    }
        else
        {
  		    $msg = "Failed to upload image";
  	    } 
     }
  }
  $result1 = mysqli_query($conn,"SELECT * FROM `user_singup` WHERE `emailid` = '$User_id'");
  $row = mysqli_fetch_array($result1);
  $result2 = mysqli_query($conn,"SELECT * FROM `verification` WHERE `User/admin_id` = '$row[user_id]'");
  $row2 = mysqli_fetch_array($result2);
  if($row2['Verification_status'] == "V")
  { 
  $status = "disabled"; 
  }else
  { 
  $status = "enabled"; 
  }
  
?>

<style>
    a:focus,a:hover,a{
    outline:none;
    text-decoration: none;
}
li,ul{
    list-style: none;
    padding: 0;
    margin: 0;
}
.header-top i {
    font-size: 18px;
}
#navigation {
    background: #0e1a35;
}

#navigation {
    padding: 0;
}

.display-table {
    display: table;
    padding: 0;
    height: 100%;
    width: 100%;
}

.display-table-row {
    display: table-row;
    height: 100%;
}

.display-table-cell {
    display: table-cell;
    float: none;
    height: 100%;
}

.v-align {
    vertical-align: top;
}
.logo img {
    max-width: 180px;
    padding: 16px 0 17px;
    width: 100%;
}

.header-top {
    margin: 0;
    padding-top: 2px;
}

.header-top img {
    border-radius: 50%;
    max-width: 48px !important;
    width: 100%;
}

.add-project {
    background: #5584ff none repeat scroll 0 0;
    border-radius: 100px;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    padding: 10px 27px 10px 45px;
    position: relative;
}

.header-rightside .nav > li > a:focus,
.header-rightside .nav > li > a:hover {
    background: none;
    text-decoration: none;
}

.add-project::before {
    background: rgba(0, 0, 0, 0) url("../images/plus.png") no-repeat scroll 0 0;
    content: "";
    ;
    height: 12px;
    left: 17px;
    position: absolute;
    top: 12px;
    width: 12px;
}

.add-project:hover {
    color: #ffffff;
}

.header-top i {
    color: #0e1a35;
}

.icon-info {
    position: relative;
}
.navi i {
    font-size: 20px;
}
.label.label-primary {
    border-radius: 50%;
    font-size: 9px;
    left: 8px;
    position: absolute;
    top: -9px;
}

.icon-info .label {
    border: 2px solid #ffffff;
    font-weight: 500;
    padding: 3px 5px;
    text-align: center;
}

.header-top li {
    display: inline-block;
    text-align: center;
}

.header-top .dropdown-toggle {
    color: #0e1a35;
}

.header-top .dropdown-menu {
    border: medium none;
    left: -85px;
    padding: 17px;
}
.view {
    background: #5584ff none repeat scroll 0 0;
    border-radius: 100px;
    color: #ffffff;
    display: inline-block;
    font-size: 14px;
    font-weight: 600;
    margin-top: 10px;
    padding: 10px 15px;
}

.navbar-content > span {
    font-size: 13px;
    font-weight: 700;
}

.img-responsive {
    width: 100%;
}
#navigation{
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

.navi a {
    border-bottom: 1px solid #0d172e;
    border-top: 1px solid #0d172e;
    color: #ffffff;
    display: block;
    font-size: 17px;
    font-weight: 500;
    padding: 28px 20px;
    text-decoration: none;
}

.navi i {
    margin-right: 15px;
    color: #5584ff;
}

.navi .active a {
    background: #122143;
    border-left: 5px solid #5584ff;
    padding-left: 15px;
}

.navi a:hover {
    background: #122143 none repeat scroll 0 0;
    border-left: 5px solid #5584ff;
    display: block;
    padding-left: 15px;
}

.navbar-default {
    background-color: #ffffff;
    border-color: #ffffff;
}

.navbar-toggle {
    border: none;
}

.navbar-default .navbar-toggle:focus,
.navbar-default .navbar-toggle:hover {
    background-color: rgba(0, 0, 0, 0);
}

.navbar-default .navbar-toggle .icon-bar {
    background-color: #0e1a35;
}

</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                    <a hef="home.html"><img src="http://jskrishna.com/work/merkury/images/logo.png" alt="merkery_logo" class="hidden-xs hidden-sm">
                        <img src="http://jskrishna.com/work/merkury/images/circle-logo.png" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
                    </a>
                </div>
                <div class="navi col-5">
                    <ul>
                        <li class="active"><a href="#"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
                        <li ><a href="Myvehicle.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">My Vehicles</span></a></li>
                        <li><a href="Vehicleupload.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Upload data</span></a></li>
                        <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Calender</span></a></li>
                        <li><a href="Mybookedvehicle.php"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Users booked</span></a></li>
                        <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Setting</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </nav>
                            <div class="search hidden-xs hidden-sm">
                                <input type="text" placeholder="Search" id="search">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">
                                    <li class="hidden-xs"><a href="#add_project" class="add-project" data-toggle="modal" data-target="#add_project">Add Project</a></li>
                                    <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                    <li>
                                        <a href="#" class="icon-info">
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            <span class="label label-primary">3</span>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="http://jskrishna.com/work/merkury/images/user-pic.jpg" alt="user">
                                            <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="navbar-content">
                                                    <span>JS Krishna</span>
                                                    <p class="text-muted small">
                                                        me@jskrishna.com
                                                    </p>
                                                    <div class="divider">
                                                    </div>
                                                    <a href="#" class="view btn-sm active">View Profile</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="user-dashboard">
                    <form method="POST" action="Adminpanel.php"  enctype="multipart/form-data">
    <div class="">
        <div class="row">
  		    <div class="col-sm-10"><h1>User name</h1></div>
                </div>
                <div class="row">
  		            <div class="col-sm-3"><!--left col-->
              

                        <div class="text-center">
                            <?php echo '<img class="img-circle img-responsive"  src="profile/'.$row['Profile_image'].'" width="200" height="200" alt="avatar"/> '?>
                            <h6>Upload a different photo...</h6>
                            <input  onchange="enableit()" type="file" name="profile_image">
                        </div>
                        <ul class="list-group">
                        <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Orders</strong></span> 125</li>
                        <?php if($status == "disabled"){ echo '<li class="list-group-item text-right" style="color: green" ><span class="pull-left"><strong style="color: black">Verificion Status</strong></span>Verified</li>'; } else { echo '<li class="list-group-item text-right"  style="color: yellow"><span class="pull-left"><strong  style="color: black">Verificion Status</strong></span>Pending</li>'; }?>
                        <a class="list-group-item text-right" href="Logout.php" ><span class="pull-left"><strong>Logout</strong></span></a>
                        </ul> 
               
                    </div><!--/col-3-->
    	            <div class="col-sm-9">
              
                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                            <hr>
                                <div class="form-group">
                          
                                    <div class="col-xs-5">
                                    <label for="first_name"><h4>First name</h4></label>
                                    <input type="text" onchange="enableit()" value="<?php echo $row['f_name'] ?>" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
                                    </div>
                                </div>
                                <div class="form-group">
                          
                                    <div class="col-xs-5">
                                    <label for="last_name"><h4>Last name</h4></label>
                                    <input type="text" onchange="enableit()" value="<?php echo $row['l_name'] ?>" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any." >
                                    </div>
                                </div>
          
                                <div class="form-group">
                          
                                    <div class="col-xs-5">
                                    <label for="phone"><h4>Phone</h4></label>
                                    <input type="text" value="<?php echo "+91".$row['ph_number'] ?>"class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any." disabled>
                                    </div>
                                </div>
         
                                <div class="form-group">
                          
                                    <div class="col-xs-5">
                                    <label for="email"><h4>Email</h4></label>
                                    <input type="email" class="form-control" value="<?php echo $row['emailid'] ?>" name="email" id="email" placeholder="you@email.com"  disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                          
                                    <div class="col-xs-5">
                                    <label for="password"><h4>PAN Number</h4></label>
                                    <input onchange="enableit()" type="text" value="<?php echo $row2['Pan_number'] ?>" class="form-control" name="pan_num" id="pan" placeholder="Pan Number" title="enter your pan number." <?php echo $status; ?>>
                                    </div>
                                </div>
                                <div class="form-group">
                          
                                    <div class="col-xs-5">
                                    <label for="password2"><h4>Adharcard Number</h4></label>
                                    <input onchange="enableit()" type="text" value="<?php echo $row2['Adhar_number'] ?>" class="form-control" name="adhar_num" id="password2" placeholder="Adhar Number" title="enter your adhar number."  <?php echo $status; ?>>
                                    </div>
                                </div>
                                <div class="form-group">
                          
                                    <div class="col-xs-10">
                                    <label for="address"><h4>Full Address</h4></label>
                                    <textarea onchange="enableit()" col="10" rows="3" type="text" value="<?php echo $row2['Adhar_number'] ?>" class="form-control" name="address" id="address" placeholder="Full Address" title="enter your full address."></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                    <br>
                              	    <button class="btn btn-lg btn-success" id="save" type="submit" name="save" disabled><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	    <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                                    </div>
                                </div>
                                </hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
                    
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div id="add_project" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Project</h4>
                </div>
                <div class="modal-body">
                            <input type="text" placeholder="Project Title" name="name">
                            <input type="text" placeholder="Post of Post" name="mail">
                            <input type="text" placeholder="Author" name="passsword">
                            <textarea placeholder="Desicrption"></textarea>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="button" class="add-project" data-dismiss="modal">Save</button>
                </div>
            </div>

        </div>
    </div>
    <script>
    $(document).ready(function(){
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });
});
    </script>
    <script>
function enableit()
{
    document.getElementById("save").disabled = false;
}
</script>
</body>