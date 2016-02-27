<?php

/* This controller renders the login functionality */

class LoginController extends BaseController {

	public function index(){
		if(Session::get('loggin') == false){
			redirect('?controller=login&action=login');	
			exit;			
		} 	
	
		render('login',array(
				'title'     => 'Welcome',
				'user'	=> Session::display(),
				'msg'		=> $msg,
		), 'welcome');
	}
	
	public function login(){
		if(Session::get('loggin') == true){
			redirect('?controller=login&action=index');
		}

		if(isset($_POST['submit'])){
			$arr = array('email' => $_POST['username'], 'pass' => md5($_POST['password']));

			if(Login::verifyLogin($arr) == false){
				$msg = "Username or Password do not match.";
			}
		}

		if($_GET['msg']=="li") {
			$msg = "Please login to view this page.";
		}
		
		render('login',array(
				'title'     => 'Login',
				'session'	=> FALSE,
				'msg'		=> $msg,
			), 'index');
	}
	
	public function logout(){
		Session::destroy();
		redirect('?');
	}
}

?>