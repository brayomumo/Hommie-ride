<?php require("auth.php") ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <script src="js/jquery1.js"></script>
    <!-- <link href="css/style1.css" rel="stylesheet" type="TEXT/CSS"> -->
    <link href="css/group.css" rel="stylesheet"type="TEXT/CSS">
   
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
                            <input type="text" class="archive input-group" id="post" placeholder="Type here ...." required><br>
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
        echo "<h3 style='text-align:center;' > ----------- Or Create one -----------</h3>";
        createGroup();
    }
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
                $r = mysqli_query($con, "INSERT INTO user_group(g_id, user_id) VALUES('$id','$admin'");
                if ($r) {
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
                <div class="input-group archive">
                <span class="article"><label>Group name</label><input type="text" name="gname" placeholder="Enter Group Name" required /><br></span>
                    <span class="article"><label for=""> select time to leave for work: </label><input type="time" name="depttime"></span>
                    <span class="article"><label for="leavetime"> select time to leave for Home: </label><input type="time" name="leavetime"></span>    
                    <span class="article"><label>First day of week</label><input type="text" name="firstday" placeholder="First day of work in a week" required></span>
                    <span class="article"><label>Last day of week</label><input type="text" name="lastday" placeholder="Last day of work in a week" required><br></span>


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
        echo "<h3 style='text-align:center;'>Groups below are either from your work area or Home area<br>Please join one</h3>";
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