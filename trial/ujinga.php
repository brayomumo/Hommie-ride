<?php
    $names = ["brian", "mumo", "Maryliz", "Paul"];

    $daysofweek = ["Monday", "Tuesday", "wednesday", "Thursday"];
   
    $driver = array_combine( $names,  $daysofweek);
    print_r($driver);
    $rand = array_rand($daysofweek, 4);
    echo $names[$rand[0]];
    
    $nums = [1,2,3,4,5,6];
    foreach($nums as $num){
      $kino = $num** 2;
      echo "\n",$kino,"\n";
    }
    

?>