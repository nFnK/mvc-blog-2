<?php
	function product(){
		global $db;
		
		$st = $db->prepare("SELECT `id`, `title` FROM `brp_product` WHERE `status` = 'Active'");
		
		$st->execute();
		
		return $st->fetchAll(PDO::FETCH_CLASS, "RewardProgram");
	}
	
	function getproduct($arr = array()){
		global $db;
		
		$st = $db->prepare("SELECT `title` FROM `brp_product` WHERE `id` = :id");
		
		$st->execute($arr);
		
		return $st->fetchAll(PDO::FETCH_CLASS, "RewardProgram");
	}	
	
	function course(){
		global $db;
		
		$st = $db->prepare("SELECT `id`, `title` FROM `brp_course` WHERE `status` = 'Active'");
		
		$st->execute();
		
		return $st->fetchAll(PDO::FETCH_CLASS, "RewardProgram");
	}

	function getcourse($arr = array()){
		global $db;
		
		$st = $db->prepare("SELECT `title` FROM `brp_course` WHERE `id` = :id");
		
		$st->execute($arr);
		
		return $st->fetchAll(PDO::FETCH_CLASS, "RewardProgram");
	}	
	
	function rewardprogram(){
		global $db;
		
		$st = $db->prepare("SELECT `id`, `title`, `description` FROM `brp_reward_program` WHERE `status` = 'Active'");
		
		$st->execute();
		
		return $st->fetchAll(PDO::FETCH_CLASS, "Home");
	}	
?>