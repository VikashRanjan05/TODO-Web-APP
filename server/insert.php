<?php

include 'config/connection.php';
include 'response.php';

$caption=$_POST['caption'];
$isCompleted=$_POST['isCompleted'];

if(!preg_match('/^[a-zA-Z0-9\s]*$/',$caption)){
    echo json_encode(errorResponse($caption));
}else if(preg_match('/^[a-zA-Z0-9\s]*$/',$caption) && !($isCompleted=="0" || $isCompleted=="1")){
    echo json_encode(errorResponse($caption));
}
else{
   $sql = "INSERT INTO `todoitem` (`caption`, `isCompleted`)
        VALUES ('$caption', '$isCompleted')";
    mysqli_query($conn,$sql);
}
$query="SELECT * FROM `todoitem` ORDER BY id DESC limit 1";
$query_result=mysqli_query($conn,$query);
$query_row=mysqli_fetch_assoc($query_result);
$new_id=$query_row['id'];

$result="SELECT * FROM todoitem WHERE id=$new_id";
$final_result=mysqli_query($conn,$result);
$final_row=mysqli_fetch_assoc($final_result);
echo json_encode(successResponse($final_row)); 

 
?>