<?php
$dbhost='mysql.hostinger.ru';
$dbname='u241818880_tasks';
$dbuser='u241818880_root';
$dbpass='qwerty7';
$link = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname");
if(mysqli_connect_errno())
{
printf("Не удалось подключиться: %s",  mysqli_connect_error());	
exit();	
}
if(!mysqli_set_charset($link, "utf8"))
{
printf("Ошибка при загрузки наборов символов utf8: %s",  mysqli_error($link));	
exit();	
}