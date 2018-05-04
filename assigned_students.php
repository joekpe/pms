<?php
	require_once 'layouts/top.php';

	//all user
	$s = Pairing::get_students_for_year($_SESSION['user_id'], @$_GET['year']);
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Assigned Students</small></h3>
				</div>
				<div class="col-md-6">
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
				</div>
			</div>
			<?php
				if($database->num_rows($s) > 0){
			?>


			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title"> # </th>
                                        <th class="column-title">Student ID </th>
                                        <th class="column-title">Topic </th>
                                        <th class="column-title no-link last"><span class="nobr">View Details</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                            		</tr>
                        		</thead>

	                            <tbody>
	                            	<?php
	                            		$counter = 1;
										while($pairing = $database->fetch_array($s)){
									?>


	                                <tr class="<?php if( ($counter % 2) == 0 ){ echo "even"; }else{ echo "odd"; } ?> pointer">
	                                    <td class=" "><?php echo $counter; ?></td>
	                                    <td class=" "><?php echo $pairing['student_id']; ?></td>
	                                    <td class=" "><?php Synopsis::get_topic($pairing['synopsis_id']); ?></td>
	                                    
	                                    <td class=" ">
	                                    	<div class="btn-group" role="group" aria-label="...">
											  <a href="student_project_details.php?id=<?php echo $pairing['id']; ?>&&student_id=<?php echo $pairing['student_id']; ?>" class="btn btn-default btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
											</div>
	                                    </td>
	                                </tr>

	                                <?php
	                                	$counter +=1 ;
										}
									?>
	                                            
	                            </tbody>

                        	</table>
                        </div>
                    </div>
                </div>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>

</div>
<?php
	
	}
	else{
?>
	<div class="col-md-6 col-md-offset-3 text-center alert alert-danger">NO STUDENTS ASSIGNED</div>
<?php
	}
?>
<br />
<?php
	require_once 'layouts/bottom.php';
?>
<script type="text/javascript">
function updateYear(val){
 var element=document.getElementById('academic_year');
 location.assign('assigned_students.php?year='+val);
}

</script>