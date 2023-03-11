<?php 
//connection
include '../app/config.php';
include '../app/functions.php';
//UI
include '../public/nav.php';
include '../public/head.php';
//section
if(isset($_POST['login'])){
    $name=$_POST['name'];
    $password=$_POST['password'];
    $select="SELECT * FROM `admin` WHERE `name`='$name' and `password`='$password'";
    $s=mysqli_query($connect,$select);
    $numOfRows=mysqli_num_rows($s);
    if($numOfRows==1){
        path("/");
        $_SESSION['admin']=$name;
    }
    else{
        echo"
        <div class='text-center alert alert-danger col-5 mx-auto'>Please Try Again</div>
        ";
    }
}
?>

<h1 class="text-center text-info display-1 mt-5 pt-5">Login Page</h1>
<div class="container col-6">
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
                <button class="btn btn-info m-3" name="login">log in</button>
            </form>
        </div>
    </div>
</div>
<?php 
include '../public/script.php'
?>