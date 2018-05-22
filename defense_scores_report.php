<?php
	require_once 'layouts/top.php';
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Defense Scores Report</small></h3>

				</div>
				<div class="col-md-6">
                    <button type="button" class="btn btn-primary pull-right" onclick="printJS({ printable: 'printJS-form', type: 'html', header: 'Defense Scores Report' })">
                        Print
                    </button>
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

                        <div class="x_content" id="printJS-form">
                        	<div class="row"> <?php if(isset($message)) { echo $message; } ?></div>
                        	<?php
                        		$data = Synopsis::find_all_for_year(@$_GET['year']);
                        		if($database->num_rows($data) > 0){
                        	?>
                        		<table class="table table-striped responsive-utilities jambo_table bulk_action">
	                                <thead>
	                                    <tr class="headings">
	                                        <th class="column-title"> # </th>
	                                        <th class="column-title">Student ID </th>
	                                        <th class="column-title">Name </th>
	                                        <th class="column-title">Internal Score </th>
	                                        <th class="column-title">External Score </th>
	                                        <th class="column-title">Total </th>
	                                        </th>
	                                        <th class="bulk-actions" colspan="7">
	                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
	                                        </th>
	                            		</tr>
	                        		</thead>

		                            <tbody>
		                            	<?php
		                            		$counter = 1;
											while($row = $database->fetch_array($data)){
												$sc = $database->query_db("SELECT internal_score, external_score FROM defences WHERE student_id = '".$row['student_id']."' ");
												$score = $database->fetch_array($sc);
										?>


		                                <tr class="<?php if( ($counter % 2) == 0 ){ echo "even"; }else{ echo "odd"; } ?> pointer">
		                                    <td class=" "><?php echo $counter; ?></td>
		                                    <td class=" "><?php echo $row['student_id']; ?></td>
		                                    <td class=" "><?php echo User::get_student_name($row['student_id']); ?></td>
		                                    <td class=" "><?php echo $score['internal_score']; ?></td>
		                                    <td class=" "><?php echo $score['external_score']; ?></td>
		                                    <td class=" "><?php echo $score['external_score'] + $score['internal_score']; ?></td>

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
 location.assign('defense_scores_report.php?year='+val);
}

</script>