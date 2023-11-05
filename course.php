<?php 
include('config.php');

$fetch= "SELECT * FROM course ORDER BY cid desc";
$result= mysqli_query($conn,$fetch) or die(mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>COURSE</title>
</head>
<body>
<div class="container my-5">

    <h1>Courses</h1>

    <a href="add-course.php"><button class="btn btn-success">Add Course</button></a>
    <a href="index.php"><button class="btn btn-info">show user</button></a>

  <table class="table table-hover table-dark my-2">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if (mysqli_num_rows($result)> 0){
        while($row=mysqli_fetch_assoc($result)){
      ?>
        <tr>
          <th scope="row"><?php echo $row['cid']?></th>
          <td><?php echo $row['cname']?></td>
          <td><a href="course-edit.php?id=<?php echo $row['cid']?>" class = "btn btn-warning btn-sm">Edit</a></td>
          <td><button class = "btn btn-danger btn-sm">Delete</button></td>
        </tr>
      <?php 
      } }else{ echo "Not Found Data";}
      ?>
    </tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $("tbody").on("click" , ".btn-danger" , function () {
        var row = $(this).closest("tr");
        var id = row.find("th").text();

        // if (confirm("Are you sure you want to delete ID " + id + "?")) {
            $.ajax({
                type: "POST",
                url: "course-delete.php",
                data: { id: id },
                success: function (data) {
                    console.log("Record deleted successfully:", data);
                    row.remove();
                    // alert("Record deleted successfully");
                },
                error: function (error) {
                    console.error("Error deleting record:", error);
                }
            });
        // }
    });
</script>
</body>
</html>  