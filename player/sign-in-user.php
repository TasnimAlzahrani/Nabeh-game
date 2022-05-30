<?php

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
include('../connection.php');
session_start();


//handell login
if (isset($_POST['login-but'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $query = "SELECT * FROM `users` WHERE `email`='$_POST[email]'";
        $result = mysqli_query($con, $query);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $result_fetch = mysqli_fetch_assoc($result);
    
                if (password_verify($_POST['password'], $result_fetch['password'])) {
                    //if password matched
                    $_SESSION['logged_in_user'] = true;
                    $_SESSION['email'] = $result_fetch['email'];
                    $_SESSION['userId'] = $result_fetch['user_id'];
                    header("location:main-menu.php");
                } else { //if incorrect password
                    echo "<p id=\"message-print\">كلمة السر غير صحيحة</p>";
                }
            } else {
                echo "<p id=\"message-print\">ليس لديك حساب</p>";
            }
        } else {
            echo "<script>alert('can not run query');
    window.location.href='sign-in-user.php';
    </script>";
        }
    } elseif (empty($_POST['email']) & !empty($_POST['password'])) {
        echo "<p id=\"message-print\">قم بإدخال اسم المستخدم </p>";
    } elseif (empty($_POST['password']) & !empty($_POST['email'])) {
        echo "<p id=\"message-print\">قم بإدخال كلمة السر </p>";
    } else {
        echo "<p id=\"message-print\">قم بأدخال البيانات اولا</p>";
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <img class="adminLogo" src="../image/image 4.png" alt="">
    </header>

    <img id="joyHead" src="../image/joyful head of a man.png" alt="">
    <img id="bodyJoy" src="../image/body shows something his hand.png" alt="">
    <img class="Vector6" src="../image/Vector6.png" alt="">
    </div>

    <form action="sign-in-user.php" method="post">
        <div class="contentSignIn">
            <div>
                <h1>تسجيل الدخول</h1>
            </div>

            <div class="lineSignIn">
                <input class="admin-testbox" type="text" name="email" id="email" placeholder="البريد الالكتروني">
                <img class="mailIcon" src="../image/mail.png" alt="">


            </div>
            <div class="lineSignIn1">
                <img class="mailIcon" src="../image/key 1.png" alt="">
                <input class="admin-testbox" type="password" name="password" id="password" placeholder="كلمة المرور">

                <a href="signup.php"><p id="noAccount"> لا تملك حسابًا؟<b style="color:#2B88DE ;"> أنشئ حسابًا جديد</b></p></a>

                <div class="button3">
                    <button type="submit" name="login-but"> تسجيل الدخول </button>
                </div>
                <div>
                    <img id="google" src="../image/google 2.png" alt="">
                </div>
                <div>
                    <img id="facebook" src="../image/facebook 2.png" alt="">
                </div>
            </div>

        </div>
    </form>

</body>

</html>