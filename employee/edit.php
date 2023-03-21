<?php
include '../app/config.php';
include "../app/functions.php";
include '../public/nav.php';
include '../public/head.php';
auth(2);
$errors = [];
$select = "SELECT *FROM `department`";
$selectDepart = mysqli_query($connect, $select);
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select = "SELECT * FROM `employeeWithDepartment` where id=$id";
    $selection = mysqli_query($connect, $select);
    $row = mysqli_fetch_assoc($selection);
    if (isset($_POST['send'])) {
        $name = filterString($_POST['name']);
        $salary = $_POST['salary'];
        if (stringValidation($name)) {
            $errors[] = "Please Enter Valid Name ";
        }
        if (numberValidation($salary)) {
            $errors[] = "Please Enter Valid Salary";
        }

        if (empty($errors)) {
            if (!empty($_FILES['image']['name'])) {
                $imageName = time() . $_FILES['image']['name'];
                $imageTmpName = $_FILES['image']['tmp_name'];
                $location = "upload/" . $imageName;
                move_uploaded_file($imageTmpName, $location);
                $image_name = $row['image'];
                unlink("./upload/$image_name");
            } else {
                $imageName = $row['image'];
            }
            $departID = $_POST['departID'];
            $insert = "UPDATE `employee` SET name='$name', salary=$salary ,imageName='$imageName', departmentID= $departID where id=$id";
            $insertion = mysqli_query($connect, $insert);
            path('employee/list.php');
        }
    }
}

?>
<h1 class="text-center text-info display-1 mt-5 pt-5">Edit Employee Page</h1>
<div class="container">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $data) : ?>
                    <li><?= $data ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="card col-md-6 mx-auto mt-5">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group mt-2">
                    <label for="">Name</label>
                    <input type="text" name="name" value="<?= $row['empName'] ?>" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">Salary</label>
                    <input type="text" name="salary" value="<?= $row['salary'] ?>" class="form-control">
                </div>
                <!-- Update Image -->
                <label for="">Image : </label><span><img width="80px" src="./upload/<?= $row['image'] ?>" alt=""></span>
                <div class="form-group mt-2">
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="">departmentID</label>
                    <select name="departID" id="" class="form-control">
                        <option selected value="<?= $row['departid'] ?>"><?= $row['departName'] ?></option>
                        <?php foreach ($selectDepart as $data) : ?>
                            <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <button class="btn btn-info m-3" name="send">Update</button>
            </form>
        </div>
    </div>
</div>
<?php
include '../public/script.php';
?>