<!DOCTYPE html>
<html>

<head>
       <meta charset="utf-8">
       <title>Login</title>
       <!-- <link rel="stylesheet" href="css/styles.css" /> -->
</head>
<style type="text/css">
       * {
              margin: 0;
              padding: 0;
       }

       body {
              font-family: Georgia, serif;
              background: url(images/login-page-bg.jpg) top center no-repeat #c4c4c4;
              color: #3a3a3a;
       }

       .clear {
              clear: both;
       }

       form {
              width: 406px;
              margin: 91px auto 0;
       }

       legend {
              display: none;
       }

       fieldset {
              border: 0;
       }

       label {
              width: 115px;
              text-align: right;
              float: left;
              margin: 0 10px 0 0;
              padding: 9px 0 0 0;
              font-size: 16px;
       }

       input {
              width: 220px;
              display: block;
              padding: 4px;
              margin: 0 0 10px 0;
              font-size: 18px;
              color: #3a3a3a;
              font-family: Georgia, serif;
       }
       .button {
              background: url(images/button-bg.png) repeat-x top center;
              border: 1px solid #999;
              -moz-border-radius: 5px;
              padding: 5px;
              color: black;
              font-weight: bold;
              -webkit-border-radius: 5px;
              font-size: 13px;
              width: 70px;
       }

       .button:hover {
              background: white;
              color: black;
       }
       #demo {
		padding-top: 10px;
		float: right;
	}
</style>

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
                     echo "<div class='form'>
                                   <h3>Username/password is incorrect.</h3>
                                   <br/>Click here to <a href='login.php'>Login</a>
                            </div>";
              }
       } else {
       ?>
              <!-- <div class="form">
                     <legend>Log In</legend>
                     <form action="" method="post" name="login">
                            <input type="text" name="username" placeholder="Username" required />
                            <input type="password" name="password" placeholder="Password" required />
                            <input name="submit" type="submit" value="Login" />
                     </form>
                     <p>Not registered yet? <a href='registration.php'>Register Here</a></p>

              </div> -->
              <div id="login">
                     <form action="" method="post" name="login">
                            <fieldset>
                                   <legend>Log in</legend>
                                   <label for="username">username</label>
                                   <input type="text" name="username" placeholder="Username" required />
                                   <!-- <input type="text" id="login" name="login" /> -->
                                   <div class="clear"></div>
                                   <label for="password">Password</label>
                                   <input type="password" name="password" placeholder="Password" required />
                                   <div class="clear"></div>
                                   <div class="clear"></div>
                                   <br />
                                   <input type="submit" style="margin: -20px 0 0 287px;" class="button" name="commit" value="Log in" />
                            </fieldset>
       </form>
       </div>
       <?php } ?>
</body>

</html>