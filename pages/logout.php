<?php 

$sid = $_COOKIE["teacher_id"];
setcookie('teacher_id', $sid, time() - 3600,'/');

header("Location: ../") 

 ?>