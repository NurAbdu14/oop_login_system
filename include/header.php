<?php
session_start();
$current_url = $_SERVER['SERVER_NAME']."".$_SERVER['REQUEST_URI'];
// echo $current_url;
include("include/user.php");
$user = new User()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Login</title>
    <link rel="stylesheet" href="http://localhost/user/bootstrap/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>
<?php 

if(strpos($current_url,"activation.php")===false){
    include("include/nav.php");
}
 
?>