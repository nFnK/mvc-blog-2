<?php

class Course{
	
	/*
		The show static method selects courses
		from the database and returns them as
		an array of Course objects.
	*/
	
	public static function show($arr = array()){
		global $db;
		
		if(empty($arr)){
			$st = $db->prepare("SELECT `id`, `title`, `description`, `status` FROM `brp_course`");
		}
		else if(!empty($arr['id'])){
			$st = $db->prepare("SELECT `id`, `title`, `description`, `status` FROM brp_course WHERE id=:id");
		}
		else{
			throw new Exception("Unsupported property!");
		}
		
		$st->execute($arr);
		
		// Returns an array of Course objects:
		return $st->fetchAll(PDO::FETCH_CLASS, "Course");
	}
	
	public static function insert($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("INSERT INTO `brp_course` (`title`, `description`, `status`) VALUES (:title, :description, :status)");		
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr);
		
		if($return) {
			redirect('?controller=course&action=index&msg=as');
		} else {
			throw new Exception("Error executing query");
		}
	}
	
	public static function update($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("UPDATE `brp_course` SET `title` = :title, `description` = :description, `status` = :status WHERE `id` = :id");		
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr);
		
		if($return) {
			redirect('?controller=course&action=index&msg=es');
		} else {
			throw new Exception("Error executing query");
		}
	}

	public static function delete($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("DELETE FROM `brp_course` WHERE `id` = :id");		
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr);
		
		if($return) {
			redirect('?controller=course&action=index&msg=ds');
		} else {
			throw new Exception("Error executing query");
		}
	}	
}

?>