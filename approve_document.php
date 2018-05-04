<?php
	require 'includes/includes.php';

	if(Doc::approve($_GET['doc_id'])){
		redirect_to($_GET['page']."?id=".@$_GET['id']."&&student_id=".@$_GET['student_id']);
	}
	else{
		redirect_to($_GET['page']."?id=".@$_GET['id']."&&student_id=".@$_GET['student_id']);
	}

	
?>