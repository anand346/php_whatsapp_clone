<?php
include "../lib/Database.php";
include "../lib/session.php";
$db = new Database();
$error = array();
if($_SERVER['REQUEST_METHOD'] == "GET"){
    $user_id = $db->link->real_escape_string(htmlentities($_GET['id']));
    $sql_get_user = "SELECT id,username,email,last_seen,online_status FROM tbl_users WHERE id = $user_id";
    $result_sql_get_user = $db->select($sql_get_user);
    if($result_sql_get_user){
        $row_get_user = $result_sql_get_user->fetch_assoc();
        echo json_encode($row_get_user);
    }else{
        echo $error[] = "no user found";
    }

}

?>