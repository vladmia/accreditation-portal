
<div class="reg__container flex-col">
  <!-- borrowed form fields -->
  <p class="info__title">Nursery Details</p>
  <hr class="info__line" />
  <div class="errors flex-jc-aic hide"> <p class="flex-jc-aic"><i class="fa fa-close"></i>  please fill in the inputs highlighted in red </p></div>

  <form class="reg__form flex-col-jcaic" id="nurseryReg" method="POST" action="">
    <div class="reg__form__details">
      <div class="reg__input__group">
        <label><span>*</span>  Nursery Manager</label>
        <input type="text" name="manager" value="" placeholder="e.g John Smith" required />
      </div>

      <div class="reg__input__group">
        <label><span>*</span> Phone Number(+254)</label>
        <input type="text" name="manager_phone" minlength="10" maxlength="10"  placeholder="e.g 07xxxxxxxx" required />
      </div>

      <div class="reg__input__group">
        <label><span>*</span> Nursery Name</label>
        <input type="text" name="nurseryname" value="" required />
      </div>

      <div class="reg__input__group option">
        <label for="categoryname"><span>*</span> Nursery Category</label>
        <select id="categoryname" name="nursery_category" required>
        <option class="selPlaceHolder"value="" selected hidden disabled
            >--select category--</option
          <option value="6">Individual</option>
          <option value="12">Community Based Organizations (CBOs)</option>
          <option value="3">Community Forest Association (CFA)</option>
          <option value="8">Company</option>
          <option value="11">Faith Based Organizations (FBOs)</option>
          <option value="6">Individual</option>
          <option value="2">Institution – NGOs</option>
          <option value="1">Institution – Government</option>
          <option value="9">Learning Institution</option>
          <option value="5">Others</option>
          <option value="4">Timber Manufacturers Association (TMA)</option>
          <option value="10">Tree Growers Associations (TGAs)</option>
          <option value="7">Women &amp; Youth</option>
        </select>
      </div>
<!--
      <input
        class="categorySelect"
        style="display: none"
        type="text"
        name="nursery_category"
      /> -->

      <div class="reg__input__group">
        <label for="subcategory" class="subLabel"><span>*</span> Specify</label>
        <input id="subcategory" type="text" value="" name="sub_category" />
      </div>

      <div class="reg__input__group yoe">
        <label><span>*</span> Year of Establishment</label>
        <input type="text" minlength="4" maxlength="4" name="YoE" value="" required />
      </div>

      <div class="reg__input__group">
        <label><span>*</span> Area <i>(acres)</i></label>
        <input type="text" name="area" value="" required placeholder="e.g. 0.5"/>
      </div>

      <div class="reg__input__group option">
        <label for="purpose"><span>*</span> Purpose</label>
        <select name="purpose" id="purpose" required>
          <option class="selPlaceHolder" value="" selected hidden disabled
            >--select purpose--</option
          >
          <optgroup label="Non-commercial (No sale of seedlings)">
            <option value="private">
              Private
            </option>
          </optgroup>
          <optgroup label="Non-commercial (e.g schools)">
            <option value="public">
              Public
            </option>
          </optgroup>
          <optgroup label="All nurseries that sell seedlings">
            <option value="commercial">
              Commercial
            </option>
          </optgroup>
        </select>
      </div>

      <div class="reg__input__group option last">
        <label for="capacity"
          ><span>*</span> <span class="mobileHide">Production</span> Capacity per year</label
        >
        <select name="capacity" id="capacity" required>
          <option class="selPlaceHolder" value="" selected hidden disabled
            >--select capacity--</option
          >
          <optgroup
            label="Commercial and individual nursery with output below 5,000 seedlings"
          >
            <option value="Below 5,000">
              Below 5,000
            </option>
          </optgroup>
          <optgroup
            label="Commercial and individual nursery with output of 5,000 - 500,000 seedlings"
          >
            <option value="small scale">
              Small scale
            </option>
          </optgroup>
          <optgroup
            label="Tree nursery with output of over 501,000 - 1,000,000 seedlings"
          >
            <option value="medium scale">
              Medium scale
            </option>
          </optgroup>
          <optgroup
            label="Commercial tree nursery with output of over 1,000,000 seedlings"
          >
            <option value="large scale">
              Large scale
            </option>
          </optgroup>
        </select>
      </div>

      <div class="reg__input__group">
        <label><span>*</span> County</label>
        <select name="county" required>
          <option class="selPlaceHolder" value="" selected hidden disabled>
            --select county--
          </option>
          <?php include '../config/apis/counties.php';?>
        </select>
      </div>

      <div class="reg__input__group">
        <label><span>*</span> Subcounty</label>
        <select name="subcounty" required>
        <option class="selPlaceHolder" value="" selected hidden disabled>
            --select subcounty--
          </option>
        </select>
      </div>

      <div class="reg__input__group">
        <label><span>*</span> Nearest Town</label>
        <input type="text" name="town" value="" required />
      </div>

      <div class="reg__input__group">
        <label>Geo-location<em>(optional)</em></label>
        <input class="gps" type="text" name="gps" value="" placeholder="GPS coordinates"/>
      </div>

      <div class="reg__input__group">
        <label><span>*</span> Is your nursery registered with KFS?</label>
        <select name="kfs_registered" required>
          <option class="selPlaceHolder" value="" selected hidden disabled>
            --Please Select--
          </option>
          <option value="Yes">
            Yes
          </option>
          <option value="No">
            No
          </option>
        </select>
      </div>

      <div class="reg__input__group btn">
        <a class="button flex-jc-aic"
          ><span>Next</span></a
        >
      </div>
    </div>

    <hr class="separator" />

    <div class="reg__form__species flex-col">
      <p class="info__title for__species">
        Add Available Tree Species in your Nursery
      </p>
      <hr class="info__line" />

      <div class="species__container">
      <div class="confirm-wrap hide flex-jc-aic">
      <div class="confirm flex-col-sbaic">
          <p class="success">Nursery Registered</p>
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
      <div class="species__header">
            <div class="species__header__titles flex-sb-aic">
                  <span>Species category</span><span>Name of species</span><span>Source of Seed</span><span>Number of seedlings</span>
            </div>
      </div>
        <?php include '../templates/species_write.php';?>
      </div>
    </div>

    <button id="add__species" type="submit" class="reg__submit button">
      Register Nursery
    </button>
  </form>
</div>

<div class="app__guide hide flex-col">
    <span class="close__guide">&times;</span>
    <p class="guide__head flex-jc-aic">Nursery Registration Guide</p>
    <p class="guide__one">Fill in your nursery details in the form provided. You can choose to fill in the GEO-location field with your nursery's GPS coordinates or not.</p>
    <p class="guide__one">The sincerity of the information entered is of paramount importance failure to which the nursery would be considered <strong>unfit</strong> for certification.</p>
    <p class="guide__one">Once filled out, click the <span class="button">Next</span> button to fill in your nursery's species information. <strong>Ensure</strong> to enter all the species that your nursery has as this information will be used to certify your nursery.</p>
  </div>


