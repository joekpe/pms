<?php
	require_once 'layouts/top.php';


	//synopsis upload
	if(isset($_POST['btnUpload'])){
	  $name = $_POST['txtName'];
	  $file_name = uniqid()."-".$_FILES['txtFile']['name'];
	  $file_tmp =$_FILES['txtFile']['tmp_name'];
     $result = $database->query_db("INSERT INTO project_documents(name, file) VALUES('".$name."', '".$file_name."')");
     if($result){
     	move_uploaded_file($file_tmp,"uploads/".$file_name);
     	$message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>PROJECT DOCUMENT UPLOADED</div>";
     }
     else{
     	$message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>FAILED TO UPLOAD PROJECT DOCUMENT</div>";
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
                            <h2>Project Document Upload Form  <small></small></h2>
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
		                        	<label>File Name</label>
		                            <input type="text" name="txtName" class="form-control" required>
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
			<h3><center>Uploaded Project Documents</center></h3>
			<table class="table table-striped responsive-utilities jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title"> # </th>
                        <th class="column-title">File Name </th>
                        <th class="column-title"> Download </th>
                        <th class="column-title no-link last"><span class="nobr">Delete</span>
                        </th>
                        <th class="bulk-actions" colspan="7">
                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                        </th>
            		</tr>
        		</thead>

                <tbody>
                	<?php
                	$f = $database->query_db("SELECT * FROM project_documents");
                		$counter = 1;
						while($file = $database->fetch_array($f)){
					?>


                    <tr class="<?php if( ($counter % 2) == 0 ){ echo "even"; }else{ echo "odd"; } ?> pointer">
                        <td class=" "><?php echo $counter; ?></td>
                        <td class=" "><?php echo $file['name']; ?></td>
                        <td class=" "><a href="uploads/<?php echo $file['file']; ?>">Download</a></td>
                        <td class=" ">
                        	<div class="btn-group" role="group" aria-label="...">
							  <a href="delete_project_doc.php?id=<?php echo $file['id']; ?>" class="btn btn-default btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
							</div>
                        </td>
                    </tr>

                    <?php
                    	$counter +=1 ;
						}
					?>
                                
                </tbody>

        	</table>

			<div class="clearfix"></div>
		</div>
	</div>

</div>
<br />

<?php
	require_once 'layouts/bottom.php';
?>