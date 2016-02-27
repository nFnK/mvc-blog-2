<?php

class Login{
	
	public static function verifyLogin($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("SELECT `id` FROM `brp_user` WHERE `email` = :email AND `pass` = :pass AND `status`='Active'");
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$st->execute($arr);
		$return = $st->fetchAll(PDO::FETCH_CLASS, "Login");
		
		if(!empty($return) && !empty($return[0])) {
			
			$st1 = $db->prepare("SELECT `brp_user`.`id`, `firstname`, `lastname`, `company`, `role`, `date_format`, `pending_requests`, `last_activity` FROM `brp_user`, `brp_user_profile` WHERE `brp_user`.`id` = `brp_user_profile`.`uid` AND `brp_user`.`id`=:id");
			
			$st1->execute((array)$return[0]);
			
			$return = $st1->fetchAll(PDO::FETCH_CLASS, "Login");
			
			foreach((array)$return[0] as $key => $val) {
				Session::set($key, $val);
			}
			Session::set('loggin', true);
			redirect('?controller=login&action=index');
			exit;
		}
		else {
			return false;
		}
	}
}

?>