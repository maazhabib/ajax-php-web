<?php
    include('config.php');

    $fetch = "SELECT * FROM course";
    $result = mysqli_query($conn, $fetch) or die(mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
</head>
<body>

    <div class="container my-5">
        <h1>ADD USER</h1>

        <form id="form">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="course">Choose Courses:</label>
                <select id="course" class="form-control"  multiple="multiple">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row['cid'] ?>"><?php echo $row['cname'] ?></option>
                            <?php
                        }
                    } else {
                        echo "<option>No Data Found</option>";
                    }
                    ?>
                </select>
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            
            $("#course").select2();

            $("#form").submit(function (e) {
                e.preventDefault();

                var formData = {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    phone: $("#phone").val(),
                    course: $("#course").val()
                };

                $.ajax({
                    type: "POST",
                    url: "user-from-submit.php",
                    data: formData,
                    success: function (data) {
                        console.log("Data sent successfully:", data);
                        // window.location.href = "index.php";
                    },
                    error: function (error) {
                        console.error("Error sending data:", error);
                    }
                });
            });
        });
    </script>
</body>
</html>
