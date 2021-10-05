<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/sidebar.css">
<title>Whatsapp clone</title>
</head>
<body>
    <div id="sidebar">
        <div id="row1">
          <div id="sidebar-header">
            <div id="avatar-container">
              <img src="assets/images/no-pic.svg" />
            </div>
            <div id="actions-container">
              <img src="assets/images/status.svg" />
              <img src="assets/images/chat.svg" />
              <img src="assets/images/3dots.svg" />
            </div>
          </div>
          <div id="search-box">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input [(ngModel)] = "searchText" type="text" name="" id="" placeholder="search or start new chat" />
          </div>
        </div>
      
        <div id="sidebar-content">
          <!-- <div id="no-conversations">
              All chats are archived
            </div> -->
          <div class="conversation" *ngFor="let conversation of !searchText ? conversations : filterConversations" (click) = "conversationClicked.emit(conversation)">
            <div class="picture">
              <img src="assets/images/no-pic.svg" />
            </div>
            <div class="content">
              <div class="conversation-header">
                <div class="name">{{ conversation.name }}</div>
                <div class="time">{{ conversation.time }}</div>
              </div>
              <div class="message">
                 <span>
                   <img *ngIf = "!conversation.latestMessageRead" src="assets/images/doubleTick.svg" alt="">
                   <img *ngIf = "conversation.latestMessageRead" src="assets/images/doubleTickBlue.svg" alt="">
                  </span>
                  {{ conversation.latestMessage }}
              </div>
            </div>
          </div>
        </div>
      </div>
      
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>