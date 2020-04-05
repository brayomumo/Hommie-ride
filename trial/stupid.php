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

}
if(isset($_POST['g_id']))
 {
//    $json = json_decode($_POST['g_id'], true);
    echo getDrivers($_POST['g_id']);
 }elseif(isset($_POST['drivers'])){
    $json = json_decode($_POST['drivers'], true);
    print_r($json);
    
 }



?>