<?php 

$sid = $_COOKIE["admin_id"];
setcookie('admin_id', $sid, time() - 3600,'/');

header("Location: ../") 

 ?>