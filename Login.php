<?php
session_start();
$MySQLdb = new PDO("mysql:host=127.0.0.1;dbname=Login", "root", "");
$MySQLdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header("content-type:application/json");
function hashpass($plainpass){
    $salt = "5861aacvt=*-.gsretg";
    return sha1($plainpass . $salt);
}
switch($_POST["action"]){
    case "login":

        $username = $_POST["username"];
        $hashpass= hashpass($_POST["password"]);
        $cursor = $MySQLdb->prepare("SELECT * FROM users WHERE username=:username");
        $cursor->execute( array(":username"=>$username) );
        if($row = $cursor->fetch()){
            
            if($username == $row["username"] && $row["password"] == $hashpass ){
                $_SESSION["username"] = $username;
                $_SESSION["id"] = $row["id"];
                echo '{"success":"true","data":"login successfully"}';
            }else{
                echo '{"success":"false","data":"login failed"}';
            }
        }else{
            echo '{"success":"false","data":"login failed"}';
        }
        

        break;


    case "register":
        
        $cursor = $MySQLdb->prepare("SELECT * FROM users WHERE username=:username");
        $cursor->execute( array(":username"=>$_POST["username"]) );
        if($cursor->rowCount()){
            echo '{"success":"false","data":"User already exists!!!"}';
        }else{
            $hashpass= hashpass($_POST["password"]);
            $cursor = $MySQLdb->prepare("INSERT INTO users (username, password,amount) value (:username,:password,:amount)");
            $cursor->execute(array(":username"=>$_POST["username"], ":password"=>$hashpass, ":amount"=>15000));
            echo '{"success":"true","data":"registerd successfully!!"}';
        }
        
        break;

        case "get_all":
        $cursor = $MySQLdb->prepare("SELECT username,id FROM users");
        $cursor->execute();
        echo json_encode($cursor->fetchAll());
        

        break;
        case "get_all_money":
            $cursor = $MySQLdb->prepare("SELECT * FROM money WHERE from_who=:username");
            $cursor->execute( array(":username"=>$_SESSION["username"]));
            echo json_encode($cursor->fetchAll());
        
        
        break;



        case "update_phone":
            $cursor = $MySQLdb->prepare("UPDATE users SET phone =:phone WHERE users.username = :username");
            $cursor->execute( array(":phone"=>$_POST["phone"],":username"=>$_SESSION["username"])); 
            echo '{"success":"true","data":"phone changed!"}';
        break;

        case "update_password":
            $hashpass= hashpass($_POST["password"]);
            $cursor = $MySQLdb->prepare("UPDATE users SET password =:password WHERE users.username = :username");
            $cursor->execute( array(":password"=>$hashpass,":username"=>$_SESSION["username"])); 
            echo '{"success":"true","data":"passwords changed!"}';
            break;

        case "update_email":
            $cursor = $MySQLdb->prepare("UPDATE users SET email =:email WHERE users.username = :username");
            $cursor->execute( array(":email"=>$_POST["email"],":username"=>$_SESSION["username"])); 
            echo '{"success":"true","data":"email changed!"}';
            break;

        case "update_lastname":
            $cursor = $MySQLdb->prepare("UPDATE users SET lastname =:lastname WHERE users.username = :username");
            $cursor->execute( array(":lastname"=>$_POST["lastname"],":username"=>$_SESSION["username"])); 
            echo '{"success":"true","data":"lastname changed!"}';
            break;

        case "update_address":
            $cursor = $MySQLdb->prepare("UPDATE users SET address =:address WHERE users.username = :username");
            $cursor->execute( array(":address"=>$_POST["address"],":username"=>$_SESSION["username"])); 
            echo '{"success":"true","data":"address changed!"}';
            break;
        

        
        
        case "money":
            $cursor = $MySQLdb->prepare("SELECT * FROM users WHERE username=:username");
            $cursor->execute( array(":username"=>$_SESSION["username"]));
            if($cursor->rowCount()){
                if($row = $cursor->fetch()){
                    $less = $row["amount"] - $_POST["amount"];
                    if($less < -1000){
                        echo '{"success":"false"}';
                    }
                    else{ $cursor = $MySQLdb->prepare("INSERT INTO money (from_who,sent_to,amount,date) value (:from_who,:sent_to,:amount,:date)");
                          $cursor->execute( array(":from_who"=>$_SESSION["username"],":sent_to"=>$_POST["sent_to"],":amount"=>$_POST["amount"],":date"=>$_POST["date"]));
                            echo '{"success":"true"}';
                    }
                }
            }
        
            break;
        
        case "transfer":
            $cursor = $MySQLdb->prepare("SELECT * FROM users WHERE username=:username");
            $cursor->execute( array(":username"=>$_SESSION["username"]));
            if($cursor->rowCount()){
                if($row = $cursor->fetch()){
                    $less = $row["amount"] - $_POST["amount"];
                    if($less < -1000){
                        echo '{"success":"false"}';
                    }
                    else{
                        $cursor = $MySQLdb->prepare("UPDATE users SET amount=:amount WHERE username=:username");
                        $cursor->execute( array(":amount"=>$less,":username"=>$_SESSION["username"])); 
                        $cursor = $MySQLdb->prepare("SELECT * FROM users WHERE username=:username");
                        $cursor->execute( array(":username"=>$_POST["sent_to"]));
                        if($cursor->rowCount()){
                            if($row = $cursor->fetch()){
                                $more = $row["amount"] + $_POST["amount"];
            
                                $cursor = $MySQLdb->prepare("UPDATE users SET amount=:amount WHERE username=:username");
                                $cursor->execute( array(":amount"=>$more,":username"=>$_POST["sent_to"])); 
                                $cursor = $MySQLdb->prepare("INSERT INTO money (from_who,sent_to,amount,date) value (:from_who,:sent_to,:amount,:date)");
                                $cursor->execute( array(":from_who"=>$_SESSION["username"],":sent_to"=>$_POST["sent_to"],":amount"=>$_POST["amount"],":date"=>$_POST["date"]));
                                echo '{"success":"true"}';
                            }
                        }else{
                            echo '{"success":"true"}';
                        }
                    }
                    
                    
                }
            }else{
                echo '{"success":"false"}';
            }
            //$cursor = $MySQLdb->prepare("SELECT * FROM users WHERE username=:username");
            //$cursor->execute( array(":username"=>$_POST["sent_to"]));
            //if($cursor->rowCount()){
                //if($row = $cursor->fetch()){
                    //$more = $row["amount"] + $_POST["amount"];

                    //$cursor = $MySQLdb->prepare("UPDATE users SET amount=:amount WHERE username=:username");
                    //$cursor->execute( array(":amount"=>$more,":username"=>$_POST["sent_to"])); 
                    
                //}
            //}else{
                //echo '{"success":"true"}';
            //}
            
            
            
            break;

        }
        

?>