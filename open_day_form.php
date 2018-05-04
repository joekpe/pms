<?php
	require_once 'layouts/top.php';

	if (isset($_POST['btnSave'])) {
	  
	    $inspector = $database->prep(trim($_POST['txtName']));
	    $phone = $database->prep(trim($_POST['txtPhone']));
	    $comment = $database->prep(trim($_POST['txtComment']));
	  
	      
        $result = OpenDay::new_entry($inspector, $phone, $comment, $_SESSION['student_id']);
        if($result){
        	$message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>ENTRY SAVED</div>";
       }
       else{
       		$message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>ENTRY NOT SAVED</div>";
       }
	    
	  
	}
?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>New Entry</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row"> <?php if(isset($message)) { echo $message; } ?></div>
				<form method="post" class="col-md-6 col-md-offset-3">
                        <div>
                        	<label>Inspector Name</label>
                            <input type="text" class="form-control" placeholder="Full Name" required="" name="txtName" />
                        </div><br>
                        <div>
                        	<label>Phone</label>
                            <input type="text" class="form-control" placeholder="Phone Number" required="" name="txtPhone" />
                        </div><br>
                        <div>
                        	<label>Other Comments / Description</label>
                            <textarea class="form-control" name="txtComment"></textarea>
                        </div><br>
                       
                        <div class="clearfix"></div>
                        <div class="separator">

                        <button class="btn btn-success" name="btnSave">Save</button>
                           
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