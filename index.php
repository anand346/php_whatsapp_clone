<?php include "header.php"; ?>
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
            <input
              type="text"
              name=""
              id="search_input"
              placeholder="search or start new chat"
              autocomplete = "off"
            />
          </div>
        </div>

        <div id="sidebar-content">
          <!-- <div id="no-conversations">
              All chats are archived
            </div> -->
          <?php
          $sql_get_users = "SELECT * FROM tbl_users WHERE id != {$my_id}";
          $result_sql_get_users = $db->select($sql_get_users);
          if($result_sql_get_users){
            while($row_get_users = $result_sql_get_users->fetch_assoc()){
          ?>
          <div class="conversation <?php echo $row_get_users['id'];?>">
          <input type="hidden" class = "to_user" name="to_user" value = "<?php echo $row_get_users['id'];?>">
            <div class="picture">
              <img src="assets/images/no-pic.svg" />
            </div>
            <div class="content">
              <div class="conversation-header">
                <div class="name"><?php echo $row_get_users['username'];?></div>
                <div class="time">9:30 AM</div>
              </div>
              <div class="message">
                <span>
                  <!-- <img *ngIf = "!conversation.latestMessageRead" src="assets/images/doubleTick.svg" alt=""> -->
                  <img
                    *ngIf="conversation.latestMessageRead"
                    src="assets/images/doubleTickBlue.svg"
                    alt=""
                  />
                </span>
                <span class = "p-message">i am fine what about you i am also fine what about your family all are fine bro then get to dinner plate</span>
              </div>
            </div>
          </div>
          <?php              
                }
              }
          ?>
        </div>
      </div>
      <div id="chat">
        <div id="chatPlaceholder" *ngIf="!conversation">
          <img
            width="400"
            src="assets/images/whatsapp_keep_your_phone_crop.png"
            alt=""
          />
        </div>
        <div id="container">
          <div id="header">
            <div id="avatar-section">
              <img src="assets/images/profile.svg" height="40" alt="" />
            </div>
            <div id="profile-section">
              <span class = "user_name">Anand</span>
              <span class = "user_last_seen">Last seen today at 20:18</span>
            </div>
            <div id="action-buttons">
              <span><img src="assets/images/search.svg" alt="" /></span>
              <span><img src="assets/images/3dots.svg" alt="" /></span>
            </div>
          </div>
          <div id="body">
            <div id="body-background"></div>
            <div id="messages-box">

              <div id="messages">
                <div class = "message-box me">
                <div
                  class=""
                  [ngClass]="{'me' : message.me}"
                  *ngFor="let message of conversation.messages"
                >
                  <div class="message_specific">
                    Good Morning
                    <span
                      >3:59<img src="assets/images/doubleTickBlue.svg" alt=""
                    /></span>
                  </div>
                </div>
                <span><img style = "position:relative;top:-8px;height:14px;" src="assets/images/left_arrow_chat.svg" alt=""></span>
                </div>
                <div
                  class="message-box"
                  [ngClass]="{'me' : message.me}"
                  *ngFor="let message of conversation.messages"
                >
                <span><img style = "position:relative;top:-8px;height:13px;transform:scaleX(-1);" src="assets/images/right_arrow_chat.svg"  alt=""></span>
                <div>
                  <div class="message_specific">
                    Good Morning
                    <span
                      >3:59<img
                        *ngIf="message.me"
                        [src]="message.seenStatus"
                        alt=""
                    /></span>
                  </div>
                  </div>
                </div>
                <div class="message-box me">
                  <div class="message_specific">
                    how are you
                    <span
                      >3:59<img src="assets/images/doubleTickBlue.svg" alt=""
                    /></span>
                  </div>
                </div>
                <div class="message-box">
                  <div class="message_specific">
                    I am fine
                    <span
                      >3:59<img
                        *ngIf="message.me"
                        [src]="message.seenStatus"
                        alt=""
                    /></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="footer">
            <div id="leftIcon">
              <div id="smilyIcon">
                <span>
                  <img
                    (click)="emojiPickerVisible = !emojiPickerVisible"
                    src="assets/images/smilyIcon.svg"
                    alt=""
                  />
                </span>
              </div>
              <div id="attachmentIcon">
                <span>
                  <img src="assets/images/attachmentIcon.svg" alt="" />
                </span>
              </div>
            </div>
            <div id="emoji" style = "position:absolute;top:170px;left:200px;display:none;">
            <emoji-picker></emoji-picker>
            </div>
            <emoji-mart
              (emojiClick)="addEmoji($event)"
              *ngIf="emojiPickerVisible"
              style="position: absolute; left: 282px; top: 160px"
            ></emoji-mart>
            <div id="textarea">
            <!-- <input type="text" name="" id="emoji_input"> -->
              <!-- <div class="placeholder-text">Type  a message</div> -->
              <textarea
              id = "textarea_emoji" placeholder="Type a message"></textarea>
            </div>
            <div id="rightIcon">
              <div id="micIcon">
                <span>
                  <img src="assets/images/micIcon.svg" alt="" />
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php include "footer.php"; ?>
    
