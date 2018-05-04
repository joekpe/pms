<?php
	require 'includes/includes.php';

	User::delete_user($_GET['id']);

	redirect_to('manage_users.php');
?>