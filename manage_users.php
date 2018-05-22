<?php
	require_once 'layouts/top.php';

	//all user
	$u = User::find_all();
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Manage Users</small></h3>
				</div>
				<div class="col-md-6">
                    <button type="button" class="btn btn-primary pull-right" onclick="printJS({ printable: 'printJS-form', type: 'html', header: 'Defense Scores Report' })">
                        Print
                    </button>
				</div>
			</div>
			<?php
				if($database->num_rows($u) > 0){
			?>


			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>All users <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content" id="printJS-form">

                            <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title"> # </th>
                                        <th class="column-title">Full Name </th>
                                        <th class="column-title">E-mail </th>
                                        <th class="column-title">Access Level </th>
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
										while($user = $database->fetch_array($u)){
									?>


	                                <tr class="<?php if( ($counter % 2) == 0 ){ echo "even"; }else{ echo "odd"; } ?> pointer">
	                                    <td class=" "><?php echo $counter; ?></td>
	                                    <td class=" "><?php echo $user['full_name']; ?></td>
	                                    <td class=" "><?php echo $user['email']; ?></td>
	                                    <td class=" ">
	                                    	<?php
	                                     		if($user['access_level'] == ADMIN){
	                                     			echo "Administrator";
	                                     		}
	                                     		elseif($user['access_level'] == SUPERVISOR){
	                                     			echo "Supervisor";
	                                     		}
	                                     		else{
	                                     			echo "Student";
	                                     		}
	                                     	?>
	                                     </td>
	                                    <td class=" ">
	                                    	<div class="btn-group" role="group" aria-label="...">
											  <a href="edit_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-default btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
											  <a href="delete_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-default btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
	<div class="col-md-6 col-md-offset-3 text-center alert alert-danger">NO USERS ADDED YET</div>
<?php
	}
?>
<br />
<?php
	require_once 'layouts/bottom.php';
?>