<?php include("auth.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script
			  src="js/jquery1.js"></script>
  <title>Document</title>
</head>
<body>
  <?php
  require("db.php");
  $user_id = $_SESSION['id'];
    $result = mysqli_query($con,"SELECT * FROM groups");
    echo "
    <table style='width: 70%; text-align:center;'>
    <tr>
        <th>Group name</th>
        <th>Work Area </th>
        <th>Neighbourhood</th>
        <th>Time they leave for work</th>
        <th>Time they leave for home</th>
        <th>work from </th>
        <th>To</th>
    </tr>  ";
    while($row = mysqli_fetch_array($result))
             {
              echo "<tr>
                        <td>" . $row['group_name'] . "</td>
                        <td> " . $row['workArea'] . "</td>
                        <td> " . $row['neighbourhood'] . "</td>
                        <td> " . $row['from_home'] . "</td>
                        <td> " . $row['from_work'] . "</td>
                        <td> " . $row['firstday'] . "</td>
                        <td> " . $row['lastday'] . "</td>
                        <td><button class='join' id='". $row['group_id'] ."' onclick='jaribu(this.id)'>Join</button></td>
                      </tr>"; //these are the fields that you have stored in your database table employee
             }
    echo "</table>";
    ?>
  <button class="trial" onclick="jaribu()" value="butn">Click</button>
<script>
  try {
    function jaribu(g_id){  
     
    console.log("Button clicked....executing ajax..");
    
    console.log(g_id);
    $.ajax({
        url: 'group_functions.php',
        type: 'post',
        data: { "g_id": g_id},
        success: function(response) { 
          alert(response);
          window.location.href = "dasboard.php";
          // console.log(response);
         }
    });
  }
}
catch(error) {
  console.error(error);
}
  
</script>
  
</body>
</html>
