<script src="../js/owner/regNursery.js"></script>
<script src="../js/owner/unApp_fetch.js"></script>
<script src="../js/owner/app_fetch.js"></script>
<script src="../js/owner/fetch_count.js"></script>
<script src="../js/owner/update_nurseries_fetch.js"></script>
<script src="../js/owner/guide_control.js"></script>
<script src="../js/filters.js"></script>

<script>
let setModal = 0;
const modal = {
        dash: `<?php require './modals/dashboards/owner_dash.html';?>`,
        reg: `<?php include './modals/forms/nursery_reg.php';?>`,
        apply: `<?php require './modals/views/apply_certification.html';?>`,
        myApp: `<?php require './modals/views/my_applications.php';?>`,
        myNurs: `<?php require './modals/views/update_nursery.php';?>`
    };


function switchModal(button, content) {
    if (button.getAttribute('id') === 'dash_1'){
        setContent(content, modal.dash);
        countFetch();
        activeNav = 'dashboard';
        guideActivate();
    } else if (button.getAttribute('id') === 'dash_2') {
        setContent(content, modal.reg);
        register(populate, remove);
        setLabel();
        validateFormInput();
        activeNav = 'registerNursery';
        guideActivate();
    } else if (button.getAttribute('id') === 'dash_3') {
        setContent(content, modal.apply);
        unApp_fetch();
        activateFilters('owner', 'getCert');
        activeNav = 'apply';
        guideActivate();
    } else if (button.getAttribute('id') === 'dash_4') {
        setContent(content, modal.myApp);
        app_fetch();
        activateFilters('owner', 'myApp');
        activeNav = 'applications';
        guideActivate();
    } else if (button.getAttribute('id') === 'dash_5') {
        setContent(content, modal.myNurs);
        toUpdateFetch();
        register(populate, remove);
        setLabel();
        validateFormInput();
        activateFilters('owner', 'myNurs');
        activeNav = 'myNurseries';
        guideActivate();
    }
}

 // set content func

function setContent(content, modal) {
    content.innerHTML = modal;
    setModal = 1;
    if (setModal) {
        let awaitSetup = document.querySelector('.await__setup'),
            userName = document.querySelector('p.username').textContent;

      


        const y = setTimeout(() => {
                awaitSetup.querySelector('p.await__title').classList.toggle('large');
                awaitSetup.querySelector('p').textContent = 'Welcome, ' + userName;
                awaitSetup.querySelector('.loader').classList.add('hide');

        const t = setTimeout(() => {
            awaitSetup.classList.add('hide');
            const x = setTimeout(() => {
                awaitSetup.style.display = 'none';
            },2000);

        }, 2000);
            }, 2000);
    }

}

</script>





