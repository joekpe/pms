<?php
	class User{
		var $name;
		var $email;
		var $password;
		var $access_level;
		

		function __construct()
		{
			
		}

		public static function total_users(){
			global $database;
			$result = $database->query_db("SELECT * FROM users");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function total_students(){
			global $database;
			$result = $database->query_db("SELECT * FROM users WHERE access_level = '".STUDENT."' ");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function total_supervisors(){
			global $database;
			$result = $database->query_db("SELECT * FROM users WHERE access_level = '".SUPERVISOR."' ");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function new_user($full_name, $email, $phone, $password, $access_level, $student_id){
			global $database;
			$result = $database->query_db("INSERT INTO users(full_name, email, phone, password, access_level, student_id) VALUES('".$full_name."', '".$email."', '".$phone."', '".sha1($password)."', '".$access_level."', '".$student_id."')");
			return $result;
		}

		public static function update_user($id, $full_name, $email, $access_level){
			global $database;
			$result = $database->query_db("UPDATE users SET full_name = '".$full_name."', email = '".$email."', access_level = '".$access_level."' WHERE user_id = '".$id."'");
			return $result;
		}

		public static function update_profile($id, $full_name, $email, $phone){
			global $database;
			$result = $database->query_db("UPDATE users SET full_name = '".$full_name."', email = '".$email."', phone = '".$phone."' WHERE user_id = '".$id."'");
			return $result;
		}

		public static function delete_user($id){
			global $database;
			$results = $database->query_db("UPDATE users SET deleted='yes' WHERE user_id='".$id."'");
			return $results;
		}

		public static function reset_student_password($student_id){
			global $database;
			$results = $database->query_db("UPDATE users SET password = '".sha1($student_id)."' WHERE student_id='".$student_id."'");
			return $results;
		}

		public static function find_by_id($id){
			global $database;
			$results = $database->query_db("SELECT * FROM users WHERE user_id='".$id."'");
			return $results;
		}

		public static function find_student($student_id){
			global $database;
			$results = $database->query_db("SELECT * FROM users WHERE student_id='".$student_id."'");
			return $results;
		}

		public static function find_all(){
			global $database;
			$results = $database->query_db("SELECT * FROM users WHERE deleted='no' AND user_id != '".$_SESSION['user_id']."' ");
			return $results;
		}

		

		public static function is_user($email){
			global $database;
			$result = $database->query_db("SELECT * FROM users WHERE email='".$email."'");
			$answer = $database->num_rows($result);
			if($answer > 0){
				return true;
			}
			else{
				return false;
			}
		}


		public static function get_name($id){
			global $database;
			$n = $database->query_db("SELECT full_name FROM users WHERE user_id = '".$id."' ");
			$result = $database->fetch_array($n);
			$name = $result['full_name'];
			return $name;
		}

		public static function get_student_name($id){
			global $database;
			$n = $database->query_db("SELECT full_name FROM users WHERE student_id = '".$id."' ");
			$result = $database->fetch_array($n);
			$name = $result['full_name'];
			return $name;
		}




	}

	
?>