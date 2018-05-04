<?php
	require_once 'layouts/top.php';
	$ac = AcademicYear::find_by_id($_GET['id']);
	$acad_year = $database->fetch_array($ac);

	if (isset($_POST['btnUpdateAcademicYear'])) {
	  	
	  	$id = @$_GET['id'];
	    $academic_year = $database->prep(trim($_POST['txtYear']));
	    $start_date = $database->prep(trim($_POST['txtStart']));
	    $end_date = $database->prep(trim($_POST['txtEnd']));
	      
        $result = AcademicYear::update_aca_year($id, $academic_year, $start_date, $end_date);
        if($result){
        	$message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>ACADEMIC YEAR UPDATED</div>";
       	}
       	else{
       		$message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>ACADEMIC YEAR NOT UPDATED</div>";	
       	}
	 
	}
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Edit <?php echo $acad_year['academic_year']; ?> Academic Year</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row"> <?php if(isset($message)) { echo $message; } ?></div>
				<form method="post" class="col-md-6 col-md-offset-3">
                        <div>
                        	<label>Academic Year</label>
                            <input type="text" class="form-control" placeholder="Academic Year" required="" name="txtYear" value="<?php echo $acad_year['academic_year'] ?>" />
                        </div><br>
                        <div>
                        	<label>Start Date For Synopsis Upload</label>
                            <input type="date" class="form-control" required="" name="txtStart" value="<?php echo $acad_year['start_date'] ?>"/>
                        </div><br>
                        <div>
                        	<label>End Date For Synopsis Upload</label>
                            <input type="date" class="form-control"  required="" name="txtEnd" value="<?php echo $acad_year['end_date'] ?>"/>
                        </div><br>
                        
                                             
                              <div><button type="submit" name="btnUpdateAcademicYear" class="btn btn-success"><span class="fa fa-user"></span> Update Academic Year</button></div>
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