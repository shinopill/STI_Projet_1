<<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Emails</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>
<body>
<?php
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n" . '</br>';
   }
  
   $query_email_user =<<<EOF
   SELECT * FROM  Messages WHERE destinataire like $username ;
EOF;

   
   $ret = $db->query($query_email_user);
   while($data = $ret->fetchArray(SQLITE3_ASSOC)){
    echo 'FROM : ' . $data['expediteur'] . '</br>';
    echo 'TO :' . $data['destinataire'] . '</br>';
    echo 'Message :' . $data['message'] . '</br>'; 
  }
  

<?>
  
</body>
</html>