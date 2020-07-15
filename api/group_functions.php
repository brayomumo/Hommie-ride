<?php
require("../auth.php");
//joining a group
function joinGroup($id)
{
    require('../db.php');
    $query1 = "SELECT * from groups where group_id = '$id'";
    $res = mysqli_query($con, $query1) or die(mysqli_error($con));
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
        }
    }
}
// creating a post
function createPost($news)
{
    require('../db.php');
    $id = $_SESSION['id'];
    $q = "SELECT group_id FROM  user_group where user_id = '$id'";
    $tri = mysqli_query($con, $q) or die(mysqli_error($con));
    $tr = mysqli_fetch_assoc($tri);
    if ($tri) {
        $g_id = $tr["group_id"];
        $when = date("Y-m-d H:i:s");
        $query = "INSERT INTO `posts`(userID, when_posted, group_id, post) VALUES('$id', '$when', ' $g_id','$news')";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        if ($result) {
            echo 'posted successfully';
        } else {
            echo " post not created";
        }
    }
}
// getting posts
function showposts($g_id)
{
    require("../db.php");
    $query = "SELECT users.username , posts.* FROM posts LEFT OUTER JOIN users on users.user_id = posts.userID where group_id='$g_id'";
    $posts = mysqli_query($con, $query) or die(mysqli_error($con));
    $allposts = array();
    if ($posts) {
        if (mysqli_num_rows($posts) > 0) {
            while ($row = mysqli_fetch_array($posts)) {
                $obj = array_fill_keys(array("username", "post", "whenPosted"), "");
                $obj["username"] = $row['username'];;
                $obj["post"] =  $row['post'];
                $obj["whenPosted"] =  $row['when_posted'];
                array_push($allposts, $obj);
            }
            mysqli_free_result($posts);
        } else {
            echo 'No group news currently';
        }
        return json_encode($allposts);
    }
}
//getting group details
function getGroupDetails($g_id)
{
    require("../db.php");
    $q = "SELECT username, place_of_work,cartype, car_plate_number from users left outer join user_group ON user_group.user_id = users.user_id WHERE user_group.group_id = '$g_id'";
    $query = mysqli_query($con, $q) or die(mysqli_error($con));
    $details = Array();
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query)) {
                $obj = array_fill_keys(array("username", "placeofwork", "cartype","carplatenumber"), "");
                $obj["username"] = $row['username'];;
                $obj["placeofwork"] =  $row['place_of_work'];
                $obj["cartype"] =  $row['cartype'];
                $obj["carplatenumber"] =  $row['car_plate_number'];
                array_push($details, $obj);
            }
            mysqli_free_result($query);
            return json_encode($details);
    }
};

function leveGroup($user_id){
    require('../db.php');
    $Q = "DELETE FROM user_group WHERE user_id = '$user_id'";
    $qw = mysqli_query($con, $Q) or die (mysqli_error($con));
    if($qw){
        return "You are no longer a member of the group";
    }
}
// choosing functions
if (isset($_POST['g_id'])) {
    echo joinGroup($_POST['g_id']);
} elseif (isset($_POST["post"])) {
    echo (createPost($_POST["post"]));
} elseif (isset($_POST['getPostID'])) {
    print_r(showposts($_POST['getPostID']));
}elseif(isset($_POST["getDetailsID"])){
    print_r(getGroupDetails($_POST["getDetailsID"]));
}elseif(isset($_POST["user_id"])){
    echo(leveGroup($_POST["user_id"]));
}
