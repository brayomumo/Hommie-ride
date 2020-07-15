<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/navbar.css" rel="stylesheet">
    <script src="js/jquery.js" type="text/js"></script>
</head>

<body>
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="trips.php">Ride Along</a></li>
            <?php
            if (isset($_SESSION['username'])) {
            ?>
                <li><a href="dashboard.php">groups</a></li>
                <li style="float: right"><a href="profile.php">
                        <?php
                        echo $_SESSION['username'];
                        ?>
                    </a></li>
                <li><a href="logout.php" style="float: right !important ;">logout </a></li>
            <?php
            } else {
            ?><li><a href="registration.php" style="float: right">Register</a></li>
                <li><a href="login.php">log in</a></li>
            <?php
            }
            ?>

            <!-- <li><a href="login.php">Log in</a></li> -->
        </ul>
        <!-- on smaller screens -->
        <select onchange="if(this.value)window.location.href = this.value;">
            <option value="index.php">Home</option>
            <option value="index.php#about">About</option>
            <option value="trips.php">Ride</option>
            <?php
            if (isset($_SESSION['username'])) {
            ?>
                <option value="dashboard.php"></option>
                <option style="float: right" value="profile.php">
                    <?php
                    echo $_SESSION['username'];
                    ?>
                </option>
                <option value="logout.php" style="float: right !important ;">logout </option>
            <?php
            } else {
            ?><option value="registration.php" style="float: right">Register</option>
                <option value="login.php">log in</option>
            <?php
            }
            ?>
        </select>
    </nav>
</body>

</html>