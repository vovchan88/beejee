<?php
function lists(){
$list = get_tasks();
if(isset($_SESSION['auto'])){
require_once('views/list_admin.php');	
}else{
require_once('views/list.php');	
}
}

function edit(){
if(!isset($_SESSION['auto'])){
header("Location: index.php");
exit;	
}
$an_empty_string = "";
if(isset($_GET['id'])){
$id = $_GET['id'];
}else{
die('Ошибка 404! <a href="index.php">Вернуться!</a>');	
}
$list = get_one_task($id);	
if(count($_POST))
{
     if($_POST['action'] === 'edit')
	{	
         if($_POST['username'] != "" && $_POST['e-mail'] != "" && $_POST['text'] != "")
		 {
			  
			             $username = $_POST['username'];	
                         $email = $_POST['e-mail'];	
                         $text = $_POST['text'];
			             $id_u = $_POST['id_u'];
			             $id = $_POST['id'];
						 $type_picture = $_POST['type_picture'];
						 
						 
		   if(@$_POST['execution'] == "on"){
		   change_execution($id);	   
		   }
						 
		   if($_FILES['picture']['name'] != "")
		   {	   
						 switch($_FILES['picture']['type']) 
                        {
                        case 'image/jpeg':
                        $type = '.jpg';
                        break;
                        case 'image/png':
                        $type = '.png';
                        break;
                        case 'image/gif':
                        $type = '.gif';
                        break;
                        default:
                        die('Запрещённый тип файла. <a href="edit.php?id=' . $id . '">Попробовать другой файл?</a>');
                        } 
						
			            imageresize_1($_FILES['picture'], $id);
			            @unlink('img/' . $id . $type_picture);
			            copy($_FILES['picture']['tmp_name'], 'img/' . $id . $type);
			            
						change_user($email, $username, $id_u);
						change_new_picture($text, $_FILES['picture']['name'], $type, $id);	
                        header("Location: index.php");
			            exit;
						
		                }else{
			            
						change_user($email, $username, $id_u);
						change_old_picture($text, $id);	  
						header("Location: index.php");
			            exit;
				        }
              }else{
              $an_empty_string = "Не все строки заполнены!";
		}
	}	
}	
require_once('views/edit.php');
}

function add(){
$an_empty_string = "";	 
if(count($_POST))
{
     if($_POST['action'] === 'add')
	 {	
         if($_POST['username'] != "" && $_POST['e-mail'] != "" && $_POST['text'] != "" && $_FILES['picture']['name'] != "")
		 {
	              switch($_FILES['picture']['type']) 
                  {
                  case 'image/jpeg':
                  $type = '.jpg';
                  break;
                  case 'image/png':
                  $type = '.png';
                  break;
                  case 'image/gif':
                  $type = '.gif';
                  break;
                  default:
                  die('Запрещённый тип файла. <a href="?">Попробовать другой файл?</a>');
                  }  
			 
			              $username = $_POST['username'];	
                          $email = $_POST['e-mail'];	
                          $text = $_POST['text'];	
                          $picture = $_FILES['picture']['name'];	
            
			              $users = get_users();
						  
                          $is_old_user = false;
                          foreach($users as $value){
                          if($email == $value['e-mail']){
                          $is_old_user = true;	
						  $value_id = $value['id'];
                          }
                          }	
						  
			     if($is_old_user)
			     {
				 $picture_id = put_into_tasks($value_id, $text, $picture, $type);	 
				 imageresize($_FILES['picture'], $picture_id);  
                 copy($_FILES['picture']['tmp_name'], 'img/' . $picture_id . $type);
				 header("Location: index.php");
				 exit;
                 }else{  
				 $user_id = put_into_users($email, $username);				 
                 $picture_id = put_into_tasks($user_id, $text, $picture, $type);
                 imageresize($_FILES['picture'], $picture_id); 
                 copy($_FILES['picture']['tmp_name'], 'img/' . $picture_id . $type);
				 header("Location: index.php");
				 exit;
                 }
}else{
$an_empty_string = "Не все строки заполнены!";		
}
}
}
require_once('views/add.php');	
}

function authorization(){
if(isset($_SESSION['auto'])){
header("Location: index.php");
exit;	
}
$base  =  parse_ini_file('login.ini');
foreach($base as $login => $pword){
if(isset($_POST['login']) && isset($_POST['pword']) && $_POST['login'] == $login && $_POST['pword'] == $pword){
$_SESSION['auto'] = true;	
$_SESSION['login'] = $login;
header("Location: index.php");
exit;	
    }
  }	
require_once('views/authorization.php'); 
}