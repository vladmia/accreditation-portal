<script src="../js/inspector/fetch_count.js"></script>
<script src="../js/inspector/uninspected_fetch.js"></script>
<script src="../js/inspector/inspected_fetch.js"></script>
<script src="../js/inspector/all_assignments_fetch.js"></script>
<script src="../js/filters.js"></script>


<script>
    let setModal = 0;
const modal = {
        dash: `<?php require './modals/dashboards/inspector_dash.html';?>`,
        inspect: `<?php require './modals/views/inspect.php';?>`,
        inspected: `<?php require './modals/views/inspected.php';?>`,
        allAssignments: `<?php require './modals/views/assignments.php';?>`,
        viewRep: `<?php require './modals/views/report.html';?>`
    };


function switchModal(button, content) {
    if (button.getAttribute('id') == 'dash_1') {
        setContent(content, modal.dash);
        console.log('clicked dash');
        countFetch();
    }
    else if (button.getAttribute('id') == 'dash_2') {
        setContent(content, modal.inspect);
        fetchUninspected();
        activateFilters('inspector', 'penInsp');
    }
    else if (button.getAttribute('id') === 'dash_3') {
        setContent(content, modal.inspected);
        fetchInspected();
        activateFilters('inspector', 'insp');
    }
    else if (button.getAttribute('id') === 'dash_4') {
        setContent(content, modal.allAssignments);
        fetchAll();
        activateFilters('inspector', 'total');
    }
   
    // else if (button.getAttribute('id') === 'dash_5') {
    //     setContent(content, modal.viewRep);
    //     //app_fetch();
    // }  
    else {
        setContent(content, '');
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





