<!DOCTYPE html>

<html>
   <head>
       <title>Target</title>
       <meta charset="utf-8" />
   </head>
   <body>
   <?php
  
   if (isset($_POST['firstname']) AND isset($_POST['lastname']) AND isset($_POST['email']) AND isset($_POST['password1'])) {
    echo 'firstname: '     . strip_tags($_POST['firstname']) . '<br/>';
    echo 'lastname: '      . strip_tags($_POST['lastname'])  . '<br/>';
    echo 'email address: ' . strip_tags($_POST['email'])     . '<br/>';
    echo 'password: ' . strip_tags($_POST['password1'])     . '<br/>';
   }
   else {
        echo 'Fields not filled';
   }
   ?>

   
   <?php
  //https://stackoverflow.com/questions/16728265/how-do-i-connect-to-an-sqlite-database-with-php

  class MyDB extends SQLite3 {
    function __construct() {
      $this->open('database.sqlite');
    }
  }
  $db = new MyDB();
  if(!$db) {
     echo $db->lastErrorMsg();
  } else {
     echo "Opened database successfully\n";
  }

  $username = $_POST['firstname'];
  $password = $_POST['password1'];
  
   $query_insert_user =<<<EOF
   INSERT INTO Users (username, passwrd) VALUES ($username, $password);
EOF;


$query_email_username =<<<EOF
SELECT * FROM  Messages WHERE destinataire like $username ;
EOF;

$query_insert_email =<<<EOF
INSERT INTO Messages (expediteur, destinataire,message) VALUES ('toto', $username,'HELLLLOOOOOO');
EOF;

  $db->exec($query);
  $db->exec($query3);
  $ret =  $db->query($query2);

  while($data = $ret->fetchArray(SQLITE3_ASSOC)){
    echo 'FROM : ' . $data['expediteur'] . '</br>';
    echo 'TO :' . $data['destinataire'] . '</br>';
    echo 'Message :' . $data['message'] . '</br>'; 
  }
  
  ?>
   </body>
</html>