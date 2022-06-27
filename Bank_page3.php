<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mercantile Bank</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

</head>

<style>
body {
  background-color: hsla(60, 43%, 51%, 0.3);
}
#submit_btn:hover {
    background-color: rgb(255, 0, 0);
    color: white;
    }
#the_style{
  display: inline-block;

}
</style>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <h1 class="navbar-brand" >Mercantile Bank</h1>
        </div>
        <ul class="nav navbar-nav" style="float: right">
            <li><a href="Bank_page2.php" id="logout">info about the account</a></li>
            <li><a href="Bank_page4.php" id="logout">Profile</a></li>
            <li><a href="Bank.php" id="logout">Logout</a></li>
        </ul>
    </div>
</nav>

<h1 style="color:MediumSeablack;">Money transfer page </h1>


<div class="row" >
<div class="container">
          <div class="col-md-offset-3 col-md-6">		
    		 <div class="panel panel-default" id="the_style" >
                <div class="panel-heading">Money Transfer:</div>
                    <div class="panel-body" id="login-panel">
                      <div class="jumbotron">
                  
                   
               

      <div class="form-group">
      <label class="control-label col-sm-2" for="sent to">sent to:</label>
      <div class="col-sm-10">
      <input type="sent to" class="form-control" id="sent_to" placeholder="Enter sent to" name="sent to" style="width: 200px";>
      </div>
      <br>
      <br>
      <br>
      <div class="form-group">
      <label class="control-label col-sm-2" for="amount">Amount Money:</label>
      <div class="col-sm-10">
      <input type="amount" class="form-control" id="amount" placeholder="Enter amount" name="amount" style="width: 200px";>
      </div>
      <br>
      <br>
      <br>
      <div class="form-group">
      <label class="control-label col-sm-2" for="data">date:</label>
      <div class="col-sm-10">
      <input id="date" type="date" class="form-control" name="date" placeholder="Enter date" min="2021-01-01" max="2023-12-31" style="width: 200px";>
      </div>
      <br>
      <br>
      <br>
      <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
      <button id="submit_btn" type="submit" class="btn btn-default">Submit</button>
      <span id="MSG"></span>



      <script>
      $("#submit_btn").click(function(){
      $.post("Login.php",{"action":"money","username":$("#from_who").val(),"sent_to":$("#sent_to").val(),"date":$("#date").val(),"amount":$("#amount").val() },function(data){
        if(data.success == "true"){
           //$("#MSG").html('<div class="alert alert-success"><strong>Success:'+data.data+'</strong></div>').fadeIn().delay(9000).fadeOut();
           //setTimeout(function(){ window.location = "Bank_page2.php"; }, 2000);
        }else{
            $("#MSG").html('<div class="alert alert-danger"><strong>Error:'+data.data+'</strong></div>').fadeIn().delay(9000).fadeOut();
        }
        console.log("h")
       });
       $.post("Login.php",{"action":"transfer","sent_to":$("#sent_to").val(),"amount":$("#amount").val(),"date":$("#date").val() },function(data){
        if(data.success == "true"){
            $("#MSG").html('<div class="alert alert-success"><strong>The transfer was successful</strong></div>').fadeIn().delay(2000).fadeOut();
            
            setTimeout(function(){ window.location = "Bank_page2.php"; }, 2000);
            
            //alert("good");
           //setTimeout(function(){ window.location = "Bank_page2.php"; }, 2000);
        }else{
            //alert("not good")
            $("#MSG").html('<div class="alert alert-danger"><strong>Error:You have exceeded the frame!!</strong></div>').fadeIn().delay(2000).fadeOut();
            setTimeout(function(){ window.location = "Bank_page2.php"; }, 2000);
        }
        });
      });
      </script>
</body>
</html>



