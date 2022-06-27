<?php
session_start();	
	
if(!isset($_SESSION["username"])){
    header("location:Bank.php");
}

if (isset($_SESSION["username"])){
    $MySQLdb = new PDO("mysql:host=127.0.0.1;dbname=Login", "root", "");
    $MySQLdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cursor = $MySQLdb->prepare("SELECT * FROM users WHERE username=:username");
    $cursor->execute( array(":username"=>$_SESSION["username"]) );
    if($cursor->rowCount()){

      $row = $cursor->fetch();
      $_SESSION["amount"] = $row["amount"];
}        
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mercantile Bank</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    
    

</head>
<body>


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Mercantile Bank</a>
        </div>
        <ul class="nav navbar-nav" style="float: right">
            <li><a href="Bank_page4.php" id="profile">Profile</a></li>
            <li><a href="Bank.php" id="logout">Logout</a></li>
        </ul>
    </div>
</nav>
  <style>
   

    img{
        margin-top: 10px;
        margin-left:30px;
        width:30%;
        height:30%;
        border-radius: 60px;
    }
    
    #btn{
        margin-top: 1px;        
        margin-left:1000px;
        height: 30%;
        width:30%;
        border-radius: 30px;
        font-size: 30px;    
    }
    #btn:hover {
    background-color: #4CAF50;
    color: white;
    }
  table, th, td {
    border: 2px solid black;
  }
  table {
    border-spacing: 20px;
  }
  </style>

  <style>
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
  th, td {
    padding: 5px;
    text-align: left;
  }
  </style>

  </head>
  <style>
  body {
    background-color: hsla(89, 43%, 51%, 0.3);
  }
  h1 {
    color: white;
    text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
  }
  </style>
 
  <body>
  
  <h1>Hello <?php echo $_SESSION["username"]; ?></h1>
  
 

  <br></br>
  <h3>info about the account:</h3>
  <style>h3 {text-shadow: 2px 2px 5px black;} </style>

  <br></br>

  <h2>Current account status: <?php echo $_SESSION["amount"]; ?></h2>  

  <br></br>
<style>
  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<table  id="cash">
  <tr >
    <th>date</th>
    <th>from who</th>
    <th>amount</th>
  </tr>
  
</table>

<script>
 $.post("Login.php",{"action":"get_all_money"},function(data){
        console.log(data);

        for(let i=0; i<data.length; i++){
          console.log(data[i].username);
            $("#cash").append('<tr>'+'<th>'+data[i].date+'</th>'+'<th>'+data[i].sent_to+'</th>'+'<th>'+data[i].amount+'</th>'+'</tr>'+'<br>');
        }
    });
    $.post("Login.php",{"action":"money"},function(data){
        console.log(data);
        for(let i=0; i<data.length; i++){
            $("#cash").append('<tr><td>'+data[i].date+'</td><th>'+data[i].sent_to+'</th>'+'<th>'+data[i].amount+'</th>'+'</tr>'+'<br>');
        }
    });


</script>

<br>
<br>
<br>




 <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
  <script>
    var xValues = ["January", "February", "March", "April", "May"];
    var yValues = [55, 49, 44, 24, 15];
    var barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#1e7145"
    ];

    new Chart("myChart", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      title: {
        display: true,
        text: "Expenses by months"
      }
    }
    });
    </script>
    <div>
    <img src="https://finance.psagot.co.il/wp-content/uploads/2019/06/%D7%90%D7%99%D7%AA%D7%95%D7%A8-%D7%9B%D7%A1%D7%A3-%D7%90%D7%91%D7%95%D7%93.jpg" style="float:right">
    <br>
    <button id="btn" type="submit" >Move to transfer page</button>
    
    <script>
    $("#btn").click(function(){
      location.href = "Bank_page3.php";

    });
    </script>
    
    </div>

  <table style="width:25%">
    <h4>Monthly savings:</h4>
    <tr>
      <th>Month</th>
      <th>Savings</th>
    </tr>
    <tr>
      <td>January</td>
      <td>$100</td>
    </tr>
    <tr>
      <td>February</td>
      <td>$600</td>
    </tr>
    <tr>
      <td>March</td>
      <td>$500</td>
    </tr>
    <tr>
      <td>April</td>
      <td>$50</td>
    </tr>
    <tr>
      <td>May</td>
      <td>$700</td>
    </tr>
  </table>

</body>
</html>
