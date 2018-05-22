<?php
    require_once 'includes/includes.php';

    session_start();
    if(!Session::is_authenticated()){
        redirect_to('index.php');
    }
    //destroying session
    if(isset($_POST['btnLogout'])){
        Session::logout();
        redirect_to('index.php');
    }

    // //checking if password has been changed
    // User::check_username_password();

    //getting user details
    $res = User::find_by_id($_SESSION['user_id']);
    $user = $database->fetch_array($res);


?>
<?php
    include 'includes/open_day.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PMS</title>

    <!-- Bootstrap core CSS -->

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="assets/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="assets/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="assets/css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://printjs-4de6.kxcdn.com/print.min.css" rel="stylesheet">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/nprogress.js"></script>

    <link href="assets/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">

    <script src="assets/js/jquery.min.js"></script>

    <!--data table-->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
    <script type="text/javascript" language="javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="assets/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="https://printjs-4de6.kxcdn.com/print.min.js"></script>



</head>


<body class="nav-md" style="font-family: 'Raleway';">
    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="dashboard.php" class="site_title"><i class="fa fa-home"></i> <span>PMS</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="row profile">
                        <div class="profile_pic">
                            <img src="assets/images/user.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo ucwords($user['full_name']); ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>MENU</h3>    
                            <ul class="nav side-menu">
                                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                                <?php
                                    if ($_SESSION['access_level'] == ADMIN) {
                                ?>
                                    
                                    
                                    <li><a><i class="fa fa-users"></i> User Management <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="new_user.php">Add User</a>
                                            </li>
                                            <li><a href="manage_users.php">Manage Users</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li><a><i class="fa fa-calendar"></i> Academic Years <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="new_aca_year.php">Add Aca. Yr.</a>
                                            </li>
                                            <li><a href="manage_aca_years.php">Manage Aca. Yr.</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li><a><i class="fa fa-file"></i> Synopsis <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="pending_synopsis.php">Pending</a>
                                            </li>
                                            <li><a href="approved_synopsis.php">Approved</a>
                                            </li>
                                            <li><a href="declined_synopsis.php">Declined</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="schedule.php"><i class="fa fa-th"></i>Schedule Management</a>
                                    </li>

                                    <li>
                                        <a href="manage_open_day.php"><i class="fa fa-th"></i>Open Day</a>
                                    </li>

                                    <li>
                                        <a href="project_docs_upload.php"><i class="fa fa-file-o"></i>Upload Project Documents</a>
                                    </li>

                                    <li>
                                        <a href="upload_scores.php"><i class="fa fa-file-o"></i>Upload Scores</a>
                                    </li>

                                    <li>
                                        <a href="defense_scores_report.php"><i class="fa fa-file-o"></i>Defense Scores Report</a>
                                    </li>

                                    <li>
                                        <a href="reset_student_password.php"><i class="fa fa-lock"></i>Reset Student Password</a>
                                    </li>
                                    
                                  
                                <?php
                                    }
                                ?>

                                <?php
                                    if ($_SESSION['access_level'] == STUDENT) {
                                ?>
                                    
                                    
                                    <li><a href="upload_synopsis.php"><i class="fa fa-file"></i> Upload Synopsis</a></li>
                                    <li><a href="upload_documents.php"><i class="fa fa-clipboard"></i> Upload Documents</a></li>

                                    <?php 
                                        if( ($open_day_start_date <= date('Y-m-d')) and ($open_day_end_date >= date('Y-m-d')) ){
                                    ?>
                                    <li><a href="open_day_form.php"><i class="fa fa-calendar"></i> Open Day</a></li>
                                    <?php
                                        }
                                    ?>
                                    
                                    
                                  
                                <?php
                                    }
                                ?>

                                <?php
                                    if ($_SESSION['access_level'] == SUPERVISOR) {
                                ?>
                                    
                                    
                                    <li><a href="assigned_students.php?year=0"><i class="fa fa-users"></i> Assigned Students</a></li>
                                    
                                  
                                <?php
                                    }
                                ?>

                                

                                 


                                
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a> -->
                        <a data-toggle="modal" data-target="#logout">
                            <span data-toggle="tooltip" data-placement="top" title="Logout" class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">

                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="fa fa-wrench"></span> Settings
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="profile.php"><i class="fa fa-user pull-right"></i>   Profile</a>
                                    </li>
                                    <li><a href="" data-toggle="modal" data-target="#logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                    if ($_SESSION['access_level'] == STUDENT) {
                                ?>
                                    
                                    
                                    <li class="">
                                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="fa fa-download"></span> Downloads
                                            <span class=" fa fa-angle-down"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                            <?php
                                                $f = $database->query_db("SELECT * FROM project_documents");
                                                    $counter = 1;
                                                    while($file = $database->fetch_array($f)){
                                                ?>

                                                <li><a href="uploads/<?php echo $file['file'] ?>" target="_blank"><?php echo ucfirst($file['name']); ?></a></li>

                                                <?php
                                                    $counter +=1 ;
                                                    }
                                                ?>
                                        </ul>
                                    </li>
                                    
                                <?php
                                    }
                                ?>
                            


                           
                            

                            

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                 <!--sign out modal-->
                <div class="modal fade" id="logout">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal">&times;</button>
                                
                                <h4 class="modal-title"><span class="glyphicon glyphicon-off"></span> Log Out</h4>
                            </div><!-- end modal-header -->
                            <div class="modal-body">
                                <p><b>Are You Sure?<b></p>                      
                            </div><!-- end modal-body -->
                            
                            <div class="modal-footer">
                                <form method="post">
                                    <button type="submit" class="btn btn-success" name="btnLogout">Yes</button> <button class="btn btn-danger" data-dismiss="modal">No</button>
                                </form>
                            </div><!-- end modal-footer -->
                        </div><!-- end modal-content -->
                    </div><!-- end modal-dialog -->
                </div><!-- end myModal -->
