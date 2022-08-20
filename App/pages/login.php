<!DOCTYPE html>
<html lang="en">
 <?php include_once('../templates/head.php'); ?>
  <body class="flex flex-jc-aic">
  <div class="login__mask flex-jc-aic">
    <div class="login__container flex-sb-aic">
    <a href="../../" class="__home"><i class="fa fa-home"></i> Home</a>
    <div class="login__image__cont flex-col-jcaic">
      <div class="login__image flex-jc-aic"></div>
      <p>Nursery Certification</p>
      </div>
      <form class="login__form flex-col-jcaic" method="POST" id="login">
        <div class="login__header">
            <p>Log in to continue</p>
        </div>
        <div class="errors hide"></div>
        <div class="input-group flex-jc-aic">
          <input type="email" name="email" placeholder="Email" id="email" required />
          <i class="input-icon fas fa-envelope"></i>
        </div>
        <div class="input-group flex-jc-aic last-textbox">
          <input type="password" name="password" placeholder="Password" id="pass" required/>
          <i class="input-icon fas fa-lock"></i>
          <i class="input-icon toggler fas fa-eye"></i>
        </div>
        <div class="input-group flex-jc-aic">
          <input type="submit" name="login" class="login__submit button" value="Sign In"/>
        </div>
        <a href="./register.php"><p>Not a member? <span>Sign Up</span></p></a>
        <a href="#"><p>Forgot username / password?</p></a>
        <div class="confirm-wrapper flex-jc-aic"><div class="confirm flex-col-sbaic">
          <p class="success">Login successful</p>
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
      <a class="admn" href="./admin_login.php">admin >></a>
    </div>
  </div>
    <script src="../js/logins.js"></script>
    <script>
        document.querySelector('#login').addEventListener('submit', (e) => {
          e.preventDefault();
          postName(getData(), 'login');
        });

        function getData() {
          let e = document.querySelector('input[name=email]').value,
              p = document.querySelector('input[name=password]').value;
          return data = {
                  email: e,
                  password: p
          };
        }

    </script>
  </body>
</html>
