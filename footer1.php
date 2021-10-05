</div>
    <script src="https://stevenlevithan.com/assets/misc/date.format.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.5.0/velocity.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/2/velocity.ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      $(document).ready(function () {
          var conn = new WebSocket("ws://localhost:8080");
          conn.onopen = function(e){
              console.log("connection established");
          }
          conn.onmessage = function(e){
              var data = JSON.parse(e.data);
              console.log(data);
              var time = new Date();
                console.log(data.msg);
                var my_id = <?php echo $my_id;?>;
                $("#messages").prepend(`
                <div class="message-box">
                  <div class="message_specific">
                    `+data.msg+`
                    <span>`+time.getHours()+`:`+time.getMinutes()+`</span>
                  </div>
                </div>
              `
              );
          }
          conn.onerror = function(e){
              console.log(e);
          }
          conn.onclose = function(e){
              console.log("connection closed");
          }
        function htmlEntities(value) {
          return String(value).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
        function send_ind_req_message(to_user){
              $.ajax({
                  url:"backend/messages.php?to_user="+to_user,
                  type : "GET",
                  success : function(data){
                   $("#body #messages-box").html(data);
                  //  console.log(data);
                  }
                });
        }
        function send_msg(value,to_user){
          $.ajax({
                url : "backend/messages.php",
                type : "POST",
                data : {message : value,to_user : to_user},
                success : function(data){
                  console.log(data);
                }
              });
        }
        function send_ind_req(to_user){
            $.ajax({
                url:"backend/get_conversation.php?id="+to_user,
                type : "GET",
                // beforeSend : function(){
                //   $("#messages-box").html(`
                //   <span id = "signup_loader" style = "display:none;"><img src="../assets/images/abc.gif"  height = "40" alt=""></span>
                //   `);
                // },
                success : function(data){
                  var response = JSON.parse(data);
                  console.log(response);
                  $("#profile-section .user_name").text(response.username);
                  var last_seen = response.last_seen;
                  var formatted_last_seen = dateFormat(last_seen,"h:MM");
                  if(response.online_status == 1){
                    $("#profile-section .user_last_seen").text("online");
                  }else{
                    $("#profile-section .user_last_seen").text("Last seen today at "+formatted_last_seen);
                  }
                }
              });
        }
        var conversation;
        $(".conversation").on("click", function () {
          $("#chatPlaceholder").slideUp(500);
            delete to_user;
            conversation = $(this);
            to_user = $(this).find("input.to_user").val();
            send_ind_req(to_user);
          // setInterval(function(){
          //     send_ind_req(to_user);
          //   },10000);
          //   setInterval(function(){
          //     send_ind_req_message(to_user);
          //   },1000);
            //   send_ind_req_message(to_user);
            //   var text = $(this).find(".message-specific").text();
            //   console.log(text);
            //   var filteredText = text.replace(/(\s+\d+\S+)/gm,"");
            //   var filteredText = filteredText.replace(/(\s+)/gm,"");
            //  var replace =  conversation.find(".p-message").text(filteredText);
            //  $(".content .message .p-message").each(function (index, value) {
            //     $(this).html($(this).html().substring(0, 15)+"..."); 
            //   });
        });
        
        $("#textarea").keyup(function (e) {
          if (e.keyCode == 13) {
            var value = $("textarea").val();
            if($.trim(value).length == 0){
             return false;
            }else{
              
              $("textarea").val("");
              var time = new Date();
              $("#messages").prepend(`
                <div class="message-box me">
                  <div class="message_specific">
                    `+htmlEntities(value)+`
                    <span>`+time.getHours()+`:`+time.getMinutes()+`<img  src="assets/images/doubleTickBlue.svg" alt="" /></span>
                  </div>
                </div>
              `
              );
              data = {
                  msg : value,
                  to_user : to_user
              }
            //   send_msg(value,to_user);
            conn.send(JSON.stringify(data));
              conversation.find(".content .message .p-message").text(value);
              conversation.find(".content .message .p-message").each(function (index, value) {
                $(this).html($(this).html().substring(0, 15)+"..."); 
              });
            }
          } 
        });
        $("#search_input").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#sidebar-content .conversation").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
        $(".content .message .p-message").each(function (index, value) {
              $(this).html($(this).html().substring(0, 15)+"...."); 
        });
      });
    </script>
  </body>
</html>