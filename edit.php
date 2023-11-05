<?php 
include('config.php');

$id = $_GET['id'];

$fetchUser = "SELECT * FROM user INNER JOIN course ON user.course_id = course.cid WHERE id = $id";
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
    <title>FORM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="container my-5">
        <h1>USER UPDATE</h1>

        <form id="form">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="<?php echo $rowUser['name']?>" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" value="<?php echo $rowUser['email']?>" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" value="<?php echo $rowUser['phone']?>" id="phone">
            </div>
            <label class="form-label" for="course">Choose a Course:</label>
            <select id="course" class="form-control" name="course">
                <?php 
                if (mysqli_num_rows($resultCourses) > 0) {
                    while ($rowCourse = mysqli_fetch_assoc($resultCourses)) {
                        $selected = ($rowCourse['cid'] == $rowUser['course_id']) ? 'selected' : '';
                ?>
                        <option value="<?php echo $rowCourse['cid']?>" <?php echo $selected ?>><?php echo $rowCourse['cname']?></option>
                <?php 
                    }
                } else { 
                    echo "Not Found Data"; 
                }
                ?>
            </select>
            <br>

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
            url: "update-data.php", 
            data: formData,
            dataType: 'json', 
            success: function (updatedData) {
                console.log("Data updated successfully:", updatedData);

                $("#name").val(updatedData.name);
                $("#email").val(updatedData.email);
                $("#phone").val(updatedData.phone);
                window.location.href="index.php";


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