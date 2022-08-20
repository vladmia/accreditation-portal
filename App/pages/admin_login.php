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
     
        <form class="login__form flex-col-jcaic" id="admin" method="POST">
          <div class="login__header admin">
            <p>login</p>
          </div>
          <div class="errors hide"></div>
          <div class="input-group flex-jc-aic option">
            <select name="role" id="log_in" required>
              <option value="" selected hidden disabled>
               Log in as..
              </option>
              <option value="admin">
                Admin
              </option>
              <option value="inspector">
                Inspector
              </option>
              <!-- <option value="management">
                Private
              </option> -->
            </select>
            <i class="input-icon fas fa-id-badge"></i>
          </div>
          <div class="input-group flex-jc-aic">
            <input type="text" name="username" placeholder="Username" required />
            <i class="input-icon fas fa-user"></i>
          </div>
          <div class="input-group flex-jc-aic last-textbox">
            <input
              type="password"
              name="password"
              placeholder="Password"
              required
            />
            <i class="input-icon fas fa-lock"></i>
            <i class="input-icon toggler fas fa-eye"></i>
          </div>
          <div class="input-group flex-jc-aic">
            <input
              type="submit"
              name="login_admin"
              class="login__submit button"
              value="Sign In"
            />
          </div>
          
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
      </div>
    </div>
    <script src="../js/logins.js"></script>
    <script>
        document.querySelector('#admin').addEventListener('submit', (e) => {
          e.preventDefault();
          postName(getData(), 'admin_login');
        });

        function getData() {
          let r = document.querySelector('select[name=role]').value,
              uname = document.querySelector('input[name=username]').value,
              p = document.querySelector('input[name=password]').value;
          return data = {
                  role: r,
                  username: uname,
                  password: p
          };
        }

    </script>
  </body>
</html>
