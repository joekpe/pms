<?php
	require_once 'layouts/top.php';

	//all user
	
	if(@$_GET['year'] == '0'){
		$s = $database->query_db("SELECT * FROM users WHERE access_level = '".STUDENT."' ");
	}
	else{
		$s = User::get_students_for_year(@$_GET['year']);
	}
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Students List</small></h3>
				</div>
				<div class="col-md-6">
					<select id="academic_year" onchange="updateYear(this.value)" class="form-control">
	                	<option>--Select Year--</option>
	                	<option value="0">All</option>
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
                                <button type="button" class="btn btn-primary pull-right" onclick="printDiv('printableArea')">
                        Print
                    </button>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content" id="printableArea">

                            <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title"> # </th>
                                        <th class="column-title">Student ID </th>
                                        <th class="column-title">Name </th>
                                        <th class="column-title">E-mail </th>
                                        <th class="column-title">Phone </th>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                            		</tr>
                        		</thead>

	                            <tbody>
	                            	<?php
	                            		$counter = 1;
										while($stdid = $database->fetch_array($s)){
										$student = User::find_student($stdid['student_id']);
										$data = $database->fetch_array($student);

									?>


	                                <tr class="<?php if( ($counter % 2) == 0 ){ echo "even"; }else{ echo "odd"; } ?> pointer">
	                                    <td class=" "><?php echo $counter; ?></td>
	                                    <td class=" "><?php echo $data['student_id']; ?></td>
	                                    <td class=" "><?php echo $data['full_name']; ?></td>
	                                    <td class=" "><?php echo $data['email']; ?></td>
	                                    <td class=" "><?php echo $data['phone']; ?></td>
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
	<div class="col-md-6 col-md-offset-3 text-center alert alert-danger">NO RECORDS AVAILABLE</div>
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
 location.assign('students_report.php?year='+val);
}

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>