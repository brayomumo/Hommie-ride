<?php require("auth.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.js"></script>
    <title>Trips</title>
</head>

<body>
    <style>
        .column {
            float: left;
            width: 50%;
        }
        .one {
            background-color: bisque;
        }
        .two{
            background-color:aqua
        }
        .joinTrip{
            margin-left: 50%
        }
        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>

    <?php
    include("navbar.php");
    require("db.php");
    $id = $_SESSION['id'];
            $tri = mysqli_query($con, "SELECT group_id FROM  user_group where user_id = '$id'");
            $tr = mysqli_fetch_assoc($tri);
            if ($tri) {
                $g_id = $tr["group_id"];
            }
    ?>
   
    <div class="row">
        <div class="column two">
            <h3>Today's trip</h3>
            <div id="transition" value="<?php echo($g_id);?>"></div>
            <?php 
            require("db.php");
            // DISPLAYING TODAYS TRIP DETAILS
            date_default_timezone_set('Africa/Nairobi');
            $date = date('Y-m-d', time());
            $q = "SELECT * FROM trips where group_id='$g_id' and date(Tdate) = '$date'";
            $tr = mysqli_query($con, $q) or die(mysqli_error($con));
            $t_id = mysqli_fetch_assoc($tr);
            if ($t_id) {
                $tr_id = $t_id["trip_id"];
                $e = "SELECT users.username, users.place_of_work FROM users LEFT JOIN ridealongs ON ridealongs.user_id = users.user_id WHERE ridealongs.trip_id = '$tr_id'";
            }else{
                echo" No trips today";
            } ?>
            <input type='button' id='<?php echo($tr_id) ?>' class='joinTrip' onclick='joinTrip(this.id)' value='join Trip'>
        </div>
        <div class="column one"> <?php coming(); ?></div>
    </div>
    <div class="todayTrip">

    </div>
        <h3>Oncoming Trips</h3>
    
    <div class="todaytrip">
        <?php
        function leos($g_id)
        {
            
        }
        function coming()
        {
            require("db.php");
            $user_id = $_SESSION['id'];
            $gr = mysqli_query($con, "SELECT group_id from user_group where user_id = '$user_id' ");
            $row = mysqli_fetch_assoc($gr);
            if ($gr) {
                $g_id = $row['group_id'];
                $trips = mysqli_query($con, "SELECT trips.* FROM trips where group_id = '$g_id'");
                if ($trips) {
                    // displaying oncoming Trips
                    echo "
        <table style='width: 50%; text-align:center;'>
        <tr>
            <th>Day</th>
            <th>Driver </th>
            <th>Car type</th>
            <th>Car Plate Number</th>
            <th>Seats Available</th>
        </tr>  ";
                    while ($trip = mysqli_fetch_array($trips)) {
                        $driver_id = $trip["driver_id"];
                        $day = $trip["day"];
                        $seats = $trip["seats_available"];
                        $result = mysqli_query($con, "SELECT username, cartype, car_plate_number from users where user_id = '$driver_id'");
                        $resultt = mysqli_fetch_assoc($result);
                        if ($result) {
                            echo "<tr>
                            <td>" . $trip["day"] . "</td>
                            <td> " . $resultt["username"] . "</td>
                            <td> " . $resultt["cartype"] . "</td>
                            <td> " . $resultt["car_plate_number"] . "</td>
                            <td> " . $trip["seats_available"] . "</td>
                            
                        </tr>";
                        } //these are the fields that you have stored in your database table employee


                    }
                }
            }
        }
        ?>
    </div>
    <script src="js/trips.js">
        
    </script>
</body>

</html>