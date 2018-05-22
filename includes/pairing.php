<?php
	class Pairing{
		

		function __construct()
		{
			
		}


		public static function new_pair($student_id, $supervisor_id, $synopsis_id, $academic_year){
			global $database;
			$result = $database->query_db("INSERT INTO pairings(student_id, supervisor_id, synopsis_id, academic_year) VALUES('".$student_id."', '".$supervisor_id."', '".$synopsis_id."', '".$academic_year."')");
			return $result;
		}

		public static function get_students_for_year($lecturer_id, $year){
			global $database;
			$results = $database->query_db("SELECT * FROM pairings WHERE supervisor_id = '".$lecturer_id."' AND academic_year = '".$year."' ");
			return $results;
		}

		public static function total_assigned_students($lecturer_id){
			global $database;
			$results = $database->query_db("SELECT * FROM pairings WHERE supervisor_id = '".$lecturer_id."' ");
			return $database->num_rows($results);
		}

		

	}

	
?>