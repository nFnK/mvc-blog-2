<?php

class RewardProgram{
	
	/*
		The show static method selects reward programs
		from the database and returns them as
		an array of Reward Program objects.
	*/
	
	public static function show($arr = array()){
		global $db;
		
		if(empty($arr)){
			$st = $db->prepare("SELECT `id`, `title`, `description`, `type`, `validity`, `added_on`, `status` FROM `brp_reward_program`");
		}
		else if(!empty($arr['id'])){
			$st = $db->prepare("SELECT brp_reward_program.`id`, `title`, `description`, `type`, `validity`, `added_on`, `status`, `item_id`, `amount` FROM brp_reward_program, brp_reward_program_item WHERE brp_reward_program.id=:id AND reward_program_id=:id");
		}
		else{
			throw new Exception("Unsupported property!");
		}
		
		$st->execute($arr);
		
		// Returns an array of Reward Program objects:
		return $st->fetchAll(PDO::FETCH_CLASS, "RewardProgram");
	}
	
	public static function insert($arr = array()){
		global $db;
		
		if(!empty($arr)){
	
			$reward_program = array('title'=>$arr['title'],'description'=>$arr['description'],'type'=>$arr['type'],'validity'=>$arr['validity'],'added_on'=>$arr['added_on'],'status'=>$arr['status']);
			
			$item = array('item_id'=>$arr['item_id'],'amount'=>$arr['amount']);
			
			$st = $db->prepare("INSERT INTO `brp_reward_program` (`title`, `description`, `type`, `validity`, `added_on`, `status`) VALUES (:title, :description, :type, :validity, :added_on, :status)");		
		}
		else{
			throw new Exception("Invalid Input");
		}
		$return = $st->execute($reward_program);
		
		$item['reward_program_id'] = $db->lastInsertId();
		
		$st1 = $db->prepare("INSERT INTO `brp_reward_program_item` (`item_id`, `amount`, `reward_program_id`) VALUES (:item_id, :amount, :reward_program_id)");
		
		$return = $st1->execute($item);
		
		if($return) {
			redirect('?controller=rewardprogram&action=index&msg=as');
		} else {
			throw new Exception("Error executing query");
		}
	}
	
	public static function update($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$reward_program = array('title'=>$arr['title'],'description'=>$arr['description'],'type'=>$arr['type'],'validity'=>$arr['validity'],'status'=>$arr['status'], 'id'=>$arr['id']);
			
			$item = array('item_id'=>$arr['item_id'],'amount'=>$arr['amount'], 'reward_program_id'=>$arr['id']);
			
			$st = $db->prepare("UPDATE `brp_reward_program` SET `title` = :title, `description` = :description, `type` = :type, `validity` = :validity, `status` = :status WHERE `id` = :id");	
			$st1 = $db->prepare("UPDATE `brp_reward_program_item` SET `item_id` = :item_id, `amount` = :amount WHERE `reward_program_id` = :reward_program_id");				
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($reward_program);
		$return = $st1->execute($item);
		
		if($return) {
			redirect('?controller=rewardprogram&action=index&msg=es');
		} else {
			throw new Exception("Error executing query");
		}
	}

	public static function delete($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$st = $db->prepare("DELETE FROM `brp_reward_program` WHERE `id` = :id");	
			$st1 = $db->prepare("DELETE FROM `brp_reward_program_item` WHERE `reward_program_id` = :id");			
		}
		else{
			throw new Exception("Invalid Input");
		}
		
		$return = $st->execute($arr);
		$return = $st1->execute($arr);
		
		if($return) {
			redirect('?controller=rewardprogram&action=index&msg=ds');
		} else {
			throw new Exception("Error executing query");
		}		
	}

	public static function uniqueTitle($arr = array()){
		global $db;
		
		if(!empty($arr)){
			$append = (!empty($arr['id'])) ? " AND `id`!=:id" : "";
			$st = $db->prepare("SELECT `id` FROM `brp_reward_program` WHERE `title`=:title" . $append);
		}
		else{
			throw new Exception("Unsupported property!");
		}
		
		$st->execute($arr);
		
		return $st->fetchAll(PDO::FETCH_CLASS, "RewardProgram");
	}
}

?>