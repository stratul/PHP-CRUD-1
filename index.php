<?php

$db = mysqli_connect("localhost", "root", "", "movie");

if($db){
    // echo "Database Connection Established !";
} else {
    echo "Database Connection Established Failed !";
}

ob_start();

?>



<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<!-- Fontawsome CDN -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

<title>CRUD</title>
</head>
<body>

    <center class="my-5">
        <h1>PHP CRUD Operations</h1>
    </center>

    <div class="container">
        <div class="row">
            
            <div class="col-md-6">
                <form method="POST">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Genre Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="gen_name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Genre Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="gen_desc"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="gen_add">ADD</button>
                    </div>
                </form>                
            </div>

            <?php
            
                if(isset($_POST['gen_add'])){
                    $gen_name = $_POST['gen_name'];
                    $gen_desc = $_POST['gen_desc'];

                    $sql = "INSERT INTO genre (gen_name,gen_desc) VALUES ('$gen_name','$gen_desc')";
                    $result = mysqli_query($db,$sql);

                    if($result){
                        // echo "Value Inserted";
                    }else {
                        echo "Value Insertion Failed!";
                    }
                }
            
            ?>
            
            <div class="col-md-6">
                <table class="table table-success">
                    <thead>
                        <tr>
                            <th scope="col">Serial No.</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            $sql2 = "SELECT * FROM genre";
                            $result = mysqli_query($db,$sql2);
                            $count = 0;

                            while ($row = mysqli_fetch_assoc($result)){
                                $gen_id = $row['gen_id'];
                                $gen_name = $row['gen_name'];
                                $gen_desc = $row['gen_desc'];
                                $count++;
                        ?>

                                <tr>
                                    <th scope="row"><?php echo $count ?></th>
                                    <td><?php echo $gen_name ?></td>
                                    <td><?php echo $gen_desc ?></td>
                                    <td>
                                        <a href="" class="mx-2"><i class="fas fa-edit text-warning"></i></a>
                                        <a href="index.php?delete_id=<?php echo $gen_id?>"><i class="fas fa-trash-alt text-danger"></i></a>
                                    </td>
                                </tr>
                        <?php

                            }
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>

            <?php
                if(isset($_GET['delete_id'])){
                    $delete_id = $_GET['delete_id'];

                    $sql3 = "DELETE FROM genre WHERE gen_id = '$delete_id'";
                    $result = mysqli_query($db,$sql3);

                    if($result){
                        // echo "Successfully Deleted";
                        header('location: index.php');
                    } else {
                        echo "Delete Operation Failed!";
                    }
                }
            ?>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <?php

        ob_end_flush();
        
    ?>
</body>
</html>