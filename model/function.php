<?php
require_once('db.php');
function imageresize($file, $id){
global $link;	
switch ($file['type']) 
{
case 'image/jpeg':
if(!@($source = imagecreatefromjpeg($file['tmp_name']))){
mysqli_query($link, 'DELETE FROM `tasks` WHERE id = ' . $id);
die('Фаил испорчен! <a href="?">Попробовать другой файл?</a>');
}
break;
case 'image/png':
if(!@($source = imagecreatefrompng($file['tmp_name']))){
mysqli_query($link, 'DELETE FROM `tasks` WHERE id = ' . $id);
die('Фаил испорчен! <a href="?">Попробовать другой файл?</a>');	
}
break;
case 'image/gif':
if(!@($source = imagecreatefromgif($file['tmp_name']))){
mysqli_query($link, 'DELETE FROM `tasks` WHERE id = ' . $id);
die('Фаил испорчен! <a href="?">Попробовать другой файл?</a>');	
}
break;
default:
die('Что-то пошло не так! <a href="?">Попробовать другой файл?</a>');
}	
$w_s = imagesx($source);
$h_s = imagesy($source);

	    $k = $w_s/$h_s;
	    $new_w = 320;
        $new_h = $new_w/$k;  	
		if($new_h >= 240)
		{
		$new_h = 240;
        $new_w = $new_h * $k;		
		}
$dest = imagecreatetruecolor($new_w, $new_h);	
$white = imagecolorallocate($dest, 0xFF, 0xFF, 0xFF);
imagefill($dest, 0, 0, $white);
imagecopyresampled($dest, $source, 0, 0, 0, 0, $new_w, $new_h, $w_s, $h_s);
imagejpeg($dest, $_FILES['picture']['tmp_name'], 75);
imagedestroy($dest);
imagedestroy($source);
}
function imageresize_1($file, $id){
global $link;	
switch ($file['type']) 
{
case 'image/jpeg':
if(!@($source = imagecreatefromjpeg($file['tmp_name']))){
die('Фаил испорчен! <a href="edit.php?id=' . $id . '">Попробовать другой файл?</a>');
}
break;
case 'image/png':
if(!@($source = imagecreatefrompng($file['tmp_name']))){
die('Фаил испорчен! <a href="edit.php?id=' . $id . '">Попробовать другой файл?</a>');	
}
break;
case 'image/gif':
if(!@($source = imagecreatefromgif($file['tmp_name']))){
die('Фаил испорчен! <a href="edit.php?id=' . $id . '">Попробовать другой файл?</a>');	
}
break;
default:
die('Что-то пошло не так! <a href="edit.php?id=' . $id . '">Попробовать другой файл?</a>');
}	
$w_s = imagesx($source);
$h_s = imagesy($source);
$k = $w_s/$h_s;
	    $new_w = 320;
        $new_h = $new_w/$k;  	
		if($new_h >= 240)
		{
		$new_h = 240;
        $new_w = $new_h * $k;		
		}
$dest = imagecreatetruecolor($new_w, $new_h);	
$white = imagecolorallocate($dest, 0xFF, 0xFF, 0xFF);
imagefill($dest, 0, 0, $white);
imagecopyresampled($dest, $source, 0, 0, 0, 0, $new_w, $new_h, $w_s, $h_s);
imagejpeg($dest, $_FILES['picture']['tmp_name'], 75);
imagedestroy($dest);
imagedestroy($source);
}
function get_tasks(){
global $link;
$query = "SELECT
`tasks` . `id` AS `id`,
`tasks` . `user_id`,
`tasks` . `text`,
`tasks` . `picture`,
`tasks` . `type_picture`,
`tasks` . `execution`,
`users` . `id` AS `id_u`,
`users` . `e-mail`,
`users` . `username`
FROM `users` JOIN `tasks` 
ON `users`.`id` = `tasks`.`user_id` 
WHERE 1";
$list = array();
   $rs = mysqli_query($link, $query);
   while($row = mysqli_fetch_assoc($rs)){
   $list[] = $row;   
   }
   return $list;
}
function get_users(){
global $link;
$query = "SELECT * FROM `users` WHERE 1";
$users = array();
$rs = mysqli_query($link, $query);
while($row = mysqli_fetch_assoc($rs))
{
$users[] = $row;	
}
return $users;
}
function put_into_tasks($value_id, $text, $picture, $type){
global $link;	
$query = "INSERT INTO `tasks` (`user_id`, `text`, `picture`, `type_picture`, `execution`)
VALUES ('" . $value_id . "', '" . $text . "', '" . $picture . "', '" . $type . "', 'Не выполнено')";	
$rs = mysqli_query($link, $query);
$picture_id = mysqli_insert_id($link);	
return $picture_id;	
}
function put_into_users($email, $username){
global $link;	
$query = "INSERT INTO `users` (`e-mail`, `username`)
VALUES ('" . $email . "', '" . $username . "')";
$rs = mysqli_query($link, $query);		
$user_id = mysqli_insert_id($link);
return $user_id;
}
function get_one_task($id){
global $link;
$query = "SELECT
`tasks` . `id` AS `id`,
`tasks` . `user_id`,
`tasks` . `text`,
`tasks` . `picture`,
`tasks` . `type_picture`,
`users` . `id` AS `id_u`,
`users` . `e-mail`,
`users` . `username`
FROM `users` JOIN `tasks` 
ON `users`.`id` = `tasks`.`user_id` 
WHERE `tasks` . `id` =" . $id;
$list = array();
$rs = mysqli_query($link, $query);
   if($row = mysqli_fetch_assoc($rs)){
   return $row;   
   }
}
function change_execution($id){
global $link;	
$query = "UPDATE `tasks` SET `execution` = 'Выполнено' WHERE id =" . $id;
$rs = mysqli_query($link, $query);
}
function change_user($email, $username, $id_u){
global $link;	
$query = "UPDATE `users` SET `e-mail` = '" . $email . "', `username` = '" . $username . "' WHERE `id` ='" . $id_u . "'";
$rs = mysqli_query($link, $query);
}
function change_new_picture($text, $file, $type, $id){
global $link;	
$query = "UPDATE `tasks` SET `text` = '" . $text . "', `picture` = '" . $file . "', `type_picture` = '" . $type . "' WHERE `id` ='" . $id . "'";
$rs = mysqli_query($link, $query);
}
function change_old_picture($text, $id){
global $link;
$query = "UPDATE `tasks` SET `text` = '" . $text . "' WHERE `id` ='" . $id . "'";
$rs = mysqli_query($link, $query);
}