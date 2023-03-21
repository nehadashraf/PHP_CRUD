<?php
function testMessage($condition, $message)
{
    if ($condition) {
        echo "
        <div class='text-center alert alert-success col-5 mx-auto'>$message Successfully</div>
        ";
    } else {
        echo "
        <div class='text-center alert alert-danger col-5 mx-auto'>$message Successfully</div>
        ";
    }
}
function path($go)
{
    echo "<script>location.replace('/com/$go')</script>";
}
function auth($num1 = NULL, $num2 = NULL)
{
    if (($_SESSION['admin'])) {
        if ($_SESSION['admin']["role"] == 1 || $_SESSION['admin']["role"] == $num1 || $_SESSION['admin']["role"] == $num2) {
        } else {
            path("public/403.php");
        }
    } else {
        path("admin/login.php");
    }
}
function filterString($value)
{
    $value = trim($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    $value = stripslashes($value);
    return $value;
}
function stringValidation($value)
{
    $empty = empty($value);
    $len = strlen($value) < 3;
    if ($empty == true || $len == true) {
        return true;
    } else {
        return false;
    }
}
function numberValidation($value)
{
    $empty = empty($value);
    $isNumber = filter_var($value, FILTER_VALIDATE_INT) == false;
    $isNegative = $value < 0;
    if ($empty == true || $isNumber == true || $isNegative == true) {
        return true;
    } else {
        return false;
    }
}
function passwordValidation($value)
{
    $empty = empty($value);
    $len = strlen($value) < 6;
    if ($empty == true || $len == true) {
        return true;
    } else {
        return false;
    }
}
function validationFileSize($imageSize, $size)
{
    $imageValidationSize = ($imageSize / 1024) / 1024; //MB
    if ($imageValidationSize > $size) {
        return true;
    } else {
        return false;
    }
}
function validationFileType($imageType)
{
    if ($imageType == "image/jpeg" || $imageType == "image/jpg" || $imageType == "image/png" || $imageType == "image/jif") {
        return false;
    } else {
        return true;
    }
}
