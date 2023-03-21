<?php
include '../app/config.php';
include "../app/functions.php";
include '../public/nav.php';
include '../public/head.php';
auth(2);
if (isset($_GET['profile'])) {
    $id = $_GET['profile'];
    $select = "SELECT *FROM `employeewithdepartment` WHERE id=$id";
    $selection = mysqli_query($connect, $select);
    $row = mysqli_fetch_assoc($selection);
}
?>
<h1 class="text-center text-info display-1 mt-5 pt-5">Profile Employee Page</h1>
<div class="container col-9">
    <div class="card">
        <img src="./upload/<?= $row['image'] ?>" alt="" class="img-top">
        <div class="card-body">
            <p>Name : <?= $row['empName'] ?></p>
            <p> Salary : <?= $row['salary'] ?></p>
            <p>Department : <?= $row['departName'] ?></p>
            <a class=" text-info" href="/com/employee/edit.php?edit=<?= $id ?>"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>
            <a class="text-danger" onclick="return confirm('Are you Sure?')" href="/com/employee/list.php?delete=<?= $id ?>"><i class="fa-solid fa-trash"></i></a>

        </div>
    </div>
</div>
<?php
include '../public/script.php';
?>