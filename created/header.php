
<?php 
if((isset($_COOKIE['teacher_id'])) && (!empty($_COOKIE['teacher_id']))){

}else{
    header("Location: ../index.php");
    exit();
}

include_once('../includes/dbcon.php');
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>E-Portfolio System</title>
    <link rel="apple-touch-icon" href="../assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendors/css/charts/chartist.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/app-lite.css">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/pages/dashboard-ecommerce.css">
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/inputmask.css"> -->
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->

    <script src="../assets/js/jquery3.0.js" type="text/javascript"></script>

    <!-- END Custom CSS-->

    <style>
    /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-contentdelete {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 25%; /* Could be more or less, depending on screen size */
  left:30%;
}

.modal-contentadd {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 25%; /* Could be more or less, depending on screen size */
  left:30%;
}

.modal-contentblank {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 25%; /* Could be more or less, depending on screen size */
  left:30%;
}
.modal-contentdeletesuccess {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 25%; /* Could be more or less, depending on screen size */
  left:30%;
}

.modal-contentedit {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 25%; /* Could be more or less, depending on screen size */
  left:30%;
}

.modal-contenteditsuccess {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 25%; /* Could be more or less, depending on screen size */
  left:30%;
}

/* The Close Button */
.closeblank {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closeblank:hover,
.closeblank:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.closeadd {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closeadd:hover,
.closeadd:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.closedelete {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closedelete:hover,
.closedelete:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.closedeletesuccess {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closedeletesuccess:hover,
.closedeletesuccess:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.closeedit {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closeedit:hover,
.closeedit:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.closeeditsuccess{
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closeeditsuccess:hover,
.closeeditsuccess:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>

  </head>
  
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">