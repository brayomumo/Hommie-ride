<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/search.js"  type="text/javascript"></script>
</head>

<body>

    <!-- <script>
        $(document).ready(function() {
            $('.button').click(function() {
                var clickBtnValue = $(this).name;
                var ajaxurl = 'join.php',
                    data = {
                        'action': clickBtnValue
                    };
                $.post(ajaxurl, data, function(response) {
                    // Response div goes here.
                    alert(response);
                });
            });
        });
    </script> -->
    <?php
    include('navbar.php');
    require('db.php');

?>

    <?php



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

            //  $trn_date = date("Y-m-d H:i:s");
            $query = "INSERT INTO groups(group_name, workArea,neighbourhood) VALUES('$groupname', '$workarea', ' $homearea')";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
            if ($result) {
                echo "<div class='form'>
                    <h3>Group created successfully.</h3>
                    </div>";
                joinGroup($groupname);
            } else {
                echo " Group not created";
            }
        } else {
    ?>
            <div class="header">
                <h3>create group</h3>
            </div>
            <form name="createGroup" action="" method="post">
                <div class="input-group">
                    <input type="text" name="gname" placeholder="Enter Group Name" required />
                    <input type="submit" name="createGroup" value="Create Group">
                </div>
                <div class="input-group">

                </div>
            </form>
    <?php
        }
    }

    // createGroup();
    ?>


    <?php
    $user_id = $_SESSION['id'];
    $homearea = $_SESSION['homearea'];
    // $groups = "SELECT groups.*  FROM groups LEFT OUTER JOIN user_group ON groups.group_id = user_group.group_id WHERE user_group.user_id = '$user_id'";
    $groups = "SELECT * FROM groups";
    $joined = mysqli_query($con, $groups) or die(mysqli_error($con));
    if ($joined) {
        if (mysqli_num_rows($joined) > 0) {
            echo '
                <div class="groups">
                <h2> Groups joined</h2>
                <table style="width: 70%; text-align:center;">
                    <tr>
                        <th>Group name</th>
                        <th>Work Area </th>
                        <th>Neighbourhood</th>
                        <th>leave for work</th>
                        <th>leave for Home</th>
                        <th>first day in a week</th>
                        <th>last day in a week</th>
                        <th>action</th>
                    </tr>  ';
            while ($row = mysqli_fetch_array($joined)) {
                echo '<tr>              
                <td> ' . $row['group_name'] . '</td>
                    <td>' . $row['workArea'] . '</td>
                    <td>' . $row['neighbourhood'] . '</td>
                    <td>' . $row['from_home'] . '</td>
                    <td>' . $row['from_work'] . '</td>
                    <td>' . $row['firstday'] . '</td>
                    <td>' . $row['lastday'] . '</td>
                    <td><input type="submit" class="button" name="' . $row["group_name"] . '" value="join" /></td>
                   </tr>';
            }
            echo " </div>
            </table>";
            mysqli_free_result($joined);
        } else {
            echo " You have not joined any group ";
            createGroup();
        }
        // 
    }
            ?>



</body>

</html>