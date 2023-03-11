<?php
include '../app/config.php';
include "../app/functions.php";
include '../public/nav.php';
include '../public/head.php';
auth();
$select="SELECT *FROM `department`";
$selection=mysqli_query($connect,$select);
if(isset($_POST['send'])){
    $name=$_POST['name'];
    $salary=$_POST['salary'];

    //uplaod file
    $imageName=time().$_FILES['image']['name'];
    $imageTmpName=$_FILES['image']['tmp_name'];
    $location="upload/".$imageName;
    move_uploaded_file($imageTmpName,$location);
    
    $departID=$_POST['departID'];
    $insert="INSERT INTO `employee` VALUES(NULL,'$name',$salary,'$imageName',$departID,default)";
    $insertion=mysqli_query($connect,$insert);
    testMessage($insertion,"insert");
}

?>
<h1 class="text-center text-info display-1 mt-5 pt-5">Add Employee Page</h1>
<div class="container">
    <div class="card col-6 mx-auto mt-5">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group mt-2">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="">Salary</label>
                <input type="text" name="salary" class="form-control">
            </div>
                        <!-- Upload Image -->
            <div class="form-group mt-2">
                <label for="">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="">departmentID</label>
                <select name="departID" id="" class="form-control">
                    <?php foreach($selection as $data):?>
                    <option value="<?=$data['id']?>"><?=$data['name']?></option>
                    <?php endforeach?>
                </select>
            </div>
            <button class="btn btn-info m-3" name="send">Send</button>
            </form>
    </div>
</div>
<?php
include '../public/script.php';
?>
