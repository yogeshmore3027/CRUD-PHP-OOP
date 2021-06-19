<?php
include 'model.php';

$obj = new Model();
// print_r($obj);

// Insert Record

if (isset($_POST['submit'])) {

    // print_r($_POST);
    $obj->insertRecord($_POST);
} //if isset close

// $data = $obj->displayRecord();
// print_r($data);


// Update Record
if (isset($_POST['update'])) {

    // print_r($_POST);
    $obj->updateRecord($_POST);
} //if isset close

// Delete Record
if (isset($_GET['deleteid'])) {

   $delid = $_GET['deleteid'];
    $obj->deleteRecord($delid);
} //if isset close


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>CRUD - PHP|OOP</title>
</head>

<body ><br>
    <h2 class="text-center text-primary">CRUD - PHP|OOP</h2>
    <br>
    <div class="container col-10">

        <!-- Success Msg -->
        <?php
        if (isset($_GET['msg']) and $_GET['msg'] == 'insert') {

            echo '<div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Record Inserted Successfully..!!    
            
            </div>';
        
            
        }

        if (isset($_GET['msg']) and $_GET['msg'] == 'update') {

                echo '<div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Record Updated Successfully..!! 
                </div>';
        }
        if (isset($_GET['msg']) and $_GET['msg'] == 'delete') {
                echo '<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong>  Record Deleted Successfully..!!
                </div>';
                
        }
        ?>

        <?php 
        if(isset($_GET['editid'])) {
            $editid = $_GET['editid'];
           $myrecord = $obj->displayRecordById($editid);
            // print_r($myrecord);
         ?>
        <!-- Update Form -->
        <form action="index.php" method="post">

            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" value="<?php echo $myrecord['name']; ?>" placeholder="Enter Name..."
                    class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="hidden" name="eid" value="<?php echo $myrecord['id']; ?>">
                <input type="text" name="email" value="<?php echo $myrecord['email']; ?>" placeholder="Enter Email..."
                    class="form-control" required>
            </div>

            <div class="form-group">
                <input type="submit" name="update" value="Update" class="btn btn-info">
            </div>

        </form>
        <?php 
        } else { ?>

        <form action="index.php" method="post">

            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" placeholder="Enter Name..." class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" placeholder="Enter Email..." class="form-control" required>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Submit" class="btn btn-info">
            </div>

        </form>


        <?php  }
        ?>

        <br>
      
        <!-- <h4 class="text-center text-danger"> Records </h4> -->
        <table class="table table-bordered">
            <tr class="bg-secondary text-white text-center">
                <th>S.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            // Display Records

            $data = $obj->displayRecord();
            $sno = 1;
            foreach ($data as $value) {
                // print_r($value) ;
            ?>

            <tr class="text-center">
                <td><?php echo $sno++; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['email']; ?></td>
                <td>
                    <a href="index.php?editid=<?php echo $value['id']; ?>" class="btn btn-info">Edit</a>
                    <a href="index.php?deleteid=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
            } //close  loop
            ?>

        </table>
    </div>
</body>

</html>