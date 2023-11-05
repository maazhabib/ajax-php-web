<?php 
include('config.php');

$fetch= "SELECT * FROM user INNER JOIN course ON user.course_id = course.cid ORDER BY id desc" ;
$result= mysqli_query($conn,$fetch) or die(mysqli_error($conn));


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>TABLE</title>
</head>
<body>
<div class="container my-5">

    <h1>Student Table</h1>
    <a href="form.php"><button class="btn btn-success">Add User</button></a>
    <a href="course.php"><button class="btn btn-info">Show Course</button></a>
    <a href="certificate.php"><button class="btn btn-dark">Certification</button></a>

  <table class="table table-hover table-dark my-2">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Course</th>
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
        <th scope="row"><?php echo $row['id']?></th>
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['email']?></td>
        <td><?php echo $row['phone']?></td>
        <td><?php echo $row['cname']?></td>
        <td><a href="edit.php?id=<?php echo $row['id']?>" class = "btn btn-warning btn-sm">Edit</a></td>
        <td><button id="delete" class = "btn btn-danger btn-sm">Delete</button></td>
      </tr>
      <?php 
      }
        }else{ echo "Not Found Data"; }
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
                url: "delete.php",
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