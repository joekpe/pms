<?php
	require_once 'layouts/top.php';

    if (isset($_POST['btnUpdateProfile'])) {
      
        $full_name = $database->prep(trim($_POST['txtName']));
        $email = $database->prep(trim($_POST['txtEmail']));
        $phone = $database->prep($_POST['txtPhone']);
        
        $result = User::update_profile($_SESSION['user_id'], $full_name, $email, $phone);
        if($result){
            $message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>PROFILE UPDATED</div>";
        }
        else{
            $message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>FAILED TO UPDATE USER PROFILE</div>";
        }
        
    }

    //user details
    $u = User::find_by_id($_SESSION['user_id']);
    $user = $database->fetch_array($u);
?>
<div class="row"> <?php if(isset($message)) { echo $message; } ?></div>
<div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="dashboard_graph">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                        <?php
                            if (isset($_POST['btnUpdatePassword'])) {
                                $op = sha1(trim($_POST['txtOldPassword']));
                                $pass1 = trim($_POST['txtNewPass']);
                                $pass2 =trim($_POST['txtRNewPass']);

                                if ($op == $user['password']) {
                                    if ($pass1 == $pass2) {

                                        $pass1 = sha1($pass1);
                                        
                                        $res = $database->query_db("UPDATE users SET password='$pass1' WHERE user_id=".$_SESSION['user_id']."");
                                        if ($res) {
                                            echo "<div class='container'>
                                                        <div class='col-lg-4'></div>
                                                        <div class='alert alert-success col-lg-4 text-center' role='alert'>
                                                           PASSWORD CHANGED
                                                        </div>
                                                        <div class='col-lg-4'></div>
                                                      </div>";
                                        }
                                        else{
                                            echo "<div class='container'>
                                                        <div class='col-lg-4'></div>
                                                        <div class='alert alert-danger col-lg-4 text-center' role='alert'>
                                                           UNABLE TO CHANGE PASSWORD
                                                        </div>
                                                        <div class='col-lg-4'></div>
                                                      </div>";
                                        }
                                    }
                                    else{
                                        echo "<div class='container'>
                                                        <div class='col-lg-4'></div>
                                                        <div class='alert alert-danger col-lg-4 text-center' role='alert'>
                                                           PASSWORDS DO NOT MATCH
                                                        </div>
                                                        <div class='col-lg-4'></div>
                                                      </div>";
                                    }
                                }
                                else{
                                    echo "<div class='container'>
                                                        <div class='col-lg-4'></div>
                                                        <div class='alert alert-danger col-lg-4 text-center' role='alert'>
                                                           WRONG OLD PASSWORD
                                                        </div>
                                                        <div class='col-lg-4'></div>
                                                      </div>";
                                }
                            }
                        ?>
                            
                            <div class="row">
                                <div class="container">

                                        <form method="post" class="form-horizontal form-label-left">

                                            <br />
                                            <span  class="section text-center">Change Password</span>
                                            <div class="item form-group">
                                                <label for="opassword" class="control-label col-md-3">Old Password *</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="opassword" type="password" name="txtOldPassword" class="form-control col-md-7 col-xs-12" required="required">
                                                </div>
                                            </div>
                                            
                                            <div class="item form-group">
                                                <label for="password" class="control-label col-md-3">Password *</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="password" type="password" name="txtNewPass" class="form-control col-md-7 col-xs-12" required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password *</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="password2" type="password" name="txtRNewPass" class="form-control col-md-7 col-xs-12" required="required">
                                                </div>
                                            </div>
                                           
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button name="btnUpdatePassword" type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </div>
                                        </form>

                                

                                    </div>
                                   
                                    
                                </div>

                                <div class="row">
                                    <div class="container">
                                        <form method="post" class="col-md-6 col-md-offset-3">
                                            <div>
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" placeholder="Full Name" required="" name="txtName" value="<?php echo $user['full_name']; ?>" />
                                            </div><br>
                                            <div>
                                                <label>E-mail</label>
                                                <input type="email" class="form-control" placeholder="E-mail" required="" name="txtEmail" value="<?php echo $user['email']; ?>" />
                                            </div><br>
                                            <div>
                                                <label>Phone</label>
                                                <input type="text" class="form-control" placeholder="Phone" required="" name="txtPhone" value="<?php echo $user['phone']; ?>" />
                                            </div><br>
                                           
                                                                 
                                                  <div><button type="submit" name="btnUpdateProfile" class="btn btn-success"><span class="fa fa-user"></span> Update Profile</button></div>
                                             </div>  
                                            <div class="clearfix"></div>
                                            <div class="separator">

                                               
                                            </div>
                                        </form>
                                    </div>
                                </div>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>

            </div>

<?php
	require_once 'layouts/bottom.php';
?>