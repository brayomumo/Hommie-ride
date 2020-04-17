<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <?php
        include("navbar.php");
        echo($_SESSION['licencenumber']);
        print_r($_SESSION);
        include("db.php");
        $id = $_SESSION["id"];
        $q = mysqli_query($con, "SELECT * from users where user_id = '$id'") or die(mysqli_error($con));
        $r = mysqli_fetch_assoc($q);
        if($q){
            echo($r["licence_number"]);
        }
    ?>
    <div class="form">
        <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
        <p>This is secure area.</p>
        <p><a href="dashboard.php">Dashboard</a></p>
        <a href="ujinga.php">try me</a>
    </div>
</body>

</html>