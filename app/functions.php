<?php
function testMessage($condition,$message){
    if($condition){
        echo"
        <div class='text-center alert alert-success col-5 mx-auto'>$message Successfully</div>
        ";
    }
    else
    {
        echo"
        <div class='text-center alert alert-danger col-5 mx-auto'>$message Successfully</div>
        ";
    }
}
function path($go){
    echo "<script>location.replace('/com/$go')</script>";
}
function auth(){
    if(!isset($_SESSION['admin'])){
        header("location:/com/admin/login.php");
    }    
}

?>
