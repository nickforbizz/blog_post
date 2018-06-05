<?php
$connError = "Sorry, Couldn't connect";

$host = "localhost";
$user = "root";
$passwd = "";
$db = "blog";


$conn = new MySQli($host, $user, $passwd, $db);
if ($conn) {
  return true;;
}else {
  echo $connError;
}

 ?>
