<?php
	class OpenDay{

		function __construct()
		{
			
		}

	

		public static function new_entry($inspector, $phone, $comment, $student_id){
			global $database;
			$result = $database->query_db("INSERT INTO open_days(inspector, phone, student_id, date_inspected, comment) VALUES('".$inspector."', '".$phone."', '".$student_id."', CURDATE(), '".$comment."')");
			return $result;
		}



		public static function update_ENTRY($id, $inspector, $comment, $phone){
			global $database;
			$result = $database->query_db("UPDATE open_days SET inspector = '".$inspector."', comment = '".$comment."', phone = '".$phone."' WHERE id = '".$id."'");
			return $result;
		}

		public static function delete_user($id){
			global $database;
			$results = $database->query_db("DELETE FROM open_days  WHERE id='".$id."'");
			return $results;
		}

		public static function find_by_id($id){
			global $database;
			$results = $database->query_db("SELECT * FROM open_days WHERE id='".$id."'");
			return $results;
		}


		public static function find_all_for_student($student_id){
			global $database;
			$results = $database->query_db("SELECT * FROM open_days WHERE student_id = '".$student_id."' ");
			return $results;
		}


	}

	
?>