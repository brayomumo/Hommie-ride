<?php require("auth.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trips</title>
</head>

<body>
    <?php
    include("navbar.php");
    require("db.php");
    echo "<h3 style='float:center'>oncoming Trips</h3>";
    $user_id = $_SESSION['id'];
    $gr = mysqli_query($con, "SELECT group_id from user_group where user_id = '$user_id' ");
    $row = mysqli_fetch_assoc($gr);
    if ($gr) {
        $g_id = $row['group_id'];
        $trips = mysqli_query($con, "SELECT trips.* FROM trips where group_id = '$g_id'");
        if ($trips) {
            // displaying oncoming Trips
            echo "
        <table style='width: 70%; text-align:center;'>
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
    ?>
</body>

</html>