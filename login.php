<!DOCTYPE html>
<html>

<head>
       <meta charset="utf-8">
       <title>Login</title>
       <link rel="stylesheet" href="css/group.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
       <?php
       require('db.php');
       session_start();
       // If form submitted, insert values into the database.
       if (isset($_POST['username'])) {
              // removes backslashes
              $username = stripslashes($_REQUEST['username']);
              //escapes special characters in a string
              $username = mysqli_real_escape_string($con, $username);
              $password = stripslashes($_REQUEST['password']);
              $password = mysqli_real_escape_string($con, $password);
              //Checking is user existing in the database or not
              $query = "SELECT * FROM `users` WHERE username='$username'
and password='" . md5($password) . "'";
              $result = mysqli_query($con, $query) or die(mysqli_error($con));
              $row = mysqli_fetch_assoc($result);
              $rows = mysqli_num_rows($result);
              if ($rows == 1) {
                     $_SESSION['username'] = $username;
                     $_SESSION["workarea"] = $row["workArea"];
                     $_SESSION["firstname"] = $row["first_name"];
                     $_SESSION["lastname"] = $row["last_name"];
                     $_SESSION["phonenumber"] = $row["phone_number "];
                     $_SESSION["email"] = $row["email"];
                     $_SESSION["licencenumber"] = $row["licence_number"];
                     $_SESSION["placeofwork"] = $row["place_of_work"];
                     $_SESSION["cartype"] = $row["cartype"];
                     $_SESSION["carplatenumber"] = $row['car_plate_number'];
                     $_SESSION['homearea'] = $row['homeArea'];
                     $_SESSION['id'] = $row['user_id'];
                     // Redirect user to index.php
                     header("Location: index.php");
              } else {
                     echo "<div class='outer-div'>
                     <div class='inner-div'>
                       <div class='front'>
                         <div class='front__bkg-photo'></div>
                         <div class='front__face-photo'></div>
                         <div class='front__text'>
                           <h3 class='front__text-header'>Username/password is incorrect.</h3>
                           <br/>Click here to <a href='login.php'>Login</a><br>
                           <br/>Click here to <a href='registration.php'>Register</a>
                         </div>
                       </div>
                   
                     </div>";
              }
       } else {
       ?>
       <div class="login">
                     <h1>Login</h1>
                     <form method="post">
                            <input type="text" name="username" placeholder="Username" required="required" />
                            <br>
                            <br>
                            <input type="password" name="password" placeholder="Password" required="required" />
                            <br>
                            <button type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
                            <br>
                            <hr>
                            <button class="btn btn-primary btn-block btn-large"> <a href="registration.php">Sign up</a></button>
                     </form>
       <?php } ?>
       
</body>

</html>