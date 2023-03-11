<?php 
//connection
include '../app/config.php';
include '../app/functions.php';
//UI
include '../public/nav.php';
include '../public/head.php';

if(isset($_POST['send'])){
$name=$_POST['name'];
$insert="INSERT INTO `department` values(NULL,'$name',Default)";
$insertion=mysqli_query($connect,$insert);
testMessage($insertion,"Insertion");
}
?>

<h1 class="text-center text-info display-1 mt-5 pt-5">Add department Page</h1>
<div class="container col-6">
    <div class="card">
        <div class="body">
            <form action="" method="POST" class="m-3">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <button class="btn btn-info m-3" name="send">send</button>
            </form>
        </div>
    </div>
</div>
<?php 
include '../public/script.php'
?>