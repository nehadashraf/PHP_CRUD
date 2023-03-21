<?php
include '../app/config.php';
include "../app/functions.php";
include '../public/nav.php';
include '../public/head.php';
auth(2, 3);
$adminId = $_SESSION['admin']['id'];
$select = "SELECT *FROM `adminsroles` WHERE id=$adminId";
$selection = mysqli_query($connect, $select);
$row = mysqli_fetch_assoc($selection);

if (isset($_POST['send'])) {
    $imageName = time() . $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $location = "upload/" . $imageName;
    $imageValue = $_FILES['image']['name'];

    if (empty($_FILES['image']['name'])) {
        $imageName = $row['Image'];
    } else {
        move_uploaded_file($imageTmpName, $location);
        $imageOldName = $row['Image'];
        if ($imageOldName != "fake.jpg") {
            unlink("./upload/$imageOldName");
        }
    }
    $insert = "UPDATE `admin` SET `Image`='$imageName' where id=$adminId";
    $insertion = mysqli_query($connect, $insert);
    path('admin/profile.php');
}




?>
<h1 class="text-center text-info display-1 mt-5 pt-5">Profile Admin </h1>
<div class="container col-4">
    <div class="card">
        <div class="card-body">
            <img src="./upload/<?= $row['Image'] ?>" alt="" class="w-100 img-top">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Upload New Image
            </button>
            <p>Name : <?= $row['name'] ?></p>
            <p>Role : <?= $row['description'] ?></p>
            <a class=" text-info" href="/com/admin/editProfile.php"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>
            <a class="text-danger" onclick="return confirm('Are you Sure?')" href="/com/admin/list.php?delete=<?= $id ?>"><i class="fa-solid fa-trash"></i></a>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="body">
                        <form action="" method="POST" class="m-3" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <button class="btn btn-info m-3" name="send">send</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
include '../public/script.php';
?>