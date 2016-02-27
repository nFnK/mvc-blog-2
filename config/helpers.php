<?php

/* These are helper functions */

function render($template,$vars = array(),$action=""){
	
	// This function takes the name of a template and
	// a list of variables, and renders it.
	
	// This will create variables from the array:
	extract($vars);
	
	// It can also take an array of objects
	// instead of a template name.
	if(is_array($template)) {
		$i = 1;
		// If an array was passed, it will loop
		// through it, and include a partial view
		foreach($template as $k){
			
			// This will create a local variable
			// with the name of the object's class
			
			$cl = strtolower(get_class($k));
			$$cl = $k;
			
			$class = ($i % 2) ? "even" : "odd"; // for templates having multiple rows
			$i++;
			
			include __SITE_PATH . "/app/views/$cl/_$cl.php";
		}
		
	}
	else if ($action != "") {
		include __SITE_PATH . "/app/views/$template/$action.php";
	}
	else {
		include __SITE_PATH . "/app/views/$template.php";
	}
}

// Helper function for title formatting:
function formatTitle($title = ''){
	if($title){
		$title.= ' | ';
	}
	
	$title .= $GLOBALS['defaultTitle'];
	
	return $title;
}

function sanitizeInput($input, $filter){
	
	switch ($filter) {
		
		case 'FILTER_SANITIZE_STRING':
			$input = filter_var($input, FILTER_SANITIZE_STRING);
			break;
			
		case 'FILTER_SANITIZE_NUMBER_INT':
			$input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
			break;
			
		case 'FILTER_SANITIZE_EMAIL':
			$input = filter_var($input, FILTER_SANITIZE_EMAIL);
			break;
			
		case 'FILTER_SANITIZE_URL':
			$input = filter_var($input, FILTER_SANITIZE_URL);
			break;			
	}
	return $input;
}

function redirect($path){
	// Perform redirection
    header('location: '.$path);
    exit;
}

function validateInput($input, $filter){
	switch ($filter) {
		
		case 'FILTER_VALIDATE_EMAIL':
			if(filter_var($input, FILTER_VALIDATE_EMAIL))
				$return = 1;
			else
				$return = 0;
			break;
			
		case 'FILTER_VALIDATE_INT':
			if(filter_var($input, FILTER_VALIDATE_INT))
				$return = 1;
			else
				$return = 0;
			break;
			
		case 'FILTER_VALIDATE_URL':
			if(filter_var($input, FILTER_VALIDATE_URL))
				$return = true;
			else
				$return = false;				
			break;
		case 'FILTER_IS_NUMBER':
			if(is_numeric($input))
				$return = 1;
			else
				$return = 0;
			break;	
	}
	
	return $return;
}
	
function validateDate($input, $filter){
	switch ($filter) {

		case 'FILTER_VALIDATE_DATE_m-d-Y':
			if (DateTime::createFromFormat('m/d/Y', $input))
				$return = true;
			else
				$return = false;
			break;				
			
		case 'FILTER_VALIDATE_DATE_passedDate':	
			if(strtotime($input)>strtotime(date('Y-m-d H:i:s')))
				$return = true;
			else
				$return = false;
			break;	
	}
	
	return $return;
}

function validatePassword($pass, $cpass){
	if($pass!="" && $pass == $cpass)
		return true;
	else 
		return false;
}
?>