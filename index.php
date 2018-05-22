<?php
require_once 'includes/includes.php';


 
 if(isset($_POST["login"]))   
 {  
      $password = sha1(trim($_POST['txtPassword']));
      $result = $database->query_db("SELECT * FROM users WHERE email = '". $_POST["txtEmail"]. "' and password = '".$password. "'");  
      $user = $database->fetch_array($result);  
      if($user)   
      {  
           if(!empty($_POST["remember"]))   
           {  
                setcookie ("member_login",$_POST["txtUname"],time()+ (10 * 365 * 24 * 60 * 60));  
                setcookie ("member_password",$_POST["txtPassword"],time()+ (10 * 365 * 24 * 60 * 60));  
           }  
           else  
           {  
                if(isset($_COOKIE["username"]))   
                {  
                     setcookie ("member_login","");  
                }  
                if(isset($_COOKIE["member_password"]))   
                {  
                     setcookie ("member_password","");  
                }  
           } 

           if($user){
             session_start();
             $_SESSION['user_id']=$user['user_id'];
             $_SESSION['access_level']=$user['access_level'];
             $_SESSION['student_id']=$user['student_id'];
             echo "<script type='text/javascript'>
              location.assign('dashboard.php');
          </script>";  
           }
           
      }  
      else  
      {  
           $message = "<div class=\"alert alert-danger\" role=\"alert\">
                <strong>Oh snap!</strong>
                 Invalid Credentials
            </div>";

      }  
 }  
?> 
<?php
  if (isset($_GET['message'])) {
    echo "<script type='text/javascript'>
              alert('DO NOT BE SMART!!...PLEASE LOG IN');
          </script>";
  }
?>



<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>PMS Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <script src="assets/js/jquery.min.js"></script>

    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" id="theme" href="assets/css/theme-default.css"/>
</head>
<body>

<div class="login-container">

    <div class="login-box animated fadeInDown">
        <div class="" style="color: #ffffff; font-weight: bolder; font-size: 40px; margin-bottom: 20px; text-align: center">PMS</div>
        <div class="login-body">
            <?php if(isset($message)) { echo $message; } ?>


            <div class="login-title"><strong>Welcome</strong>, Please login</div>
            <form  class="form-horizontal" method="post">

                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="E-mail" required="" name="txtEmail" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" class="form-control" placeholder="Password" required="" name="txtPassword" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
<!--                        <a href="#" class="btn btn-link btn-block">Forgot your password?</a>-->
                    </div>
                    <div class="col-md-6">
                        <button name="login" type="submit" class="btn btn-accent btn-block " style="color: #ffffff;">Log In</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-footer">
            <br>
            <br>
            <div class="text-center">
                &copy; 2018 PMS
            </div>

        </div>

    </div>

</div>

</body>
</html>
<?php
  $database->close_connection();
?>










