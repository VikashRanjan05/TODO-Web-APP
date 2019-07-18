<?php
header("Content-Type: application/json");
include 'response.php';

include 'config/connection.php';

$filter = $_GET['filter'];
if($filter=="all"){
    $sql = "SELECT * FROM todoitem";
}else if($filter=="completed"){
    $sql = "SELECT * FROM todoitem WHERE isCompleted='1'";
}else if($filter=="incompleted"){
    $sql = "SELECT * FROM todoitem WHERE isCompleted='0'";
}
 $res=mysqli_query($conn,$sql);
    
$todo = array();
while ($row=mysqli_fetch_assoc($res)) {
    array_push($todo,array(
        "id"=>$row['id'],
        "caption"=>$row['caption'],
        "isCompleted"=>$row['isCompleted'])
    );
}
echo json_encode(successResponse($todo));

?>