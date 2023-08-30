<?php
// error_reporting(0);
  include('connection.php');
 
  session_destroy();
  header('Location: index.php');
?>