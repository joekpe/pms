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
           $message = "<div class='alert alert-danger text-center'>
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
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PMS </title>

    <!-- Bootstrap core CSS -->

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/icheck/flat/green.css" rel="stylesheet">


    <script src="assets/js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <?php if(isset($message)) { echo $message; } ?>
                <section class="login_content">
                    <form method="post">
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="E-mail" required="" name="txtEmail" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" name="txtPassword" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" />
                        </div>
                        <div class="form-group">  
                              <div><button type="submit" name="login" class="btn btn-success btn-block"><span class="fa fa-user"></span> Login</button>
                              </div>  
                         </div>  
                        <div class="clearfix"></div>
                        <div class="separator">

                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="" style="font-size: 26px;"></i> PMS</h1>

                                <!-- <p>©<?php echo date("Y"); ?> All Rights Reserved. Powered by<a href="https://www.facebook.com/nineteen38">nineteen38</a></p> -->
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            
        </div>
    </div>

</body>

</html>
<?php
  $database->close_connection();
?>