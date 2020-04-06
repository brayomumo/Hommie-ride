<?php
require("auth.php");
    function oncomingTrips($g_id){
        $today = date("Y/m/d");
        require("db.php");
        $query = "SELECT * FROM trips where group_id='$g_id'and Tdate = '$today'";
        $res = mysqli_query($con,$query) or die(mysqli_error($con));
        if($res){

        }
    }
   function joinTrip($trip_id){
       require("db.php");
       $ID = $_SESSION["id"];
       $query = mysqli_query($con, "INSERT INTO ridealong(trip_id, user_id) VALUES('$trip_id', '$ID')");
        if($query){
            echo("Joined Successfully");
        }
   }
    
?>