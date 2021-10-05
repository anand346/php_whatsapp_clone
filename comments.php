<?php
          // $sql_get_users_id = "SELECT * FROM tbl_users WHERE id != {$my_id}";
          // $result_sql_get_users_id = $db->select($sql_get_users_id);
          // if($result_sql_get_users_id){
          //   while($row_get_users_id = $result_sql_get_users_id->fetch_assoc()){
        ?>
        // $(".conversation.<?php
        //  echo $row_get_users_id['id'];
         ?>").on("click", function () {
        //   $("#chatPlaceholder").slideUp(500);
        //   var to_user_<?php
        //  echo $row_get_users_id['id'];
         ?> = $(this).find("input.to_user").val();
        //   setInterval(()=>{
        //     console.log(to_user_<?php
          //  echo $row_get_users_id['id'];
           ?>;
        //   },1000);
        // });
        <?php
        //   }
        // }
        ?>