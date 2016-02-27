<?php

/* This controller renders the reward program pages */

class RewardProgramController extends BaseController {
	
	public function __construct() {
		Session::isAuth();
	}	

	public function index(){
		
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$rewardprograms = RewardProgram::show(array('id'=>$id));
		} else {
			$rewardprograms = RewardProgram::show(); // Fetch all the reward programs:
		}
	
		if($_GET['msg']=="as") {
			$msg = "Reward Program added successfully.";
		}
		if($_GET['msg']=="es") {
			$msg = "Reward Program updated successfully.";
		}
		if($_GET['msg']=="ds") {
			$msg = "Reward Program deleted.";
		}
		
		render('rewardprogram',array(
			'title'     => 'Reward Programs',
			'rewardprograms'	=> $rewardprograms,
			'msg'		=> $msg,
		), 'index');		
	}
	
	public function view(){
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$rewardprograms = RewardProgram::show(array('id'=>$id));
			
			if($rewardprograms[0]->type="Sale") {
				$temp = getproduct(array('id'=>$rewardprograms[0]->item_id));
			}
			else {
				$temp = getcourse(array('id'=>$rewardprograms[0]->item_id));
			}
			$rewardprograms[0]->itemname = $temp[0]->title;
			
			render('rewardprogram',array(
			'title'     => 'Reward Programs',
			'rewardprograms'	=> $rewardprograms[0],
			), 'view');
		} else {
			throw new Exception("Invalid reward program.");
		}		
	}
	
	public function add(){
		$qproducts = product();
		$qcourses = course();

		render('rewardprogram',array('title'   => 'Reward Programs',
		'rewardprograms' => array(
			'qproducts' => $qproducts,
			'qcourses' => $qcourses,
		)), 'add');		
	}
	
	public function insert(){

	    $title = sanitizeInput($_POST['title'], FILTER_SANITIZE_STRING);
	    $description = sanitizeInput($_POST['description'], FILTER_SANITIZE_STRING);
		$validity = validateDate($_POST['validity'], 'FILTER_VALIDATE_DATE_m-d-Y');
		$validity = validateDate($_POST['validity'], 'FILTER_VALIDATE_DATE_passedDate');
		$product_reward_amount = validateInput($_POST['product_reward_amount'], 'FILTER_IS_NUMBER');
		$course_reward_amount = validateInput($_POST['course_reward_amount'], 'FILTER_IS_NUMBER');
		
		$msg = ($title=="" || $_POST['type']=="") ? "* marked fields are mandatory<br>" : "";
		if(!empty(RewardProgram::uniqueTitle(array('title'=>$_POST['title'])))) {
			$msg.= "A reward program with this title already exists<br>";
		}
		if($_POST['type']=="Sale" && $_POST['qproduct']==""){
			$msg.= "A select a product for this reward program<br>";
		}
		if($_POST['type']=="Sale" && $_POST['qproduct']!="" && ($_POST['product_reward_amount']=="" || !($product_reward_amount))){
			$msg.= "Please enter a valid reward amountmr<br>";
		} 
		if($_POST['type']=="Training" && $_POST['qcourse']==""){
			$msg.= "A select a course for this reward programff<br>";
		}		
		if($_POST['type']=="Training" && $_POST['qcourse']!="" && ($_POST['course_reward_amount']=="" || $course_reward_amount == FALSE)){
			$msg.= "Please enter a valid reward amount<br>";
		}		
		$msg.= !($validity) ? "Please select a valid date" : "";
		
		if($msg!="") {
			$qproducts = product();
			$qcourses = course();
			
			render('rewardprogram',array(
			'title'   => 'Reward Programs',
			'rewardprograms' => array(
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'type' => $_POST['type'],
				'qproducts' => $qproducts,
				'qcourses' => $qcourses,	
				'qproduct' => $_POST['qproduct'],
				'qcourse' => $_POST['qcourse'],
				'product_reward_amount' => $_POST['product_reward_amount'],
				'course_reward_amount' => $_POST['course_reward_amount'],
				'validity' => $_POST['validity'],
				'status' => $_POST['status'],
				'msg' => $msg,
				)
			), 'add');	
		}
		else {
			$today = date('Y-m-d H:i:s');			
			$date = date('Y-m-d H:i:s', strtotime($_POST['validity']));
			$item = ($_POST['qproduct']) ? $_POST['qproduct'] : $_POST['qcourse'];
			$amount = ($_POST['product_reward_amount']) ? $_POST['product_reward_amount'] : $_POST['course_reward_amount'];
			
			$record = RewardProgram::insert(array('title'=>$title,'description'=>$description,'type'=>$_POST['type'],'validity'=>$date,'added_on'=>$today,'status'=>$_POST['status'],'item_id'=>$item,'amount'=>$amount));
		}
		
	}
	
	public function edit(){
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$rewardprograms = RewardProgram::show(array('id'=>$id));
	
			$rp = (array)$rewardprograms[0];
			$rp['qproducts'] = product();
			$rp['qcourses'] = course();
			if($rp['type']=="Sale") {
				$rp['qproduct'] = $rp['item_id'];
				$rp['product_reward_amount'] = $rp['amount'];
			} else {
				$rp['qcourse'] = $rp['item_id'];
				$rp['course_reward_amount'] = $rp['amount'];				
			}
			render('rewardprogram',array(
			'title'     => 'Reward Programs',
			'rewardprograms'	=> $rp,
			), 'edit');
		} else {
			throw new Exception("Invalid reward program.");
		}
	}
	
	public function update(){

	    $title = sanitizeInput($_POST['title'], FILTER_SANITIZE_STRING);
	    $description = sanitizeInput($_POST['description'], FILTER_SANITIZE_STRING);
		$validity = validateDate($_POST['validity'], 'FILTER_VALIDATE_DATE_m-d-Y');
		$validity = validateDate($_POST['validity'], 'FILTER_VALIDATE_DATE_passedDate');
		$product_reward_amount = validateInput($_POST['product_reward_amount'], 'FILTER_IS_NUMBER');
		$course_reward_amount = validateInput($_POST['course_reward_amount'], 'FILTER_IS_NUMBER');
	
		$msg = ($title=="" || $_POST['type']=="") ? "* marked fields are mandatory<br>" : "";
		if(!empty(RewardProgram::uniqueTitle(array('title'=>$_POST['title'], 'id'=>$_POST['id'])))) {
			$msg.= "A reward program with this title already exists<br>";
		}
		if($_POST['type']=="Sale" && $_POST['qproduct']==""){
			$msg.= "A select a product for this reward program<br>";
		}
		if($_POST['type']=="Sale" && $_POST['qproduct']!="" && ($_POST['product_reward_amount']=="" || !($product_reward_amount))){
			$msg.= "Please enter a valid reward amountmr<br>";
		} 
		if($_POST['type']=="Training" && $_POST['qcourse']==""){
			$msg.= "A select a course for this reward programff<br>";
		}		
		if($_POST['type']=="Training" && $_POST['qcourse']!="" && ($_POST['course_reward_amount']=="" || $course_reward_amount == FALSE)){
			$msg.= "Please enter a valid reward amount<br>";
		}		
		$msg.= !($validity) ? "Please select a valid date" : "";
		
		if($msg!="") {
			$qproducts = product();
			$qcourses = course();
			
			render('rewardprogram',array(
			'title'   => 'Reward Programs',
			'rewardprograms' => array(
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'type' => $_POST['type'],
				'qproducts' => $qproducts,
				'qcourses' => $qcourses,	
				'qproduct' => $_POST['qproduct'],
				'qcourse' => $_POST['qcourse'],
				'product_reward_amount' => $_POST['product_reward_amount'],
				'course_reward_amount' => $_POST['course_reward_amount'],				
				'validity' => $_POST['validity'],				
				'status' => $_POST['status'],
				'id' => $_POST['id'],
				'msg' => $msg,
				)
			), 'edit');				
		}
		else {			
			$date = date('Y-m-d H:i:s', strtotime($_POST['validity']));
			$item = ($_POST['qproduct']) ? $_POST['qproduct'] : $_POST['qcourse'];
			$amount = ($_POST['product_reward_amount']) ? $_POST['product_reward_amount'] : $_POST['course_reward_amount'];
			
			$record = RewardProgram::update(array('title'=>$title,'description'=>$description,'type'=>$_POST['type'],'validity'=>$date,'status'=>$_POST['status'],'id'=>$_POST['id'],'item_id'=>$item,'amount'=>$amount));			
		}		
	}
	
	public function delete(){
		
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$record = RewardProgram::delete(array('id'=>$id));
		}
		else {
			throw new Exception("Invalid reward program.");
		}		
	}
}

?>