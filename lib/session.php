<?php
//session
class session{
  public static function init(){
    session_start();
  }
  public static function set($key,$val){
    $_SESSION[$key] = $val;
  }
  public static function get($key){
    if(isset($_SESSION[$key])){
      return $_SESSION[$key];
    }else{
      return false;
    }
  }
  public static function checkSession(){
    if(self::get("login") == false){
      self::destroy();
      header("location:authentication/");
    }
  }
  public static function checkLogin(){
    if(self::get("login") == true){
      return true;
    }else{
      return false;
    }
  }
  public static function destroy(){
    session_unset();
    session_destroy();
    header("location:authentication/");
  }
}

?>