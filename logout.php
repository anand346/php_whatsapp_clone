<?php
include "lib/session.php";
include "lib/Database.php";
session::init();
$db = new Database();
$my_id = session::get("id");
$sql_update_last_seen = "UPDATE tbl_users SET last_seen = CURRENT_TIMESTAMP,online_status = 0  WHERE id = {$my_id}";
$result_update_last_seen = $db->update($sql_update_last_seen);
session::destroy();

?>