<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/navbar.css" rel="stylesheet" >
    <script src="js/jquery-3.3.1.min.js" type="text/js"></script>
</head>
<body>
    <nav>
        <ul>
        <button>✖</button>
            <li><a href="index.php">Home</a></li>
            <li><a href="ride.php" >About</a></li>
            <li><a href="dashboard.php">Ride Along</a></li>
            <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search groups..." />
        <div class="result"></div>
    </div>
            <?php
                session_start();
                if(isset($_SESSION['username'])){
                    ?><li style="float: right"><a href="profile.php">
                        <?php
                        echo $_SESSION['username'];
                        ?>
                    </a></li>
                    <li><a href="logout.php" style="float: right !important ;">logout </a></li>
                    <?php
                }else{
                ?><li><a href="registration.php" style="float: right">Register</a></li>
                <li><a href="login.php">log in</a></li>
                <?php
                }
            ?>
            <!-- <li><a href="login.php">Log in</a></li> -->
        </ul>
    </nav>
    <script type="text/javascript">
        $("document").ready(function(){
        $("button").click(function (){
            if($("button").text() == "☰"){
                $("button").text("🞬");
            }else{
                $("button").text("☰");
            }
            
            /* this function toggle the visibility of our "li" elements */
            $("li").toggle("slow");
        });
        });
    </script>
</body>
</html>