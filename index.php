<?php
session_start();
require_once('db.php');	
require_once('model/function.php');

   if(isset($_GET['view']))
    {
	$controller_action = $_GET['view'];
	}
     else
	{
	 $controller_action = 'lists';	 
	}
require_once("controller/tasks.controller.php");	
  	
$function_name = $controller_action;

$function_name();