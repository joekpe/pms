<?php
	class Comment{
		function __construct(){

		}

		public static function new_comment($doc_id, $comment, $supervisor_id){
			global $database;
			$result = $database->query_db("INSERT INTO comments(doc_id, comment, supervisor_id, date_posted) VALUES('".$doc_id."', '".$comment."', '".$supervisor_id."', CURDATE()) ");
			return $result;
		}

		public static function all(){
			global $database;
			$result = $database->query_db("SELECT * FROM comments");
			return $result;
		}

		public static function for_doc($doc_id){
			global $database;
			$result = $database->query_db("SELECT * FROM comments WHERE doc_id = '".$doc_id."' ");
			return $result;
		}

		public static function total_unread_for_doc($doc_id){
			global $database;
			$result = $database->query_db("SELECT * FROM comments WHERE doc_id = '".$doc_id."' AND status = ".UNREAD." ");
			echo $database->num_rows($result);
		}

		public static function total_read_for_doc($doc_id){
			global $database;
			$result = $database->query_db("SELECT * FROM comments WHERE doc_id = '".$doc_id."' AND status = ".READ." ");
			echo $database->num_rows($result);
		}

		public static function read_comments($doc_id){
			global $database;
			$database->query_db("UPDATE comments SET status = ".READ." WHERE doc_id = '".$doc_id."'  ");
		}

		

	}
?>