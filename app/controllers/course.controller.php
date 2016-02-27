<?php

/* This controller renders the course pages */

class CourseController extends BaseController {

	public function __construct() {
		Session::isAuth();
	}
	
	public function index(){
		
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$courses = Course::show(array('id'=>$id));
		} else {
			$courses = Course::show(); // Fetch all the cources:
		}
	
		if($_GET['msg']=="as") {
			$msg = "Course added successfully.";
		}
		if($_GET['msg']=="es") {
			$msg = "Course updated successfully.";
		}
		if($_GET['msg']=="ds") {
			$msg = "Course deleted.";
		}
		
		render('course',array(
			'title'     => 'Courses',
			'courses'	=> $courses,
			'msg'		=> $msg,
		), 'index');		
	}
	
	public function view(){
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$courses = Course::show(array('id'=>$id));
			
			render('course',array(
			'title'     => 'Courses',
			'courses'	=> $courses[0],
			), 'view');
		} else {
			throw new Exception("Invalid course.");
		}		
	}
	
	public function add(){
		render('course',array('title'   => 'Courses'), 'add');		
	}
	
	public function insert(){

	    $title = sanitizeInput($_POST['title'], FILTER_SANITIZE_STRING);
	    $description = sanitizeInput($_POST['description'], FILTER_SANITIZE_STRING);
		
		if($title=="") {
			render('course',array(
			'title'   => 'Courses',
			'courses' => array(
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'status' => $_POST['status'],
				'msg' => '* marked fields are mandatory',
				)
			), 'add');	
		}
		else {
			$record = Course::insert(array('title'=>$title,'description'=>$description,'status'=>$_POST['status']));
		}
		
	}
	
	public function edit(){
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$courses = Course::show(array('id'=>$id));
			
			render('course',array(
			'title'     => 'Courses',
			'courses'	=> $courses[0],
			), 'edit');
		} else {
			throw new Exception("Invalid course.");
		}
		
	}
	
	public function update(){

	    $title = sanitizeInput($_POST['title'], FILTER_SANITIZE_STRING);
	    $description = sanitizeInput($_POST['description'], FILTER_SANITIZE_STRING);
		
		if($title=="") {
			render('course',array(
			'title'   => 'Courses',
			'courses' => (object) array(
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'status' => $_POST['status'],
				'id' => $_POST['id'],
				'msg' => '* marked fields are mandatory',
				)
			), 'edit');	
		}
		else {
			$record = Course::update(array('title'=>$title,'description'=>$description,'status'=>$_POST['status'],'id'=>$_POST['id']));
		}		
	}
	
	public function delete(){
		
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$record = Course::delete(array('id'=>$id));
		}
		else {
			throw new Exception("Invalid course.");
		}		
	}
}

?>