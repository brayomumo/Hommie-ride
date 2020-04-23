<?php require("auth.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/style1.css" /> -->
    <link href="css/profile.css" rel="stylesheet" type="TEXT/CSS">
    <script src="js/jquery.js"></script>
    <title><?php echo ($_SESSION["username"]); ?></title>
</head>

<body>

    <?php
    include("navbar.php");
    // print_r($_SESSION);
    include("db.php");
    ?>
    <div class="container column side">
    </div>
    <div class="profile">
        <div class='card column content'>
            <div id="person"></div>
            <h3 class="user_id" id="<?php echo ($_SESSION["id"]); ?>"></h3>
            <header> Personal Details</header>
            <div id="personal"></div>
            <header> Work details</header>
            <div id="work"></div>
            <header> Car details </header>
            <div id="car"></div>
        </div>
    </div>
    <a href="#openPopup">Update Profile</a>
    <div id="openPopup" class="myPopup">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h1>Update Profile</h1>
            <div class="updateform">
                <form id="updateProfile">
                    <div class="row">
                        <div class="column"><br>
                            <div class="input-group">
                                <label>Username</label>
                                <input type="text" id="username" placeholder="Username"  value ="" required />
                            </div><br>
                            <div class="input-group">
                                <label>First Name</label>
                                <input type="text" id="firstname" placeholder="first name" required />
                            </div><br>
                            <div class="input-group">
                                <label>Last Name</label>
                                <input type="text" id="lastname" placeholder="last name" required />
                            </div><br>
                            <div class="input-group">
                                <label>Phone number</label>
                                <input type="tel" id="phonenumber" placeholder="phone number" required />
                            </div><br>
                            <div class="input-group">
                                <label>Email</label>
                                <input type="email" id="email" placeholder="Email" required />
                            </div>
                            <br>
                            <div class="input-group">
                                <label>Password</label>
                                <input type="password" id="password" placeholder="Password" required />
                            </div>
                        </div>
                        <div class="column"> <br>
                            <div class="input-group">
                                <label>Company/Institution</label>
                                <input type="text" id="placeofwork" placeholder="company/institution" required />
                            </div><br>
                            <div class="input-group">
                                <label>Work Area</label>
                                <input type="text" id="workarea" placeholder="work Area" required />
                            </div><br>
                            <div class="input-group">
                                <label>Home Area</label>
                                <input type="text" id="homearea" placeholder="home Area" required />
                            </div><br>
                            <div class="input-group">
                                <label>Licence Number</label>
                                <input type="text" id="licencenumber" placeholder="Licence Number" required />
                            </div><br>
                            <div class="input-group">
                                <label>Car type</label>
                                <input type="text" id="cartype" placeholder="car Type" required />
                            </div><br>
                            <div class="input-group">
                                <label>Car plate number</label>
                                <input type="text" id="carplatenumber" placeholder="car plate Number" required />
                            </div>
                            <div class="input-group">
                                <input type="button" name="update" onclick="updateProfile()" value="Update Details">
                            </div>
                        </div>
                    </div>
                </form>
                <!-- <form name="update" action="" method="post">
            <div class="input-group">
                <label>Username</label><br> 
                <input type="text" name="username" placeholder="Username" required />
            </div>
            <div class="input-group">
                <label>Email</label><br>
                <input type="email" name="email" placeholder="Email" required />
            </div>
            <div class="input-group">
                <label>Password</label><br>
                <input type="password" name="password" placeholder="Password" required />
            </div>
            <div class="input-group">
                <label>Licence Number</label><br>
                <input type="text" name="LicenceNumber" placeholder="Licence Number" required />
            </div>
            <div class="input-group">
                <label>First Name</label><br>
                <input type="text" name="firstname" placeholder="first name" required />
            </div>
            <div class="input-group">
                <label>Last Name</label><br>
                <input type="text" name="lastname" placeholder="last name" required />
            </div>
            <div class="input-group">
                <label>Phone number</label><br>
                <input type="tel" name="phone" placeholder="phone number" required />
            </div>
            <div class="input-group">
                <label>Company/Institution</label><br>
                <input type="text" name="place" placeholder="company/institution" required />
            </div>
            <div class="input-group">
                <label>Work Area</label><br>
                <input type="text" name="workArea" placeholder="work Area" required />
            </div>
            <div class="input-group">
                <label>Home Area</label><br>
                <input type="text" name="homeArea" placeholder="home Area" required />
            </div>
            <div class="input-group">
                <label>Car type</label><br>
                <input type="text" name="carType" placeholder="car Type" required />
            </div>
            <div class="input-group">
                <label>Car plate number</label><br>
                <input type="text" name="plateNumber" placeholder="car plate Number" required />
            </div>
            <div class="input-group">
                <input type="button" name="update" value="Update Details">
            </div>
        </form> -->
            </div>
        </div>
    </div>

    <script src="js/profile.js"></script>
</body>

</html>