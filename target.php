 <?php
  session_start();

  if(isset($_SESSION["username"]) and $_SESSION["level"] == 1){
    header("Location: target2.php");
  }


  if(!isset($_SESSION["username"]) or $_SESSION["active"] == 0){
     if ((!isset($_POST['username']) OR !isset($_POST['password']))) {
      header("Location: login.php");
    }
    
   

  //https://stackoverflow.com/questions/16728265/how-do-i-connect-to-an-sqlite-database-with-php

  class MyDB extends SQLite3 {
    function __construct() {
      $this->open('./database.sqlite');
    }
  }
  $db = new MyDB();

  $username = strip_tags($_POST['username']);
  $password = strip_tags($_POST['password']); 

  $query_verify_login = <<<EOF
  SELECT hashedPassword,active,permissionLevel FROM Users WHERE username like '$username';
EOF;
 
  $ret = $db->query($query_verify_login);

  $data = $ret->fetchArray(SQLITE3_ASSOC);

  if($password === $data['hashedPassword'] ) {
    /*session is started if you don't write this line can't use $_Session  global variable*/
    $_SESSION["username"]=$username;
    $_SESSION["level"]=$data["permissionLevel"];
    $_SESSION["active"]=$data["active"];
    if( $_SESSION["level"] == 1){
      header("Location: target2.php");
    }
    if($_SESSION["active"]  == 0){
       header("Location: login.php");
    }
  }
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