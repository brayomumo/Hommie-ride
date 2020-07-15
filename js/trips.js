$(document).ready(function () {
    $(".setTime").hide()
    console.log($(".row").attr("id"))
    getOnComingTrips()
    getTodaytripdetails();
})
// joining a trip
function joinTrip(g_id) {
    $.ajax({
        method: "POST",
        url: "api/trips.php",
        data: {
            "joinID": g_id
        },
        success: function (response) {
            
            $("#" + g_id).hide()
            getTodaytripdetails();

        }
    })
}
function setDept(){
    $(".setTime").show();
    var time = 0
    // getting departure time from user
    $("#Setdept").click(function(e){
        var data = $("#deptForm").serializeArray()
        $.each(data, function(i, field) { 
            time = field.value
        }); 
    })
    console.log(time)
    //pass data to backend
    $.ajax({
        method: "POST",
        url: "api/trips.php ",
        data: {"deptTime": time},
        success: function(response){
            console.log(response)
        }
    })

}

// getting today's trip details
function getTodaytripdetails() {
    var g_id = document.getElementById("tripDetails").getAttribute("value");
    var driver_id = 0
    var isLastDate = false;
    var CurrentUser_id = $(".row").attr("id")
    $.ajax({
        method: "POST",
        url: "api/trips.php",
        data: { "todayID": g_id },
    }).done(function (data) {
        // console.log(data)
            if (data === "No Trip Today"){
                $(".joinbtn").hide()
                $("#tripDetails").html("<h2>No Trip Today</h2>");
            }else{
        var result = $.parseJSON(data);
        // console.log(result)
        var string = '<table style="width: 50%; text-align:center";> <tr>\
                                    <th>Name</th>\
                                    <th>place of work</th>\
                                    <th>status</th>\
                                </tr>';
        $.each(result, function (key, value) {
            if(value["user_id"] == CurrentUser_id){
                $(".joinbtn").hide()
            }
            driver_id = value["driver"]
            isLastDate = value["lastDate"]
            string += "<tr> <td>" + value['name'] + "</td> \
                        <td>"+ value['place'] + '</td>  \
                        <td>'+ value['state'] + "</td> </tr>";
        });
        string += '</table>';
        if(driver_id == CurrentUser_id){
            setDept();
        }
        // setting next phase drivers
        if (isLastDate){
            // if last day, save drivers for next month
            var today = new Date();
            getUsers(today.getDate(), today.getMonth()+1, today.getFullYear());
        }
        $("#tripDetails").html(string);
    }
    });
    // check for today's driver 
   
}
function getOnComingTrips() {
    $.ajax({
        method: "POST",
        url: "api/trips.php",
        data: { "oncoming": true },
    }).done(function (data) {
        // console.log(data)
        var results = $.parseJSON(data);
       
        if(results.length  == 0){
            var today = new Date();
            console.log(today.getMonth()+1 )
            getUsers(today.getDate(), today.getMonth()+1, today.getFullYear());
        }else{
        var string = "<table style='width: 50%; text-align:center;'> <tr><th>Date</th><th>Day</th><th>Driver </th><th>Cartype</th><th>Car Plate Number</th><th>Seats Available</th></tr>"
        $.each(results, function (key, value) {
            string += "<tr> <td>"+ value['date']+ "</td><td>" + value['day'] + "</td>\
            <td>" + value['Driver'] + "</td>\
            <td>" + value['cartype'] + "</td>\
            <td>" + value['platenumber'] + "</td>"
            if (value['seatsAvailable'] == 0){
                string +="<td> <i>To be set</i></td> </tr>"
            }
            
        });
    
        string += "</table>";
        $('.oncoming').html(string)
    }
    })
}


/* choosing and saving drivers from group details */

// save Drivers to database asynchronously 
function saveDrivers(drivers) {
    $.ajax({
        type: 'POST',
        url: 'api/trips.php',
        data: { "drivers": drivers },
        success: function (msg) {
            console.log('success');
        },
        error: function (msg) {
            console.log('fail', msg);
        }
    });
}
// Get all members of the group
function getUsers(day,month, year) {
    /*  Gets all members of the group and passes to allocateDriver () for allocation then passes the allocated drivers to () for storage*/
    var g_id = document.getElementById("tripDetails").getAttribute("value"); 
    console.log(day,month,year)
    $.ajax({
        url: 'api/trips.php',
        type: 'POST',
        data: { "g_id": g_id },
        success: function (response) {
            var getUserarray = $.parseJSON(response)
            var dr = alocateDrivers(getUserarray, day, month, year) 
            saveDrivers(dr)
        }
    });
}


// getting work dates in a month
function getworkdays(users, date, month, year) {
    var date = new Date(year, month-1, date);
    var days = [];
    var workdays = []
    var count = 0
    while (count < users.length) {
        var k = date.getDay();
        if (k == 0 || k == 6) {
            date.setDate(date.getDate() + 1);
            continue
        } else {
            days.push(new Date(date));
            date.setDate(date.getDate() + 1);
            count += 1
        }
    }
    for (var i = 0; i < days.length; i++) {
        var obj = {}
        let month = days[i].getMonth() +1
        var date = days[i].getFullYear() + "/" +month + "/" + days[i].getDate()
        obj["day"] = days[i].toDateString().slice(0,3)
        obj["date"] = date
        workdays.push(obj)
    }
    return workdays;
}

function alocateDrivers(userIDS, lastdate, month, year) {
    var days = getworkdays(userIDS, lastdate, month, year);
    // document.getElementById("days").innerHTML = days;
    var drivers = {};
    for (var i = 0; i < userIDS.length; i++) {
        days[i]["driverID"] = userIDS[i]
    }
    // console.log(JSON.stringify(days))
    return JSON.stringify(days)
}

