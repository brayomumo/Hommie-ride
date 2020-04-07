<?php
require("../auth.php");
    function oncomingTrips($g_id){
        $today = date("Y/m/d");
        require("db.php");
        $query = "SELECT * FROM trips where group_id='$g_id'and Tdate = '$today'";
        $res = mysqli_query($con,$query) or die(mysqli_error($con));
        if($res){

        }
    }
   function joinTrip($trip_id){
       require("../db.php");
       $ID = $_SESSION["id"];
       $query = mysqli_query($con, "INSERT INTO ridealongs(trip_id, user_id) VALUES('$trip_id', '$ID')");
        if($query){
            echo("Joined Successfully");
        }
   }
   function getTodaysTrip($g_id){
       require("../db.php");
        date_default_timezone_set('Africa/Nairobi');
        $date = date('Y-m-d', time());       
        $q = "SELECT * FROM trips where group_id='$g_id' and date(Tdate) = '$date'";
        $tr = mysqli_query($con,$q) or die(mysqli_error($con));
        $trip = mysqli_fetch_assoc($tr);
        $tripDetails = Array();
        if($tr){
            $t_id = $trip["trip_id"];
            $e = "SELECT users.username, users.place_of_work FROM users LEFT JOIN ridealongs ON ridealongs.user_id = users.user_id WHERE ridealongs.trip_id = '$t_id'";
            $ride = mysqli_query($con,$e) or die(mysqli_error($con));            
            while ($row = mysqli_fetch_array($ride)) {
                $obj = array_fill_keys(array("name","place","state"),"");
                $obj["name"] = $row["username"];
                $obj["place"] = $row["place_of_work"];
                $obj["state"] = "passenger";

                array_push($tripDetails, $obj);

            }
        }
        return json_encode($tripDetails);
   }
   
   
    if(isset($_POST["joinID"])){
        echo jointrip($_POST["joinID"]);
    }elseif(isset($_POST["todayID"])){
        print_r (getTodaysTrip($_POST["todayID"]));
    }
?>