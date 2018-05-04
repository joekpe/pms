<?php
	class Chapter{
		function __construct(){

		}

		public static function new_chapter($name, $deadline, $close_date){
			global $database;
			$result = $database->query_db("INSERT INTO chapters(name, deadline, close_date) VALUES('".$name."', '".$deadline."', '".$close_date."') ");
			return $result;
		}

		public static function all(){
			global $database;
			$result = $database->query_db("SELECT * FROM chapters WHERE deleted='no'");
			return $result;
		}

		public static function find($id){
			global $database;
			$result = $database->query_db("SELECT * FROM chapters WHERE chapter_id = '".$id."' ");
			return $result;
		}

		public static function delete_chapter($id, $user_id){
			global $database;
			$result = $database->query_db("UPDATE chapters SET deleted='yes' WHERE chapter_id = '".$id."' ");
			return $result;
		}

		public static function update_chapter($name, $deadline, $close_date, $id){
			global $database;
			$result = $database->query_db("UPDATE chapters SET name = '".$name."', deadline = '".$deadline."', close_date = '".$close_date."' WHERE chapter_id = '".$id."' ");
			return $result;
		}

		public static function total_chapters(){
			global $database;
			$result = $database->query_db("SELECT * FROM chapters WHERE deleted = 'no' ");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function get_open_chapters(){
			global $database;
			$results = $database->query_db("SELECT * FROM chapters WHERE close_date >= CURDATE() ");
			return $results;
		}

	}
?>