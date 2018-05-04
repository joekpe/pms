<?php
	require_once 'layouts/top.php';

	if (isset($_POST['btnUpdateUser'])) {
	  
	    $full_name = $database->prep(trim($_POST['txtName']));
	    $email = $database->prep(trim($_POST['txtEmail']));
	    $access_level = $database->prep($_POST['txtAccessLevel']);
	    
	    $result = User::update_user($_GET['id'], $full_name, $email, $access_level);
	    if($result){
        	$message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>USER DETAILS UPDATED</div>";
	    }
	    else{
	    	$message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>FAILED TO UPDATE USER DETAILS</div>";
	    }
	    
	}

	//user details
	$u = User::find_by_id($_GET['id']);
	$user = $database->fetch_array($u);
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>New User</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row"> <?php if(isset($message)) { echo $message; } ?></div>
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
                        	<label>Access Level</label>
                            <select class="form-control" name="txtAccessLevel" required >
                            	<option value="<?php echo $user['access_level']; ?>">
                            		<?php 
                            	 		if($user['access_level'] == ADMIN){
                                 			echo "Administrator";
                                 		}
                                 		elseif($user['access_level'] == SUPERVISOR){
                                 			echo "Supervisor";
                                 		}
                                 		else{
                                 			echo "Student";
                                 		}
                            	 	?>                            	 </option>
                            	<option value="0">Administrator</option>
                                <option value="1">Supervisor</option>
                                <option value="2">Student</option>
                            </select>
                        </div><br>
                                             
                              <div><button type="submit" name="btnUpdateUser" class="btn btn-success"><span class="fa fa-user"></span> Update User</button></div>
                         </div>  
                        <div class="clearfix"></div>
                        <div class="separator">

                           
                        </div>
                    </form>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>

</div>
<br />
<?php
	require_once 'layouts/bottom.php';
?>