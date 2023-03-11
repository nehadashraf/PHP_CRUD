<?php 
//connection
include '../app/config.php';
include '../app/functions.php';
//UI
include '../public/nav.php';
include '../public/head.php';
auth();
$name=NULL;
if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $select="SELECT * FROM `department` WHERE `id`=$id";
    $selection=mysqli_query($connect,$select);
    $row=mysqli_fetch_assoc($selection);

    if(isset($_POST['send'])){
        $name=$_POST['name'];
        $insert="UPDATE `department` SET  name='$name' where id=$id";
        $insertion=mysqli_query($connect,$insert);
        path('department/list.php');
    }
}
?>
<h1 class="text-center text-info display-1 mt-5 pt-5">Add department Page</h1>
<div class="container col-6">
    <div class="card">
        <div class="body">
            <form action="" method="POST" class="m-3">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" value="<?= $row['name']?>" name="name" class="form-control">
                </div>
                <button class="btn btn-info m-3" name="send">update</button>
            </form>
        </div>
    </div>
</div>
<?php 
include '../public/script.php'
?>