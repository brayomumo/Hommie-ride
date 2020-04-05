<?php
function getDrivers($g_id){
    require("db.php");
    $drivers = array();
    $statement = "SELECT * FROM user_group WHERE group_id = '$g_id'";
    $query = mysqli_query($con,$statement ) or die(mysqli_error($con)); 
        while($row = mysqli_fetch_array($query)){
            array_push($drivers,$row['user_id']);
    }
    return $drivers;
}
$drivers = getDrivers(12);
print_r($drivers);
?>