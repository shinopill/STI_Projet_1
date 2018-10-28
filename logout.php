<?php
session_start();
session_destroy();
header('Location: http://localhost/sti_projet_1/login.php');
?>