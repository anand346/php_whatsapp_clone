</div>
<script src="https://stevenlevithan.com/assets/misc/date.format.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.5.0/velocity.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/2/velocity.ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/emoji-button@latest/dist/index.min.js"></script>
<!-- <script src="assets/js/ajax_lib.js"></script> -->
<script>
  $(window).load(function() {
    setTimeout(function() {
      $("#startup").slideUp(500);
    }, 1000);
  })
  $("#__loader_logo").velocity({
        translateY: "10px"
      }, {
        loop: true
      }).velocity("reverse");
</script>
<script>
  $(document).ready(function() {
    // $("#smilyIcon").on("click",function(){
    //   $("#emoji").toggle();
    //   document.querySelector('emoji-picker').
    //   addEventListener('emoji-click', event => {
    //     console.log(event);
    //     var val = $("textarea").val() ;
    //     $("textarea").val(val+event.detail.unicode);
    //   });
    // })
    const picker = new EmojiButton({
      position: 'top-start'
    });
    const trigger = document.querySelector('#smilyIcon');
    picker.on('emoji', function(emoji) {
      var val = $("textarea").val();
      $("textarea").val(val + emoji);
      pikcer.pickerVisible = true;
    });
    // $(document).keyup(function(e) {
    //   if (e.keyCode == 9) {
    //     picker.pickerVisible ? picker.hidePicker() : picker.showPicker(trigger);
    //   }
    // });
    trigger.addEventListener('click', function() {
      picker.pickerVisible ? picker.hidePicker() : picker.showPicker(trigger);
    });
    var time = new Date();
    var yesterday_date = new Date(time);
    yesterday_date = yesterday_date.setDate(yesterday_date.getDate() - 1);

    function htmlEntities(value) {
      return String(value).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function send_ind_req_message(to_user) {
      $.ajax({
        url: "backend/messages.php?to_user=" + to_user + "&chat_user=" + chat_user,
        type: "GET",
        success: function(data) {
          $("#body #messages-box").html(data);
          //  console.log(data);
        }
      });
    }

    function send_msg(value, to_user) {
      $.ajax({
        url: "backend/messages.php",
        type: "POST",
        data: {
          message: value,
          to_user: to_user
        },
        success: function(data) {
          console.log(data);
        }
      });
    }

    function send_req_chat_open(of_user) {
      // $.ajax({
      //       url : "backend/messages.php",
      //       type : "POST",
      //       data : {message : value,to_user : to_user},
      //       success : function(data){
      //         console.log(data);
      //       }
      // })
    }

    function send_ind_req(to_user) {
      $.ajax({
        url: "backend/get_conversation.php?id=" + to_user,
        type: "GET",
        // beforeSend : function(){
        //   $("#messages-box").html(`
        //   <span id = "signup_loader" style = "display:none;"><img src="../assets/images/abc.gif"  height = "40" alt=""></span>
        //   `);
        // },
        success: function(data) {
          var response = JSON.parse(data);
          console.log(response);
          $("#profile-section .user_name").text(response.username);
          var last_seen = response.last_seen;
          var formatted_last_seen_hours = dateFormat(last_seen, "h:MM");
          var formatted_last_seen_days = dateFormat(last_seen, "mmmm d");

          if (formatted_last_seen_days == dateFormat(time, "mmmm d")) {
            formatted_last_seen_days = "today";
          } else if (formatted_last_seen_days == dateFormat(yesterday_date, "mmmm d")) {
            formatted_last_seen_days = "yesterday";
          }
          if (response.online_status == 1) {
            $("#profile-section .user_last_seen").text("online");
          } else {
            $("#profile-section .user_last_seen").text("Last seen " + formatted_last_seen_days + " at " + formatted_last_seen_hours);
          }
        }
      });
    }
    var conversation , conversationDiv , conversationClass = null;
    $(".conversation").on("click", function() {
      if(conversationClass != null){
        document.getElementsByClassName(conversationClass)[0].removeAttribute("style"); 
      }
      $("#chatPlaceholder").slideUp(500);
      delete chat_user;
      var classes = $(this).attr("class");
      var classArr = classes.split(/\s+/);
      chat_user = classArr[1];
      conversation = $(this);
      conversationDiv = this;
      conversationDiv.style.backgroundColor = "#ebebeb";
      conversationClass = conversationDiv.classList[1];
      delete to_user;
      to_user = $(this).find("input.to_user").val();
      send_ind_req(to_user);
      setInterval(function() {
        send_ind_req(to_user);
      }, 10000);
      setInterval(function() {
        send_ind_req_message(to_user, chat_user);
      }, 1000);
      send_ind_req_message(to_user);
      //   var text = $("#message").text();
      //   console.log(text);
      //   var filteredText = text.replace(/(\s+\d+\S+)/gm,"");
      //   var filteredText = filteredText.replace(/(\s+)/gm,"");
      //  var replace =  $(".p-message").text(filteredText);
      //  $(".content .message .p-message").each(function (index, value) {
      //     $(this).html($(this).html().substring(0, 15)+"..."); 
      //   });


    });
    $("#textarea").keyup(function(e) {
      if (e.keyCode == 13) {
        delete time_now;
        time_now = new Date();
        var value = $("textarea").val();
        if ($.trim(value).length == 0) {
          return false;
        } else {
          $("textarea").val("");
          $("#messages").prepend(`
            <div class="message-box me">
              <div class="message_specific">
                ` + htmlEntities(value) + `
                <span>` + time_now.getHours() + `:` + String(time_now.getMinutes()).padStart(2, '0')+ `<img  src="assets/images/singleTick.svg" alt="" /></span>
              </div>
            </div>
          `);
          send_msg(value, to_user);
          conversation.find(".content .message .p-message").text(value);
          conversation.find(".content .message .p-message").each(function(index, value) {
            $(this).html($(this).html().substring(0, 15) + "...");
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
    $(".content .message .p-message").each(function(index, value) {
      $(this).html($(this).html().substring(0, 15) + "....");
    });
  });
</script>

</body>

</html>