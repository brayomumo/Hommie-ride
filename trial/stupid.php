<?php
function getDrivers($g_id){
    require("db.php");
    $drivers = array();
    $statement = "SELECT * FROM user_group WHERE group_id = '$g_id'";
    $query = mysqli_query($con,$statement ) or die(mysqli_error($con)); 
        while($row = mysqli_fetch_array($query)){
            array_push($drivers,$row['user_id']);
    }
    return json_encode($drivers) ;
}
function setDrivers($drivers){
    require("db.php");
    for($i = 0;$i<count($drivers);$i++){
        $id = $_SESSION['id'];
        $group = "SELECT  group_id FROM user_group where user_id = '$id'";
        $get = mysqli_query($con, $group) or die(mysqli_error($con));
        $row = mysqli_fetch_object($get);
        if ($row){
            $group_id = $row->group_id;
        }
}
}
if(isset($_POST['g_id']))
 {
//    $json = json_decode($_POST['g_id'], true);
    echo getDrivers($_POST['g_id']);
 }elseif(isset($_POST['drivers'])){
     require("db.php");
    $json = json_decode($_POST['drivers'], true);
    // print_r(count($json));
    // $leo = date("Y/m/d");
    // print_r($leo);
    for($i =0;$i<count($json);$i++){
        $user_id = $json[$i]["driverID"];
        $group = "SELECT  groups.group_id FROM groups LEFT JOIN user_group ON groups.group_id = user_group.group_id WHERE user_group.user_id = '$user_id'";
        $get = mysqli_query($con, $group) or die(mysqli_error($con));
        $row = mysqli_fetch_object($get);
        if ($row){
            $group_id = $row->group_id;
            $leo = DATE($json[$i]["date"]);
            
            $day = $json[$i]["day"];    
            
            $push = " INSERT INTO trips(Tdate, day, driver_id, group_id)VALUES ('$leo', '$day', '$user_id','$group_id')";
            $res = mysqli_query($con,$push) or die(mysqli_error($con));
            if($res){
                echo("Success");
            }
            
        }   
    }
    
   
    
    
 }
 


?>