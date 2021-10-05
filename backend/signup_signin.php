<?php
include "../lib/Database.php";
include "../lib/session.php";
session::init();
$db = new Database();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $error = array();
    if(isset($_POST['signup'])){
        $username = $db->link->real_escape_string(htmlentities(trim($_POST['username'])));
        $email = $db->link->real_escape_string(htmlentities(trim($_POST['email'])));
        $password = $db->link->real_escape_string(htmlentities(trim($_POST['password'])));

        //check for existance of username -start

        $sql_username_check = "SELECT * FROM tbl_users WHERE username = '{$username}'";
        $result_username_check = $db->select($sql_username_check);
        if($result_username_check){
            echo $error[] = "username already exists";die();
        }

        //check for existence of username -end

        if($username == "" OR $email == "" OR $password == ""){
           echo $error[] = "Fields must not be empty.";
        }else if(strlen($username) > 50 OR strlen($username) < 3){
            echo $error[] = "Username must not be more than 50 characters and less than 3 characters.";
        }else if(strlen($email) > 100 OR strlen($email) < 10){
            echo $error[] = "Email must not be more than 100 characters and less than 30 characters.";
        }else if(strlen($password) > 100 OR strlen($password) < 8){
            echo $error[] = "Password must not be more than 100 characters and less than 8 characters.";
        }else if(empty($username) OR empty($email) OR empty($password)){
            echo $error[] = "Fields must not be empty.";
        }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo $error[] = "Please enter a valid email address.";
        }else{
            $password = md5($password);
            $sql_insert = "INSERT INTO tbl_users(username,email,password) VALUES('{$username}','{$email}','{$password}')";
            $result_sql_insert = $db->insert($sql_insert);
            if($result_sql_insert){
               echo 1;
            }    
        }
    }
    if(isset($_POST['signin'])){
        $email = $db->link->real_escape_string(htmlentities(trim($_POST['email'])));
        $password = md5($db->link->real_escape_string(htmlentities(trim($_POST['password']))));
        if($email == "" OR $password == ""){
            echo $error[] = "Fields must not be empty.";
        }else if(empty($email) OR empty($password)){
            echo $error[] = "Fields must not be empty.";
        }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo $error[] = "Please enter a valid email address.";
        }else{
            $sql_check = "SELECT * FROM tbl_users WHERE email = '{$email}' AND password = '{$password}'";
            $result_sql_check = $db->select($sql_check);
            if($result_sql_check){
                $row_sql_check = $result_sql_check->fetch_assoc();
                $sql_update_online_status = "UPDATE tbl_users SET online_status = 1 WHERE id = {$row_sql_check['id']}";
                $db->update($sql_update_online_status);
                $sql_update_msg_status = "UPDATE tbl_messages SET msg_status = 2 WHERE to_user = {$row_sql_check['id']}";
                $db->update($sql_update_msg_status);
                session::set("username",$row_sql_check['username']);
                session::set("id",$row_sql_check['id']);
                session::set("email",$row_sql_check['email']);
                session::set("login","true");
                echo 1;
            }else{
                echo $error[] = "Please enter correct username and password";
            }    
        }
    }
}
?>