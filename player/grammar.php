<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لعبة القواعد</title>
    <link rel="stylesheet" href="../css/grammar.css">
    <script src="../javascript/app.js" async></script>
    <?php
    include('../connection.php');
    session_start();
    $user_id = $_SESSION['userId'];



    ?>
</head>

<body>

    <main>
        <div class="main-page">
            <?php
            //1 for grammar 2 for S&O
            $level = 0;
            $query = "SELECT reached_level FROM users WHERE user_id=$user_id";
            $rowsObj = @mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($rowsObj)) {
                $level = $row['reached_level'];
            }
            $query = "SELECT * FROM game WHERE level= $level AND game_id=1";
            $rowsObj = @mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($rowsObj)) {
                $question_id = $row['question_id'];
                $question = $row['question'];
                $answer = $row['answer'];
                $hint = $row['hint'];
            }
            ?>

            <!-- HEADER -->
            <a href="main-menu.php">
                <button id="go-back">العودة للرئيسية</button>
            </a>
            <!-- <button id="next" disabled="true">السؤال التالي</button> -->

            <h1 id="title"><?php echo "$question"; ?></h1>

            <div class="header">

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


                <div class="element">
                    <div>
                        <img class="coins" src="../images/coins.png">
                        <p id="coins-text">النقاط</p>
                    </div>
                </div>

                <div class="element">
                    <div>
                        <img class="hint" style="margin-top:0%;height: 100%; width: 35%;" src="../images/medal.png">
                        <p id="hint-text">المرحلة</p>
                        <span id="level"><?php echo $level; ?></span>
                    </div>
                </div>

                <div class="element">

                    <button class="hint-btn" style="background-color: transparent; border-color: transparent;">
                        <img class="hint" src="../images/light-bulb.png">
                        <p id="hint-text">تلميح</p>
                    </button>

                </div>

                <div class="element">
                    <div class="img">
                        <img class="logo" src="../images/Log2.png">
                    </div>
                </div>
            </div>

            <!-- QUESTIONS AREA -->
            <div class="question">

                <!-- DISK DRAW -->

                <div id="disk-shadow"></div>
                <div id="disk"></div>

                <div id="hand">
                    <img style="position:relative; height: 100%;" src="../images/hand.png">
                </div>
                <div id="pen">
                    <img style="position:relative; height: 50%;" src="../images/pencil.png">
                </div>

                <!-- ANSWER AREA -->
                <!-- place 1 -->

                <form method="POST">

                    <div class="place-here">
                        <div class="shadow1 options"></div>
                        <div name="نبيهٌ" class="place1 options on-hover">
                            <div class="text"></div>
                            <input name='answer[]' type="hidden" value=''>
                        </div>
                    </div>

                    <!-- place 2 -->
                    <div class="place-here">
                        <div class="shadow2 options" id="shadow2"></div>
                        <div name="فتًى" class="place2 options on-hover" id="place2">
                            <div class="text"></div>
                            <input name='answer[]' type="hidden" value=''>
                        </div>
                    </div>

                    <!-- place 3 -->
                    <div class="place-here">
                        <div class="shadow3 options" id="shadow3"></div>
                        <div name="مؤدبٌ" class="place3 options on-hover" id="place3">
                            <div class="text"></div>
                            <input name='answer[]' type="hidden" value=''>
                        </div>
                    </div>
                    <div id="submit">
                        <button name='submit_answer' type="submit" id="submit-button">
                            التحقق من الجواب
                        </button>
                    </div>
                </form>
                <script>
                    var itemsInStorage = JSON.parse(window.localStorage.getItem('answer'))

                    function setWrong(place) {
                        if (itemsInStorage.length == 3) {
                            for (var i = 0; i < itemsInStorage.length; i++) {
                                if (itemsInStorage[i].classList[0] === place) {
                                    var itemObj = {
                                        classList: itemsInStorage[i].classList, //classlist[0] = placeId
                                        color1: '#D45555',
                                        color2: '#F0CCCC',
                                        text: itemsInStorage[i].text, //the id of option
                                        textColor: '#CD3100'
                                    };

                                    itemsInStorage[i] = itemObj;
                                    window.localStorage.setItem('answer', JSON.stringify(itemsInStorage));
                                    break;
                                }
                            }
                        }
                    }

                    function setRight(place) {
                        if (itemsInStorage.length == 3) {
                            for (var i = 0; i < itemsInStorage.length; i++) {
                                if (itemsInStorage[i].classList[0] === place) {
                                    var itemObj = {
                                        classList: itemsInStorage[i].classList, //classlist[0] = placeId
                                        color1: '#D0E4E3',
                                        color2: '#D5ECE2',
                                        text: itemsInStorage[i].text, //the id of option
                                        textColor: '#4D7D7B'
                                    };

                                    itemsInStorage[i] = itemObj;
                                    window.localStorage.setItem('answer', JSON.stringify(itemsInStorage));
                                    break;
                                }
                            }
                        }
                    }

                    function setAllRight() {

                        for (var i = 0; i < itemsInStorage.length; i++) {
                            var itemObj = {
                                classList: itemsInStorage[i].classList, //classlist[0] = placeId
                                color1: '#D0E4E3',
                                color2: '#D5ECE2',
                                text: itemsInStorage[i].text, //the id of option
                                textColor: '#4D7D7B'
                            };
                            itemsInStorage[i] = itemObj;
                        }
                        window.localStorage.setItem('answer', JSON.stringify(itemsInStorage));

                    }

                    function log(content) {
                        console.log(content)
                    }
                    <?php
                    if (isset($_POST['submit_answer'])) {
                        ini_set('display_errors', 1);
                        error_reporting(E_ALL & ~E_NOTICE);
                        $got_it = false;

                        $answers = explode(" ", $answer);
                        $userAnswer = implode(" ", $_POST['answer']);
                        if ($answer == $userAnswer) {
                            //لونيها اخضر كلها
                            //a script that display go to next level
                            echo 'setAllRight();';
                            $got_it = true;
                        } else {

                            for ($i = 0; $i < count($answers); $i++) {
                                if ($answers[$i] == $_POST['answer'][$i]) {
                                    //color in green
                                    $num = $i + 1;
                                    $place = 'place' . "$num";
                                    echo "setRight('$place');";
                                } else {
                                    //color in red

                                    $num = $i + 1;
                                    $place = 'place' . "$num";
                                    echo "log('here');";
                                    echo "setWrong('$place');";
                                }
                            }
                        }
                        //update score
                        if ($got_it) {

                            $query = "UPDATE users SET total_score =  $score+10 WHERE user_id= $user_id";
                            if (@mysqli_query($con, $query)) {
                                //print '<p>The company entrie` slaray has been updated.</p>';
                                // header("Refresh:0");
                            }
                        } else {
                            $query = "UPDATE users SET total_score =  $score-1 WHERE user_id= $user_id";
                            if (@mysqli_query($con, $query)) {
                                //print '<p>The company entrie` slaray has been updated.</p>';
                                // header("Refresh:0");
                            }
                        }
                    }
                    ?>
                </script>
                <!-- OPTIONS AREA -->
                <?php
                $query = "SELECT option_content FROM options WHERE question_id= $question_id";
                $rowsObj = @mysqli_query($con, $query);
                $options_array = array();

                while ($row = mysqli_fetch_array($rowsObj)) {
                    $options_array[] = $row;
                }

                ?>
                <!-- 1st palce -->
                <!-- option1 -->
                <div draggable="true" class="option transform1-1" id="<?php echo $options_array[0][0];?>">
                    <div class="frst-option1-1 options "></div>
                    <div class="frst-option1-2 options ">
                        <div class="text"><?php echo $options_array[0][0];?></div>
                    </div>
                </div>
                <!-- option2 -->
                <div draggable="true" class="option transform1-2" id="<?php echo $options_array[1][0];?>">
                    <div class="frst-option2-1 options"></div>
                    <div class="frst-option2-2 options">
                        <div class="text"><?php echo $options_array[1][0];?></div>
                    </div>
                </div>
                <!-- option2 -->
                <div draggable="true" class="option transform1-3" id="<?php echo $options_array[2][0];?>">
                    <div class="frst-option3-1 options"></div>
                    <div class="frst-option3-2 options">
                        <div class="text"><?php echo $options_array[2][0];?></div>
                    </div>
                </div>


                <!-- 2st palce -->
                <!-- option1 -->
                <div draggable="true" class="option transform2-1" id="<?php echo $options_array[3][0];?>">
                    <div class="scnd-option1-1 options"></div>
                    <div class="scnd-option1-2 options">
                        <div class="text"><?php echo $options_array[3][0];?></div>
                    </div>
                </div>
                <!-- option2 -->
                <div draggable="true" class="option transform2-2" id="<?php echo $options_array[4][0];?>">
                    <div class=" scnd-option2-1 options "></div>
                    <div class="scnd-option2-2 options ">
                        <div class="text "><?php echo $options_array[4][0];?></div>
                    </div>
                </div>
                <!-- option2 -->
                <div draggable="true" class="option transform2-3" id="<?php echo $options_array[5][0];?>">
                    <div class="scnd-option3-1 options "></div>
                    <div class="scnd-option3-2 options ">
                        <div class="text "><?php echo $options_array[5][0];?></div>
                    </div>
                </div>


                <!-- 3rd palce -->
                <!-- option1 -->
                <div draggable="true" class="option transform3-1" id="<?php echo $options_array[6][0];?>">
                    <div class="thrd-option1-1 options "></div>
                    <div class="thrd-option1-2 options ">
                        <div class="text "><?php echo $options_array[6][0];?></div>
                    </div>
                </div>
                <!-- option2 -->
                <div draggable="true" class="option transform3-2" id="<?php echo $options_array[7][0];?>">
                    <div class="thrd-option2-1 options "></div>
                    <div class="thrd-option2-2 options ">
                        <div class="text "><?php echo $options_array[7][0];?></div>
                    </div>
                </div>
                <!-- option2 -->
                <div draggable="true" class="option transform3-3" id="<?php echo $options_array[8][0];?>">
                    <div class="thrd-option3-1 options "></div>
                    <div class="thrd-option3-2 options ">
                        <div class="text "><?php echo $options_array[8][0];?></div>
                    </div>
                </div>
            </div>
        </div>



        <!-- HINT WINDOW -->
        <div id="hint-page">
            <div class="hint-window">
                <form method='POST'>
                    <button style="background-color: transparent; border:none;" name='close-btn' class="close close-btn">&times;</button>
                </form>
                <p class="headline">إليك تلميحًا</p>
                <p class="hint-content"><?php print($hint) ?></p>
            </div>
        </div>

        <!-- NEXT QUESTION WINDOW -->
        <div id="next-page">
            <div class="hint-window next-window">
                <span class="close close-btn">&times;</span>
                <p class="headline">إجابة صحيحة!</p>
                <button class="next-content" disabled="true">الانتقال للسؤال التالي</button>
            </div>
        </div>

    </main>

    <script type="text/javascript">
        var page = document.getElementById("hint-page");

        var trigger = document.getElementsByClassName("hint-btn")[0];

        var closeWindow = document.getElementsByClassName("close")[0];

        var nextPage = document.getElementById("next-page");

        var closeNextWindow = document.getElementsByClassName("close")[1];


        trigger.onclick = function() {
            <?php
            $query = "SELECT * FROM user_hint WHERE user_id=$user_id and question_id=$question_id";
            $result = mysqli_query($con, $query);
            $test = mysqli_num_rows($result);
            if (mysqli_num_rows($result) == 0) {
                echo 'let confirmAction = confirm("سيتم خصم 3 نقاط من مجموع نقاطك، هل أنت متأكد؟");
                if (confirmAction) {
                    page.style.display = "block";
                }';
            } else {
                echo 'page.style.display = "block";';
            }

            ?>
        }
        // When the user clicks on <span> (x), close the modal
        closeWindow.onclick = function() {
            page.style.display = "none";

        }
        closeNextWindow.onclick = function() {
            nextPage.style.display = "none";

        }

        window.onclick = function(event) {
            if (event.target == page) {
                nextPage.style.display = "none";
            }
        }
        // var reload = false;
        <?php
        if (isset($_POST['close-btn'])) {
            ini_set('display_errors', 1);
            error_reporting(E_ALL & ~E_NOTICE);

            $query = "SELECT * FROM user_hint WHERE user_id=$user_id and question_id=$question_id";
            $result = mysqli_query($con, $query);
            $test = mysqli_num_rows($result);
            if (mysqli_num_rows($result) == 0) {
                $query = "UPDATE users SET total_score =  $score-3 WHERE user_id= $user_id";
                if (@mysqli_query($con, $query)) {
                    $query = "INSERT INTO user_hint VALUES (0,$question_id,$user_id)";
                    if (@mysqli_query($con, $query)) {
                        echo "console.log('tm')";
                    } else {
                        $error =  mysqli_error($con);
                        echo "console.log($error)";
                    }
                }
            }
        }
        ?>
    </script>



</body>

</html>