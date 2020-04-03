<?php
    if (isset($_POST['action'])) {
        joinGroup('dads');
    }

    function select() {
        echo "The select function is called.";
        exit;
    }

    function joinGroup($name){
        require('db.php');
        $query1 = "SELECT * from `groups` where group_name = '$name'";    
        $res = mysqli_query($con, $query1) or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($res);
        if ($res){
            $group_id = $row['group_id'];
            $user_id = $_SESSION['id'];
            $query = "SELECT COUNT(user_group.user_id)as members from user_group where group_id= $group_id";
            $resl = mysqli_query($con, $query) or die(mysqli_error($con));
            $data=mysqli_fetch_assoc($resl);
            if($data['members'] < 5){
                $join = "INSERT INTO `user_group`(group_id, user_id) VALUES('$group_id','$user_id')";
                $response = mysqli_query($con, $join) or die(mysqli_error($con));
                if($response){
                    echo"Joined Group successfully";
                }}else{
                    echo " Group already Full";
                    createGroup();
                }
        }
       
    }
?>