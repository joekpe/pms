<?php
	require_once 'layouts/top.php';

	//new chapter
	if (isset($_POST['btnSave'])) {
		$start_date = $database->prep(trim($_POST['txtStartDate']));
		$end_date = $database->prep(trim($_POST['txtEndDate']));

		if (set_open_day($start_date, $end_date)) {
?>
		<script type="text/javascript">
			location.assign('open_day.php?success=OPEN DAY SET');
		</script>
<?php
		}
		else{
?>
		<script type="text/javascript">
			location.assign('open_day.php?failed=FAILED TO SET OPEN DAY');
		</script>
<?php
		}
	}


?>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><i class="fa fa-th"></i> <small>Open Day Module</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row">
			     <div class="col-md-12">
			       <?php echo @$message; ?>
			       <?php
			        if (isset($_GET['success'])) {
			      ?>
			          <div class="col-md-4 col-md-offset-4 alert alert-success text-center"><?php echo @$_GET['success']; ?></div><br />
			      <?php
			        }
			        elseif(isset($_GET['failed'])){
			      ?>
			          <div class="col-md-4 col-md-offset-4 alert alert-danger text-center"><?php echo @$_GET['failed']; ?></div><br />
			      <?php
			        }
			      ?>
			     </div>
			  	</div>
			   <div class="row">
			    <div class="col-md-6">
			      <div class="panel panel-default">
			        <div class="panel-heading">
			          <strong>
			            <span class="glyphicon glyphicon-th"></span>
			            <span>Set Open Day Date</span>
			         </strong>
			        </div>
			        <div class="panel-body">
			          <form method="post">
			            <div class="form-group">
			            	<label>Start Date</label>
			                <input type="date" class="form-control" name="txtStartDate"  required value="<?php echo $open_day_start_date; ?>">
			            </div>
			            <div class="form-group">
			            	<label>End Date</label>
			                <input type="date" class="form-control" name="txtEndDate"  required value="<?php echo $open_day_end_date; ?>">
			            </div>
			            <button type="submit" name="btnSave" class="btn btn-primary"><i class="fa fa-th"></i> Set Date</button>
			        </form>
			        </div>
			      </div>
			    </div>
			    <div class="col-md-6">
			    <div class="panel panel-default">
			      <div class="panel-heading">
			        <strong>
			          <span class="glyphicon glyphicon-th"></span>
			          <span>Open Day</span>
			       </strong>
			      </div>
			        <div class="panel-body">
			          <table class="table table-bordered table-striped table-hover">
			            <thead>
			                <tr>
			                    <th>Start Date</th>
			                    <th>End Date</th>
			                   <!--  <th class="text-center" style="width: 100px;">Actions</th> -->
			                </tr>
			            </thead>
			            <tbody>
			                <tr>
			                    <td><?php echo $open_day_start_date; ?></td>
			                    <td><?php echo $open_day_end_date; ?></td>
			                   <!--  <td class="text-center">
			                      <div class="btn-group">
			                        <a href="schedule.php?id=<?php echo $chapter['chapter_id'];?>"  class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit">
			                          <i class="fa fa-pencil"></i>
			                        </a>
			                        <a href="delete_category.php?id=<?php echo $chapter['chapter_id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete">
			                          <i class="glyphicon glyphicon-trash"></i>
			                        </a>
			                      </div>
			                    </td> -->

			                </tr>
			            
			            </tbody>
			          </table>
			       </div>
			    </div>
			    </div>
			   </div>
			  </div>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>

</div>
<br />

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="schedule.php"  class="close"  aria-hidden="true">&times;</a>
                <h4 class="modal-title">Update Chapter</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
			        <div class="panel-heading">
			          <strong>
			            <span class="glyphicon glyphicon-th"></span>
			            <span>Update Chapter</span>
			         </strong>
			        </div>
			        <div class="panel-body">
			          <form method="post">
			            <div class="form-group">
			                <input type="text" class="form-control" name="txtUpdateChapterName" placeholder="Chapter Name" required value="<?php echo $c['name'] ?>">
			            </div>
			            <div class="form-group">
			            	<label>Deadline</label>
			                <input type="date" class="form-control" name="txtUpdateDeadline"  required value="<?php echo $c['deadline'] ?>">
			            </div>
			            <div class="form-group">
			            	<label>Close Date</label>
			                <input type="date" class="form-control" name="txtUpdateCloseDate"  required value="<?php echo $c['close_date'] ?>">
			            </div>
			            <button type="submit" name="btnUpdateChapter" class="btn btn-primary"><i class="fa fa-th"></i> Update Chater</button>
			        </form>
			        </div>
			      </div>
            </div>
        </div>
    </div>
</div>

<?php
	require_once 'layouts/bottom.php';
?>