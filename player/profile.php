<?php
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
include('../connection.php');
session_start();
$user_check = $_SESSION['email'];
$query = "SELECT * FROM `users` WHERE `email`='$user_check'";
$result = mysqli_query($con, $query);
$result_fetch = mysqli_fetch_assoc($result);
$loggedin_user = $result_fetch['user_name'];
$loggedin_email = $result_fetch['email'];
$loggedin_pass = $result_fetch['password'];



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


    <header>
        <img class="logo" src="../images/image 4.png" alt="">
        <div class="containerArrow">
            <a href="main-menu.php"><img class="arrow" src="../images/Arrow.png" alt=""></a>
            <p> العودة إلى القائمة الرئيسية</p>
        </div>
    </header>

    <div class="content">
        <div>
            <img class="boyHead" src="../images/boy head.png" alt="">
            <img class="editPic" src="../images/add-image.png" alt="">
        </div>
        <div class="line">
            <p class="nameOfTheUser" id="center"><?php print $loggedin_user; ?></p>

        </div>
        <div class="line1">
            <p class="nameOfTheUser"><?php print $loggedin_email ?></p>
        </div>
        <div class="line2">
            <p class="nameOfTheUser"> <?php print $loggedin_pass ?></p>
        </div>
        <div class="button1">
            <a href="sign_out.php"> <button type="submit">تسجيل الخروج</button></a>
            <a href="profileEdit.php"> <button class="edit"> تعديل البيانات</button></a>
        </div>
    </div>
    <div class="vector1">
        <img src="../images/Vector-1.png" alt="">
    </div>
    <div>
        <img class="vector2" src="../images/Vector (1).png" alt="">
    </div>

</body>

</html>