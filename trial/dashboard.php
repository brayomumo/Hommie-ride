<?php require("auth.php") ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <script src="js/jquery1.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.9);
        transition: 0.3s;
        border-radius: 5px;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .container {
        padding: 2px 16px;
    }

    .news {
        width: 800px;
        height: 500px;
        overflow: auto;
        text-align: justify;
    }
</style>

<body>

    <?php
    include('navbar.php');

    ?>
    <!-- <div class="form">
        <p>Welcome <?php //echo $_SESSION['username']; 
                    ?>!</p>
        <p>This is secure area.</p>
        <p><a href="ride.php">ride</a></p>
        <a href="logout.php">Logout</a>
    </div> -->



    <?php
    require("db.php");
    $id = $_SESSION['id'];
    $group = "SELECT  group_id FROM user_group where user_id = ' $id'";
    $get = mysqli_query($con, $group) or die(mysqli_error($con));
    $row = mysqli_fetch_object($get);
    if ($row) {
        $group_id = $row->group_id;
    ?>
    <div class="groupDetails">
        <h3>Group Name</h3>
        <h3></h3>
    </div>
        <div class="news">
            <div class="transition" id="<?php echo ($group_id) ?>"></div>
            
        </div><br><br>
        <form id="post_form">
                    <div class="input-group">
                        <label>Post</label><br>
                        <input type="text" id="post" placeholder="Type here ...." required><br>
                        <input type="button" onclick="postnews()" value="Post">
                    </div>
                </form>
        <?php

        // createPost($group_id);
        showusers($group_id);
    } else {
        showGroups($_SESSION['homearea'], $_SESSION['workarea']);
        echo "<h3> Or Create one</h3>";
        createGroup();
    }

    function showusers($group_id)
    {
        require("db.php");
        $groups = "SELECT users.username, users.first_name, users.last_name, users.workArea, users.place_of_work,users.phone_number FROM users LEFT OUTER JOIN user_group ON users.user_id = user_group.user_id WHERE user_group.group_id = '$group_id'";
        $query = mysqli_query($con, $groups) or die(mysqli_error($con));
        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                echo '
                    <div class="groups">
                    <h2> &nbsp Ride Alongs :)</h2>
                    <table style="width: 70%; text-align:center;">
                        <tr>
                            <th>username</th>
                            <th>full name </th>
                            <th>Place of work</th>
                            <th>phone number</th>
                        </tr>  ';
                while ($row = mysqli_fetch_array($query)) {
                    echo '<tr>              
                    <td> ' . $row['username'] . '</td>
                        <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
                        <td>' . $row['place_of_work'] . '</td>
                        <td>+254' . $row['phone_number'] . '</td>
                        
                        
                       </tr>';
                }
                echo " </div>
                </table><br>";
                mysqli_free_result($query);
            }
        }
    }

    function createGroup()
    {

        require('db.php');
        // If form submitted, insert values into the database.
        if (isset($_REQUEST['gname'])) {
            $workarea = $_SESSION["workarea"];
            $homearea = $_SESSION['homearea'];;
            $id = $_SESSION['id'];
            // removes backslashes
            $groupname = stripslashes($_REQUEST['gname']);
            //escapes special characters in a string
            $groupname = mysqli_real_escape_string($con, $groupname);
            $departuretime = stripslashes($_REQUEST['departuretime']);
            $departuretime = mysqli_real_escape_string($con, $departuretime);

            $firstaday = stripslashes($_REQUEST['firstday']);
            $firstaday = mysqli_real_escape_string($con, $firstaday);

            $lastday = stripslashes($_REQUEST['lastday']);
            $lastday = mysqli_real_escape_string($con, $lastday);

            $depttime = $_REQUEST['depttime'];
            $deptime = date("H:i:s", strtotime($depttime));

            $leavetime = $_REQUEST['leavetime'];
            $leavetime = date("H:i:s", strtotime($leavetime));


            echo $deptime;

            //  $trn_date = date("Y-m-d H:i:s");
            $query = "INSERT INTO groups(group_name, workArea,neighbourhood, from_home, from_work, firstday, lastday) VALUES('$groupname', '$workarea', ' $homearea','$leavetime', '$deptime', '$firstaday', '$lastday')";
            $result = mysqli_query($con, $query);
            if ($result) {
                echo "<div class='form'>
                    <h3>Group created successfully.</h3>
                    </div>";
                joinGroup($groupname);
            } else {
                echo " Group not created";
                createGroup();
            }
        } else {
        ?>
            <div class="header">

            </div>
            <form name="createGroup" action="" method="post">
                <div class="input-group">
                    <label>Group name</label><br>
                    <input type="text" name="gname" placeholder="Enter Group Name" required />
                    <input type="text" name="departuretime" placeholder="Departure time" required><br>
                    <input type="text" name="firstday" placeholder="First day of work in a week" required>
                    <input type="text" name="lastday" placeholder="Last day of work in a week" required><br>

                    <label for=""> select time to leave for work: </label>
                    <select class="time" name="depttime">
                        <option value="">Select...</option>
                        <option value="0400">4:00am</option>
                        <option value="0500">5:00 am</option>
                        <option value="0600">6:00am</option>
                        <option value="0700">7:00am</option>
                        <option value="0800">8:00am</option>
                        <option value="0900">9:00am</option>
                        <option value="1000">10:00p.m</option>
                        <option value="1100">11:00p.m</option>
                        <option value="1200">12:00 noon</option>
                        <option value="1300">1:00p.m</option>
                        <option value="1400">2:00p.m</option>
                        <option value="1500">3:00p.m</option>
                        <option value="1600">4:00p.m</option>

                    </select>
                    <label for=""> select time to leave for Home: </label>
                    <select class="time" name="leavetime">
                        <option value="">Select...</option>
                        <option value="0400">4:00am</option>
                        <option value="0500">5:00 am</option>
                        <option value="0600">6:00am</option>
                        <option value="0700">7:00am</option>
                        <option value="0800">8:00am</option>
                        <option value="0900">9:00am</option>
                        <option value="1000">10:00p.m</option>
                        <option value="1100">11:00p.m</option>
                        <option value="1200">12:00 noon</option>
                        <option value="1300">1:00p.m</option>
                        <option value="1400">2:00p.m</option>
                        <option value="1500">3:00p.m</option>
                        <option value="1600">4:00p.m</option>

                    </select><br>
                    <input type="submit" name="createGroup" value="Create Group">
                </div>
                <div class="input-group">

                </div>
            </form>
    <?php
        }
    }
    function showGroups($homearea, $workarea)
    {
        require("db.php");
        echo "<h3>Groups below are either from your work area or Home area<br>Please join one</h3>";
        $result = mysqli_query($con, "SELECT * FROM groups WHERE neighbourhood = '$homearea' or workArea = '$workarea'");
        if ($result) {
            echo "
        <table style='width: 70%; text-align:center;'>
        <tr>
            <th>Group name</th>
            <th>Work Area </th>
            <th>Neighbourhood</th>
            <th>Time they leave for work</th>
            <th>Time they leave for home</th>
            <th>work from </th>
            <th>To</th>
            <th>Action</th>
        </tr>  ";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>
                <td>" . $row['group_name'] . "</td>
                <td> " . $row['workArea'] . "</td>
                <td> " . $row['neighbourhood'] . "</td>
                <td> " . $row['from_home'] . "</td>
                <td> " . $row['from_work'] . "</td>
                <td> " . $row['firstday'] . "</td>
                <td> " . $row['lastday'] . "</td>
                <td>
                <input type='submit'id='" . $row['group_id'] . "' onclick='join(this.id)' name='createGroup' value='join'>
                    <button class='' id='" . $row['group_id'] . "' onclick='jaribu(this.id)'>Join</button >
                </td>
                
              </tr>"; //these are the fields that you have stored in your database table employee
            }
            echo "</table>";
        }
    }

    ?>

    <script src="js/groups.js"></script>
</body>

</html>