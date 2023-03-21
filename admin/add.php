<?php
include '../app/config.php';
include '../app/functions.php';
include '../public/head.php';
include '../public/nav.php';
$errors = [];
$roles = "SELECT * FROM `roles`";
$roleData = mysqli_query($connect, $roles);
$row = mysqli_fetch_assoc($roleData);
if (isset($_POST['send'])) {
    $name = filterString($_POST['name']);
    $password = sha1($_POST['password']);
    $role = $_POST['role'];
    if (stringValidation($name)) {
        $errors[] = "Please Enter Valid Name ";
    }
    if (passwordValidation($password)) {
        $errors[] = "Please Enter Valid Password";
    }
    if (empty($errors)) {
        $insert = "INSERT INTO `admin` VALUES(NULL,'$name','$password',$role,'fake.jpg')";
        $insertion = mysqli_query($connect, $insert);
    }
}
auth();

?>
<h1 class="text-center text-info display-1 mt-5 pt-5">Add department Page</h1>
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
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="role" id="" class="form-control">
                        <?php foreach ($roleData as $data) : ?>
                            <option value=<?= $data['id'] ?>><?= $data['description'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-info m-3" name="send">send</button>
            </form>
        </div>
    </div>
</div>
<?php
include '../public/script.php';
?>