function drawMobNav() {
    const header = document.querySelector("header.header"),
    hamBurger = document.querySelector(".header__menu"),
    overlay = document.querySelector(".header__overlay"),
    body = document.querySelector("body");

  hamBurger.addEventListener("click", () => {
    header.classList.toggle("open");
    if (header.classList.contains('open')) {
      overlay.classList.remove("fade-out");
      overlay.classList.add("fade-in");
      body.classList.add('noscroll');
    } else {
      overlay.classList.remove("fade-in");
      overlay.classList.add("fade-out");
      body.classList.remove('noscroll');
    }
  });
}

const owner_setup = () => {
    const content = document.querySelector('.profile__content'),
        dash_buttons = document.querySelectorAll('.profile__nav__link.main'),
        profileTitle = document.querySelector('.profile__title .profile_text'),
        logoutButton = document.querySelector('.profile__nav__link.logout'),
        cancelLogout = document.querySelector('.selection .cancel'),
        logoutCont = document.querySelector('.logout__cont'),
        profileLogout = document.querySelector('.profile__logout');


    dash_buttons.forEach(button => {
        if (button.classList.contains('main')) {
            button.addEventListener('click', () => {
                switchModal(button, content);
                resetClassMain();
                button.classList.add('active');
                switch (button.querySelector('p.text').textContent) {
                    case 'Pending Inspection':
                        profileTitle.textContent = 'Nurseries Awaiting Inspection';
                        break;
                    case 'My Applications':
                    case 'View Applications':
                    case 'Inspected Nurseries':
                        profileTitle.textContent = '';
                        break;
                    default: profileTitle.textContent = button.querySelector('p.text').textContent;
                }
            });
        }
    });

    dash_buttons[0].click(); //load dash on window load


    logoutButton.addEventListener('click', () => {
        if (logoutCont !== null) {
            logoutCont.classList.remove('hide');
        }
    });

    profileLogout.addEventListener('click', () => {
        if (logoutCont !== null) {
            logoutCont.classList.remove('hide');
        }
    });


    cancelLogout.addEventListener('click', () => {
        if (logoutCont !== null) {
            logoutCont.classList.add('hide')
        }
    });


    // toggle active class between dashboard buttons

    function resetClassMain() {
        dash_buttons.forEach(button => {
            if (button.classList.contains('active')) {
                button.classList.remove('active');
            }
        });
    }

}

// to be used to fetch nursery data for view nurseries modal
function appPost() {
    const showBtn = document.querySelectorAll('.app__table .view__button');
    // countPop = document.querySelector('.profile__nav__link .count'),
    // countText = countPop.querySelector('p'),
    // dashButtons = document.querySelectorAll('.profile__nav__link.main');
    let butId = "";

    showBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            butId = btn.getAttribute('id');
            console.log('clicked show button');
            let name = btn.parentElement.parentElement.querySelector('.column2').textContent;

            // const btnRow = btn.parentNode.parentNode;


            expandNurseryData(getData(butId), name);
        });
    });

    //remove popup
    // dashButtons.forEach(btn => {
    //     if (!btn.getAttribute('class').includes('active') && btn.getAttribute('id') != 'dash_4') {
    //         btn.addEventListener('click', () => {
    //             countPop.classList.add('hide');
    //         });
    //     }
    // });

    function getData(butId) {
        return data = {
            reg_num: butId
        };
    }

}

// to be called after view button click to fetch nursery data
function expandNurseryData(data, name) {
    data['showNursery'] = true;

    const url = '../config/apis/show_nurseries_ajax.php';

    let params = Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        const res = JSON.parse(this.responseText);
        console.log(res[0]);
        showNurseryDetails();

        function showNurseryDetails() {
            const modal = document.querySelector('.nurs__expand'),
                close = document.querySelector('.nurs__close'),
                header = document.querySelector('.nurs__header p'),
                nursContent = document.querySelector('.nurs__content'),
                specContent = document.querySelector('.species__content');

            close.addEventListener('click', () => {
                modal.classList.add('hide');
            });

            if (res[0]) {
                modal.classList.remove('hide');
                header.textContent = name;
                nursContent.innerHTML = res[1][0];
                specContent.innerHTML = res[1][1];

                let cat = nursContent.querySelector('.cat__name p'),
                    catVal = cat.textContent;
                activateLabel(cat, catVal);
            } else {
                modal.classList.remove('hide');
                modal.innerHTML = "<h1>ERROR FETCHING DETAILS</h1>";
            }


            function activateLabel(subLabel, val) {
                switch (val) {
                    case "1":
                        subLabel.innerText = "Institution-Government";
                        break;
                    case "2":
                        subLabel.innerText = "institution-NGOs";
                        break;
                    case "3":
                        subLabel.innerText = "Community Forest Association";
                        break;
                    case "4":
                        subLabel.innerText = "Timber manufacturers Association";
                        break;
                    case "5":
                        subLabel.innerText = "Others";
                        break;
                    case "6":
                        subLabel.innerText = "Individual";
                        break;
                    case "7":
                        subLabel.innerText = "Women & Youth";
                        break;
                    case "8":
                        subLabel.innerText = "Company";
                        break;
                    case "9":
                        subLabel.innerText = "learning Institution";
                        break;
                    case "10":
                        subLabel.innerText = "Tree Growers Association";
                        break;
                    case "11":
                        subLabel.innerText = "Faith Based Organisation";
                        break;
                    case "12":
                        subLabel.innerText = "Community Based Organisations";
                        break;
                }
            }

        }
        // console.log(res);
        // let apply_button = document.querySelector('div#dash_3');
        // if (apply_button !== null) {
        //     const x = setTimeout(() => {
        //         apply_button.click();
        //     }, 3000);
        // } else {
        //     console.log('couldn\'t find the button');
        // }
    }

    xhr.send(params);
}


// show species modal 
// species add list creation
function remove(someId) {
    const selects = document.querySelectorAll('.input-group select');
    let id = someId.substr(5),
        species = document.querySelector('.group'),
        lastSpecies;
        speciesGroup = document.querySelector('#grp-' + id);
        if (species.children.length == 1) {
            species.children[0].querySelectorAll('.mySpecies').forEach(someTag => {
                if (!someTag.hasAttribute('type')) {
                   someTag.querySelector('option').selected = 'true';
                   someTag.style.color = 'lightgrey';
                }
                else {
                    someTag.value = "";
                }
            });
        } else {
        species.removeChild(speciesGroup);
        if (species.children.length > 1) {
            lastSpecies = species.lastElementChild;
        } else {
            lastSpecies = species.children[0];
        }

        //console.log(id);
        lastSpecies.querySelector('.add').disabled = false;
        lastSpecies.querySelector('.add').style.color = 'green';
    }
}

function populate(someId) {
    let id = someId.substr(3),
        speciesGroup = document.querySelector('#grp-' + id);
        //console.log(id);
    function checkEmpty() {
        let stopFlag = 0;
        speciesGroup.querySelectorAll('input').forEach(input => input.value.trim() ? null : stopFlag = 1);
        speciesGroup.querySelectorAll('select').forEach(select => select.value == "" ? stopFlag = 1 : null);
        return stopFlag;
    }
    if (!checkEmpty()) {
    let species = document.querySelector('.group'),
        add = document.querySelectorAll('.add'),
        maxId = 0,
        nextId = 0;
        //catch all button ids
        allAddIds = [];
        add.forEach(addBtn => {
            allAddIds.push(addBtn.id.substr(3));
        });
        maxId = Math.max(...allAddIds);
        // console.log('maxId:', maxId);
        nextId = ++maxId;

        let speciesGroupClone = speciesGroup.cloneNode(true);
        speciesGroupClone.querySelectorAll('select').forEach(select => {
            if (!select.value) {
                if (select.classList.contains('read')) {
                    select.classList.remove('read');
                    select.classList.add('write');
                    // select.style.color = "lightgrey";
                    select.addEventListener('change', () => {
                        select.style.color = '#6E6E6E';
                    });
                } else {
                    select.style.color = "lightgrey";
                    select.addEventListener('change', () => {
                        select.style.color = '#6E6E6E';
                    });
                }
            }
        });

        speciesGroupClone.setAttribute('id', 'grp-'+nextId);
        speciesGroupClone.querySelector('.add').setAttribute('id', 'add' + nextId);
        speciesGroupClone.querySelector('.minus').setAttribute('id', 'minus' + nextId);
        speciesGroupClone.querySelector('.minus').disabled = false;
        speciesGroupClone.querySelectorAll('input').forEach((input)=>{
            input.value="";
        });

        species.appendChild(speciesGroupClone);


        speciesGroup.querySelector('.add').disabled = true;
        speciesGroup.querySelector('.add').style.color = '#aaa';
        species.lastChild.querySelector('.species-input').focus();
    }

}

//show reports modal
function showReports() {
    const report = document.querySelector('.app__iframe__container'),
        closeReport = document.querySelector('.iframe__close');
    report.classList.remove('hide');

    closeReport.addEventListener('click', () => {
        report.classList.add('hide');
    });
}

// activate feedback
function activateFeedBack() {
    let showFeed = document.querySelectorAll('.view__feedback'),
        iframe = document.querySelector('iframe.feedback');

    showFeed.forEach(btn => {
        btn.addEventListener('click', () => {
            let btnId = btn.getAttribute('id'),
                appSpan = document.querySelector('span.app_id');
            appSpan.textContent = btnId;
            showFeedback();
            iframe.src = iframe.src;
        });
    });
}

//show feedback modal
function showFeedback() {
    const feedback = document.querySelector('.feedback__iframe__container'),
        closeFeedback = document.querySelector('.iframe__close.feedback'),
        iframeLoader = document.querySelector('.iframe__loader');

    feedback.classList.remove('hide');

    iframeLoader.classList.add('hide');
    const x = setTimeout(() => {
        iframeLoader.style.display = 'none';
    }, 2000);

    closeFeedback.addEventListener('click', () => {
        feedback.classList.add('hide');
        iframeLoader.style.display = 'flex';
    });
}

// retrieve feedback data to show
function acquireFeedback(btnId) {
    const url = `../../../config/apis/fetch_feedback_ajax.php`;
    let data = {};
    btnId = btnId.split('-')[1];

    data['app_id'] = btnId;

    let params = Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        //console.log(JSON.parse(this.responseText));
        const data = JSON.parse(this.responseText),
            feedbackCont = document.querySelector('.report__container.feedback'),
            nurs_name = document.querySelector('.nurs__details .nurs__name'),
            reg_numSpan = document.querySelector('.nurs__details span.reg_num');

        if (data[0]) {
            feedbackCont.innerHTML = data[1][3];
            nurs_name.textContent = data[1][1];
            reg_numSpan.textContent = data[1][0];

        }


    }

    xhr.send(params);
}

// set globals for admin & owner dash tiles
var global_assigned_admin = 0,
    global_uninspected_admin = 0,
    global_inspected_admin = 0,
    global_certified_admin = 0,
    global_rejected_admin = 0,
    global_certified_owner = 0,
    global_rejected_owner = 0,
    global_awaiting_insp_owner = 0,
    global_cert_inspec = 0,
    global_rej_inspec = 0;

//set globals for side nav owner
let activeNav = '';

//reset globals

function resetGlobals() {
    global_assigned_admin = 0;
    global_uninspected_admin = 0;
    global_inspected_admin = 0;
    global_certified_admin = 0;
    global_rejected_admin = 0;
    global_certified_owner = 0;
    global_rejected_owner = 0;
    global_awaiting_insp_owner = 0;
    global_cert_inspec = 0;
    global_rej_inspec = 0;
}


// auto filter owner & ad for dashboard - status & single field search
function autoFilter(globals, classname, certGlobals) {
    let allRows = document.querySelectorAll('tr.data'),
        profileText = document.querySelector('.profile_text');
    if (globals) {
        if (certGlobals == 'cert') {
            profileText.textContent = "Certified Applications";
        } else if (certGlobals == 'rej') {
            profileText.textContent = "Declined Applications";
        } else if (certGlobals == 'pen') {
            profileText.textContent = "Awaiting Inspection";
        } else if (certGlobals == 'ass') {
            profileText.textContent = "Assigned Nurseries";
        } else if (certGlobals == 'insp') {
            profileText.textContent = "Inspected Nurseries";
        }

        allRows.forEach(row => {
            let cells = row.querySelectorAll(`td.${classname}`)
            cells.forEach(cell => {
                if (!(classname == 'status')) {
                    if (cell.textContent == "__") {
                        row.classList.add('hide');
                    }
                } else if (certGlobals == 'pen') {
                    if (!(cell.textContent == "pending")) {
                        row.classList.add('hide');
                    }
                } else if (certGlobals == 'cert') {
                    if (!(cell.textContent == "certified")) {
                        row.classList.add('hide');
                    }
                } else if (certGlobals == 'rej') {
                    if (!(cell.textContent == "declined")) {
                        row.classList.add('hide');
                    }
                }
            });
        });

        if (!tableData(allRows)) {
            noDataToShow(1)
        }
        resetGlobals();
    }
}


// check if table has data
function tableData(allRows) {
    let count = 0;
    allRows.forEach(row => {
        if (!row.classList.contains('hide')) {
            count++;
        }
    });
    return count;
}

// auto-filter 2 params dashboard tiles date-search
function autoFilter_2(globals, classname_1, classname_2, certGlobals = 0) {
    let dateAss = document.querySelectorAll(`tr.data td.${classname_1}`),
        dateInsp = document.querySelectorAll(`tr.data td.${classname_2}`),
        allRows = document.querySelectorAll('tr.data'),
        profileText = document.querySelector('.profile_text');

    if (globals) {
        if (certGlobals == "awaitInsp") {
            profileText.textContent = "Awaiting Inspection";
        }
        for (let i = 0; i < dateAss.length; i++) {
            if (dateAss[i].textContent == '__') {
                dateAss[i].parentElement.classList.add('hide');
            } else if (dateInsp[i].textContent !== '__') {
                dateInsp[i].parentElement.classList.add('hide');
            }
        }
        if (!tableData(allRows)) {
            noDataToShow(1);
        }
        resetGlobals();
    }

}

function noDataToShow(toggle) {
    let appEmpty = document.querySelector('.app__table tr.app__empty');
    if (toggle) {
        if (appEmpty.classList.contains('d_none')) {
            appEmpty.classList.remove('d_none');
        }
    } else {
        if (!appEmpty.classList.contains('d_none')) {
            appEmpty.classList.add('d_none');
        }
    }
}










