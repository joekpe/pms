<?php
	require_once 'layouts/top.php';

	Comment::read_comments(@$_GET['doc_id']);

	//all comments
	$c = Comment::for_doc(@$_GET['doc_id']);
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><small>Comments</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>
			<?php
				if($database->num_rows($c) > 0){
			?>


			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>All comments <small>Custom design</small></h2>
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
                                        <th class="column-title">Comment </th>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                            		</tr>
                        		</thead>

	                            <tbody>
	                            	<?php
	                            		$counter = 1;
										while($comment = $database->fetch_array($c)){
									?>


	                                <tr class="<?php if( ($counter % 2) == 0 ){ echo "even"; }else{ echo "odd"; } ?> pointer">
	                                    <td class=" "><?php echo $counter; ?></td>
	                                    <td class=" "><?php echo $comment['comment']; ?></td>
	                                   
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
	<div class="col-md-6 col-md-offset-3 text-center alert alert-danger">NO COMMENTS ADDED YET</div>
<?php
	}
?>
<br />
<?php
	require_once 'layouts/bottom.php';
?>