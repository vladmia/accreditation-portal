function app_fetch() {
    const countPop = document.querySelector('.profile__nav__link .count'),
        dashButtons = document.querySelectorAll('.profile__nav__link.main'),
        profileText = document.querySelector('.profile_text');


    countPop.classList.remove('hide');



    const url = '../config/apis/fetch_app_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        //console.log(JSON.parse(this.responseText));
        const data = JSON.parse(this.responseText),
            tbody = document.querySelector('#tbody'),
            app = document.querySelector('.app'),
            zeroCont = document.querySelector('.zero__content'),
            print = document.querySelector('.printMe');

        // console.log(data[1].length);          

        // check data[1].length > 0? 
        if (data[1].includes('<tr class="data ')) {
            tbody.innerHTML = data[1];
            if (app.classList.contains('hide')) {
                app.classList.remove('hide');
                zeroCont.classList.add('hide');
            }

            profileText.textContent = "All Applications";
            //run auto-filter
            autoFilter(global_awaiting_insp_owner, 'status', 'pen');
            autoFilter(global_certified_owner, 'status', 'cert');
            autoFilter(global_rejected_owner, 'status', 'rej');

            print.addEventListener('click', () => {
                showReports();
            });

            // activate feedback
            activateFeedBack();


            //update countpop value
            let allRows = document.querySelectorAll('tr.data'),
                filteredRows = document.querySelectorAll('tr.data.hide'),
                intactRows = allRows.length - filteredRows.length;
            countPop.querySelector('p').textContent = intactRows;

        } else {
            app.classList.add('hide');
            zeroCont.classList.remove('hide');

            let appButton = document.querySelector('.applyCert'),
                appNursery = document.querySelector('.profile__nav__link.main#dash_3');
            if (appButton) {
                appButton.addEventListener('click', () => {
                    appNursery.click();
                });
            }
        }

        //remove popup
        dashButtons.forEach(btn => {
            if (!btn.getAttribute('class').includes('active') && btn.getAttribute('id') != 'dash_4') {
                btn.addEventListener('click', () => {
                    countPop.classList.add('hide');
                });
            }
        });
    }

    xhr.send();
}




