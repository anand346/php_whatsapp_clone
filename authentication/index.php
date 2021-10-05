<?php include "header.php";?>
      <div class="authentication">
        <div class="limit">
          <div class="login-container">
            <div class="bb-login">
              <form class="bb-form validate-form" id = "signin_form">
                <span class="bb-form-title p-b-26 "> Sign In </span>
                <span class="bb-form-title p-b-48" style = "margin-top:10px;width:100%;height:100px;display:flex;justify-content: center;overflow:hidden;">
                  <img src="../assets/images/logo.jfif" class = "logo" alt="" style = "width:100px;height:100%;">
                </span>
                <div
                  class="wrap-input100 validate-input"
                  data-validate="Valid email is: a@b.c"
                >
                  <input
                    id = "signin_email"
                    class="input100"
                    type="email"
                    name="signin_email"
                    placeholder="email"
                    autocomplete = "off"
                  />
                </div>
                <div
                  class="wrap-input100 validate-input"
                  data-validate="Enter password"
                >
                  <span class="btn-show-pass" style = "color:#40C150">
                    <i class="fa fa-eye " aria-hidden="true"></i>
                  </span>
                  <input
                    id = "signin_password"
                    class="input100"
                    type="password"
                    name="signin_password"
                    placeholder="Password"
                    autocomplete = "off"
                  />
                </div>
                <div class="login-container-form-btn">
                  <div class="bb-login-form-btn">
                    <div class="bb-form-bgbtn"></div>         
                    <button class="bb-form-btn" name = "login" type = "submit" id = "signin_btn">Sign In</button>
                  </div>
                  <span id = "signin_loader" style = "display:none;"><img src="../assets/images/abc.gif"  height = "40" alt=""></span>
                </div>
                <div class="text-center p-t-115">
                  <span class="txt1"> Don’t have an account? </span>
                  <a class="txt2 sign-up " id = "sign_up_btn" href="#"> Sign Up </a>
                </div>
              </form>
              <form class="bb-form validate-form" id = "signup_form">
                <span class="bb-form-title p-b-26 sign-up-logo"> Sign Up </span>
                <span class="bb-form-title p-b-48" style = "margin-top:10px;width:100%;height:100px;display:flex;justify-content: center;overflow:hidden;">
                  <img src="../assets/images/logo.jfif" class = "logo" alt="" style = "width:100px;height:100%;">
                </span>
                <div
                  class="wrap-input100 validate-input"
                  data-validate="Valid email is: a@b.c"
                >
                  <input
                    id = "signup_username"
                    class="input100"
                    type="text"
                    name="signup_username"
                    placeholder="username"
                    autocomplete = "off"
                  />
                </div>
                <div
                  class="wrap-input100 validate-input"
                  data-validate="Valid email is: a@b.c"
                >
                  <input
                    id = "signup_email"
                    class="input100"
                    type="email"
                    name="signup_email"
                    placeholder="email"
                    autocomplete = "off"
                  />
                </div>
                <div
                  class="wrap-input100 validate-input"
                  data-validate="Enter password"
                >
                  <span class="btn-show-pass" style = "color:#40C150">
                  <i class="fa fa-eye " aria-hidden="true"></i>
                  </span>
                  <input
                    id = "signup_password"
                    class="input100"
                    type="password"
                    name="signup_password"
                    placeholder="Password"
                    autocomplete = "off"
                  />
                </div>
                <div class="login-container-form-btn">
                  <div class="bb-login-form-btn">
                    <div class="bb-form-bgbtn"></div>
                    <button class="bb-form-btn disabled" type = "submit" name = "Sign Up" id = "signup_btn">Sign Up</button>
                  </div>
                  <span id = "signup_loader" style = "display:none;"><img src="../assets/images/abc.gif"  height = "40" alt=""></span>
                </div>
                <div class="text-center p-t-115">
                  <span class="txt1"> Already have an account? </span>
                  <a class="txt2 sign-up " id = "sign_in_btn" href="#"> Sign In </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php include "footer.php";?>