<?php
include '../app/config.php';
include "../app/functions.php";
include '../public/nav.php';
include '../public/head.php';
auth();
$select="SELECT *FROM `employeewithdepartment`";
$selection=mysqli_query($connect,$select);
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    
    $selectIamge="SELECT `image` FROM `employeewithdepartment` WHERE id=$id";
    $runSelect=mysqli_query($connect,$select);
    $row=mysqli_fetch_assoc($runSelect);
    $image=$row['image'];
    unlink("./upload/$image");

    $delete="DELETE FROM `employee` WHERE `id`=$id ";
    $deletion=mysqli_query($connect,$delete);
    path("employee/list.php");
}
auth();
?>
<h1 class="text-center text-info display-1 mt-5 pt-5">List Employee Page</h1>
<div class="container col-9">

    <form action="./search.php" method="GET" >
    <div class="row mt-5 my-3">
        <div class="col-md-10">
        <div class="form-group" >
            <input type="text" id="myInput" name="nameValue" placeholder="Search" class="form-control p-2 " >
        </div>
        </div>
        <div class="col-md-2">
            <div class="d-grid">
            <button name="search"  class="btn btn-info">Search</button>
            </div>
        </div>

        </div>

    </form>
    <div class="card ">
        <div class="card-body">
            <table id="myTable" class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2" class="text-center">Action</th>
                </tr>
                <?php foreach($selection as $data):?>
                    <tr>
                        <td><?=$data['id']?></td>
                        <td><?=$data['empName']?></td>
                        <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary " type="button" data-bs-toggle="dropdown" aria-expanded="false">                                 
                            <i class="fa-solid fa-list"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-info"  href="/com/employee/edit.php?edit=<?=$data['id']?>"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a></li>
                                <li><a class="dropdown-item text-danger"  onclick="return confirm('Are you Sure?')" href="/com/employee/list.php?delete=<?=$data['id']?>"><i class="fa-solid fa-trash"></i></a></li>
                                <li><a class="dropdown-item text-primary" href="/com/employee/profile.php?profile=<?=$data['id']?>" ><i class="fa-solid fa-eye"></i></a></li>
                            </ul>
                        </div>
                        </td>
                    </tr>
                    <?php endforeach ;?>
            </table> 
        </div>
    </div>
</div>
<?php
include '../public/script.php';
?>
