<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="js/jquery.js"></script>
  <title>algos</title>
</head>

<body>


  <script>
    var users = []
    function getUsers() {

      $.ajax({
        url: 'stupid.php',
        type: 'GET',
        dataType: "html",
        success: function(response) {
          users = response;
          
          //   window.location.href = "dashboard.php";
          // console.log(response);
        }
      });
    }
    // getting dates iin amonth
    function getDaysInMonth(users,date,month, year) {
    var date = new Date(year, month+1, date+1);
    var days = [];
    var count = 0
    while (date.getMonth() === month+1 && count < users.length) {
      days.push(new Date(date));
      if(date.getDay() == "Sunday" || date.getDay() == "Saturday"){
        continue;
      }else{
      date.setDate(date.getDate() + 1);
      count +=1
      }
    }
    var workdays = []
    for(var i=0;i<days.length;i++){
        var D = days[i].getDate();
        workdays.push(D)    
    }
    return workdays;
  }

function alocateDrivers(userIDS, lastdate, month,year){
    var days = getDaysInMonth(userIDS,lastdate, month, year);
    // document.getElementById("days").innerHTML = days;
    var drivers = {};
    for(var i=0;i<userIDS.length;i++){
        drivers[days[i]] = userIDS[i];
    }
    return drivers
}
    var userIDS = [10, 12, 19, 28, 34, 45]
    getUsers()
    alert(users)
    console.log(alocateDrivers(users,21,4,2020))




    // 
    function getDaysInMonth(users,date,month, year) {
    var date = new Date(year, month+1, date+1);
    var days = [];
    var count = 0
    while (date.getMonth() === month+1 && count < users.length) {
      days.push(new Date(date));
      if(date.getDay() == 0 || date.getDay() == 6){
        continue;
      }else{
      date.setDate(date.getDate() + 1);
      count +=1
      }
    }
    var workdays = []
    for(var i=0;i<days.length;i++){
        var D = days[i].getDate();
        workdays.push(D)    
    }
    return workdays;
  }
  var userIDS = [10,12,19,28,34,45]
  console.log(getDaysInMonth(userIDS,1,4,2020))
  </script>
</body>

</html>