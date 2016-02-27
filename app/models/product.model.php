<?php

class Product{
	
	/*
		The show static method selects products
		from the database and returns them as
		an array of Product objects.
	*/
	
	public static function show($arr = array()){
		global $db;
		
		if(empty($arr)){
			$st = $db->prepare("SELECT `id`, `title`, `description`, `status` FROM `brp_product`");
		}
		else if(!empty($arr['id'])){
			$st = $db->prepare("SELECT `id`, `title`, `description`, `status` FROM brp_product WHERE id=:id");
		}
		else{
			throw new Exception("Unsupported property!");
		}
		
		$st->execute($arr);
		
		// Returns an array of Product objects:
		return $st->fetchAll(PDO::FETCH_CLASS, "Product");
	}
	
	public static function insert($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("INSERT INTO `brp_product` (`title`, `description`, `status`) VALUES (:title, :description, :status)");		
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr);
		
		if($return) {
			redirect('?controller=product&action=index&msg=as');
		} else {
			throw new Exception("Error executing query");
		}
	}
	
	public static function update($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("UPDATE `brp_product` SET `title` = :title, `description` = :description, `status` = :status WHERE `id` = :id");		
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr);
		
		if($return) {
			redirect('?controller=product&action=index&msg=es');
		} else {
			throw new Exception("Error executing query");
		}
	}

	public static function delete($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("DELETE FROM `brp_product` WHERE `id` = :id");		
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr);
		
		if($return) {
			redirect('?controller=product&action=index&msg=ds');
		} else {
			throw new Exception("Error executing query");
		}
	}	
}

?>