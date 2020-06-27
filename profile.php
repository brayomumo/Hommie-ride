<?php require("auth.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/group.css" />
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
     <a style="text-align: right !important;" href="#openPopup">Update Profile</a>
    <div id="openPopup" class="myPopup" >
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h1>Update Profile</h1>
            <div class="updateform">
                <form id="updateProfile">
                    <div class="archive">
                        <div class="article" style=" background:none !important;"><br>
                            <div class="input-group">
                                <label>Username</label>
                                <input type="text" id="username" placeholder="Username" value="" required />
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
                        <div class="article" style=" background:none !important;"> <br>
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
            </div>
        </div>
    </div>
    <div class="profile">
       
            <div id="person"> </div>
                <header class="user_id" id="<?php echo ($_SESSION["id"]); ?>"></header>
            <header> Personal Details</header>
                <div  id="personal"> </div>
            <header> Work details</header>
                <div  id="work"> </div>
            <header> Car details </header>
                <div  id="car"> </div>
       
    </div>

   

    <script src="js/profile.js"></script>
</body>

</html>