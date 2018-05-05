<?php
	class Doc{
		

		function __construct()
		{
			
		}

		public static function find($student_id, $chapter_id){
			global $database;
			$results = $database->query_db("SELECT * FROM docs WHERE student_id = '".$student_id."' AND chapter_id = '".$chapter_id."' ");
			return $results;
		}


		public static function new_doc($chapter_id, $student_id, $file){
			global $database;
			

			//checking if student has already uploaded
			$st = Doc::find($student_id, $chapter_id);
		    $status = $database->fetch_array($st);
			if( strlen($status['status']) > 0 ){
				$result = $database->query_db("UPDATE docs SET file = '".$file."', date_uploaded = CURDATE(), status = 'warning' WHERE student_id = '".$student_id."' AND chapter_id = '".$chapter_id."' ");
			}
			else{
				$result = $database->query_db("INSERT INTO docs(student_id, chapter_id, file, date_uploaded, status) VALUES('".$student_id."', '".$chapter_id."', '".$file."', CURDATE(), 'warning')");
			}

			return $result;
		}


		public static function delete_doc($id){
			global $database;
			$results = $database->query_db("DELETE FROM docs WHERE doc_id='".$id."'");
			return $results;
		}

		public static function approve($id){
			global $database;
			$results = $database->query_db("UPDATE docs SET status = '".APPROVED."' WHERE doc_id='".$id."'");
			return $results;
		}

		public static function reject($id){
			global $database;
			$results = $database->query_db("UPDATE docs SET status = '".DECLINED."' WHERE doc_id='".$id."'");
			return $results;
		}

		public static function stall($id){
			global $database;
			$results = $database->query_db("UPDATE docs SET status = 'warning' WHERE doc_id='".$id."'");
			return $results;
		}

		public static function get_chapter_doc($student_id, $chapter_id){
			global $database;
			$results = $database->query_db("SELECT * FROM docs WHERE student_id = '".$student_id."' AND chapter_id = '".$chapter_id."' ");
			return $results;
		}


		// public static function find_all_for_year($academic_year){
		// 	global $database;
		// 	$results = $database->query_db("SELECT * FROM synopsis WHERE academic_year = '".$academic_year."'");
		// 	return $results;
		// }

		// public static function find_all_pending_for_year($academic_year){
		// 	global $database;
		// 	$results = $database->query_db("SELECT * FROM synopsis WHERE academic_year = '".$academic_year."' AND status = 'warning' ");
		// 	return $results;
		// }

		// public static function find_all_rejected_for_year($academic_year){
		// 	global $database;
		// 	$results = $database->query_db("SELECT * FROM synopsis WHERE academic_year = '".$academic_year."' AND status = '".DECLINED."' ");
		// 	return $results;
		// }

		// public static function find_all_approved_for_year($academic_year){
		// 	global $database;
		// 	$results = $database->query_db("SELECT * FROM synopsis WHERE academic_year = '".$academic_year."' AND status = '".APPROVED."' ");
		// 	return $results;
		// }

		// public static function find_by_student($student_id){
		// 	global $database;
		// 	$results = $database->query_db("SELECT * FROM synopsis WHERE student_id = '".$student_id."'");
		// 	return $results;
		// }

		

		public static function get_topic($synopsis_id){
			global $database;
			$result = $database->query_db("SELECT topic FROM synopsis WHERE id = '".$synopsis_id."'");
			$topic = $database->fetch_array($result);
			echo $topic['topic'];
		}


	}

	
?>