<?php
	function redirect_to($location)
	{
		header("Location: {$location}");
	}


	function render_status($status){
		if($status == 'success'){
                
        	echo '<button class="btn btn-success"><span class="fa fa-thumbs-up"></span>Approved</button>';
    
        }
        elseif($status == 'warning'){
    
         echo '<button class="btn btn-warning"><span class="fa fa-pause"></span>Pending</button>';
    
        }
        elseif($status == 'danger'){
    
        echo '<button class="btn btn-danger"><span class="fa fa-thumbs-down"></span>Declined</button>';
   
        }
        else{
            echo '<button class="btn btn-primary"><span class="fa fa-close"></span>Not Uploaded</button>';
        }
	}

    function render_submission_status($deadline, $submission_date){

        if(strlen($submission_date) <= 0){
            echo 'N/A';
        }
        elseif($deadline > $submission_date){
                
            echo '<button class="btn btn-success"><span class="fa fa-thumbs-up"></span>Early</button>';
    
        }
        elseif($deadline == $submission_date){
    
         echo '<button class="btn btn-warning"><span class="fa fa-warning"></span>On Time</button>';
    
        }
        elseif($deadline < $submission_date){
    
        echo '<button class="btn btn-danger"><span class="fa fa-thumbs-down"></span>Late</button>';
   
        }

    }

    function set_open_day($start_date, $end_date){
        $link = "includes/open_day.php";
        $open_day = fopen($link, "w");
        $txt = '
            <?php
                $open_day_start_date = "'.$start_date.'";
                $open_day_end_date = "'.$end_date.'";
            ?>
        ';

        fwrite($open_day, $txt);
        fclose($open_day);

        return true;
    }

?>