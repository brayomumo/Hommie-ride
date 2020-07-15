<?php require("auth.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.js"></script>
    <link href="css/group.css" rel="stylesheet">
    <title>Trips</title>
</head>

<body>
    <?php
    include("navbar.php");
    require("db.php");
    global $g_id;
    $id = $_SESSION['id'];
    // global $t_id;
    $get = mysqli_query($con, "SELECT  user_group.group_id, groups.group_name, groups.workArea, groups.neighbourhood, groups.from_home, groups.from_work FROM user_group left outer join groups on user_group.group_id = groups.group_id where user_id = ' $id'") or die(mysqli_error($con));
    $row = mysqli_fetch_object($get);
    if ($row) {
        $g_id = $row->group_id;
        $group_id = $row->group_id;
        $group_name = $row->group_name;
        $homearea = $row->neighbourhood;
        $workarea = $row->workArea;
        $from_home = date("g:i a", strtotime("$row->from_home"));
        $from_work = date("g:i a", strtotime("$row->from_work"));
        
    } else {
        echo "<script type='text/javascript'>alert('You have to join a Group first \n Redirecting to Groups page');</script>";
        header("Location: dashboard.php");
    }
    date_default_timezone_set("Africa/Nairobi");
    $date = date("Y/m/d", time());   
    $q = "SELECT * FROM trips where group_id='$g_id' and date(Tdate) = '$date'";
    $tr = mysqli_query($con,$q) or die(mysqli_error($con));
    $trip = mysqli_fetch_assoc($tr);
    if(mysqli_num_rows($tr) > 0){
        $t_id = $trip["trip_id"];
    }
    ?>
    <div class="archive">
        <h3 class="article" style="text-align: center"> <b>Group name: </b><?php echo ($group_name); ?></h3>
        <h3 class="article"> <b>Home Area:</b> <?php echo ($homearea); ?></h3>
        <h3 class="article"> <b>Work Area: </b> <?php echo ($workarea); ?></h3>
        <h4 class="article"><b>Leave for work at: </b> <?php echo ($from_home); ?></h4>
        <h4 class="article"> <b>Leave work at :</b> <?php echo ($from_work); ?></h4>
    </div>
    <div id="<?php echo ($id); ?>" class="archive ">
        <div class="article two">
            <h3 class="joinbtn">Today's trip</h3>
            <div id="tripDetails" value="<?php echo ($group_id); ?>"></div>
            <span class="setTime">
                <form id="deptForm" method="POST">
                    <label> Set departure time:</label>
                    <input type="time" name="depjointTime" placeholder="Enter time...">
                    <input type="button" id="Setdept" value="Set Time">
                </form>
            </span>
            <input class="joinbtn" type='button' id='<?php echo ($t_id) ?>' class='joinTrip' onclick='joinTrip(this.id)' value='join Trip'>
        </div>
        <div class="article one">
            <h3> Oncoming Trips</h3>
            <span class="oncoming"> </span>
        </div>
    </div>
    <script src="js/trips.js">

    </script>
</body>

</html>