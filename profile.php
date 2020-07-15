<?php require("auth.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/group.css" />
    <link href="css/profile.css" rel="stylesheet" type="TEXT/CSS">
    <link href="css/style1.css" type="stylesheet" type="TEXT/CSS">
    <script src="js/jquery.js"></script>
    <title><?php echo ($_SESSION["username"]); ?></title>
</head>

<body>

    <?php
    include("navbar.php");
    // print_r($_SESSION);
    include("db.php");
    ?>
    
    <div class="archive">
        <!-- updating diffetent parts -->
        <!-- profile details -->
        <section id="personalPopup" class="myPopup article" style="margin: 10% auto">
            <div class="input-group">
                <a href="#close" title="Close" class="close">X</a>
                <label>Enter new Username: </label>
                <input type="text" id="username" value="<?php echo ($_SESSION['username']); ?>" required />
                <label>Enter new Email: </label>
                <input type="email" id="email" value="<?php echo ($_SESSION['placeofwork']); ?>" required />
                <label>Enter new Phone Number: </label>
                <input type="text" id="phoneNumber" value="<?php echo ($_SESSION['phonenumber']); ?>" required />

                <input type="button" onclick="updatePersonalDetails()" class="" value="Update">
            </div><br>
        </section>
        <!-- Car details -->
        <section id="carPopup" class="myPopup article" style="margin: 10% 50%">
            <div class="input-group">
                <a href="#close" title="Close" class="close">X</a>
                <label>Enter new Car type: </label>
                <input type="text" id="cartype" value="<?php echo ($_SESSION['cartype']); ?>" required />
                <label>Enter new Car Plate Number: </label>
                <input type="text" id="platenumber" value="<?php echo ($_SESSION['carplatenumber']); ?>" required />
                <input type="button" onclick="updateCarDetails()" class="" value="Update">
            </div><br>
        </section>
        <!-- Work details -->
        <section id="workPopup" class="myPopup article" style="margin: 25% auto">
            <div class="input-group">
                <a href="#close" title="Close" class="close">X</a>
                <label>Enter new work place: </label>
                <input type="text" id="workplace1" placeholder="work place " required />
                <label>Enter company/institution name: </label>
                <input type="text" id="company1" value="<?php echo ($_SESSION['placeofwork']); ?>" required />
                <input type="button" onclick="updatework()" class="" value="Update">
            </div><br>
        </section>
        <!-- Home Area -->
        <section id="homePopup" class="myPopup article" style="margin: 25% 50%">
            <div class="input-group">
                <a href="#close" title="Close" class="close">X</a>
                <label>Enter new home Area: </label>
                <input type="text" id="homearea1" placeholder="home area" required />
                <input type="button" onclick="updateHome()" class="" value="Update">
            </div><br>
        </section>
    </div>
    <!-- displaying values  -->
    <div class="profile">

        <div id="person"> </div>
        <header class="user_id" id="<?php echo ($_SESSION["id"]); ?>"></header>
        <header class=''> Personal Details</header>
        <div id="personal"> </div>
        <header class=''> Work details</header>
        <div id="work"> </div>
        <header class=''> Car details </header>
        <div id="car"> </div>

    </div>

    <div class="center ">
        <section class="archive">
            <a class="article cent"  href="#personalPopup">Update Personal Details</a>
            <a class="article cent"  href="#workPopup">Update work Area</a>
            <a class="article cent"  href="#homePopup">Update Home Area</a>
            <a class="article cent" href="#carPopup">Update Car Details</a>
        </section>

        <!-- on smaller screens -->
        <select onchange="if(this.value)window.location.href = this.value;">
            <option value="#personalPopup">Update Personal Details</option>
            <option value="#workPopup">Update Work Details</option>
            <option value="#homePopup">Update Home Area</option>
            <option value="#carPopup">Update Car Details</option>
        </select>
    </div>


    <script src="js/profile.js"></script>
</body>

</html>