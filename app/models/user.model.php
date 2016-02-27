<?php

class User{
	
	/*
		The show static method selects users
		from the database and returns them as
		an array of User objects.
	*/
	public static function show($arr = array()){
		global $db;
		
		if(empty($arr)){
			$st = $db->prepare("SELECT `brp_user`.`id`, `email`, `status`, `firstname`, `lastname`, `company` FROM `brp_user`, `brp_user_profile` WHERE `brp_user`.`id` = `brp_user_profile`.`uid`");
		}
		else if(!empty($arr['id'])){
			$st = $db->prepare("SELECT `brp_user`.`id`, `email`, `status`, `created`, `firstname`, `lastname`, `company`, `role`, `date_format`, `last_activity` FROM `brp_user`, `brp_user_profile` WHERE `brp_user`.`id` = `brp_user_profile`.`uid` AND `brp_user`.`id`=:id");
		}
		else{
			throw new Exception("Unsupported property!");
		}
		
		$st->execute($arr);
		
		// Returns an array of User objects:
		return $st->fetchAll(PDO::FETCH_CLASS, "User");
	}
	
	public static function insert($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$arr_user = array('email'=>$arr['email'], 'pass'=>$arr['pass'], 'status'=>$arr['status'], 'created'=>$arr['created']);
			$arr_profile = array('firstname'=>$arr['firstname'], 'lastname'=>$arr['lastname'], 'role'=>$arr['role'], 'company'=>$arr['company'], 'date_format'=>$arr['date_format'], 'last_activity'=>$arr['created']);
			
			$st = $db->prepare("INSERT INTO `brp_user` (`email`, `pass`, `status`, `created`) VALUES (:email, :pass, :status, :created)");		
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr_user);
		
		$arr_profile['uid'] = $db->lastInsertId();
		
		$st1 = $db->prepare("INSERT INTO `brp_user_profile` (`firstname`, `lastname`, `role`, `company`, `date_format`, `last_activity`, `uid`) VALUES (:firstname, :lastname, :role, :company, :date_format, :last_activity, :uid)");
		
		$return = $st1->execute($arr_profile);
		
		if($return) {
			redirect('?controller=user&action=index&msg=as');
		} else {
			throw new Exception("Error executing query");
		}
	}
	
	public static function update($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$arr_user = array('status'=>$arr['status'], 'id'=>$arr['id']);
			
			$arr_profile = array('firstname'=>$arr['firstname'], 'lastname'=>$arr['lastname'], 'role'=>$arr['role'], 'company'=>$arr['company'], 'date_format'=>$arr['date_format'], 'last_activity'=>date('Y-m-d H:i:s'), 'id'=>$arr['id']);
			
			$st = $db->prepare("UPDATE `brp_user` SET `status` = :status WHERE `id` = :id");		
			
			$st1 = $db->prepare("UPDATE `brp_user_profile` SET `firstname` = :firstname, `lastname` = :lastname, `role` = :role, `company` = :company, `date_format` = :date_format, `last_activity` = :last_activity WHERE `uid` = :id");
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr_user);
		$return = $st1->execute($arr_profile);
		
		if($return) {
			redirect('?controller=user&action=index&msg=es');
		} else {
			throw new Exception("Error executing query");
		}
	}

	public static function delete($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("DELETE FROM `brp_user` WHERE `id` = :id");	
			$st1 = $db->prepare("DELETE FROM `brp_user_profile` WHERE `uid` = :id");				
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr);
		$return = $st1->execute($arr);
		
		if($return) {
			redirect('?controller=user&action=index&msg=ds');
		} else {
			throw new Exception("Error executing query");
		}
	}
	
	public static function uniqueEmail($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("SELECT `id` FROM `brp_user` WHERE `email`=:email");
		}
		else{
			throw new Exception("Unsupported property!");
		}
		
		$st->execute($arr);
		
		return $st->fetchAll(PDO::FETCH_CLASS, "User");
	}
	
	public static function updateprofile($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("UPDATE `brp_user_profile` SET `firstname` = :firstname, `lastname` = :lastname, `company` = :company, `date_format` = :date_format, `last_activity` = :last_activity WHERE `uid` = :id");
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr);
		
		if($return) {
			redirect('?controller=user&action=profile&id='.$arr['id'].'&msg=es');
		} else {
			throw new Exception("Error executing query");
		}
	}	
}

?>