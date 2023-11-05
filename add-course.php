
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD COURSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="container my-5">
        <h1>ADD COURSES</h1>

        <form id="form">
            <div class="mb-3">
                <label for="name" class="form-label"> Course Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter a Course Name">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
        
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>

    $(document).ready(function () {
        $("#form").submit(function (e) {
            e.preventDefault(); 

            var formData = {
                name: $("#name").val(),
            };
        
            $.ajax({
                type: "POST",
                url: "course-from-submit.php", 
                data: formData,
                success: function (data) {
                    console.log("Data sent successfully:", data);
                    window.location.href="course.php";
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