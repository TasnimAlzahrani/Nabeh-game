<?php
include('../connection.php');
session_start();
$user_id = $_SESSION['userId'];


?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <title>القائمة الرئيسية</title>
    <link rel="stylesheet" type="text/css" href="../css/style-rawan.css" />
</head>

<body>

    <div class="main-menu">

        <div class="my-acc-logo-text">
            <a href="profile.php"><button class="nabeh-menu"></button></a>
            <p class="my-acc-text">حسابي</p>
        </div>

        <img class="mint-vector-player" src="../images/mint-vector.svg">
        <img class="violet-vector" src="../images/violet-vector.svg">
        <div class="header-bar">
            <div class="menu-div1">
                <a href=""><button class="menu-setting"></button></a>
                <p class="menu-text-bar">الإعدادات</p>
            </div>
            <div class="menu-div2">
                <a href="rank.php"><button class="menu-rank"></button></a>
                <p class="menu-text-bar">التصنيف</p>
            </div>
            <div class="menu-div3">
                <button class="menu-points"></button>
                <p class="menu-text-bar" style="padding-left:5px;">النقاط</p>
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

        <div class="main-menu-body">

            <div class="main-menu-title">
                <p class="play-nabeh">! العب يا نبيه</p>
                <img class="logo-menu" src="../images/logo.png">
            </div>

            <div class="main-menu-buttons">

                <div class="games-buttons">
                    <!-- <div class="word-of-the-day-menu">
                            <p id="wotd-menu">كلمة اليوم</p>
                        </div> -->
                    <a href="word-of-the-day.php">
                        <button class="word-of-the-day-menu">
                            <p id="wotd-menu">كلمة اليوم</p>
                        </button>
                    </a>

                    <!-- <div class="syn-and-opps-menu">
                            <p id="sao-menu">المرادفات والأضداد</p>
                        </div> -->

                    <a href="synonyms-and-opposites.html">
                        <button class="syn-and-opps-menu">
                            <p id="sao-menu">المرادفات والأضداد</p>
                        </button>
                    </a>

                    <a href="grammar.php">
                        <button class="grammar-game-menu">
                            <p id="ggm">القواعد</p>
                        </button>
                    </a>
                    <!-- <div class="grammar-game-menu">
                            <p id="ggm">القواعد</p>
                        </div> -->
                </div>

                <div class="under-games-buttons">
                    <div class="word-of-the-day-menu-under">
                    </div>
                    <div class="syn-and-opps-menu-under">
                    </div>
                    <div class="grammar-game-menu-under">
                    </div>
                </div>

            </div>

        </div>
    </div>
</body>

</html>