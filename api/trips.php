<?php
require("../auth.php");
$todaysTripID = 0;
function joinTrip($trip_id){
    require("../db.php");
    $ID = $_SESSION["id"];
    $query = mysqli_query($con, "INSERT INTO ridealongs(trip_id, user_id) VALUES('$trip_id', '$ID')");
    if($query){
        echo("Joined Successfully");
    }
}
function getTodayTripDetails($g_id){
    require("../db.php");
    date_default_timezone_set('Africa/Nairobi');
    $date = date('Y-m-d', time());       
    $q = "SELECT * FROM trips where group_id='$g_id' and date(Tdate) = '$date'";
    $tr = mysqli_query($con,$q) or die(mysqli_error($con));
    $trip = mysqli_fetch_assoc($tr);
    $tripDetails = Array();
    if(mysqli_num_rows($tr) > 0){
        $t_id = $trip["trip_id"];
        $driver = $trip["driver_id"]; 
        $lastDay = mysqli_query($con, "SELECT max(Tdate) as tdate  from trips where group_id='$g_id'")or die(mysqli_error($con));
        $lD = mysqli_fetch_assoc($lastDay)["tdate"];
        $lDate = Date("Y-M-d ", strtotime($lD));
        $ride = mysqli_query($con,"SELECT users.username,users.user_id, users.place_of_work FROM users LEFT JOIN ridealongs ON ridealongs.user_id = users.user_id WHERE ridealongs.trip_id = '$t_id'") or die(mysqli_error($con));            
        while ($row = mysqli_fetch_array($ride)) {
            $obj = array_fill_keys(array("trip_id","name","place","state","lastDate","driver"),"");
            $obj["trip_id"] = $t_id;
            $obj["name"] = $row["username"];
            $obj["user_id"] = $row['user_id'];
            $obj["place"] = $row["place_of_work"];
            if($obj["user_id"] == $driver){
                $obj["state"] = "Driver";
            }else{
                $obj["state"] = "passenger";
            }
            if ($lDate == $date){
                $obj["lastDate"] = "true";
            }else{
                $obj["lastDate"] = "false";
            }
            $obj["driver"] = $driver;
            array_push($tripDetails, $obj);
        }
    }else {
        return "No Trip Today";
    }
    return json_encode($tripDetails);
}
//returns oncoming trips
function coming()
{
    require("../db.php");
    $user_id = $_SESSION['id'];
    $gr = mysqli_query($con, "SELECT group_id from user_group where user_id = '$user_id' ");
    $row = mysqli_fetch_assoc($gr);
    $oncoming = Array(); //store oncoming trip details as an array
    if ($gr) {
        $g_id = $row['group_id'];
        $today = date("Y-m-d H:m:s");
        $trips = mysqli_query($con, "SELECT trips.* FROM trips where group_id = '$g_id' and Trip_state ='pending' AND Tdate > '$today'");
        if ($trips) {
            while ($trip = mysqli_fetch_array($trips)) {
                // check if trip date is before today 
                $driver_id = $trip["driver_id"];
                // $obj = array_fill_keys(array("date","day","Driver","cartype", "platenumber", "seatsAvailable"),"");
                $result = mysqli_query($con, "SELECT username, cartype, car_plate_number from users where user_id = '$driver_id'");
                $resultt = mysqli_fetch_assoc($result);
                if ($result) {
                    $obj = array_fill_keys(array("date","day","Driver","cartype", "platenumber", "seatsAvailable","Trip_state"),"");
                    $obj["day"] = $trip["day"];
                    $obj["date"] = $trip["Tdate"]; 
                    $obj["Driver"] =  $resultt["username"];
                    $obj["cartype"] =$resultt["cartype"];
                    $obj["platenumber"] = $resultt["car_plate_number"] ;
                    $obj["seatsAvailable"] =  $trip["seats_available"];
                    $obj["Trip_state"] = $trip["Trip_state"];
                    array_push($oncoming, $obj);
                }
        }
        }
    }
    return json_encode($oncoming);
}
// get all members of the group
function getDrivers($g_id){
    require("../db.php");
    $drivers = array();
    $statement = "SELECT * FROM user_group WHERE group_id = '$g_id'";
    $query = mysqli_query($con,$statement ) or die(mysqli_error($con)); 
        while($row = mysqli_fetch_array($query)){
            array_push($drivers,$row['user_id']);
    }
    return json_encode($drivers) ;
}
// save drivers to databse 
function saveDrivers($drivers){
    require("../db.php");
    $json = json_decode($drivers, true);
    for($i =0;$i<count($json);$i++){
        $user_id = $json[$i]["driverID"];
        $group = "SELECT  groups.group_id FROM groups LEFT JOIN user_group ON groups.group_id = user_group.group_id WHERE user_group.user_id = '$user_id'";
        $get = mysqli_query($con, $group) or die(mysqli_error($con));
        $row = mysqli_fetch_object($get);
        if ($row){
            $group_id = $row->group_id;
            $leo = DATE($json[$i]["date"]);
            print_r($leo);
            $day = $json[$i]["day"];  
            $push = " INSERT INTO trips(Tdate, day, driver_id, group_id, Trip_state)VALUES ('$leo', '$day', '$user_id','$group_id', 'pending')";
            $res = mysqli_query($con,$push) or die(mysqli_error($con));
            if($res){
                echo("Success");
            }
            
        }   
    }
    
}
function setDeptTime($data){
    require("../db.php");
    global $todaysTripID;
    $time =  Date("Y-m-d", strtotime($data));
    $q = mysqli_query($con, "UPDATE `trips` SET `departure_time` = '$time', `Trip_state` ='complete' WHERE `trips`.`trip_id` = '$todaysTripID'");
    if ($q){
        return "success";
    }
    
}

if(isset($_POST["joinID"])){
    echo jointrip($_POST["joinID"]);
}elseif(isset($_POST["todayID"])){
    print_r (getTodayTripDetails($_POST["todayID"]));
}elseif(isset($_POST["oncoming"])){
    print_r(coming());
}elseif(isset($_POST['g_id'])){
    echo getDrivers($_POST['g_id']);
}elseif(isset($_POST['drivers'])){
    print_r(saveDrivers($_POST['drivers']));
}elseif(isset($_POST['deptTime'])){
    print_r(setDeptTime($_POST['deptTime']));
}