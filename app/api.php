<?php
header('Content-Type: Application/Json');
include('../connection/database.php');
$fetchAllBlog = "SELECT * FROM blog_schema ORDER BY id";
$querySql = $connection->query($fetchAllBlog);
$countData = mysqli_num_rows($querySql);
$apiResponse = [];
if ($countData > 0) {
    while ($row = mysqli_fetch_assoc($querySql)) {
        $apiResponse[] = $row;
    }
    echo json_encode($apiResponse, JSON_PRETTY_PRINT);
} else {
    $errorResponse = ['error' => 'no blog found'];
    echo json_encode($errorResponse);
}
