<div class="app">
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
    
        <div class="search flex-jc-aic">
          <span class="flex-jc-aic"><i class="fa fa-search"></i></span>
          <input type="text" />
        </div>
      </div>
  <div class="app__header  assign__form__header flex-sb-aic">
    <p class="flex">Reg. Number</p>
    <p class="flex">Nursery Name</p>
    <p class="flex">Date Registered</p>
    <p class="flex">County</p>
    <p class="flex">Assign Evaluator</p>
    <p class="btn flex">More</p>
  </div>
  <div class="app__content no-overflow">
    <form
      action=""
      class="app__assign__form flex-col-sbaic"
      id="assignForm"
      method="POST"
    >
      <div class="table__container">
        <table class="app__table">
          <tbody id="tbody"></tbody>
        </table>
      </div>
      <button type="submit" class="button assign__button">Assign</button>
    </form>
    <?php include "./modals/views/nurseries_expand.html"; ?>
  </div>
</div>

<div class="zero__content flex-col-jcaic hide">
  <p class="zero__content__title t-center">
    There are no applications awaiting inspector assignment currently
  </p>
  <div class="zero__content__image"></div>
</div>
