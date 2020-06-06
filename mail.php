<?php
$text = "Trial and testing \n Please confirm";

$text = wordwrap($text,70);
$email = "brayomumo5@gmail.com";
mail($email,"Email trials", $text);
// if (mail($email,"Email trials", $text)){
    
// echo("Email sent to ". $email ." Successfully");
// }else{
//     echo("Email not sent");
// }

?>