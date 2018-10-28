<?php
  session_start();
  if(!isset($_SESSION['username'])) {
    header("Location: login.php");
  }
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Change password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>



<body>


  	<form action="changePassword.php" method="post">
                Old Password <input type="password" name="old_password"/><br/>
                New Password <input type="password" name="new_password"/> <br/>
                <input type="submit" value="Change password"/>
		</form>

    	<form action="target.php" method="post">
                <input type="submit" name ="getBack" value="Back to menu"/>
		</form>

<?php



if(isset($_POST['old_password']) and isset($_POST['new_password'])){

  class MyDB extends SQLite3 {
    function __construct() {
      $this->open('./database.sqlite');
    }
  }

   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n" . '</br>';
   }
   $newpassword = $_POST["new_password"];
   $user = $_SESSION["username"];
   echo $user;
   $query_password_user =<<<EOF
   UPDATE Users SET hashedPassword = '$newpassword' WHERE username like '$user' ;
EOF;

   $query_verify_login = <<<EOF
  SELECT hashedPassword FROM Users WHERE username LIKE '$user';
EOF;
  
$ret = $db->query($query_verify_login);



$data = $ret->fetchArray(SQLITE3_ASSOC);
echo  $data['hashedPassword'];
if($_POST["old_password"] === $data['hashedPassword'] ) {
  /*session is started if you don't write this line can't use $_Session  global variable*/
  $db->exec($query_password_user);
  echo "Password changed";
} else {
  echo "Wrong inputs ";
}
}

?>

</body>
</html>