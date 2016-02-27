<?php

/* This controller renders the product pages */

class ProductController extends BaseController {
	
	public function __construct() {
		Session::isAuth();
	}

	public function index(){
		
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$products = Product::show(array('id'=>$id));
		} else {
			$products = Product::show(); // Fetch all the cources:
		}
	
		if($_GET['msg']=="as") {
			$msg = "Product added successfully.";
		}
		if($_GET['msg']=="es") {
			$msg = "Product updated successfully.";
		}
		if($_GET['msg']=="ds") {
			$msg = "Product deleted.";
		}
		
		render('product',array(
			'title'     => 'Products',
			'products'	=> $products,
			'msg'		=> $msg,
		), 'index');		
	}
	
	public function view(){
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$products = Product::show(array('id'=>$id));
			
			render('product',array(
			'title'     => 'Products',
			'products'	=> $products[0],
			), 'view');
		} else {
			throw new Exception("Invalid product.");
		}		
	}
	
	public function add(){
		render('product',array('title'   => 'Products'), 'add');		
	}
	
	public function insert(){

	    $title = sanitizeInput($_POST['title'], FILTER_SANITIZE_STRING);
	    $description = sanitizeInput($_POST['description'], FILTER_SANITIZE_STRING);
		
		if($title=="") {
			render('product',array(
			'title'   => 'Products',
			'products' => array(
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'status' => $_POST['status'],
				'msg' => '* marked fields are mandatory',
				)
			), 'add');	
		}
		else {
			$record = Product::insert(array('title'=>$title,'description'=>$description,'status'=>$_POST['status']));
		}
		
	}
	
	public function edit(){
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$products = Product::show(array('id'=>$id));
			
			render('product',array(
			'title'     => 'Products',
			'products'	=> $products[0],
			), 'edit');
		} else {
			throw new Exception("Invalid product.");
		}
		
	}
	
	public function update(){

	    $title = sanitizeInput($_POST['title'], FILTER_SANITIZE_STRING);
	    $description = sanitizeInput($_POST['description'], FILTER_SANITIZE_STRING);
		
		if($title=="") {
			render('product',array(
			'title'   => 'Products',
			'products' => (object) array(
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'status' => $_POST['status'],
				'id' => $_POST['id'],
				'msg' => '* marked fields are mandatory',
				)
			), 'edit');	
		}
		else {
			$record = Product::update(array('title'=>$title,'description'=>$description,'status'=>$_POST['status'],'id'=>$_POST['id']));
		}		
	}
	
	public function delete(){
		
		if(!empty($_GET['id'])){
			$id = sanitizeInput($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
			$record = Product::delete(array('id'=>$id));
		}
		else {
			throw new Exception("Invalid product.");
		}		
	}
}

?>