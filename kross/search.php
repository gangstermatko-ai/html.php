<?php
if ($_SERVER["REQUEST_METHOD"]== "POST" ){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
       require_once "dbhinc.php";

       $query = "INSERT INTO users (username, pwd, email) VALUES(:username,:pwd, :email);";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $pwd);
    $stmt->bindParam(":email", $email);

       $stmt->execute();

       $pdo = null;
       $stmt = null;

header("Location: ../index.php");

       die();
    } catch (PDOException $e) {
        die("query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../index.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel= "stylesheet" href ="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- <h3><pre>Sign up</pre></h3>

    <form action="includes/formhandler.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <input type="text" name="email" placeholder="E-Mail">
        <button>Sign up</button>
    </form> 

        <a href ='updateuser.php' class = "uprav"> update</a>
       <a href ='deleteuser.php'> vymaz ucet</a>
-->











   
 <a href="https://www.facebook.com" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/2021_Facebook_icon.svg" class="ikona_v_rohu">
</a> 

 
<a href="https://www.instagram.com/m_hruska_/" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" class="ikona_v_rohu" style="right: 20px;">
</a>
</body>
</html>