<div class="app cert flex-se-aic">
  <div class="main__section flex-col">
  <div class="app__controls flex-sb-aic">
    <div></div>
    
    <div class="search flex-jc-aic">
      <span class="flex-jc-aic"><i class="fa fa-search"></i></span>
      <input type="text" />
    </div>
  </div>
  <div class="app__header flex-sb-aic">
    <p class="flex">Reg. No.</p>
    <p class="flex">Nursery Name</p>
    <p class="flex">County</p>
    <p class="flex">Class</p>
  </div>
 
  <div class="app__content certification">
 
    <table class="app__table">
      <tbody id="tbody"></tbody>
    </table>
  </div>
  </div>
  <?php include "./modals/views/certificate_iframe.html"; ?>

  <div class="view__cert flex-col-seaic">
  <div class="cert__mask flex-col">
    <p class="instructions">Click on a nursery row to view<br> its certification details</p>
    <div class="mask__badge"></div>
  </div>
  <div class="mark__1"></div>
  <div class="mark__2"></div>
  <div class="badge"></div>
  <div class="cert__content flex-col-jcaic">
    <p class="reg flex-jc-aic"><span class="label flex">Reg. No.: </span><span class="cont flex"></span></p>
    <p class="name flex-jc-aic"><span class="label flex">Nursery Name: </span><span class="cont flex"></span></p>
    <p class="category flex-jc-aic"><span class="label flex">Certification Category: </span><span class="cont flex"></span></p>
    <p class="rating flex-jc-aic"><span class="label flex">Rating: </span><span class="cont flex">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
    </span></p>
  </div>
  <button type="button" class="button view__certificate">View Certificate</button>
<?php include "./modals/views/certificate_iframe.html"; ?>
</div>
</div>


<div class="zero__content flex-col-jcaic hide">
  <p class="zero__content__title t-center">
    There are no certified nurseries to show currently
  </p>
  <div class="zero__content__image"></div>
</div>
