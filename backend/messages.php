<?php
include "../lib/Database.php";
include "../lib/session.php";
session::init();
$db = new Database();
$error = array();
$my_id = session::get("id");
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['message'])){
        $message = $db->link->real_escape_string(htmlentities(trim($_POST['message'])));
        $to_user = $db->link->real_escape_string(htmlentities(trim($_POST['to_user'])));
        $to_user = $db->link->real_escape_string(htmlentities(trim($_POST['to_user'])));
        $from_user = $my_id;
        $sql_check_user_online = "SELECT * FROM tbl_users WHERE id = $to_user";
        $sql_check_user_online_result = $db->select($sql_check_user_online);
        $row_check_user_online = $sql_check_user_online_result->fetch_assoc();
        if($row_check_user_online['online_status'] == 1){
            $sql_save_message = "INSERT INTO tbl_messages(message,from_user,to_user,msg_status,sent_time) VALUES('{$message}','{$from_user}','{$to_user}',2,CURRENT_TIMESTAMP)";
            $result_save_message = $db->insert($sql_save_message);
            if($result_save_message){
                echo 1;
            }else{
                echo $error[] = "message not sent";
            }
        }else{
            $sql_save_message = "INSERT INTO tbl_messages(message,from_user,to_user,msg_status,sent_time) VALUES('{$message}','{$from_user}','{$to_user}',1,CURRENT_TIMESTAMP)";
            $result_save_message = $db->insert($sql_save_message);
            if($result_save_message){
                echo 1;
            }else{
                echo $error[] = "message not sent";
            }
        }
        
        
    }
}else if($_SERVER['REQUEST_METHOD'] == "GET"){
    $output = "";
    if(isset($_GET['to_user'])){
        $to_user = $db->link->real_escape_string(htmlentities(trim($_GET['to_user'])));
        $chat_user = $db->link->real_escape_string(htmlentities(trim($_GET['chat_user'])));
        $from_user = $my_id;
        $sql_update_msg_blue = "UPDATE tbl_messages SET msg_status = 3 WHERE from_user = $chat_user AND to_user = $my_id";
        $db->update($sql_update_msg_blue);
        $sql_get_messages = "SELECT * FROM tbl_messages WHERE (from_user IN ({$from_user},{$to_user}) AND to_user IN ({$from_user},{$to_user})) ORDER BY id DESC";
        $result_get_messages = $db->select($sql_get_messages);
        if($result_get_messages){
            $output .= "<div id='messages'>";
            while($row_get_messages = $result_get_messages->fetch_assoc()){
                if($my_id == $row_get_messages['from_user']){
                    $time_create = date_create($row_get_messages['sent_time']);
                    $time = date_format($time_create,"H:i");
                    if($row_get_messages['msg_status'] == 1){
                        $output .= "
                        <div class='message-box me'>
                            <div class='message_specific'>
                            {$row_get_messages['message']}
                            <span>{$time}<img src='assets/images/singleTick.svg' alt=''/></span>
                            </div>
                        </div>
                        ";
                    }else if($row_get_messages['msg_status'] == 2){
                        $output .= "
                        <div class='message-box me'>
                            <div class='message_specific'>
                            {$row_get_messages['message']}
                            <span>{$time}<img src='assets/images/doubleTick.svg' alt=''/></span>
                            </div>
                        </div>
                        ";
                    }else{
                        $output .= "
                        <div class='message-box me'>
                            <div class='message_specific'>
                            {$row_get_messages['message']}
                            <span>{$time}<img src='assets/images/doubleTickBlue.svg' alt=''/></span>
                            </div>
                        </div>
                        ";
                    }
                }else{
                    $time_create = date_create($row_get_messages['sent_time']);
                    $time = date_format($time_create,"H:i");
                    $output .= "
                        <div class='message-box '>
                            <div class='message_specific'>
                            {$row_get_messages['message']}
                            <span>{$time}</span>
                            </div>
                        </div>
                        ";
                }
                
            }
            $output .= "</div>";
        }
        echo $output;
    }
}
?>