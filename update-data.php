<?php
include('config.php');

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$courseId = $_POST['course'];

$updateQuery = "UPDATE user SET name='$name', email='$email', phone='$phone', course_id='$courseId' WHERE id='$id'";
if (mysqli_query($conn, $updateQuery)) {
    $fetchUpdatedData = "SELECT * FROM user INNER JOIN course ON user.course_id = course.cid WHERE user.id = $id";
    $resultUpdatedData = mysqli_query($conn, $fetchUpdatedData) or die(mysqli_error($conn));
    $updatedData = mysqli_fetch_assoc($resultUpdatedData);

    echo json_encode($updatedData);
} else {
    echo json_encode(['error' => mysqli_error($conn)]);
}

mysqli_close($conn);
?>
