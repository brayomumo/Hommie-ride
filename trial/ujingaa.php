<?php
require("auth.ph");
    function createPost( $post){
        require('db.php');
        $id = $_SESSION['id'];
        $assoc = mysqli_fetch_assoc(mysqli_query($con, "SELECT group_id from user_group where user_id = '$id'"));
        $g_id = $assoc["group_id"];
        $when = date("Y-m-d H:i:s");
        $query = "INSERT INTO `posts`(userID, when_posted, group_id, post) VALUES('$id', '$when', ' $g_id','$post')";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        if ($result) {
            echo "Posted successfully";
        }
            
    } 
    if(isset($_POST["post"])){
       echo  createPost($_POST["post"]);
    }
?>