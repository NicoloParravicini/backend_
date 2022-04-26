<?php
   $host = "172.17.0.1:3306";
   $user = "root";
   $pass = "my-secret-pw";
   $db = "mydb";
 
   $connessione = new mysqli($host, $user, $pass, $db);
  
   if($connessione-> connect_error){
       echo "Connessione falita".$connessione->connect_error;
   }
?>
