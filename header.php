<?php
include "lib/session.php";
include "lib/Database.php";
$db = new Database();
session::init();
session::checkSession();
$my_id = session::get('id');
$my_username = session::get('username');
$my_email = session::get('email');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="Description" content="Enter your description here" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />
    <!-- <link rel="stylesheet" href="assets/css/loader.css"> -->
    <link rel="stylesheet" href="assets/css/wa_loader.css">
    <link rel="stylesheet" href="assets/css/background.css" />
    <link rel="stylesheet" href="assets/css/sidebar.css" />
    <link rel="stylesheet" href="assets/css/chat.css" />
    <title>Whatsapp Clone</title>
    <style>

    </style>
  </head>
  <body>
  <!-- <div id="loading">
      <div id="loading-center">
        <div id="loading-center-absolute">
          <div class="object" id="object_one"></div>
          <div class="object" id="object_two"></div>
          <div class="object" id="object_three"></div>
          <div class="object" id="object_four"></div>
          <div class="object" id="object_five"></div>
          <div class="object" id="object_six"></div>
          <div class="object" id="object_seven"></div>
          <div class="object" id="object_eight"></div>
        </div>
      </div>
    </div> -->
    <div id="startup">
      <img src="assets/images/logo-whatsapp-png-46044.png" height = "40" alt="" id = "__loader_logo">
    <svg class="spinner-container" width="30px" height="65px" viewBox="0 0 52 52">
      <circle class="path" cx="26px" cy="26px" r="20px" fill="none" stroke-width="4px" />
    </svg>
  </div>
    <div id="background-header"></div>
    <div id="background-body"></div>
    <div id="chat-container">
