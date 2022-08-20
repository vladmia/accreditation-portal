<div class="inspection">
  <form class="flex-jc-aic" id="inspectionForm" method="POST">
  <div class="inspection__sidebar"></div>
  <div class="inspection__content">
    <div class="content__header flex-sb-aic">
      <div class="profile__title flex-sb-aic">
        <span></span>
        <span class="profile_text">Inspection Checklist : <span id="regNum"></span><span id="assId"></span> </span>
      </div>

      <div class="content__title flex-jc-aic">
          <div class="progress flex-sb-aic">
            <p>Question <span id="qNum"></span> / <span id="qTotal"></span></p>
            <div class="progress__cont flex-jc-aic">
              <progress id="prog"></progress>
            </div>
          </div>
        </div>
      <div class="content__close flex-jc-aic"><span>&times;</span></div>
    </div>

    <div class="content__body">
   
    </div>
    <div class="content__submit flex-jc-aic">
      <button class="apply__button complete__inspection button disabled" type="submit" >Complete Inspection</button>
    </div>

    <div class="error__mask flex-jc-aic hide">
        <div class="submit__error flex-col-sbaic">
          <p class="error__text">
            Cannot submit empty selections
          </p>
          <button type="button" class="error__btn button">Ok</button>
        </div>
    </div>
  </div>
  </form>
</div>
