<?php

    session_start();
    if (!isset($_SESSION['userid'])) {
            header('location: logintoblackend.php');
    } else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้ดูเเล <?php echo "คุณ : ".$_SESSION['first_name'] ?></title>
</head>
<body>

    <div class="container">

    <h3 class="mt-4"> ยินดีต้อนรับ, <?php echo $_SESSION['first_name'] ." ". $_SESSION['last_name'] ?> </h3>

        <p><a href="logout.php">logout</a></p>
    </div>
    
<?php } ?>
</body>
</html>