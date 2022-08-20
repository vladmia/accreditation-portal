<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once '../templates/head.php';
?>
  <body>
    <header class="profile__header flex-sb-aic">
    <a href="./" class="logo"><h2 class="header__logo flex-jc-aic"><span class="header__logo__img"></span> OTNA</h2></a>
      <div class="profile__title flex-sb-aic">
        <span></span>
        <span class="profile_text">Dashboard</span>
      </div>
      <div class="profile__info flex-sb-aic">
        <div class="profile__pic flex-jc-aic"><i class="far fa-user"></i></div>
        <div class="profile__details flex-col">
          <p class="username"><?php echo ucwords($_SESSION['username']); ?></p>
          <p class="role">Nursery owner</p>
        </div>
       <div class="profile__logout flex-jc-aic"><i class="fa fa-sign-out"></i></div>
      </div>
    </header>
    <section class="profile__body flex-sb-aic">
      <div class="profile__nav flex-col">
        <a class="profile__nav__link logo" href="#">
          <span class="logo__cont flex-jc-aic">
            <span class="logo__image flex-jc-aic"></span> 
          </span>
         </a>
        <div id="dash_1" class="profile__nav__link main active flex">
          <span><i class="fa fa-dashboard"></i></span>
          <p class="text">Dashboard</p>
        </div>
        <div id="dash_2" class="profile__nav__link main flex">
        <span><i class="fa fa-plus-circle"></i></span>
          <p class="text">Register a Nursery</p>
        </div>
        <div id="dash_3" class="profile__nav__link main flex">
        <span><i class="fa fa-pencil-square-o"></i></span>
          <p class="text">Get Certified</p>
        </div>
        <div id="dash_5" class="profile__nav__link main flex">
          <span><i class="fa fa-file-text"></i></span>
          <p class="text">My Nurseries</p>
        </div>
        <div id="dash_4" class="profile__nav__link main flex">
        <div class="count hide flex-jc-aic"><p></p></div>
          <span><i class="fa fa-tasks"></i></span>
          <p class="text">My Applications</p>
        </div>
        <div id="dash_6" class="profile__nav__link help flex">
        <div class="count hide flex-jc-aic"><p></p></div>
          <span><i class="fa fa-tasks"></i></span>
          <p class="text">Help ?</p>
        </div>

        <hr class="profile__nav__link__divider" />
        <div class="profile__nav__link settings flex">
          <span><i class="fa fa-wrench"></i></span>
          <p class="text">Settings</p>
        </div>
        
        <div class="profile__nav__link logout flex">
          <span class="flex"><i class="fa fa-sign-out"></i></span>
          <p>Log out</p>
        </div>
        <p class="copyright">&copy; KEFRI ICT, 2021</p>
      </div>
      <div class="profile__content">

      </div>
    </section>
    <div class="logout__cont flex-jc-aic hide">
      <div class="logout__confirm flex-col-seaic">
        <p class="message">Are you sure you want to log out?</p>
        <div class="selection flex-sb-aic">
          <a href="../config/logout.php?owner=1" class="button apply__button">Proceed</a>
          <button class="cancel button apply__button">Cancel</button>
        </div>
      </div>
    </div>
    <div class="await__setup flex-col-jcaic">
      <p class="await__title">setting up...</p>
      <i class="loader fa fa-spinner fa-spin fa-3x fa-fw"></i>
    </div>
    <script src="../js/script.js"></script>
    <?php include '../templates/content_setup_owner.php';?>
    <script>
      window.onload = () => {
        owner_setup();
      }
    </script> 
    <script src="../js/owner/regNursery.js"></script>
    
  </body>
</html>
