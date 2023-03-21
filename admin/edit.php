<?php
//connection
include '../app/config.php';
include '../app/functions.php';
//UI
include '../public/nav.php';
include '../public/head.php';
$errors = [];
$name = NULL;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select = "SELECT * FROM `admin` WHERE `id`=$id";
    $selection = mysqli_query($connect, $select);
    $row = mysqli_fetch_assoc($selection);

    if (isset($_POST['send'])) {
        $name = filterString($_POST['name']);
        $password = sha1($_POST['password']);
        if (stringValidation($name)) {
            $errors[] = "Please Enter Valid Name ";
        }
        if (passwordValidation($password)) {
            $errors[] = "Please Enter valid password";
        }
        if (empty($errors)) {
            $insert = "UPDATE `admin` SET  name='$name', password='$password' where id=$id";
            $insertion = mysqli_query($connect, $insert);
            path('admin/list.php');
        }
    }
}
auth();
?>
<h1 class="text-center text-info display-1 mt-5 pt-5">Edit Admin Page</h1>
<div class="container col-6">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $data) : ?>
                    <li><?= $data ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="body">
            <form action="" method="POST" class="m-3">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" value="<?= $row['name'] ?>" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" value="" name="password" class="form-control">
                </div>
                <button class="btn btn-info m-3" name="send">update</button>
            </form>
        </div>
    </div>
</div>
<?php
include '../public/script.php'
?>