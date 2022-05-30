<?php
include('../connection.php');
session_start();
$user_id = $_SESSION['userId'];


?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-jumana.css">
    <script src="../javascript/script.js" defer></script>
    <title>كلمة اليوم</title>
</head>

<body>
    <a href="main-menu.php">
        <button id="go-back">العودة للرئيسية</button>
    </a>

    <div class="header">

        <div class="element">
            <div class='img'>
                <img class="logo" src="../images/Log2.png">
            </div>
        </div>
        <div class="element">
            <div>
                <img class="coins" src="../images/coins.png">
                <p id="coins-text">النقاط</p>
            </div>
        </div>
        <p id="point">
            <?php
            $query = "SELECT total_score FROM users WHERE user_id= $user_id";
            $rowsObj = @mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($rowsObj)) {
                $score = $row['total_score'];
                print "$score";
            }
            ?>
        </p>


    </div>

    <!-- <img src="../images/logo.png" style="width: 100px ;" class="logo"> -->
    <h1>احزر كلمة اليوم <img src="../images/dizzy-new-idea.png" class="nabeh"></h1>
    <div class="alert-container" data-alert-container></div>
    <div dir="rtl" data-guess-grid class="guess-grid">
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
        <div class="tile"></div>
    </div>
    <div dir="rtl" data-keyboard class="keyboard">
        <button class="key" data-key="ج">ج</button>
        <button class="key" data-key="ح">ح</button>
        <button class="key" data-key="خ">خ</button>
        <button class="key" data-key="ه">ه</button>
        <button class="key" data-key="ع">ع</button>
        <button class="key" data-key="غ">غ</button>
        <button class="key" data-key="ف">ف</button>
        <button class="key" data-key="ق">ق</button>
        <button class="key" data-key="ث">ث</button>
        <button class="key" data-key="ص">ص</button>
        <button class="key" data-key="ض">ض</button>
        <button class="key" data-key="ة">ة</button>
        <button class="key" data-key="ك">ك</button>
        <button class="key" data-key="م">م</button>
        <button class="key" data-key="ن">ن</button>
        <button class="key" data-key="ت">ت</button>
        <button class="key" data-key="ا">ا</button>
        <button class="key" data-key="ل">ل</button>
        <button class="key" data-key="ب">ب</button>
        <button class="key" data-key="ي">ي</button>
        <button class="key" data-key="س">س</button>
        <button class="key" data-key="ش">ش</button>
        <button data-delete class="key">&#10005;</button>
        <button class="key" data-key="ى">ى</button>
        <button class="key" data-key="و">و</button>
        <button class="key" data-key="ر">ر</button>
        <button class="key" data-key="ز">ز</button>
        <button class="key" data-key="د">د</button>
        <button class="key" data-key="ذ">ذ</button>
        <button class="key" data-key="ط">ط</button>
        <button class="key" data-key="ظ">ظ</button>
        <button class="key" data-key="ء">ء</button>
        <button data-enter class="key"> &#8592;</button>
    </div>
    <img class="blob" src="../images/blob.svg">
</body>

</html>