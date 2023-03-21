<?php
//connection
include '../app/config.php';
include '../app/functions.php';
//UI
include '../public/nav.php';
include '../public/head.php';
auth(2, 3);
$select = "SELECT *FROM `department`";
$selection = mysqli_query($connect, $select);
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM `department` WHERE `id`=$id ";
    $deletion = mysqli_query($connect, $delete);
    path("department/list.php");
}

?>

<h1 class="text-center text-info display-1 mt-5 p5-5">List Department</h1>
<div class="container col-6">
    <div class="card">
        <div class="body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>created_at</th>
                    <th colspan="2" class="text-center">Action</th>
                </tr>
                <?php
                foreach ($selection as $data) : ?>
                    <tr>
                        <td><?= $data['id'] ?></td>
                        <td><?= $data['name'] ?></td>
                        <td><?= substr($data['created_at'], 10, 9) ?></td>
                        <td>
                            <a href="/com/department/edit.php?edit=<?= $data['id'] ?>" class="btn btn-info">Edit</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Are you Sure?')" href="/com/department/list.php?delete=<?= $data['id'] ?>" class="btn btn-danger">Remove</a>
                        </td>
                    </tr>

                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
<?php
include '../public/script.php'
?>