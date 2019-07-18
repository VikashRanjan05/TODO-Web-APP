<?php

include 'config/connection.php';
include 'response.php';

$id=$_POST['id'];

$sql = "DELETE FROM `todoitem` WHERE id=$id";


if ($conn->query($sql) === TRUE) {
    echo json_encode(successResponse("Deleted"));
} else {
    echo json_encode(errorResponse("Error"));}
?>