<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Personal profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <h1 class="navbar-brand" >Personal profile:</h1>
        </div>
        <ul class="nav navbar-nav" style="float: right">
            <li><a href="Bank_page2.php" id="logout">info about the account</a></li>
            <li><a href="Bank_page3.php" id="logout">Money transfer page</a></li>
            <li><a href="Bank.php" id="logout">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="row">
          <div class="col-md-offset-3 col-md-6">		
    		 <div class="panel panel-default">
                <div class="panel-heading">Personal Information:</div>
                    <div class="panel-body" id="login-panel">
        <div class="input-group">
         Phone: <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="phone" type="text" class="form-control" name="phone" placeholder="phone_number">
        <button id="phone_btn" type="submit" class="btn btn-primary btn-block">Update phone</button>
        </div>
        <br>
        <br>
    <div class="input-group">
        Email: <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="email" type="text" class="form-control" name="email" placeholder="email">
        <button id="email_btn" type="submit" class="btn btn-primary btn-block">Update email</button>
        </div>
                                
        <br>
        <br>
    <div class="input-group">
        Address:<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="address" type="text" class="form-control" name="address" placeholder="address">
        <button id="address_btn" type="submit" class="btn btn-primary btn-block">Update address</button>
        </div>
        <br>
        <br>
    <div class="input-group">
        Password:<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="password" type="password" class="form-control" name="password" placeholder="password">
        <button id="password_btn" type="submit" class="btn btn-primary btn-block">Update password</button>
        </div>
        <br>
        <br>
    <div class="input-group">
        Lastname:<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="lastname" type="text" class="form-control" name="lastname" placeholder="lastname">
        <button id="lastname_btn" type="submit" class="btn btn-primary btn-block">Update lastname</button>
        </div>
        <br>
    <style>
        body {
            background-color: hsla(89, 43%, 51%, 0.3);
        }
    </style>
    <span style="float:left;width:500px;margin-top:100px;margin-left:50px;" id="MSG"></span>
    <span id="login"></span>

    <script>
    $("#email_btn").click(function(){
        $.post("Login.php",{"action":"update_email","email":$("#email").val()},function(data){
            console.log(data);
            $("#MSG").html('<div class="alert alert-success"><strong>Your email has been updated</strong></div>').fadeIn().delay(2000).fadeOut();
            
            
          
        });
    });
    $("#phone_btn").click(function(){
        $.post("Login.php",{"action":"update_phone","phone":$("#phone").val()},function(data){
            console.log(data);
            $("#MSG").html('<div class="alert alert-success"><strong>Your phone number has been updated</strong></div>').fadeIn().delay(2000).fadeOut();
            
        });
    });
    $("#password_btn").click(function(){
        $.post("Login.php",{"action":"update_password","password":$("#password").val()},function(data){
            console.log(data);
            $("#MSG").html('<div class="alert alert-success"><strong>Your password has been updated</strong></div>').fadeIn().delay(2000).fadeOut();
        });
    });
    $("#lastname_btn").click(function(){
        $.post("Login.php",{"action":"update_lastname","lastname":$("#lastname").val()},function(data){
            console.log(data);
            $("#MSG").html('<div class="alert alert-success"><strong>Your last name has been updated</strong></div>').fadeIn().delay(2000).fadeOut();
        });
    });
    $("#address_btn").click(function(){
        $.post("Login.php",{"action":"update_address","address":$("#address").val()},function(data){
            console.log(data);
            $("#MSG").html('<div class="alert alert-success"><strong>Your address has been updated</strong></div>').fadeIn().delay(2000).fadeOut();
        });
    });

</script>
</body>
</html>
