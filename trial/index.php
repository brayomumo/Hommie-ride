<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/navbar.css" rel="stylesheet" >
    <title>Hommie Ride</title>
</head>
<body>
         <nav>
        <ul>
        <button>✖</button>
            <li><a href="index.php">Home</a></li>
            <li><a href="ride.php" >About</a></li>
            <li><a href="trips.php">Ride Along</a></li>
            <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search groups..." />
        <div class="result"></div>
        
    </div>   <li><a href="login.php">log in</a></li>
                
            
            <!-- <li><a href="login.php">Log in</a></li> -->
        </ul>
    </nav>
        <h2> Welcome Sucker </h2>
        <form action="" method="POST">
            <input type="radio" name="radio" value="radio 1">Radio 1
            <input type="radio" name="radio" value="radio 1">Radio 2
            <input type="radio" name="radio" value="radio 1">Radio 3
            <input type="submit" name="submit" value="Get selected item">
        </form>
        <?php
            if(isset($_POST['submit'])){
                if(isset($_POST['radio'])){
                    echo "You have selected:  ".$_POST['radio'];
                }
            }
        ?>
</body>
</html>