<!DOCTYPE html>

<html>
   <head>
       <title>Target</title>
       <meta charset="utf-8" />
   </head>
   <body>
   <?php
  
   if (isset($_POST['email']) AND isset($_POST['password'])) {
    echo 'email address: ' . strip_tags($_POST['email'])     . '<br/>';
    echo 'password: '      . strip_tags($_POST['password']) . '<br/>';
   }
   else {
        echo 'Fields not filled';
   }
   ?>

   
   <?php
  //https://stackoverflow.com/questions/16728265/how-do-i-connect-to-an-sqlite-database-with-php

  class MyDB extends SQLite3 {
    function __construct() {
      $this->open('./database.sqlite');
    }
  }
  $db = new MyDB();
  /*if(!$db) {
     echo $db->lastErrorMsg();
  } else {
     echo "Opened database successfully\n" . '</br>';
  }*/

  $username = strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']); 

  $query_verify_login = <<<EOF
  SELECT hashedPassword FROM Users WHERE username like '$username';
EOF;

  $ret = $db->query($query_verify_login);

  /*$query_insert_user =<<<EOF
   INSERT INTO Users (username, passwrd) VALUES ($username, $password);
EOF;*/


/*$query_email_username =<<<EOF
SELECT * FROM  Messages WHERE destinataire like $username ;
EOF;*/

/*$query_insert_email =<<<EOF
INSERT INTO Messages (expediteur, destinataire,message) VALUES ('toto', $username,'HELLLLOOOOOO');
EOF;*/
/*
  $db->exec($query);
  $ret =  $db->query($query2);
*/
/*
  $query_email_user =<<<EOF
  SELECT * FROM  Messages WHERE destinataire like $username ;
EOF;

  $query_insert_email =<<<EOF
  INSERT INTO Messages (expediteur, destinataire,message) VALUES ('toto', $username,'HELLLLOOOOOO');
EOF;

  $db->exec($query_insert_user);
  $db->exec($query_insert_email);
  $ret =  $db->query($query_email_user);
*/

  $data = $ret->fetchArray(SQLITE3_ASSOC);

  if($password === $data['hashedPassword'] ) {
    echo '<br/> YES';
  }
  else {
    header("Location: login.php");
  }

  ?>
   </body>
</html>