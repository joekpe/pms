<?php
	require_once 'layouts/top.php';

	if (isset($_POST['btnAddUser'])) {
	  if(User::is_user($_POST['txtEmail'])){
	     $message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>ACCOUNT ALREADY EXISTS</div>";
	  }
	  else{
	    $full_name = $database->prep(trim($_POST['txtName']));
	    $email = $database->prep(trim($_POST['txtEmail']));
	    $phone = $database->prep(trim($_POST['txtPhone']));
	    $pass1 = $database->prep(trim($_POST['txtPassword']));
	    $pass2 = $database->prep(trim($_POST['txtCPassword']));
	    $access_level = $database->prep($_POST['txtAccessLevel']);
	    $student_id = $database->prep($_POST['txtStudentId']);
	      if ($pass1 == $pass2) {
	        $result = User::new_user($full_name, $email, $phone, $pass1, $access_level, $student_id);
	        if($result){
	        	$message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>USER CREATED</div>";
	       }
	      }
	      else{
	       $message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>PASSWORDS DO NOT MATCH</div>";
	      }
	  }
	}
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
                            <input type="text" class="form-control" placeholder="Full Name" required="" name="txtName" />
                        </div><br>
                        <div>
                        	<label>E-mail</label>
                            <input type="email" class="form-control" placeholder="E-mail" required="" name="txtEmail" />
                        </div><br>
                        <div>
                        	<label>Phone</label>
                            <input type="text" class="form-control" placeholder="Phone Number" required="" name="txtPhone" />
                        </div><br>
                        <div>
                        	<label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" required="" name="txtPassword" />
                        </div><br>
                        <div>
                        	<label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm password" required="" name="txtCPassword" />
                        </div><br>
                        <div>
                        	<label>Access Level</label>
                            <select class="form-control" name="txtAccessLevel" required onchange="CheckUserType(this.value);">
                            	<option value="">-- Select Access Level --</option>
                            	<option value="0">Administrator</option>
                                <option value="1">Supervisor</option>
                                <option value="2">Student</option>
                            </select>
                        </div><br>
                        <div style="display:none;" id="student_id">
                        	<label>Student Id</label>
                            <input type="text" class="form-control" placeholder="Enter Student ID" required="" name="txtStudentId" />
                        </div><br>
                                             
                              <div><button type="submit" name="btnAddUser" class="btn btn-success"><span class="fa fa-user"></span> Add User</button></div>
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
<script type="text/javascript">
function CheckUserType(val){
 var element=document.getElementById('student_id');
 if(val=='2')
   	element.style.display='block';
 else  
   element.style.display='none';
}

</script> 