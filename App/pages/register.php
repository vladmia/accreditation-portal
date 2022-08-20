
<!DOCTYPE html>
<html lang="en">
<?php include_once('../templates/head.php'); ?>
  <body class="flex flex-jc-aic">
  <div class="login__mask flex-jc-aic">
    <div class="login__container reg flex-sb-aic">
    <a href="../../" class="__home"><i class="fa fa-home"></i> Home</a>
    <div class="login__image__cont reg flex-col-jcaic">
      <div class="login__image reg flex-jc-aic"></div>
      <p>Nursery Certification</p>
      </div>
      <form class="login__form reg flex-col-jcaic" id="register" method="POST">
        <div class="login__header reg">
            <p>Register as a nursery owner</p>
        </div>
        <div class="errors hide"></div>
        <div class="input-group flex-jc-aic">
          <input type="text" name="fname" placeholder="First Name" required/>
          <i class="input-icon fas fa-user"></i>
        </div>
        <div class="input-group flex-jc-aic">
          <input type="text" name="lname" placeholder="Last Name" required/>
          <i class="input-icon fas fa-user"></i>
        </div>
        <div class="input-group flex-jc-aic">
          <input type="text" name="phone" placeholder="Phone Contact" required/>
          <i class="input-icon fas fa-phone"></i>
        </div>
        <div class="input-group flex-jc-aic">
          <input type="email" name="email" placeholder="Email" required/>
          <i class="input-icon fas fa-envelope"></i>
        </div>
        <div class="input-group flex-jc-aic">
          <input type="password" name="password_1" placeholder="Password" required/>
          <i class="input-icon fas fa-lock"></i>
          <i class="input-icon toggler fas fa-eye"></i>
        </div>
        <div class="input-group flex-jc-aic last-textbox">
          <input type="password" name="password_2" placeholder="Confirm Password" required/>
          <i class="input-icon fas fa-lock"></i>
          <i class="input-icon toggler fas fa-eye"></i>
        </div>
        <div class="input-group flex-jc-aic">
          <input type="submit" name="register" class="login__submit button" value="Sign Up" />
        </div>
        <a href="./login.php"><p>Already a member? <span>Sign in</span></p></a>
        <div class="confirm-wrapper flex-jc-aic"><div class="confirm flex-col-sbaic">
          <p class="success">Account created successfully</p>
          <div class="wrapper">
              <svg
              class="checkmark"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 52 52"
            >
              <circle
                class="checkmark__circle"
                cx="26"
                cy="26"
                r="25"
                fill="none"
              />
              <path
                class="checkmark__check"
                fill="none"
                d="M14.1 27.2l7.1 7.2 16.7-16.8"
              />
            </svg>
          </div>
        </div>
        </div>
      </form>
    </div>
    </div>
    <script src="../js/logins.js"></script>
    <script>
        document.querySelector('#register').addEventListener('submit', (e) => {
          e.preventDefault();
          postName(getData(), 'reg');
        });

        function getData() {
          let f = document.querySelector('input[name=fname]').value,
              l = document.querySelector('input[name=lname]').value,
              ph = document.querySelector('input[name=phone]').value,
              em = document.querySelector('input[name=email]').value,
              p1 = document.querySelector('input[name=password_1]').value,
              p2 = document.querySelector('input[name=password_2]').value;

          return data = {
                  fname: f,
                  lname: l,
                  phone: ph,
                  email: em,
                  password_1: p1,
                  password_2: p2
          };
        }
    </script>
  </body>
</html>
