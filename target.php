<?php
    session_start();
?>

<!DOCTYPE html>

<html>
   <head>
       <title>Target</title>
       <meta charset="utf-8" />
   </head>
   <body>
<?php

if (!empty($_POST)) {
    if (isset($_POST['email'])) {
        if($_POST['password'] == "toto") {
            $_SESSION['email'] = strip_tags($_POST['email']);
        }
    }
}

if(isset($_SESSION['email']) AND $_POST['password'] == "toto") {
    echo 'Welcome !</br>';
    echo 'email address: ' . $_SESSION['email'] . '<br/>';
}

else {
    header("Location: http://localhost/sti_projet_1/registration.php");
}

?>
   
   <a href="logout.php">Logout</a>
    
   </body>
</html>