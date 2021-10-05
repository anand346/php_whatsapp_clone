$(document).ready(function () {
    $(".logo").velocity({
        translateY: "10px"
      }, {
        loop: true
      }).velocity("reverse");
     
    var base_url = "http://localhost/whatsapp/";
    $("#signup_form").hide();
    var showPass = 0;
    $(".btn-show-pass").on("click", function () {

      if (showPass == 0) {
        $(this).next("input").attr("type", "text");
        $(this).find("i").removeClass("fa-eye");
        $(this).find("i").addClass("fa-eye-slash");
        showPass = 1;
      } else {
        $(this).next("input").attr("type", "password");
        $(this).find("i").addClass("fa-eye");
        $(this).find("i").removeClass("fa-eye-slash");
        showPass = 0;
      }
    });
    $("#sign_up_btn").on("click",function(){
        $("#signin_form").slideUp();
        $("#signup_form").slideDown();
    });
    $("#sign_in_btn").on("click",function(){
        $("#signup_form").slideUp();
        $("#signin_form").slideDown();
    });
    $("#signup_btn").on("click",function(e){
      e.preventDefault();
      var username = $("#signup_username").val();
      var email = $("#signup_email").val();
      var password = $("#signup_password").val();
      $("#signup_username").val("");
      $("#signup_email").val("");
      $("#signup_password").val("");
      $.ajax({
          url : "../backend/signup_signin.php",
          type : "POST",
          data : {signup : "signup" ,username : username,email : email,password : password},
          beforeSend : function(){
            $("#signup_loader").show();
          },
          success : function(data){
            var redirect = false;
            $("#signup_loader").hide();
            if(data == 1){
              swal({
                  title: "Done :) ",
                  text: "Your registration done successfully.Please check your email!",
                  icon: "success",
                  button: "hurray!",
                });
                $(".swal-button--confirm").on("click",()=>{
                  window.open(base_url+"authentication","_self");
                })
            }else{
              // $(".modal-body").text(data);
              // $("#exampleModal").modal();
              swal({
                  title: "Error :(",
                  text: data,
                  icon: "error",
                  button: "retry!",
                });
            }
          }
      });
    });
    $("#signin_btn").on("click",function(e){
      e.preventDefault();
      var email = $("#signin_email").val();
      var password = $("#signin_password").val();
      $.ajax({
          url : "../backend/signup_signin.php",
          type : "POST",
          data : {signin : "signin",email : email,password : password},
          beforeSend : function(){
            $("#signin_loader").show();
          },
          success : function(data){
            $("#signin_loader").hide();
            if(data == 1){
              window.open(base_url,"_self");
            }else{
              swal({
                  title: "Error :(",
                  text: data,
                  icon: "error",
                  button: "retry!",
                });
            }
          }
      });
    });
  });