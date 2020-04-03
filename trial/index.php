<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hommie Ride</title>
</head>
<body>
    <?php
        include('navbar.php');
        ?>
        <h2> Welcome Sucker </h2>
        <form action="" method="POST">
            <input type="radio" name="radio" value="radio 1">Radio 1
            <input type="radio" name="radio" value="radio 1">Radio 2
            <input type="radio" name="radio" value="radio 1">Radio 3
            <input type="submit" name="submit" value="Get selected item">
        </form>
        <?php
            if(isset($_POST['submit'])){
                if(isset($_POST['radio'])){
                    echo "You have selected:  ".$_POST['radio'];
                }
            }
        ?>
</body>
</html>