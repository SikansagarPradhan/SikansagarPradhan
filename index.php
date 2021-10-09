<?php
$insert = false;
$update = false;
$delete = false;
$servername = "localhost";
$username = "root";
$password ="";
$database = "mynotes";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Connection is not established".mysqli_connect_error());
};
if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `mytable` WHERE `srn` = $sno";
    $result = mysqli_query($conn,$sql);
    if ($result){
        $delete = true;
    }

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['srno'])){   
        //upadate record
        $srn = $_POST['srno'];
        $title = $_POST['titleEdit'];
        $description = $_POST['descriptionEdit'];
    
        $sql ="UPDATE `mytable` SET `title` = '$title' , `description` = '$description' WHERE `mytable`.`srn` = $srn;";
        $result = mysqli_query($conn,$sql);
        if($result){
            $update = true;
        }
    }
    else{
        $title = $_POST['title'];
        $description = $_POST['description'];
    
        $sql ="INSERT INTO `mytable` (`title`, `description`) VALUES ('$title', '$description')";
        $result = mysqli_query($conn,$sql);

        if($result){
            $insert = true;
        }
        else{
            echo 'The record has not been recorded'. mysqli_error($conn);
        }
};
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <title>To-Do form</title>
</head>

<body>
    <!-- modal for edit -->
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editmodal">
  Editmodal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodalLable" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editmodalLabel">Edit Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action='/crud/index.php' method='POST'>
      <input type="hidden" name="srno" id="srno">
            <div class="form-group">
                <label for="title">Note title </label>
                <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp"
                    placeholder="Enter note">
            </div>
            <div class="form-group">
                <label for="description">Add description</label>
                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add note</button>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
     



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Inote</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Contact</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    
    if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Your note added successfully</strong> 
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    if($update){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Your note updated successfully</strong> 
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    if($delete){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Your note deleted successfully</strong> 
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }


    ?>

    <div class="container my-5">
        <h2> My Note </h2>
        <form action='/crud/index.php' method='POST'>
            <div class="form-group">
                <label for="title">Note title </label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                    placeholder="Enter note" require>
            </div>
            
            <div class="form-group">
                <label for="description">Add description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add note</button>
        </form>
    </div>

    <div class="container my-4">
        <table class="table" id="mytable">
            <thead>
                <tr>
                    <th scope="col">Srn</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `mytable`";
                $result = mysqli_query($conn,$sql);
                $serial = 0;
                while ($row = mysqli_fetch_assoc($result)){
                    $serial = $serial + 1;
                    echo "<tr>
                    <th scope='row'>".$serial."</th>
                    <td>".$row['title']."</td>
                    <td>".$row['description']."</td>
                    <td><button class='edit btn btn-sm btn-primary' id=".$row['srn'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['srn'].">Delete</button> </td>  
                </tr>";
                };

                ?>
            </tbody>
        </table>
    </div>
    <hr>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function(){
            $('#mytable').DataTable();
        });
        </script>
        <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener('click',(e)=>{
                console.log('edit');
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                desc = tr.getElementsByTagName("td")[1].innerText;
                console.log(title,desc);
                titleEdit.value = title;
                descriptionEdit.value = desc;
                srno.value = e.target.id;
                console.log(e.target.id);
                $('#editmodal').modal('toggle');

            });
        });
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element)=>{
            element.addEventListener('click',(e)=>{
                console.log('delete', );
                sno = e.target.id.substr(1,);
                if(confirm('Are you sure to delete')){
                    console.log('yes');
                    window.location =`/crud/index.php?delete=${sno}`;
                }
                else{
                    console.log('No');
                };
            });
        });
        </script>
</body>

</html>