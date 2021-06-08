<?php

$connection = mysqli_connect('127.0.0.1', 'root','', 'blog');
if ($connection==false)
{
	echo 'Не удалось подключиться к БД<br>';
	echo mysqli_connect_error();
	exit();
} 
$query = "SELECT * FROM 'articles'";
$result = mysqli_query($connection, $query);

while ( ($resord=mysqli_fetch_assoc($result)) ) {
	print_r($resord);
	echo '<hr>';
}
