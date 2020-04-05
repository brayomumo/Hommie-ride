<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="js/jquery.js"></script>
  <title>algos</title>
</head>

<body>
  <div id="days"></div>


  <script>
  function pushDrivers(drivers){
    $.ajax({
   type: 'POST',
   url: 'stupid.php',
   data: {"drivers": drivers},
   success: function(msg){
     console.log(msg)
     console.log('success');
   },
   error: function(msg){
     console.log('fail', msg);
   }
 });
  }
  
    function getUsers() {
      var g_id = 12; //Get From user's Displayed Group
      $.ajax({
        url: 'stupid.php',
        type: 'POST',
        data: {"g_id":g_id},
        success: function(response) {
          var getarray = jQuery.parseJSON(response)
          var dr = alocateDrivers(getarray, 21, 4, 2020)
          pushDrivers(dr)
          // document.getElementById("days").innerHTML = dr;

        }
      });
    }

    function getday(n) {
      var day
      if (n == 0) {
        day = "Sunday";
      } else if (n == 1) {
        day = "Monday";
      } else if (n == 2) {
        day = "Tuesday";
      } else if (n == 3) {
        day = "Wednesday";
      } else if (n == 4) {
        day = "Thursday";
      } else if (n == 5) {
        day = "Friday";
      } else if (n == 6) {
        day = "Saturday";
      }
      return day
    }
    // getting work dates in amonth
    function getworkdays(users, date, month, year) {
      var date = new Date(year, month - 1, date + 1);
      var days = [];
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

      var workdays = []
      for (var i = 0; i < days.length; i++) {
        var obj = {}
        obj["day"] = getday(days[i].getDay())
        obj["date"] = days[i].getDate()         
        obj["month"] = days[i].getMonth()
        obj["year"] = days[i].getFullYear()
        workdays.push(obj)
      }
      
      return workdays;
    }

    function alocateDrivers(userIDS, lastdate, month, year) {
      var days = getworkdays(userIDS, lastdate, month, year);
      // document.getElementById("days").innerHTML = days;
      
      var drivers = {};
      for (var i = 0; i < userIDS.length; i++) {
        days[i]["driverID"] =userIDS[i]        
      }
      console.log(days)
      return JSON.stringify(days)
    }

    getUsers()
  </script>
</body>

</html>