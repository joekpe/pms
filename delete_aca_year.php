<?php
	require 'includes/includes.php';

	AcademicYear::delete_aca_year($_GET['id']);

	redirect_to('manage_aca_years.php');
?>