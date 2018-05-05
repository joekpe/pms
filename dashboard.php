<?php
	require_once 'layouts/top.php';
?>
<br />
<?php
    if ($_SESSION['access_level'] == ADMIN) {
?>
<div class="">

    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i>
                </div>
                <div class="count"><?php echo User::total_users(); ?></div>

                <h3>Users</h3>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>

<?php
    if ($_SESSION['access_level'] == STUDENT) {
?>
<table class="table table-striped responsive-utilities jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title"> # </th>
            <th class="column-title">Stage </th>
            <th class="column-title no-link last"><span class="nobr">Status</span>
            </th>
            <th class="column-title no-link last"><span class="nobr">Comments</span>
            </th>
            <th class="column-title no-link last"><span class="nobr">Info</span>
            </th>
        </tr>
    </thead>

    <tbody>

        <tr class="odd pointer">
            <td class=" ">1.</td>
            <td class=" ">Synopsis</td>
            <td class=" ">
                <?php
                    $st = Synopsis::check_status($_SESSION['student_id']);
                    $status = $database->fetch_array($st);
                    
                    render_status($status['status']);
                ?>
            </td>
            <td> - </td>
            <td> - </td>
        </tr>
        <?php
            $ch = Chapter::all();
            $counter = 2;
            while ($chapter = $database->fetch_array($ch)){
        ?>

            <tr class="odd pointer">
                <td class=" "><?php echo $counter;?></td>
                <td><?php echo ucfirst($chapter['name']); ?></td>
                <td class=" ">
                <?php
                    $d = Doc::find($_SESSION['student_id'], $chapter['chapter_id']);
                    $doc = $database->fetch_array($d);
                    
                    render_status($doc['status']);
                ?>
                </td>
                <td>
                    <a href="comments.php?doc_id=<?php echo $doc['doc_id']; ?>">View Comments 
                        <br> (<span>Unread: <?php Comment::total_unread_for_doc($doc['doc_id']) ?>, Read: <?php Comment::total_read_for_doc($doc['doc_id']) ?></span>) </a>
                </td>
                <td>
                    <?php render_submission_status($chapter['deadline'], $doc['date_uploaded']); ?>
                    
                </td>

            </tr>
        <?php 
            $counter += 1;
            } 
        
        ?>
        <tr>
            <td class=" "><?php echo $counter; ?>.</td>
            <td class=" ">Defence Clearance</td>
            <td class=" ">
                <?php
                    $de = $database->query_db("SELECT * FROM defences WHERE student_id = '".$_SESSION['student_id']."' ");
                    if($database->num_rows($de) == 1){
                ?>
                    <button class="btn btn-success"><span class="fa fa-thumbs-up"></span>Cleared</button>
                <?php
                    }
                    else{
                ?>
                    <button class="btn btn-danger"><span class="fa fa-thumbs-up"></span>Not Cleared</button>
                <?php
                    }
                ?>
            </td>
            <td> - </td>
            <td> - </td>
        </tr>

        <tr>
            <td class=" "><?php echo $counter + 1; ?>.</td>
            <td class=" ">Internal Assessment</td>
            <td class=" ">
                <?php
                    $de = $database->query_db("SELECT * FROM defences WHERE student_id = '".$_SESSION['student_id']."' ");
                    $internal = $database->fetch_array($de);
                    if($internal['internal_score'] == 0.00){
                ?>
                    <button class="btn btn-danger"><span class="fa fa-thumbs-down"></span>Not Uploaded</button>
                <?php
                    }
                    elseif($internal['internal_score'] > 0.00){
                ?>
                    <button class="btn btn-success"><span class="fa fa-thumbs-up"></span>Uploaded</button>
                <?php
                    }
                ?>
            </td>
            <td> - </td>
            <td> - </td>
        </tr>
        <tr>
            <td class=" "><?php echo $counter + 2; ?>.</td>
            <td class=" ">External Assessment</td>
            <td class=" ">
                <?php
                    $de = $database->query_db("SELECT * FROM defences WHERE student_id = '".$_SESSION['student_id']."' ");
                    $external = $database->fetch_array($de);
                    if($external['external_score'] == 0.00){
                ?>
                    <button class="btn btn-danger"><span class="fa fa-thumbs-down"></span>Not Uploaded</button>
                <?php
                    }
                    elseif($external['external_score'] > 0.00){
                ?>
                    <button class="btn btn-success"><span class="fa fa-thumbs-up"></span>Uploaded</button>
                <?php
                    }
                ?>
            </td>
            <td> - </td>
            <td> - </td>
        </tr>
         
    </tbody>

</table>
    
  
<?php
    }
?>
                        
<?php
	require_once 'layouts/bottom.php';
?>