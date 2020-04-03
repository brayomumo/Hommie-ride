
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <?php
        include('navbar.php');
        
    ?>
<div class="form">
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<p>This is secure area.</p>
<p><a href="dashboard.php">Dashboard</a></p>
<a href="logout.php">Logout</a>
</div>

<?php
function createG(){

}

    function createGroup(){
        
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
                    </div>" ; 
                    joinGroup($groupname);
                }else {
                        echo" Group not created";
                }
            }else {
    ?>
        <div class="header">
        </div>
            <form name="createGroup" action="" method="post">
                <div class="input-group">
                    <label >Group name</label><br>
                    <input type="text" name="gname" placeholder="Enter Group Name" required />
                    <input type="submit" name="createGroup" value="Create Group">
                </div>
                <div class="input-group">
                    
                </div>
            </form>
            <?php
    }

}
function joinGroup($name){
    require('db.php');
    $query1 = "SELECT * from groups where group_name = '$name'";    
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
createGroup();
?>
</body>
</html>