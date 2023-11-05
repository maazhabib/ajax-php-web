<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $insertQuery = "INSERT INTO course (cname) VALUES ('$name')";
  
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
