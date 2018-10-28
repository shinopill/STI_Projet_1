<!DOCTYPE html>
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
  session_start();
  if(!isset($_SESSION['username'])) {
    header("Location: login.php");
  }
?>

<?php

  $emailsPerPage = 5;

  if(isset($_GET['page'])) {
    $page = $_GET['page'];
  }
  else {
    $page = 1;
  }

  $startFrom = ($page-1) * $emailsPerPage;

  class MyDB extends SQLite3 {
    function __construct() {
      $this->open('./database.sqlite');
    }
  }

   $db = new MyDB();
   $username = $_SESSION['username'];
   $query_email_user =<<<EOF
   SELECT rowid, * FROM  Messages WHERE emailTo like '$username' LIMIT '$startFrom', '$emailsPerPage';
EOF;

   $ret = $db->query($query_email_user);
  
   while($data = $ret->fetchArray(SQLITE3_ASSOC)){
    $id = $data['rowid'];
    echo 'FROM : ' . $data['emailFrom'] . '</br>';
    echo 'TO : ' . $data['emailTo'] . '</br>';
    echo 'Timestamp : ' . $data['timeDate'] . '</br>';
    echo 'Subject : ' . $data['subject'] . '</br></br>'; 
  } 
  
  // Pagination (10 emails per page)
  $query_count_rows =<<<EOF
  SELECT COUNT(*) as count FROM Messages WHERE emailTo like '$username';
EOF;
  $totalRows = $db->query($query_count_rows);
  $totalRows = $totalRows->fetchArray(SQLITE3_ASSOC);
  $totalRows = $totalRows['count'];
  $totalPages = ceil($totalRows / $emailsPerPage);
  $pageLink = "<div class='pagination'>";
  for($i = 1; $i <= $totalPages; $i++) {
    $pageLink .= "<a href='seeEmail.php?page=" . $i . "'> " . $i . " </a>";
  }
  echo $pageLink . "</div>";
 
?>
  
</body>
</html>