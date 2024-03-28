<?php

    $conn = mysqli_connect("localhost","root","","beta");

    function print_array($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
    
    // try {
    //     $conn = new PDO("mysql:host=$servername;dbname=beta", $username, $password);
    //     // set the PDO error mode to exception
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     echo "Connected successfully";
    //   } catch(PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    //   }
?>