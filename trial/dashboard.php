<?php require("auth.php") ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <script src="js/jquery1.js"></script>
    <link href="css/group.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>

    <?php
    include('navbar.php');
    require("db.php");
    $id = $_SESSION['id'];
    $group = "SELECT  user_group.group_id, groups.group_name, groups.workArea, groups.neighbourhood, groups.from_home, groups.from_work FROM user_group left outer join groups on user_group.group_id = groups.group_id where user_id = ' $id'";
    $get = mysqli_query($con, $group) or die(mysqli_error($con));
    $row = mysqli_fetch_object($get);
    if ($row) {
        $group_id = $row->group_id;
        $group_name = $row->group_name;
        $homearea = $row->neighbourhood;
        $workarea = $row->workArea;
        $from_home = date("g:i a", strtotime("$row->from_home"));
        $from_work = date("g:i a", strtotime("$row->from_work"));
    ?>
        <div class="container">
            <div class="archive">
                <h3 class="article" style="text-align: center"> <b>Group name: </b><?php echo ($group_name); ?></h3>
                <h3 class="article"> <b>Home Area:</b> <?php echo ($homearea); ?></h3>
                <h3 class="article"> <b>Work Area: </b> <?php echo ($workarea); ?></h3>
                <h4 class="article"><b>Leave for work at: </b> <?php echo ($from_home); ?></h4>
                <h4 class="article"> <b>Leave work at :</b> <?php echo ($from_work); ?></h4>
            </div>
            <section class="archive">
                <div class="article 0ne">
                    <div class="news">
                        <div class="transition" id="<?php echo ($group_id) ?>"></div>
                    </div><br><br>
                    <form id="post_form">
                        <div class="input-group">
                            <h3>Post</h3>
                            <input type="text" id="post" placeholder="Type here ...." required><br>
                            <input type="button" onclick="postnews()" value="Post">
                        </div>
                    </form>
                </div>
                <div class="article two">
                    <div class="det">
                        <h2 style="text-align: center"> Group Members </h2>
                        <div class="members"> </div>
                        <h2 style="text-align: center">Group cars</h2>
                        <div class="cars"></div>
                        <input type="button" id="<?php echo ($id); ?>" onclick="eval('leavegroup(this.id)')" value="Leave Group">
                    </div>

                </div>
            </section>

        </div>

        <?php
    } else {
        showGroups($_SESSION['homearea'], $_SESSION['workarea']);
        echo "<h3> ----------- Or Create one -----------</h3>";
        createGroup();
    }

    // function showusers($group_id)
    // {
    //     require("db.php");
    //     $groups = "SELECT users.username, users.first_name, users.last_name, users.workArea, users.place_of_work,users.phone_number FROM users LEFT OUTER JOIN user_group ON users.user_id = user_group.user_id WHERE user_group.group_id = '$group_id'";
    //     $query = mysqli_query($con, $groups) or die(mysqli_error($con));
    //     if ($query) {
    //         if (mysqli_num_rows($query) > 0) {
    //             echo '
    //                 <div class="groups">
    //                 <h2> &nbsp Ride Alongs :)</h2>
    //                 <table style="width: 70%; text-align:center;">
    //                     <tr>
    //                         <th>username</th>
    //                         <th>full name </th>
    //                         <th>Place of work</th>
    //                         <th>phone number</th>
    //                     </tr>  ';
    //             while ($row = mysqli_fetch_array($query)) {
    //                 echo '<tr>              
    //                 <td> ' . $row['username'] . '</td>
    //                     <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
    //                     <td>' . $row['place_of_work'] . '</td>
    //                     <td>+254' . $row['phone_number'] . '</td>


    //                    </tr>';
    //             }
    //             echo " </div>
    //             </table><br>";
    //             mysqli_free_result($query);
    //         }
    //     }
    // }

    function createGroup()
    {

        require('db.php');
        // If form submitted, insert values into the database.
        if (isset($_REQUEST['gname'])) {
            $workarea = $_SESSION["workarea"];
            $homearea = $_SESSION['homearea'];;
            $id = $_SESSION['id'];
            $groupname = stripslashes($_REQUEST['gname']);
            $groupname = mysqli_real_escape_string($con, $groupname);

            $firstaday = stripslashes($_REQUEST['firstday']);
            $firstaday = mysqli_real_escape_string($con, $firstaday);

            $lastday = stripslashes($_REQUEST['lastday']);
            $lastday = mysqli_real_escape_string($con, $lastday);

            $depttime = $_REQUEST['depttime'];
            $deptime = date("H:i:s", strtotime($depttime));

            $leavetime = $_REQUEST['leavetime'];
            $leavetime = date("H:i:s", strtotime($leavetime));

            $admin = $_SESSION["id"];
            //  $trn_date = date("Y-m-d H:i:s");
            $query = "INSERT INTO groups(group_name, workArea,neighbourhood, Admin, from_home, from_work, firstday, lastday) VALUES('$groupname', '$workarea', ' $homearea',' $admin ','$leavetime', '$deptime', '$firstaday', '$lastday')";
            $result = mysqli_query($con, $query);
            if ($result) {
                echo "<div class='form'>
                    <h3>Group created successfully.</h3>
                    </div>";
                $g_id = mysqli_query($con, "SELECT LAST_INSERT_ID()") or die(mysqli_error($con));
                $id = mysqli_fetch_row($g_id);
                if (mysqli_query($con, "INSERT INTO user_group(g_id, user_id) VALUES('$id','$admin'")) {
                    echo " Group Created successfully";
                }
                // joinGroup($groupname);
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
                    <label for=""> select time to leave for work: </label>
                    <select class="time" name="depttime">
                        <option value="">Select...</option>
                        <option value="0400">4:00am</option>
                        <option value="0500">5:00 am</option>
                        <option value="0600">6:00am</option>
                        <option value="0700">7:00am</option>
                        <option value="0800">8:00am</option>
                        <option value="0900">9:00am</option>
                        <option value="1000">10:00a.m</option>
                        <option value="1100">11:00a.m</option>
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
                        <option value="1000">10:00a.m</option>
                        <option value="1100">11:00a.m</option>
                        <option value="1200">12:00 noon</option>
                        <option value="1300">1:00p.m</option>
                        <option value="1400">2:00p.m</option>
                        <option value="1500">3:00p.m</option>
                        <option value="1600">4:00p.m</option>

                    </select><br>
                    <label>Group name</label>
                    <input type="text" name="gname" placeholder="Enter Group Name" required /><br>
                    <label>First day of week</label><input type="text" name="firstday" placeholder="First day of work in a week" required>
                    <label>Last day of week</label><input type="text" name="lastday" placeholder="Last day of work in a week" required><br>


                    <input type="submit" name="createGroup" value="Create Group">
                </div>
                <div class="input-group">

                </div>
            </form>
    <?php
        }
    }
    function  showGroups($homearea, $workarea)
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
                </td>
                
              </tr>"; //these are the fields that you have stored in your database table employee
            }
            echo "</table>";
        }
    }

    ?>
    </div>
    <script type=text/javascript src="js/groups.js"></script>
</body>

</html>