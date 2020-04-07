<?php
require("../auth.php");
function joinGroup($id)
{
    require('../db.php');
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
// creating a post
function createPost($news)
{
    require('../db.php');
    $id = $_SESSION['id'];
    $q = "SELECT group_id FROM  user_group where user_id = '$id'";
    $tri = mysqli_query($con,$q ) or die(mysqli_error($con));
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
        $allposts = Array();
        if ($posts) {
            if (mysqli_num_rows($posts) > 0) {
                while ($row = mysqli_fetch_array($posts)) {
                $obj = array_fill_keys(array("username","post","whenPosted"),"");
                $obj["username"] = $row['username'];;
                $obj["post"] =  $row['post'] ;
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
// choosing functions
if (isset($_POST['g_id'])) {
    echo joinGroup($_POST['g_id']);
} elseif (isset($_POST["post"])) {
    echo (createPost($_POST["post"]));
}
elseif(isset($_POST['getID'])){
    print_r(showposts($_POST['getID']));
}
