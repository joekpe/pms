<?php
	require_once 'layouts/top.php';

	if (isset($_POST['btnReset'])) {
	    $student_id = $database->prep($_POST['txtStudentId']);
	      
	    $result = User::reset_student_password($student_id);
        if($result){
        	$message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>PASSWORD RESET SUCCESSFUL</div>";
        }
        else{
        	$message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>FAILED TO RESET PASSWORD</div>";
        }
	}
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Reset Student Password</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row"> <?php if(isset($message)) { echo $message; } ?></div>
				<form method="post" class="col-md-6 col-md-offset-3">
                        <div>
                        	<label>Student's Identification Number</label>
                            <input type="text" class="form-control" placeholder="Student's Identification Number" required="" name="txtStudentId" />
                        </div><br>
                       
                                             
                              <div><button type="submit" name="btnReset" class="btn btn-success"><span class="fa fa-lock"></span>Reset Password</button></div>
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
 