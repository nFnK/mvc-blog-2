<?php

/* This controller renders the home page */

class HomeController extends BaseController {

	public function index(){	
		if(Session::get('loggin') == false){
			redirect('?controller=login&action=login');	
			exit;			
		} 	
		
		render('home',array(
			'title'		=> 'Welcome to Localhost',
			'content'	=> rewardprogram(),
		), 'index');
	}
}

?>