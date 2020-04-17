<?php require("auth.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/profile.css" rel="stylesheet" type="TEXT/CSS">
    <script src="js/jquery.js" ></script>
    <title><?php echo($_SESSION["username"]); ?></title>
</head>
<body>
    <?php
        include("navbar.php"); 
        // print_r($_SESSION);
        include("db.php");
    ?>
    <div class="container column side"><br>kino
    <br>
    <br></div>
    <div class="profile">
        <h3 class="user_id" id="<?php echo($_SESSION["id"]);?>"><?php echo($_SESSION["id"]);?></h3>       
    </div>
    <script src="js/profile.js"></script>
</body>
</html>