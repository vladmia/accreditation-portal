<div class="app update">
<div class="app__controls flex-sb-aic">
    <div class="set__filter flex-sb-aic">
      <div>
        <label>Filter by: </label>
        <select class="app__filter" id="">
          <option value="all">All</option>
          <option value="dateSpec">Specific Date</option>
          <option value="dateRange">Date Range</option>
        </select>
      </div>

      <div class="select__all">
        <input type="text" value="No filter" disabled />
      </div>
      <div class="select__date range hide flex-sb-aic">
        <div class="date__container">
          <label for="">From</label>
          <input type="date" />
        </div>
        <div class="date__container">
          <label for="">To</label>
          <input type="date" />
        </div>
      </div>
      <div class="select__date spec hide flex-sb-aic">
        <div class="date__container">
            <label for="">Choose</label>
          <input type="date" />
        </div>
      </div>
      <button class="button apply__filter">Filter</button>
    </div>

    <div class="printMe flex-jc-aic">
     <span class="fa fa-print print_icon"></span><span class="print__preview">Print</span>
    </div>

    <div class="search flex-jc-aic">
      <span class="flex-jc-aic"><i class="fa fa-search"></i></span>
      <input type="text" />
    </div>
  </div>
  <div class="app__header flex-sb-aic">
    <p class="flex">Reg. Number</p>
    <p class="flex">Nursery Name</p>
    <p class="flex">Manager</p>
    <p class="flex">Date Registered</p>
    <p class="btn flex">More</p>
    <p class="btn flex">Update</p>
    <!-- <p class="btn add__new flex"><span class="flex-jc-aic">+</span></p> -->
  </div>
  <div class="app__content">
    <table class="app__table">
      <tbody id="tbody"></tbody>
    </table>
  </div>
  <div class="app__guide hide flex-col">
    <span class="close__guide">&times;</span>
    <p class="guide__head flex-jc-aic">My Nurseries Guide</p>
    <p class="guide__one">A list of nurseries that you have registered are shown here.</p>
    <p class="guide__one">You can filter the list of nurseries by date registered by using the filter menu on the top left corner of the view. You can also filter the list by typing any text to search in the search box provided on the top right corner of the view.</p>
    <p class="guide__one">You can choose to print your registered nurseries list by clicking on the print button provided.</p>
    <p class="guide__one">You can click on the <strong>eye</strong> icon in order to see your nursery details against the selected nursery record.</p>
    <p class="guide__one">You can click on the <strong>update</strong> icon against any nursery record in order to update nursery information.</p>
    <p class="guide__one"><strong>NOTE: </strong>For nurseries which have already been applied for certification, you are allowed to change only two bits of information; The manager's name and the manager's contact as will be indicated by the form fields highlighted in green.</p>
  </div>
  <?php include "./modals/views/report_iframe.html"; ?>
  <?php include "./modals/views/nurseries_expand.html"; ?>
</div>

<div class="zero__content flex-col-jcaic hide">
  <p class="zero__content__title t-center">
    There are no registered nurseries to display currently
  </p>
  <button type="button" class="button registerNursery">Register a nursery</button>
  <div class="zero__content__image">

  </div>
</div>

<?php include 'modals/forms/nursery_update.php'?>
