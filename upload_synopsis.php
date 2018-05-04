<?php
	require_once 'layouts/top.php';

	//checking is student is eligible for another upload
	$st = Synopsis::check_status($_SESSION['student_id']);
    $status = $database->fetch_array($st);
	if($status['status'] == 'danger' ){
		$message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>SYNOPSIS NOT APPROVED</div>";
		$disabled = "";
	}
	elseif($status['status'] == 'warning' || $status['status'] == 'success'){
		$disabled = "disabled";
	}
	else{
		$disabled = "";
	}


	//synopsis upload
	if(isset($_POST['btnUpload'])){
	  $academic_year = $_POST['txtYear'];
	  $topic = $database->prep($_POST['txtTopic']);
	  $file_name = uniqid()."-".$_FILES['txtFile']['name'];
	  $file_tmp =$_FILES['txtFile']['tmp_name'];
     
     if(Synopsis::new_synopsis($_SESSION['student_id'], $academic_year, $file_name, $topic)){
     	move_uploaded_file($file_tmp,"uploads/".$file_name);
     	$message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>SYNOPSIS UPLOADED</div>";
     }
     else{
     	$message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>FAILED TO UPLOAD SYNOPSIS</div>";
     }
	  
     
   }
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Synopsis Upload</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>
			



			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Form  <small>Custom design</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                        	<div class="row"> <?php if(isset($message)) { echo $message; } ?></div>
                        	<form method="post" class="col-md-6 col-md-offset-3" enctype="multipart/form-data">
		                        <div>
		                        	<label>Academic Year</label>
		                            <select class="form-control" required="" name="txtYear">
		                            	
		                            	<?php
		                            		$ac = AcademicYear::get_open_aca_years();
		                            		while($row = $database->fetch_array($ac)){
		                            	?>
		                            		<option value="<?php echo $row['id'] ?>"><?php echo $row['academic_year']; ?></option>
		                            	<?php
		                            		}
		                            	?>
		                            </select>
		                        </div><br>
		                        <div>
		                        	<label>File</label>
		                            <input type="file" class="form-control" required="" name="txtFile" />
		                        </div><br>

		                        <div>
		                        	<label>Topic</label>
		                            <input type="text" class="form-control" required="" name="txtTopic" />
		                        </div><br>
		                        
		                                             
		                              <div><button <?php echo $disabled; ?> id="btn_upload" type="submit" name="btnUpload" class="btn btn-success"><span class="fa fa-upload"></span> Upload Synopsis</button></div>
		                         </div>  
		                        <div class="clearfix"></div>
		                        <div class="separator">

		                           
		                        </div>
		                    </form>
                            
                        </div>
                    </div>
                </div>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>

</div>
<br />
<?php
	require_once 'layouts/bottom.php';
?>