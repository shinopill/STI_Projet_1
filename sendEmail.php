<?php
session_start();
if(!isset($_SESSION['username']) or $_SESSION("active") === 0) {
  header("Location: login.php");
}
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Message to send</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>
<body>

	<form action ="sendEmail.php" method="post">
				To <input type="text" name="to"/>            <br/>
        Subject <input type="text" name="object"/>     <br/>
         <textarea type="text" name="email_text"></textarea>
         <br/>
       <input type="submit" value="Register"/>
	</form>
  
  <form action="target.php" method="post">
                <input type="submit" name ="getBack" value="Back to menu"/>
		</form>

 <?php

  if(isset($_POST['to']) and isset($_POST['object']) and isset($_POST["email_text"])) {

  class MyDB extends SQLite3 {
    function __construct() {
      $this->open('./database.sqlite');
    }
  }

  $username=$_SESSION["username"];
  $to = $_POST['to'];
  $object = $_POST['object'];
  $email_text = $_POST["email_text"];
  $now = date('Y-m-d H:i:s');

   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n" . '</br>';
   }

   $query_insert_email =<<<EOF
   INSERT INTO Messages (sender,recipient,subject,message,timeDate) VALUES ('$to','$username','$object','$email_text','$now');
EOF;


  $db->exec($query_insert_email);
   echo "Email send ";
  }
  ?>
</body>
</html>