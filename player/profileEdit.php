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


//update
if (isset($_POST['saveEdit'])) {
    //if one of the textbox is empty 
    if (!empty($_POST['usernameEdit'])) {

        $newusername = $_POST['usernameEdit'];

        $queryUpdate = "UPDATE `users` SET `user_name` = '$newusername'           
                      WHERE `email` = '$loggedin_email'";
        $re = mysqli_query($con, $queryUpdate);
        echo "<p class=\"message-print-profile\">تم التعديل</p>";
    }


    if (!empty($_POST['passwordEdit'])) {

        $newuserpassword = $_POST['passwordEdit'];

        if (strlen($newuserpassword) >= 8 && strlen($newuserpassword) <= 12) {
            $queryUpdate = "UPDATE `users` SET `password` = '$newuserpassword'           
                                          WHERE `email` = '$loggedin_email'";
            $re = mysqli_query($con, $queryUpdate);
            echo "<p class=\"message-print-profile\">تم التعديل</p>";
        } else {
            echo "<p class=\"message-print-profile\" style=\"left:38%;\"> كلمة السر يجب ان تكون 8 خانات او 12 خانة واقل</p>";
        }
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <header>
        <img class="logo" src="../images/image 4.png" alt="">
        <div class="containerArrow">
            <a href="profile.php"><img class="arrow" src="../images/Arrow.png" alt=""></a>
            <p> العودة الملف الشخصي  </p>
        </div>
    </header>

    <div class="contentEditProfile">
        <form  method="post">
            <div>

                <img class="boyHead" src="../images/boy head.png" alt="">
                <h2 id="editText">تعديل الملف الشخصي</h2>
                <input class="textusernameEdit" type="text" name="usernameEdit" id="username" placeholder=" تعديل اسم المستخدم">
                <input class="textpasswordEdit" type="password" name="passwordEdit" id="password" placeholder=" تعديل الرقم السري">
            </div>
            <div class="line"> </div>
            <div class="line1">
                <div class="buttonSave">
                    <a href="profile.php"> <button class="save" name="saveEdit" type="submit">حفظ</button></a>
                </div>
            </div>

        </form>
    </div>
    <div class="vector1">
        <img src="../images/Vector-1.png" alt="">
    </div>
    <div>
        <img class="vector2" src="../images/Vector (1).png" alt="">
    </div>

</body>

</html>