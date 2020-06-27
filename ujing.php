<!-- <?php  ?>
<html>

<head>
    <title>jQuery AJAX POST Example</title>
    <style>
        body {
            font-family: "Arial Black", Gadget, sans-serif;
        }

        #container {
            text-align: center;
        }

        #container table {
            margin: 0 auto;
            text-align: left;
        }

        .btn {
            background-color: #008CBA;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type='text'],
        input[type='email'] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .success,
        .error {
            width: 20%;
            border: 1px solid;
            margin: 10px 0px;
            padding: 15px 10px 15px 50px;
            background-repeat: no-repeat;
            background-position: 10px center;
            display: inline-block;
        }

        .success {
            color: #4F8A10;
            background-color: #DFF2BF;
        }

        .error {
            color: #D8000C;
            background-color: #FFBABA;
        }
    </style>
</head>

<body>
    <div id="container">
        <h3>jQuery AJAX Post method example with php and MySQL</h3>
        <p><strong>Please fill in the form and click save.</strong></p>
        <div id="message"></div>
        <form name="postNews" action="" method="post">
            <div class="input-group">
                <label>Post</label><br>
                <input type="text" name="post" id="news" placeholder="Type here ...." required><br>
                <button onclick="sukuma()" >Post</button>
                <input type="submit" onclick="sukuma()" name="postNews" value="Post">
            </div>
        </form>
    </div>
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
        function sukuma() {
            var post = $("#news").val();
            console.log(post)
            $.ajax({
                method: "POST",
                url: "ujingaa.php",
                data: {
                    "post": post
                },
                success: function(response) {
                    console.log(response);

                }
            })
        };
    </script>
</body>

</html> -->
<?php
    function deleteAccount($id){
        include("db.php");
        // delete group
        $query = "DELETE FROM  user_group where user_id = '$id'";
        $q = mysqli_query($con,$query) or die(mysqli_error($con));
        if($q){
            $query = "DELETE FROM  trips where driver_id = '$id'";
            $q = mysqli_query($con,$query) or die(mysqli_error($con));
            if($q){
                $query = "DELETE FROM  ridealongs where user_id = '$id'";
                $q = mysqli_query($con,$query) or die(mysqli_error($con));
                if($q){
                    $query = "DELETE FROM  users where user_id = '$id'";
                    $q = mysqli_query($con,$query) or die(mysqli_error($con));
                    if($q){
                        return "Account deleted successfully";
                    }
                }
            }
        }
        // delete trip
        // delete user
        
        
    }
    echo (deleteAccount(22));
?>