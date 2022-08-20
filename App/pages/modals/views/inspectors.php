<div class="app">
  <div class="app__controls flex-sb-aic">
    <div></div>
    <div class="printMe flex-jc-aic">
     <span class="fa fa-print print_icon"></span><span class="print__preview">Print</span>
    </div>
    <div class="search flex-jc-aic">
      <span class="flex-jc-aic"><i class="fa fa-search"></i></span>
      <input type="text" />
    </div>
  </div>
  <div class="app__header flex-sb-aic">
    <p class="flex">First Name</p>
    <p class="flex last__name">Last Name</p>
    <p class="flex">Email</p>
    <p class="flex">Phone Contact</p>
    <p class="flex">Region</p>
    <p class="flex">Centre</p>
    <p class="flex btn">Set status</p>
  </div>
  <div class="app__content">
    <table class="app__table">
      <tbody id="tbody"></tbody>
    </table>
  </div>
  <?php include "./modals/views/report_iframe.html"; ?>
</div>

<div class="zero__content flex-col-jcaic hide">
  <p class="zero__content__title t-center">
    There are no inspectors registered in the system currently
  </p>
  <div class="zero__content__image"></div>
</div>
