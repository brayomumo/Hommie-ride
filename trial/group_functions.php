<?php
require("auth.php");
    function joinGroup($id)
    {
        require('db.php');
        $query1 = "SELECT * from groups where group_id = '$id'";
        $res = mysqli_query($con, $query1) or die(mysqli_error($con));
        echo "queried";
        $row = mysqli_fetch_assoc($res);
        if ($res) {
            $group_id = $row['group_id'];
            $user_id = $_SESSION['id'];
            $query = "SELECT COUNT(user_group.user_id)as members from user_group where group_id= '$group_id'";
            $resl = mysqli_query($con, $query) or die(mysqli_error($con));
            $data = mysqli_fetch_assoc($resl);
            if ($data['members'] < 5) {
                $join = "INSERT INTO `user_group`(group_id, user_id) VALUES('$group_id','$user_id')";
                $response = mysqli_query($con, $join) or die(mysqli_error($con));
                if ($response) {
                    echo "Joined Group successfully";
                }
            } else {
                echo " Group already Full";
                createGroup();
            }
        }
    }
    if (isset($_POST['g_id'])) {
        echo joinGroup($_POST['g_id']);
    }
?>