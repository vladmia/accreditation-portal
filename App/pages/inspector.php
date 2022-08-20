<?php
session_start();
if (!isset($_SESSION['ins_uname'])) {
    header('location: admin_login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once '../templates/head.php';?>
  <body>
    <header class="profile__header flex-sb-aic">
    <a href="./" class="logo"><h2 class="header__logo flex-jc-aic"><span class="header__logo__img"></span>OTNA</h2></a>
      <div class="profile__title flex-sb-aic">
        <span></span>
        <span class="profile_text">Dashboard</span>
      </div>
      <div class="profile__info flex-sb-aic">
      <div class="profile__pic flex-jc-aic"><i class="far fa-user"></i></div>
        <div class="profile__details flex-col">
          <p class="username"><?php echo ucwords($_SESSION['ins_uname']); ?></p>
          <p class="role">Field Inspector</p>
        </div>
        <div class="profile__logout flex-jc-aic"><i class="fa fa-sign-out"></i></div>
      </div>
    </header>
    <section class="profile__body flex-sb-aic">
      <div class="profile__nav flex-col">
        <a class="profile__nav__link logo" href="../../../../"
          >
          <!-- <span></span> -->
          <span class="logo__cont flex-jc-aic">
            <span class="logo__image flex-jc-aic"></span
          >  </span>
        </a>
        
        <div id="dash_1" class="profile__nav__link main active flex">
        <span><i class="fa fa-dashboard"></i></span>
          <p class="text">Dashboard</p>
        </div>
        <div id="dash_2" class="profile__nav__link main flex">
        <span><i class="fa fa-hourglass-1 "></i></span>
          <p class="text">Pending Inspection</p>
        </div>
        <div id="dash_3" class="profile__nav__link main flex">
        <span><i class="fa fa-check-square-o"></i></span>
          <p class="text">Inspected Nurseries</p>
        </div>
        <div id="dash_4" class="profile__nav__link main flex">
        <span><i class="fa fa-plus-square"></i></span>
          <p class="text">Total Assignments</p>
        </div>
        <!-- <div id="dash_5" class="profile__nav__link main flex">
        <span><i class="fa fa-line-chart"></i></span>
          <a href="../templates/reports/reportsTemp.php" target="_blank"><p class="text">View Reports</p></a>
        </div> -->
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
          <a href="../config/logout.php?insp=1" class="button apply__button">Proceed</a>
          <button class="cancel button apply__button">Cancel</button>
        </div>
      </div>
    </div>
    <div class="await__setup flex-col-jcaic">
      <p class="await__title">Setting up your account</p>
      <i class="loader fa fa-spinner fa-spin fa-3x fa-fw"></i>
    </div>
    <?php include './modals/forms/inspection.php'?>
    <script src="../js/script.js"></script>
    <?php include '../templates/content_setup_inspector.php';?>
    <script>
      window.onload = () => {
        console.log('inspector in yeey!');
        owner_setup();
      };
    </script>
  </body>
</html>
