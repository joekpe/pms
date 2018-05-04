<?php
	require 'includes/includes.php';

	if(Synopsis::stall($_GET['id'])){
		redirect_to($_GET['page']);
	}
	else{
		redirect_to($_GET['page']);
	}

	
?>