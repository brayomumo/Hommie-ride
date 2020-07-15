<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style1.css" />
</head>

<body>
    <?php
    require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);$username = mysqli_real_escape_string($con, $username);
        $email = stripslashes($_REQUEST['email']);$email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);$password = mysqli_real_escape_string($con, $password);
        $LicenceNumber = stripslashes($_REQUEST['LicenceNumber']);$LicenceNumber = mysqli_real_escape_string($con, $LicenceNumber);
        $firstname = stripslashes($_REQUEST['firstname']);$firstname = mysqli_real_escape_string($con, $firstname);
        $lastname = stripslashes($_REQUEST['lastname']);$lastname = mysqli_real_escape_string($con, $lastname);
        $phone = stripslashes($_REQUEST['phone']);$phone = mysqli_real_escape_string($con, $phone);
        $place = stripslashes($_REQUEST['place']);$place = mysqli_real_escape_string($con, $place);
        $workArea = stripslashes($_REQUEST['workArea']);$workArea = mysqli_real_escape_string($con, $workArea);
        $homeArea = stripslashes($_REQUEST['homeArea']);$homeArea = mysqli_real_escape_string($con, $homeArea);
        $carType = stripslashes($_REQUEST['carType']);$carType = mysqli_real_escape_string($con, $carType);
        $plateNumber = stripslashes($_REQUEST['plateNumber']);$plateNumber = mysqli_real_escape_string($con, $plateNumber);
        $query = "INSERT into `users` (username,first_name, last_name, licence_number, email,  password, place_of_work,  workArea,homeArea, phone_number, carType, car_plate_number)
VALUES ('$username', '$firstname',' $lastname', '$LicenceNumber','$email', '" . md5($password) . "', '$place', '$workArea', '$homeArea','$phone', '$carType', ' $plateNumber')";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        if ($result) {
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    } else {
    ?>
        <div class="header">
            <h1>Registration</h1>
        </div>
        <form name="registration" action="" method="post">
            <div class="input-group"><label>Username</label><br><input type="text" name="username" placeholder="Username" required /></div>
            <div class="input-group"><label>Email</label><br><input type="email" name="email" placeholder="Email" required /></div>
            <div class="input-group"><label>Password</label><br><input type="password" name="password" placeholder="Password" required /></div>
            <div class="input-group"><label>Licence Number</label><br><input type="text" name="LicenceNumber" placeholder="Licence Number" required /></div>
            <div class="input-group"><label>First Name</label><br><input type="text" name="firstname" placeholder="first name" required /></div>
            <div class="input-group"><label>Last Name</label><br><input type="text" name="lastname" placeholder="last name" required /></div>
            <div class="input-group"><label>Phone number</label><br><input type="tel" name="phone" placeholder="phone number" required /></div>
            <div class="input-group"><label>Company/Institution</label><br><input type="text" name="place" placeholder="company/institution" required /></div>
            <div class="input-group"><label>Work Area</label><br><input type="text" name="workArea" placeholder="work Area" required /></div>
            <div class="input-group"><label>Home Area</label><br><input type="text" name="homeArea" placeholder="home Area" required /></div>
            <div class="input-group"><label>Car Model.</label><br><input type="text" name="carType" placeholder="car Type" required /></div>
            <div class="input-group"><label>Car plate number</label><br><input type="text" name="plateNumber" placeholder="car plate Number" required /></div>
            <div class="input-group"><button class="btn" type="submit" name="submit">Register</button><button class="btn" type="login" name="login"><a href="login.php">Log in</a> </button></div>

        </form>
    <?php } ?>
</body>

</html>