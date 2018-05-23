<?php
	require_once 'layouts/top.php';
?>
<br />
<?php
    if ($_SESSION['access_level'] == ADMIN) {
?>
<div class="">

    <div class="row top_tiles">
    
        <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i>
                </div>
                <div class="count"><?php echo User::total_students(); ?></div>

                <h3>Students</h3>

            <p class="text-right"><a href="students_report.php">View Report</a></p>
            </div>
        </div>

        <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-file"></i>
                </div>
                <div class="count"><?php echo Synopsis::total_synopsis(); ?></div>

                <h3>Synopsis</h3>

            <p class="text-right"><a href="synopsis_report.php">View Report</a></p>
            </div>
        </div>

    </div>


    </div>
</div>
<?php
    }
?>



                        
<?php
	require_once 'layouts/bottom.php';
?>