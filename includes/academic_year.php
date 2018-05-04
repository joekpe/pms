<?php
	class AcademicYear{
		

		function __construct()
		{
			
		}

		public static function total_years(){
			global $database;
			$result = $database->query_db("SELECT * FROM academic_years WHERE deleted = 'no'");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function new_aca_year($academic_year, $start_date, $end_date){
			global $database;
			$result = $database->query_db("INSERT INTO academic_years(academic_year, start_date, end_date) VALUES('".$academic_year."', '".$start_date."', '".$end_date."')");
			return $result;
		}

		public static function update_aca_year($id, $academic_year, $start_date, $end_date){
			global $database;
			$result = $database->query_db("UPDATE academic_years SET academic_year = '".$academic_year."', start_date = '".$start_date."', end_date = '".$end_date."' WHERE id = '".$id."'");
			return $result;
		}

		public static function delete_aca_year($id){
			global $database;
			$results = $database->query_db("UPDATE academic_years SET deleted='yes' WHERE id='".$id."'");
			return $results;
		}

		public static function find_by_id($id){
			global $database;
			$results = $database->query_db("SELECT * FROM academic_years WHERE id='".$id."'");
			return $results;
		}

		public static function find_all(){
			global $database;
			$results = $database->query_db("SELECT * FROM academic_years WHERE deleted='no'");
			return $results;
		}

		public static function get_open_aca_years(){
			global $database;
			$results = $database->query_db("SELECT * FROM academic_years WHERE start_date <= CURDATE() and end_date >=CURDATE() and  deleted='no'");
			return $results;
		}

	}

	
?>