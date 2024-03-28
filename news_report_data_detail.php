<?php

require_once 'config/db.php';
session_start();
error_reporting(E_ALL ^ E_NOTICE);


$save_user_id = $_SESSION['userid'];
$save_user_code_member = $_SESSION['code_member'];
$save_user_first_name = $_SESSION['first_name'];
$save_user_last_name = $_SESSION['last_name'];
$save_user_role = $_SESSION['role'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link type="text/css" rel="stylesheet" href="css/cssmain.css">

    <title>Fai Kham</title>
    <style>
        a{
            text-decoration:none;
            color:#000;
        }
    </style>
</head>

<body>

    <!-- Modal -->
    <div class="modal" id="exampleModal_2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <!--! ---------------------------------- Head Bar Start ---------------------------------- -->
    <?php
    include ('nav.php');
    ?>
    <!--! ---------------------------------- Head Bar End ----------------------------------  -->

    <!--! ---------------------------------- Body Show Start ----------------------------------  -->

    <div class="setcarouel">
        <div class="col-lg-7 m-auto px-4 py-3 bg-white mt-2">
            
            <center>
            <?php 
                $id=$_GET['id'];
                $sql="SELECT * FROM news_report_data WHERE id='$id'";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    $id=$row['id'];
                    $newname=$row['news_name'];
                    $new_detail=$row['new_detail'];
                    $new_img=$row['new_img'];
                    echo "<div class='row'>
                           <div class='col-12'>
                                <h2>$newname</h2>
                                ";
                                if(empty($new_img))
                                {
                                    echo "<img src='img/news_report_data/d.png' width='300' height='200'>";
                                }
                                else
                                {
                                    echo "<img src='img/news/$new_img' width='300' height='200'>";
                                }
                                

                               echo " <br>
                                รายละเอียด : $new_detail
                           </div>
                       </div>";
                }
               

            ?>
            <br>
            <a href='news_report_data.php' class='btn btn-dark'>กลับหน้าหลัก</a>
            </center>
            
        </div>
    </div>

        <!--! ---------------------------------- Body Show End ----------------------------------  -->



        <!-- ? ---------------------------------- End Script ---------------------------------- -->

        <script type="text/javascript">
            $('.datepicker').datepicker({
                startDate: new Date()
            });
        </script>

        <script src="javascript/show_modal.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
        <!-- ? ---------------------------------- End Script ---------------------------------- -->
</body>

</html>