<!DOCTYPE html>

<html>
   <head>
       <title>Target</title>
       <meta charset="utf-8" />
   </head>
   <body>
   <?php
   if (isset($_POST['firstname']) AND isset($_POST['lastname']) AND isset($_POST['email'])) {
    echo 'firstname: '     . strip_tags($_POST['firstname']) . '<br/>';
    echo 'lastname: '      . strip_tags($_POST['lastname'])  . '<br/>';
    echo 'email address: ' . strip_tags($_POST['email'])     . '<br/>';
   }
   else {
        echo 'Fields not filled';
   }
   ?>
   
   </body>
</html>