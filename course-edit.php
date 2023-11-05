<?php 
include('config.php');

$id = $_GET['id'];

$fetchUser = "SELECT * FROM course WHERE cid = $id";
$resultUser = mysqli_query($conn, $fetchUser) or die(mysqli_error($conn));

$rowUser = mysqli_fetch_assoc($resultUser);

$fetchCourses = "SELECT * FROM course";
$resultCourses = mysqli_query($conn, $fetchCourses) or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COURSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="container my-5">
        <h1>COURSE UPDATE</h1>

        <form id="form">
            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" value="<?php echo $rowUser['cname']?>" class="form-control" id="name">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
     $(document).ready(function () {
    $("form").submit(function (e) {
        e.preventDefault(); 

        var formData = {
            id: <?php echo $id ?>,
            name: $("#name").val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            course: $("#course").val()
        };
        
        $.ajax({
            type: "POST",
            url: "course-update.php", 
            data: formData,
            dataType: 'json', 
            success: function (updatedData) {
                // console.log("Data updated successfully:", updatedData);

                $("#name").val(updatedData.name);
                window.location.href="course.php";
            },
            error: function (error) {
                console.error("Error updating data:", error);
            }
        });
    });
});
    </script>
</body>
</html>