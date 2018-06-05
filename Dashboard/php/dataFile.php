<?php
require 'conn.php';

 function fetchArrayFromDb($value){
   global $conn;
  $smallArray = array();
  $selectDataQuery = $conn->query("SELECT * FROM ".$value." ");
  while ($a = $selectDataQuery->fetch_assoc()) {
    // $a = htmlspecialchars_decode( $a );
    if ($value == "blogposts") {
      $a['content'] = htmlspecialchars_decode($a['content']);
    }
    array_push($smallArray, $a);
  }
  return $smallArray;
}
//
$bigArray = array();
array_push($bigArray, fetchArrayFromDb("blogposts") );

echo json_encode($bigArray);
 ?>
