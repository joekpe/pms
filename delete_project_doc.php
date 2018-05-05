<?php
	require 'includes/includes.php';

	$database->query_db("DELETE FROM project_documents WHERE id = '".$_GET['id']."' ");

	redirect_to('project_docs_upload.php');
?>