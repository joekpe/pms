<?php
	require_once 'layouts/top.php';
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Declined Synopsis</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>
			



			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <select id="academic_year" onchange="updateYear(this.value)" class="form-control">
                            	<option>--Select Year--</option>
                            	<?php
	                        		$ac = AcademicYear::find_all();
	                        		while($row = $database->fetch_array($ac)){
	                        	?>
	                        		<option value="<?php echo $row['id'] ?>"><?php echo $row['academic_year']; ?></option>
	                        	<?php
	                        		}
	                        	?>
                            </select>
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
                        	<?php
                        		$syn = Synopsis::find_all_rejected_for_year(@$_GET['year']);
                        		if($database->num_rows($syn) > 0){
                        	?>
                        		<table class="table table-striped responsive-utilities jambo_table bulk_action">
	                                <thead>
	                                    <tr class="headings">
	                                        <th class="column-title"> # </th>
	                                        <th class="column-title">Student ID </th>
	                                        <th class="column-title">File </th>
	                                        <th class="column-title no-link last"><span class="nobr">Action</span>
	                                        </th>
	                                        <th class="bulk-actions" colspan="7">
	                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
	                                        </th>
	                            		</tr>
	                        		</thead>

		                            <tbody>
		                            	<?php
		                            		$counter = 1;
											while($row = $database->fetch_array($syn)){
										?>


		                                <tr class="<?php if( ($counter % 2) == 0 ){ echo "even"; }else{ echo "odd"; } ?> pointer">
		                                    <td class=" "><?php echo $counter; ?></td>
		                                    <td class=" "><?php echo $row['student_id']; ?></td>
		                                    <td class=" "><a href="uploads/<?php echo $row['file']; ?>">Download <span class="fa fa-download"></span></a></td>
		                                    
		                                    <td class=" ">
		                                    	<div class="btn-group" role="group" aria-label="...">
												  <a href="approve_synopsis.php?id=<?php echo $row['id']; ?>&&page=<?php echo basename($_SERVER['PHP_SELF'])."&&year=".@$_GET['year']."&&student_id=".$row['student_id']."&&topic=".$row['topic']; ?>" class="btn btn-default btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-thumbs-up"></i></a>
												  <a href="stall_synopsis.php?id=<?php echo $row['id']; ?>&&page=<?php echo basename($_SERVER['PHP_SELF'])."?year=".@$_GET['year']; ?>" class="btn btn-default btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Stall"><i class="fa fa-pause"></i></a>
												</div>
		                                    </td>
		                                </tr>

		                                <?php
		                                	$counter +=1 ;
											}
										?>
		                                            
		                            </tbody>

	                        	</table>
                        	<?php
                        		}
                        		else{
                        	?>
                        			<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>NOTHING TO SHOW... SELECT A DIFFERENT YEAR</div>
                        	<?php
                        		}
                        	?>
                            
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
<script type="text/javascript">
function updateYear(val){
 var element=document.getElementById('academic_year');
 location.assign('declined_synopsis.php?year='+val);
}

</script>