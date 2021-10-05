<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/chat.css">
<title>Whatsapp Clone</title>
</head>
<body>
    <div id="container">
        <div id="header">
            <div id="avatar-section">
                <img src="assets/images/profile.svg" height = "40" alt="">
            </div>
            <div id="profile-section">
                <span>Anand</span>
                <span>Last seen today at 20:18</span>
            </div>
            <div id="action-buttons">
                <span><img src="assets/images/search.svg" alt=""></span>
                <span><img src="assets/images/3dots.svg" alt=""></span>
            </div>
        </div>
        <div id="body">
            <div id="body-background"></div>
            <div id="messages">
                <div id = "message-box"  [ngClass] = "{'me' : message.me}" *ngFor = "let message of conversation.messages">
                    <div id="message">{{ message.body }} <span>{{ message.time }} <img *ngIf = "message.me" [src]="message.seenStatus" alt=""></span></div>
                </div>            
            </div>
        </div>
        <div id="footer">
            <div id="leftIcon">
                <div id="smilyIcon">
                    <span>
                        <img (click) = "emojiPickerVisible = !emojiPickerVisible" src="assets/images/smilyIcon.svg" alt="">
                    </span>            
                </div>
                <div id="attachmentIcon">
                    <span>
                        <img src="assets/images/attachmentIcon.svg" alt="">
                    </span>
                </div>
            </div>
            <emoji-mart (emojiClick)="addEmoji($event)" *ngIf = "emojiPickerVisible" style = "    position: absolute;left: 282px;top: 160px;"></emoji-mart>
            <div id="textarea">
                <!-- <div class="placeholder-text">Type  a message</div> -->
                <textarea [(ngModel)] = "message" placeholder = "Type a message" (keyup.enter) = "addMessage($event)"></textarea>
            </div>
            <div id="rightIcon">
                <div id="micIcon">
                    <span>
                        <img src="assets/images/micIcon.svg" alt="">
                    </span>
                </div>    
            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
