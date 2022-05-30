<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include("../connection.php");
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password_con = $_POST['user_password_con'];

    if (!empty($user_name) && !empty($user_email) && !empty($user_password) && !empty($user_password_con)) {

        if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

            if (strcmp($user_password, $user_password_con) != 0) {
                echo '<p class="pass">!كلمة المرور غير مطابقة</p>';
            } else {
                //Password validation
                if (strlen($user_password) >= 8 && strlen($user_password) <= 12 && preg_match('@[0-9]@', $user_password) && preg_match('@[A-Z]@', $user_password) && preg_match('@[a-z]@', $user_password)) {
                    $check_email_query = "SELECT email FROM users WHERE email = '$user_email' limit 1";
                    $r = mysqli_query($con, $check_email_query);
                    $rows = mysqli_num_rows($r);

                    if ($rows == 0) {
                        $en_password = password_hash($user_password, PASSWORD_DEFAULT);

                        $inser_new_user_query = "INSERT INTO users (user_id, email, password, user_name, total_score, user_image) VALUES (0, '$user_email',  '$en_password', '$user_name', 10, '../images/boy head.png'),'1'";
                        if (mysqli_query($con, $inser_new_user_query)) {
                            header("Location:sign-in-user.php");
                        } else {
                            print "<p>Could not insert the entry because: <b>" . mysqli_error($con) . "</b>. The query was $inser_new_user_query.</>";
                        }
                    } else {
                        echo '<p class="pass">البريد الالكتروني مستخدم مسبقًا</p>';
                        mysqli_close($con);
                    }
                } else {
                    echo '<p class="pass">:يجب على كلمة المرور أن</p>';
                    echo '<p class="pass"><br>.لا يقل طولها عن 8 حروف ولا يزيد عن 12 حرفًا<br>.تحتوي رقمًا واحدًا على الأقل <br> .تحتوي حرفًا كبيرًا واحدًا على الأقل<br>.تحتوي حرفًا صغيرًا واحدًا على الأقل</p>';
                }
            }
        } else
            echo '<p class="pass">البريد الالكتروني غير صالح.</p>';
    } else {
        echo '<p class="pass">الرجاء ملء جميع الحقول</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link rel="stylesheet" type="text/css" href="../css/style-rawan.css" />
    <style>
        .pass {
            text-align: right;
            position: absolute;
            color: #4E4C4F;
            top: 50%;
            right: 27%
        }
    </style>
</head>

<!-- <body>
    <img class="logo" style="position: absolute; width:15vw; left: 86%; top:0%;" src="../images/logo.png">
    <img class="vector2" src="../images/nabeh2.png">
    <div class="sign-up-form">

        <p class="sign-up-welcome">!أهلًا بك في نبيه</p>
        <form action="signup.php" method="post">

            <input class="input" type="text" id="name" placeholder="الإسم" name="user_name" required><br>
            <input class="input" type="text" id="email" placeholder="البريد الإلكتروني" name="user_email" required><br>
            <input class="input" type="password" id="password" placeholder="كلمة السر" name="user_password" required><br>
            <input class="input" type="password" id="password" placeholder="تأكيد كلمة السر " name="user_password_con" required>
            <div class="create-acc">
                <p>إنشاء حساب</p>
                <button class="next-arrow" name="submit"></button>
            </div>
        </form>
        <button class="to-login">لديك حساب؟ سجّل دخول</button>

    </div>
</body> -->

<body>
    <img class="logo" style="position: absolute; width:15vw; left: 86%; top:0%;" src="../images/logo.png">
    <img class="vector2" src="../images/nabeh2.png">
    <div class="sign-up-form">

        <p class="sign-up-welcome">!أهلًا بك في نبيه</p>

        <form class="form2" method="POST">

            <div class="input-div">
                <input id="username" placeholder="اسم المستخدم" name="user_name" required>
                <img class="size-icon" src="../image/name.png">
            </div>

            <div class="line-signup"></div>

            <div class="input-div">
                <input id="email" placeholder="البريد الإلكتروني" name="user_email" required>
                <img class="size-icon" src="../images/mail.png">
            </div>

            <div class="line-signup"></div>

            <div class="input-div">
                <input type="password" id="password" placeholder="كلمة المرور" name="user_password" required>
                <img class="size-icon" src="../images/key 1.png">
            </div>

            <div class="line-signup"></div>

            <div class="input-div">
                <input type="password" id="password2" placeholder="تأكيد كلمة المرور" name="user_password_con" required>
                <img class="size-icon" src="../images/key 1.png">
            </div>

            <div class="line-signup"></div>
            <div class="create-acc">
                <p>إنشاء حساب</p>
                <button class="next-arrow" name="submit"></button>
            </div>
        </form>


        <button class="to-login">لديك حساب؟ سجّل دخول</button>

        <p id="create-acc-by">إنشاء حساب باستخدام </p>
        <div class="google-facebook">
            <div>
                <button id="google"></button>
            </div>
            <div>
                <button id="facebook"></button>
            </div>
        </div>
    </div>
</body>

</html>