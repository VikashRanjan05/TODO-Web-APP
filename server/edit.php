<?php

include 'config/connection.php';
include 'response.php';

$id=$_POST['id'];
if($_POST['caption']){
$new_caption=$_POST['caption'];
}


$que = "SELECT isCompleted FROM todoitem WHERE id='$id'";
$res=mysqli_query($conn,$que);
$row=mysqli_fetch_assoc($res);


if($id && !$_POST['caption']){
    if($row['isCompleted']==1){
        $sql = "UPDATE `todoitem` SET isCompleted='0' WHERE id=$id";
        if ($conn->query($sql) === TRUE) { echo json_encode(successResponse("isCompleted=0"));}
        }else{
            $sql = "UPDATE `todoitem` SET isCompleted='1' WHERE id=$id";
            if ($conn->query($sql) === TRUE) { echo json_encode(successResponse("isCompleted=1"));}
        }
    }else {
        if(!preg_match('/^[a-zA-Z0-9\s]*$/',$new_caption)){
            echo json_encode(errorResponse("Error"));
        }else{
            $sql = "UPDATE `todoitem` SET caption='$new_caption' WHERE id='$id'";
            if ($conn->query($sql) === TRUE) { echo json_encode(successResponse($new_caption));}
        }
    }


?>