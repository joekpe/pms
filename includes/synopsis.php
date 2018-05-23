<?php
	class Synopsis{
		

		function __construct()
		{
			
		}

		public static function total_synopsis_for_year($academic_year){
			global $database;
			$result = $database->query_db("SELECT * FROM synopsis WHERE academic_year = '".$academic_year."'");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function total_synopsis(){
			global $database;
			$result = $database->query_db("SELECT * FROM synopsis");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function approved_projects(){
			global $database;
			$result = $database->query_db("SELECT * FROM synopsis WHERE status = '".APPROVED."'");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function pending_projects(){
			global $database;
			$result = $database->query_db("SELECT * FROM synopsis WHERE status = 'warning' ");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function declined_projects(){
			global $database;
			$result = $database->query_db("SELECT * FROM synopsis WHERE status = '".DECLINED."'");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function new_synopsis($student_id, $academic_year, $file, $topic){
			global $database;
			

			//checking is student is eligible for another upload
			$st = Synopsis::check_status($student_id);
		    $status = $database->fetch_array($st);
			if($status['status'] == 'danger' ){
				$result = $database->query_db("UPDATE synopsis SET file = '".$file."', academic_year = '".$academic_year."', topic = '".$topic."', date_uploaded = CURDATE(), status = 'warning' WHERE student_id = '".$student_id."' ");
			}
			else{
				$result = $database->query_db("INSERT INTO synopsis(student_id, academic_year, file, topic, date_uploaded) VALUES('".$student_id."', '".$academic_year."', '".$file."', '".$topic."', CURDATE())");
			}

			return $result;
		}


		public static function delete_synopsis($id){
			global $database;
			$results = $database->query_db("DELETE FROM synopsis WHERE id='".$id."'");
			return $results;
		}

		public static function approve($id){
			global $database;
			$results = $database->query_db("UPDATE synopsis SET status = '".APPROVED."' WHERE id='".$id."'");
			return $results;
		}

		public static function reject($id){
			global $database;
			$results = $database->query_db("UPDATE synopsis SET status = '".DECLINED."' WHERE id='".$id."'");
			return $results;
		}

		public static function stall($id){
			global $database;
			$results = $database->query_db("UPDATE synopsis SET status = 'warning' WHERE id='".$id."'");
			return $results;
		}


		public static function find_all_for_year($academic_year){
			global $database;
			$results = $database->query_db("SELECT * FROM synopsis WHERE academic_year = '".$academic_year."'");
			return $results;
		}

		public static function find_all_pending_for_year($academic_year){
			global $database;
			$results = $database->query_db("SELECT * FROM synopsis WHERE academic_year = '".$academic_year."' AND status = 'warning' ");
			return $results;
		}

		public static function find_all_rejected_for_year($academic_year){
			global $database;
			$results = $database->query_db("SELECT * FROM synopsis WHERE academic_year = '".$academic_year."' AND status = '".DECLINED."' ");
			return $results;
		}

		public static function find_all_approved_for_year($academic_year){
			global $database;
			$results = $database->query_db("SELECT * FROM synopsis WHERE academic_year = '".$academic_year."' AND status = '".APPROVED."' ");
			return $results;
		}

		public static function find_by_student($student_id){
			global $database;
			$results = $database->query_db("SELECT * FROM synopsis WHERE student_id = '".$student_id."'");
			return $results;
		}

		public static function check_status($student_id){
			global $database;
			$results = $database->query_db("SELECT status FROM synopsis WHERE student_id = '".$student_id."'");
			return $results;
		}

		public static function get_topic($synopsis_id){
			global $database;
			$result = $database->query_db("SELECT topic FROM synopsis WHERE id = '".$synopsis_id."'");
			$topic = $database->fetch_array($result);
			echo $topic['topic'];
		}


	}

	
?>