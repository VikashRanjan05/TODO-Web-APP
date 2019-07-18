<?php
function successResponse($successObj) {
    $successResponseObj = [
        'success' => true,
        'data' => $successObj
    ];
    return $successResponseObj;
}

function errorResponse($errorObj) {
    $errorResponseObj = [
        'error' => true,
        'data' => $errorObj
    ];
    return $errorResponseObj;
}
?>
