<?php
	require_once 'layouts/top.php';

	// if(){
	// 	redirect_to($_GET['page']);
	// }
	// else{
	// 	redirect_to($_GET['page']);
	// }

	

	if (isset($_POST['btnApprove'])) {

		
	  
	  	$synopsis_id = $database->prep(trim($_GET['id']));
	    $academic_year = $database->prep(trim($_GET['year']));
	    $student_id = $database->prep(trim($_GET['student_id']));
	    $supervisor_id = $database->prep(trim($_POST['txtSupervisorID']));
	      
	    $approve = Synopsis::approve($_GET['id']);
        $pair = Pairing::new_pair($student_id, $supervisor_id, $synopsis_id, $academic_year);
        if($approve and $pair){
        	echo "<script type='text/javascript'> 
        			alert('APPROVED');
        			location.assign('".$_GET['page']."?year=".$_GET['year']."');
        	 </script>";
       	}
       	else{
       		echo "<script type='text/javascript'> 
        			alert('FAILED TO APPROVE');
        	 </script>";
       	}
	 
	}
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Approve Synopsis</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row"> <?php if(isset($message)) { echo $message; } ?></div>
				<form method="post" class="col-md-6 col-md-offset-3">
                        <div>
                        	<label>Topic</label>
                            <input type="text" class="form-control" placeholder="Topic" required="" name="txtTopic" value="<?php echo @$_GET['topic'] ?>" readonly="readonly" />
                        </div><br>
                        <div>
                        	<label>Student ID</label>
                            <input type="text" class="form-control" required="" name="txtStudentID" value="<?php echo @$_GET['student_id'] ?>" readonly="readonly"/>
                        </div><br>
                        <div>
                        	<label>Supervisor</label>
                            <select class="form-control" name="txtSupervisorID">
                            	<option value="">--Select Supervisor--</option>
                            	<?php
                            		$su = $database->query_db("SELECT * FROM users WHERE access_level = '".SUPERVISOR."' ");
                            		while ($row = $database->fetch_array($su)) {
                            	?>
                            	<option value="<?php echo $row['user_id']; ?>"><?php echo $row['full_name']; ?></option>
                            	<?php
                            		}
                            	?>
                            </select>
                        </div><br>
                        
                                             
                              <div><button type="submit" name="btnApprove" class="btn btn-success"><span class="fa fa-thumbs-up"></span> Approve</button></div>
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