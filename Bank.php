<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Welcome </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
<style>
body {
    background-color: #bbbbbb; 
}</style>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Hello</a>
    </div>
 
</nav>
    <style>
       h1 {
        text-shadow: 2px 2px;
        }
    </style>
  <div class="container">
     <div class="row">
	  <div class="col-md-offset-3 col-md-6">
	     <h1 class="jumbotron" >Welcome</h1>
         <style>h1 {color: white;
            text-shadow: 3px 3px 2px black, 0 0 35px green, 0 0 10px darkblue;} </style>
		 </div>
		</div>
        <div class="row">
          <div class="col-md-offset-3 col-md-6">		
    		 <div class="panel panel-default">
                <div class="panel-heading">Login:</div>
			   
                
                <div class="panel-body" id="login-panel">
				        <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="l_username" type="text" class="form-control" name="username" placeholder="username">
                    </div>
                    <br>
                        <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="l_password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <br>
                <button id="btn_l" type="submit" class="btn btn-primary btn-block">login</button>
                    <a href="#" id="register"><i class="glyphicon glyphicon-info-sigh"></i>register</a>
                  
         </div>

        
        <div class="panel-body" id="register-panel" hidden>
                        <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="r_username" type="text" class="form-control" name="username" placeholder="username">
                    </div>
                    <br>
                        <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="r_password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <br>
                <button id="btn_r" type="submit" class="btn btn-primary btn-block">register</button>
                    <a href="#" id="login"><i class="glyphicon glyphicon-info-sign"></i>login</a>
        </div>
    </div>
</div>
</div>
</div>
<span style="float:left;width:500px;margin-top:100px;margin-left:50px;" id="MSG"></span>
<script>
$("#register").click(function () {
    $("#login-panel").fadeOut(1000);
    $("#register-panel").delay(1000).fadeIn(1000);
});

$("#login").click(function () {
    $("#register-panel").fadeOut(1000);
    $("#login-panel").delay(1000).fadeIn(1000);
});

$("#btn_r").click(function(){
    $.post("Login.php",{"action":"register","username":$("#r_username").val(),"password":$("#r_password").val()},function(data){
        if(data.success == "true"){
            $("#MSG").html('<div class="alert alert-success"><strong>Success:'+data.data+'</strong></div>').fadeIn().delay(2000).fadeOut();
        }else{
            $("#MSG").html('<div class="alert alert-danger"><strong>Error:'+data.data+'</strong></div>').fadeIn().delay(2000).fadeOut();
        }
    });
   
});

$("#btn_l").click(function(){
    $.post("Login.php",{"action":"login","username":$("#l_username").val(),"password":$("#l_password").val()},function(data){
        console.log($("#l_username").val());
        if(data.success == "true"){
            $("#MSG").html('<div class="alert alert-success"><strong>Success:'+data.data+'</strong></div>').fadeIn().delay(2000).fadeOut();
            
            setTimeout(function(){ window.location = "Bank_page2.php"; }, 1000);
        }else{
            $("#MSG").html('<div class="alert alert-danger"><strong>Error:'+data.data+'</strong></div>').fadeIn().delay(2000).fadeOut();
        }
    });
    
});

</script>
</body>
</html>