<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    // $courseID =  $_POST['course'];
    $register_date = date("Y.m.d");


    $insertQuery = "INSERT INTO user (name, email, phone, register_date) VALUES ('$name', '$email', '$phone' , '$register_date')";
  var_dump($insertQuery);
    if (mysqli_query($conn, $insertQuery)) {
        echo "Data inserted successfully";
        
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }

    mysqli_close($conn);

} else {
    echo "Form not submitted";
}
?>
