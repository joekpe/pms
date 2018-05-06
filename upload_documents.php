<?php
	require_once 'layouts/top.php';


	//synopsis upload
	if(isset($_POST['btnUpload'])){
	  $chapter_id = $_POST['txtChapter'];
	  $student_id = $_SESSION['student_id'];
	  $file_name = uniqid()."-".$_FILES['txtFile']['name'];
	  $file_tmp =$_FILES['txtFile']['tmp_name'];
     
     if(Doc::new_doc($chapter_id, $student_id, $file_name)){
     	move_uploaded_file($file_tmp,"uploads/".$file_name);
     	$message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>DOCUMENT UPLOADED</div>";
     }
     else{
     	$message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>FAILED TO UPLOAD DOCUMENT</div>";
     }
	  
     
   }
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Document Upload</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>
			



			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Project Chapters Upload Form  <small></small></h2>
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
		                        	<label>Chapter</label>
		                            <select class="form-control" required="" name="txtChapter">
		                            	<option value="">--Select Chapter--</option>
		                            	<?php
		                            		$ch = Chapter::get_open_chapters();
		                            		while($row = $database->fetch_array($ch)){
		                            	?>
		                            		<option value="<?php echo $row['chapter_id'] ?>"><?php echo $row['name']; ?></option>
		                            	<?php
		                            		}
		                            	?>
		                            </select>
		                        </div><br>
		                        <div>
		                        	<label>File</label>
		                            <input type="file" class="form-control" required="" name="txtFile" />
		                        </div><br>		                        
		                                             
		                              <div><button type="submit" name="btnUpload" class="btn btn-success"><span class="fa fa-upload"></span> Upload Document</button></div>
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