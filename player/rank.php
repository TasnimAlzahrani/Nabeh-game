<?php
include '../connection.php';
$query = "select email,user_name,total_score,user_image from users order by total_score desc";
$run = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rank</title>
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

    <div>
        <div class="human">
            <img id="humanHead" src="../images/boy head.png" alt="">
            <img id="humanBody" src="../images/body.png" alt="">
        </div>
        <div>
            <div class="pinkContainer">
                <table class="table-rank" border="0" cellspacing="0" cellpadding="0">
                    <tr class="heading">

                        <th>النقاط</th>
                        <th>اسم الاعب</th>
                        <th>الصورة</th>
                        <th>الترتيب</th>


                    </tr>
                    <?php
                    $i = 1;
                    if ($num = mysqli_num_rows($run) > 0) {
                        while ($result = mysqli_fetch_assoc($run)) {
                            echo "  
                          <tr class='data'>  
                           
                               <td>" . $result['total_score'] . "</td> 
                               <td>" . $result['user_name'] . "</td> 
                               <td>" . "<img style='width: 4vw; height: 4vw;' src='../images/".$result['user_image']."'alt='rank img'>" . "</td> 
                                <td>" . $i++ . "</td> 
           
                          </tr>  
                     ";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>

    </div>
    <div>
        <div> <img class="vector3" src="../images/vector3.png" alt=""></div>
    </div>
    <div>
        <div>
            <img class="vector4" src="../images/vector4.png" alt="">
        </div>
    </div>


</body>

</html>