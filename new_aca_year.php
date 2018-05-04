<?php
	require_once 'layouts/top.php';

	if (isset($_POST['btnAddAcademicYear'])) {
	  
	    $academic_year = $database->prep(trim($_POST['txtYear']));
	    $start_date = $database->prep(trim($_POST['txtStart']));
	    $end_date = $database->prep(trim($_POST['txtEnd']));
	      
        $result = AcademicYear::new_aca_year($academic_year, $start_date, $end_date);
        if($result){
        	$message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>ACADEMIC YEAR CREATED</div>";
       	}
       	else{
       		$message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>ACADEMIC YEAR NOT CREATED</div>";	
       	}
	 
	}
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>New Academic Year</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row"> <?php if(isset($message)) { echo $message; } ?></div>
				<form method="post" class="col-md-6 col-md-offset-3">
                        <div>
                        	<label>Academic Year</label>
                            <input type="text" class="form-control" placeholder="Academic Year" required="" name="txtYear" />
                        </div><br>
                        <div>
                        	<label>Start Date For Synopsis Upload</label>
                            <input type="date" class="form-control" required="" name="txtStart" />
                        </div><br>
                        <div>
                        	<label>End Date For Synopsis Upload</label>
                            <input type="date" class="form-control"  required="" name="txtEnd" />
                        </div><br>
                        
                                             
                              <div><button type="submit" name="btnAddAcademicYear" class="btn btn-success"><span class="fa fa-user"></span> Add Academic Year</button></div>
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