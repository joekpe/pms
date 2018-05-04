<?php
	require_once 'layouts/top.php';

	//new chapter
	if (isset($_POST['btnSave'])) {
		$name = $database->prep(trim($_POST['txtChapterName']));
		$deadline = $database->prep(trim($_POST['txtDeadline']));
		$close_date = $database->prep(trim($_POST['txtCloseDate']));

		$result = Chapter::new_chapter($name, $deadline, $close_date);
		if ($result) {
			 $message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>CHAPTER SAVED</div>";
		}
		else{
			 $message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>FAILED TO SAVE CHAPTER</div>";
		}
	}

	//update categories
	if (isset($_POST['btnUpdateChapter'])) {
		$name = $database->prep(trim($_POST['txtUpdateChapterName']));
		$deadline = $database->prep(trim($_POST['txtUpdateDeadline']));
		$close_date = $database->prep(trim($_POST['txtUpdateCloseDate']));

		$result = Chapter::update_chapter($name, $deadline, $close_date, $_GET['id']);
		if ($result) {
			echo "<script>alert('CHAPTER UPDATED'); location.assign('schedule.php');</script>";
		}
		else{
			 echo "<script>alert('FAILED TO UPDATE CHAPTER'); location.assign('schedule.php');</script>";
		}
		
	}

	//get chapters
	$ch = Chapter::all();


?>

<?php
	if(@isset($_GET['id'])){
	//finding single chapter
	$chapt = Chapter::find(@$_GET['id']);
	$c = $database->fetch_array($chapt);
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script>
<?php
	}
?>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">

			<div class="row x_title">
				<div class="col-md-6">
					<h3><i class="fa fa-th"></i> <small>Manage Chapters</small></h3>
				</div>
				<div class="col-md-6">

				</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row">
			     <div class="col-md-12">
			       <?php echo @$message; ?>
			     </div>
			  	</div>
			   <div class="row">
			    <div class="col-md-4">
			      <div class="panel panel-default">
			        <div class="panel-heading">
			          <strong>
			            <span class="glyphicon glyphicon-th"></span>
			            <span>Add New Chapter</span>
			         </strong>
			        </div>
			        <div class="panel-body">
			          <form method="post">
			            <div class="form-group">
			            	<label>Chapter Name</label>
			                <input type="text" class="form-control" name="txtChapterName" placeholder="Chapter Name" required>
			            </div>
			            <div class="form-group">
			            	<label>Deadline</label>
			                <input type="date" class="form-control" name="txtDeadline"  required>
			            </div>
			            <div class="form-group">
			            	<label>Close Date</label>
			                <input type="date" class="form-control" name="txtCloseDate"  required>
			            </div>
			            <button type="submit" name="btnSave" class="btn btn-primary"><i class="fa fa-th"></i> Add Chapter</button>
			        </form>
			        </div>
			      </div>
			    </div>
			    <div class="col-md-8">
			    <div class="panel panel-default">
			      <div class="panel-heading">
			        <strong>
			          <span class="glyphicon glyphicon-th"></span>
			          <span>All Chapters</span>
			       </strong>
			      </div>
			        <div class="panel-body">
			          <table class="table table-bordered table-striped table-hover">
			            <thead>
			                <tr>
			                    <th class="text-center" style="width: 50px;">#</th>
			                    <th>Chapters</th>
			                    <th>Deadline</th>
			                    <th class="text-center" style="width: 100px;">Actions</th>
			                </tr>
			            </thead>
			            <tbody>
			              <?php 
			                $counter = 1;
			                while ($chapter = $database->fetch_array($ch)){
			              ?>
			                <tr>
			                    <td class="text-center"><?php echo $counter;?></td>
			                    <td><?php echo ucfirst($chapter['name']); ?></td>
			                    <td><?php echo ucfirst($chapter['deadline']); ?></td>
			                    <td class="text-center">
			                      <div class="btn-group">
			                        <a href="schedule.php?id=<?php echo $chapter['chapter_id'];?>"  class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit">
			                          <i class="fa fa-pencil"></i>
			                        </a>
			                        <a href="delete_category.php?id=<?php echo $chapter['chapter_id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete">
			                          <i class="glyphicon glyphicon-trash"></i>
			                        </a>
			                      </div>
			                    </td>

			                </tr>
			              <?php 
			                $counter += 1;
			                } 
			              ?>
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