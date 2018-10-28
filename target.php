 <?php
  session_start();
 
  if(!isset($_SESSION["username"])){
     if ((!isset($_POST['username']) OR !isset($_POST['password']))) {
     header("Location: login.php");
    }
  }

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

  $username = strip_tags($_POST['username']);
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
    /*session is started if you don't write this line can't use $_Session  global variable*/
    $_SESSION["username"]=$username;
  }
  else {
    header("Location: login.php");
  }

?>
 <html>
   <head>
       <title> Menu</title>
       <meta charset="utf-8" />
   </head>
   <body>
		<h1>
			<br />
		</h1>
		
		<form action="seeEmail.php" method="post">
                <input type="submit" value="see your mails"/>
     </form>
		<form action="sendEmail.php" method="post">
                <input type="submit" value="Write mails"/>
   </form>
		<form action="changePassword.php" method="post">
                <input type="submit" value="Change your password"/>
     </form>
		
   </body>
</html>