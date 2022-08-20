<script src="../js/admin/fetch_count.js"></script>
<script src="../js/admin/unAssigned.js"></script>
<script src="../js/filters.js"></script>
<script src="../js/admin/eval_fetch.js"></script>
<script src="../js/admin/app_fetch.js"></script>
<script src="../js/admin/owners_fetch.js"></script>
<script src="../js/admin/nurseries_fetch.js"></script>
<script src="../js/admin/email_fetch.js"></script>
<script src="../js/admin/cert_fetch.js"></script>
<script src= "https://smtpjs.com/v3/smtp.js"></script>
<script>
let setModal = 0;
const modal = {
        dash: `<?php require './modals/dashboards/admin_dash.html';?>`,
        ass: `<?php require './modals/forms/inspector_assign.php';?>`,
        viewNurs: `<?php require './modals/views/view_nurseries_admin.php';?>`,
        viewApp: `<?php require './modals/views/my_applications_admin.php';?>`,
        viewInsp: `<?php require './modals/views/inspectors.php';?>`,
        addInsp: `<?php require './modals/views/add_inspectors.php';?>`,
        viewOwners: `<?php require './modals/views/owners.php';?>`,
        viewCert: `<?php require './modals/views/viewCert.php';?>`
    };


function switchModal(button, content) {
    if (button.getAttribute('id') == 'dash_1') {
        setContent(content, modal.dash);
        countFetch();
    }
    else if (button.getAttribute('id') === 'dash_2') {
        setContent(content, modal.ass);
        fetch_unass();
        activateFilters('admin', 'assign');
    }
    else if (button.getAttribute('id') === 'dash_3') {
        setContent(content, modal.viewApp);
        app_fetch();
        activateFilters('admin', 'apps');
    }
    else if (button.getAttribute('id') === 'dash_4') {
        setContent(content, modal.viewInsp);
        eval_fetch();
        activateFilters('admin', 'insp');
    }
    else if (button.getAttribute('id') === 'dash_5') {
        setContent(content, modal.viewOwners);
        owners_fetch();
    } 
    else if (button.getAttribute('id') === 'dash_6') {
        setContent(content, modal.addInsp);
        emailFetch(populate, remove);
    }
   
    else if (button.getAttribute('id') === 'dash_7') {
        setContent(content, modal.viewNurs);
        fetchAll();
        activateFilters('admin', 'assign');
        //app_fetch();
    }  else if (button.getAttribute('id') === 'dash_8') {
        setContent(content, modal.viewCert);
        cert_fetch();
        // fetchAll();
        activateFilters('admin', 'assign');
        //app_fetch();
    } else {
        setContent(content, "");
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





