<?php
require 'conn.php';

print_r($_POST);

function validateData($name){
  $name = htmlspecialchars($name);
  return $name;
}

$blogTitle = validateData($_POST['title']);
$blogContent = validateData($_POST['text']);
$user = validateData($_POST['user']);

$posts = $conn->query("insert into blogposts (title, content, postedBy) values('$blogTitle', '$blogContent', '$user')");
if ($posts) {
  echo "Blog Posted Succesfully";
}else {
  echo "Sorry An Error Ocured \n Blog couldn't be posted";
}
echo $conn->error;
 ?>
