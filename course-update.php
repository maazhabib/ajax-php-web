<?php
include('config.php');

$id = $_POST['id'];
$name = $_POST['name'];


$updateQuery = "UPDATE course SET cname='$name' WHERE cid='$id'";
if (mysqli_query($conn, $updateQuery)) {
    $fetchUpdatedData = "SELECT * FROM course WHERE cid = $id";
    $resultUpdatedData = mysqli_query($conn, $fetchUpdatedData) or die(mysqli_error($conn));
    $updatedData = mysqli_fetch_assoc($resultUpdatedData);

    echo json_encode($updatedData);
} else {
    echo json_encode(['error' => mysqli_error($conn)]);
}

mysqli_close($conn);
?>
