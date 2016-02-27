<?php

/* This controller renders the user pages */

class UserController extends BaseController {
	
	public function __construct() {
		Session::isAuth();
	}	

	public function index(){
		
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$users = User::show(array('id'=>$id));
		} else {
			$users = User::show(); // Fetch all the users:
		}
	
		if($_GET['msg']=="as") {
			$msg = "User added successfully.";
		}
		if($_GET['msg']=="es") {
			$msg = "User updated successfully.";
		}
		if($_GET['msg']=="ds") {
			$msg = "User deleted.";
		}
		
		render('user',array(
			'title'     => 'Users',
			'users'	=> $users,
			'msg'		=> $msg,
		), 'index');		
	}
	
	public function view(){
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$users = User::show(array('id'=>$id));
			
			render('user',array(
			'title'     => 'Users',
			'users'	=> $users[0],
			), 'view');
		} else {
			throw new Exception("Invalid user.");
		}		
	}
	
	public function add(){
		render('user',array('title'   => 'Users'), 'add');		
	}
	
	public function insert(){
	    $firstname = sanitizeInput($_POST['firstname'], FILTER_SANITIZE_STRING);
	    $lastname  = sanitizeInput($_POST['lastname'], FILTER_SANITIZE_STRING);
		$company   = sanitizeInput($_POST['company'], FILTER_SANITIZE_STRING);
		$email     = validateInput($_POST['email'], 'FILTER_VALIDATE_EMAIL');
		$pass      = validatePassword($_POST['pass'], $_POST['cpass']);
		
		$msg = "";
		if($firstname=="" || $lastname=="" || $company=="") {
			$msg = "* marked fields are mandatory<br>";
		}
		if(!$email) {
			$msg.= "Please enter a valid email address<br>";
		}
		if(!empty(User::uniqueEmail(array('email'=>$_POST['email'])))) {
			$msg.= "A user with this email address already exists<br>";
		}	
		if(!$pass) {
			$msg.= "Invalid passwords<br>";
		}
		
		if($msg!="") {
			render('user',array(
			'title'   => 'Users',
			'users' => array(
				'firstname' => $_POST['firstname'],
				'lastname' => $_POST['lastname'],
				'email' => $_POST['email'],
				'company' => $_POST['company'],
				'role' => $_POST['role'],
				'date_format' => $_POST['date_format'],				
				'status' => $_POST['status'],
				'msg' => $msg,
				)
			), 'add');	
		}
		else {
			$today = date('Y-m-d H:i:s');
			
			$record = User::insert(array('email'=>$_POST['email'],'pass'=>md5($_POST['pass']),'status'=>$_POST['status'],'created'=>$today,'firstname'=>$_POST['firstname'],'lastname'=>$_POST['lastname'],'role'=>$_POST['role'],'company'=>$_POST['company'],'date_format'=>$_POST['date_format']));
		}
		
	}
	
	public function edit(){
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$users = User::show(array('id'=>$id));
			
			render('user',array(
			'title'     => 'Users',
			'users'	=> $users[0],
			), 'edit');
		} else {
			throw new Exception("Invalid user.");
		}
		
	}
	
	public function update(){

	    $firstname = sanitizeInput($_POST['firstname'], FILTER_SANITIZE_STRING);
	    $lastname  = sanitizeInput($_POST['lastname'], FILTER_SANITIZE_STRING);
		$company   = sanitizeInput($_POST['company'], FILTER_SANITIZE_STRING);
		
		$msg = "";
		if($firstname=="" || $lastname=="" || $company=="") {
			$msg = "* marked fields are mandatory<br>";
		}

		if($msg!="") {
			render('user',array(
			'title'   => 'Users',
			'users' => (object) array(
				'firstname' => $_POST['firstname'],
				'lastname' => $_POST['lastname'],
				'email' => $_POST['email'],
				'company' => $_POST['company'],
				'role' => $_POST['role'],
				'date_format' => $_POST['date_format'],				
				'status' => $_POST['status'],
				'id' => $_POST['id'],
				'msg' => $msg,
				)
			), 'edit');	
		}
		else {
			$record = User::update(array('status'=>$_POST['status'],'firstname'=>$_POST['firstname'],'lastname'=>$_POST['lastname'],'role'=>$_POST['role'],'company'=>$_POST['company'],'date_format'=>$_POST['date_format'],'id'=>$_POST['id']));
		}		
	}
	
	public function delete(){
		
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$record = User::delete(array('id'=>$id));
		}
		else {
			throw new Exception("Invalid user.");
		}		
	}
	
	public function profile(){
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$users = User::show(array('id'=>$id));
			
			if($_GET['msg']=="es") {
				$msg = "Profile updated.";
			}			
			render('user',array(
			'title' => 'Profile',
			'users'	=> $users[0],
			'msg' => $msg,
			), 'profile');
		} else {
			throw new Exception("Invalid user.");
		}		
	}
	
	public function editprofile(){
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$users = User::show(array('id'=>$id));
			
			render('user',array(
			'title'     => 'Profile',
			'users'	=> $users[0],
			), 'editprofile');
		} else {
			throw new Exception("Invalid user.");
		}	
	}	
	
	public function updateprofile(){

	    $firstname = sanitizeInput($_POST['firstname'], FILTER_SANITIZE_STRING);
	    $lastname  = sanitizeInput($_POST['lastname'], FILTER_SANITIZE_STRING);
		$company   = sanitizeInput($_POST['company'], FILTER_SANITIZE_STRING);
		
		$msg = "";
		if($firstname=="" || $lastname=="" || $company=="") {
			$msg = "* marked fields are mandatory<br>";
		}

		if($msg!="") {
			render('user',array(
			'title'   => 'Users',
			'users' => (object) array(
				'firstname' => $_POST['firstname'],
				'lastname' => $_POST['lastname'],
				'email' => $_POST['email'],
				'company' => $_POST['company'],
				'date_format' => $_POST['date_format'],			
				'id' => $_POST['id'],
				'msg' => $msg,
				)
			), 'editprofile');	
		}
		else {
			$record = User::updateprofile(array('firstname'=>$_POST['firstname'],'lastname'=>$_POST['lastname'],'company'=>$_POST['company'],'date_format'=>$_POST['date_format'],'last_activity'=>date('Y-m-d H:i:s'),'id'=>$_POST['id']));
		}		
	}	
}

?>