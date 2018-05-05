<?php
  require_once 'layouts/top.php';


  //student details
  $stu = User::find_student(@$_GET['student_id']);
  $student = $database->fetch_array($stu);

  //synopsis detils
  $sy = Synopsis::find_by_student(@$_GET['student_id']);
  $synopsis = $database->fetch_array($sy);

  //post comment code
  if(isset($_POST['btnComment'])){
    $doc_id = $_GET['doc_id'];
    $comment = $database->prep($_POST['txtComment']);
    $supervisor_id = $_SESSION['user_id'];

    if(Comment::new_comment($doc_id, $comment, $supervisor_id)){
        echo "<script>alert('COMMENT POSTED'); location.assign('student_project_details.php?id=".$_GET['id']."&&student_id=".$_GET['student_id']."');</script>";
    }
    else{
        echo "<script>alert('FAILED TO POST COMMENT'); location.assign('student_project_details.php?id=".$_GET['id']."&&student_id=".$_GET['student_id']."');</script>";
    }
  }

  //endorse student code
  if(isset($_POST['btnEndorse'])){
    $result = $database->query_db("INSERT INTO defences(student_id) VALUES('".$_GET['student_id']."')");
    if($result){
      $message = "<div class='alert alert-success col-md-4 col-md-offset-4 text-center'>STUDENT ENDORSED</div>";
    }
    else{
      $message = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>FAILED TO ENDORSE STUDENT</div>";
    }
  }

?>

<?php
    if(@isset($_GET['doc_id'])){
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script>
<?php
    }
?>
<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script> -->

<div class="page-title">
    <div class="title_left">
        <h3>  </h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="row"> <?php if(isset($message)) { echo $message; } ?></div>
<div class="row">
  <div class="col-md-12">
      <div class="x_panel">
          <div class="x_title">
              <h2> <small>Data Sheet </small></h2>
              <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
              </ul>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">


          <section class="content invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12 invoice-header">
                    <h1>
            <i class="fa fa-globe"></i> Data Sheet.
            <small class="pull-right">Date: <?php echo @date('m/d/Y'); ?></small>
          </h1>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <u>Student Details</u>
                    <address>
            <strong><?php echo $student['full_name']; ?></strong>
            <br>Phone: <?php echo $student['phone']; ?>
            <br>Email: <?php echo $student['email']; ?>
          </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-8 invoice-col">
                    <u>Project Details</u>
                    <address>
            <strong><?php //cho @$order['customer_name']; ?></strong>
            <br>Topic: <?php echo @$synopsis['topic']; ?>
            <br>File: <a href="uploads/<?php echo @$synopsis['file']; ?>"><span class="fa fa-download"></span> Download</a>
          </address>
                </div>
                <!-- /.col -->
            
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Chapter #</th>
                                <th>Document</th>
                                <th>Action<th>
                                <th>Status</th>
                                <th>Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $ch = Chapter::all();
                              while($chapter = $database->fetch_array($ch)){
                            ?>
                            <tr class="odd pointer">
                                <td><?php echo ucfirst($chapter['name']); ?></td>
                                <td class=" ">
                                    <?php
                                        $d = Doc::get_chapter_doc($_GET['student_id'], $chapter['chapter_id']);
                                        $doc = $database->fetch_array($d);
                                        if(strlen($doc['file']) <= 0 ){
                                            echo "Not Available";
                                        }
                                        else{
                                    ?>
                                        <a href="uploads/<?php echo @$doc['file']; ?>"><span class="fa fa-download"></span> Download</a>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td class=" ">
                                    <?php
                                        $d = Doc::get_chapter_doc($_GET['student_id'], $chapter['chapter_id']);
                                        $doc = $database->fetch_array($d);
                                        if(strlen($doc['file']) <= 0 ){
                                            echo "N/A";
                                        }
                                        else{
                                    ?>
                                        <div class="btn-group" role="group" aria-label="...">
                                          <a href="student_project_details.php?id=<?php echo @$_GET['id']; ?>&&student_id=<?php echo @$_GET['student_id']; ?>&&doc_id=<?php echo $doc['doc_id']; ?>" class="btn btn-default btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Comment"><i class="fa fa-comments-o"></i></a>
                                          <a href="approve_document.php?doc_id=<?php echo $doc['doc_id']; ?>&&page=<?php echo basename($_SERVER['PHP_SELF'])."&&id=".@$_GET['id']."&&student_id=".@$_GET['student_id']; ?>" class="btn btn-default btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-thumbs-up"></i></a>
                                        </div>
                                    <?php
                                        }
                                    ?>

                                </td>
                                <td>
                                    <td class=" ">
                                    <?php
                                        $d = Doc::get_chapter_doc($_GET['student_id'], $chapter['chapter_id']);
                                        $doc = $database->fetch_array($d);
                                        if(strlen($doc['file']) <= 0 ){
                                            echo "N/A";
                                        }
                                        else{
                                            render_status($doc['status']);
                                        }
                                    ?>

                                </td>
                                </td>
                                <td>
                                  <?php render_submission_status($chapter['deadline'], $doc['date_uploaded']); ?>
                                </td>

                            </tr>
                            <?php
                              }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <h4><u><center>Open Day Records</center></u></h4>
              <div class="col-xs-12 table">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Inspector</th>
                                <th>Phone<th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $counter = 1;
                               $od = OpenDay::find_all_for_student($_GET['student_id']);
                              while($open_day = $database->fetch_array($od)){
                            ?>
                            <tr class="odd pointer">
                              <td><?php echo $counter; ?></td>
                                <td><?php echo ucfirst($open_day['inspector']); ?></td>
                                <td><?php echo ucfirst($open_day['phone']); ?></td>
                                <td><a href="single_entry.php?id=<?php echo $open_day['id']; ?>">View</a></td>
                                

                            </tr>
                            <?php
                            $counter +=1;
                              }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
              
            </div>

            
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                  <?php
                      $de = $database->query_db("SELECT * FROM defences WHERE student_id = '".$_GET['student_id']."' ");
                      if($database->num_rows($de) == 1){
                  ?>
                      <button class="btn btn-success"><span class="fa fa-thumbs-up"></span>Cleared</button>
                  <?php
                      }
                      else{
                  ?>
                      <form method="post">
                        <button class="btn btn-success" type="submit" name="btnEndorse">Endorse Student</button>
                      </form>
                  <?php
                      }
                  ?>
                    
                </div>
            </div>
          </section>

                
              
          </div>

        </div>
      </div>
  </div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="student_project_details.php?id=<?php echo @$_GET['id']; ?>&&student_id=<?php echo @$_GET['student_id']; ?>"  class="close"  aria-hidden="true">&times;</a>
                <h4 class="modal-title">Comment</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Comment</span>
                     </strong>
                    </div>
                    <div class="panel-body">
                      <form method="post">
                        <div class="form-group">
                            <label for="des">Comment*</label>
                            <textarea class="form-control" id="des" name="txtComment" required></textarea>
                        </div>
                        <button type="submit" name="btnComment" class="btn btn-primary"><i class="fa fa-comments-o"></i> Post Comment</button>
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