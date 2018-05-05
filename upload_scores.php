<?php
	require_once 'layouts/top.php';


if(isset($_POST["btnUpload"])){
 
 
        echo $filename=$_FILES["txtFile"]["tmp_name"];
 
 
         if($_FILES["txtFile"]["size"] > 0)
         {
 
            $file = fopen($filename, "r");
             while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
             {
 
              //It wiil insert a row to our subject table from our csv file`
               $sql = "UPDATE defences SET internal_score = '$emapData[1]', external_score = '$emapData[2]' WHERE student_id = '$emapData[0]' ";
             //we are using mysql_query function. it returns a resource on true else False on error
              $result = $database->query_db( $sql);
                if(! $result )
                {
                    echo "<script type=\"text/javascript\">
                            alert(\"Invalid File:Please Upload CSV File.\");
                        </script>";
 
                }
 
             }
             fclose($file);
             //throws a message if data successfully imported to mysql database from excel file
             echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                    </script>";
 
 
 
 
         }
    }    
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Scores Upload</small></h3>
				</div>
				<div class="col-md-6">
                    <a href="docs/defence_scores.csv">Click Here To Download Scores Form Template</a>
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