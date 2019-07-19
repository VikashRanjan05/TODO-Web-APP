<?php

include 'config/connection.php';
include 'response.php';

$id=$_POST['id'];

$sql = "DELETE FROM `todoitems` WHERE id=$id";


if ($conn->query($sql) === TRUE) {
    echo json_encode(successResponse("Deleted"));
} else {
    header("HTTP/1.1 500");
    echo json_encode(errorResponse(mysqli_error($conn)));}
?>