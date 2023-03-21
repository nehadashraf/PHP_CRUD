<?php
session_start();
if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  header("location:/com/admin/login.php");
}
?>
<nav class="navbar navbar-expand-lg bg-dark Navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">DIV INN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        if (isset($_SESSION['admin'])) : ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/com/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/com/admin/profile.php">Profile</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Department
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/com/department/add.php">Add Department</a></li>
              <li><a class="dropdown-item" href="/com/department/list.php">List Department</a></li>
            </ul>
          </li>
          <?php if ($_SESSION['admin']['role'] == 1 || $_SESSION['admin']['role'] == 2) : ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Employee
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/com/employee/add.php">Add Employee</a></li>
                <li><a class="dropdown-item" href="/com/employee/list.php">List Employee</a></li>
              </ul>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['admin']['role'] == 1) : ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Admins
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/com/admin/add.php">Add Admin</a></li>
                <li><a class="dropdown-item" href="/com/admin/list.php">List Admin</a></li>
              </ul>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <div>
        <?php if (!isset($_SESSION['admin'])) : ?>
          <a href="/com/admin/login.php" class="btn btn-outline-success">Login</a>
        <?php else : ?>
          <form action="" method="GET">
            <button name="logout" href="/com/admin/login.php" class="btn btn-outline-danger">Logout</button>
          </form>
        <?php endif ?>
      </div>
    </div>
  </div>
</nav>