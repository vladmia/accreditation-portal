function countFetch() {

    const url = '../config/apis/fetch_count_admin_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        const data = JSON.parse(this.responseText),
            unass = document.querySelector('span#unass'),
            total = document.querySelector('span#total'),
            awaiting = document.querySelector('span#awaiting'),
            assigned = document.querySelector('span#assigned'),
            pending = document.querySelector('span#pending'),
            complete = document.querySelector('span#complete'),
            registered = document.querySelector('span#registered'),
            certified = document.querySelector('span#certified'),
            declined = document.querySelector('span#declined'),
            regTile = document.querySelector('#dash__reg'), //pick
            totalTile = document.querySelector('#dash__total'),
            unassTile = document.querySelector('#dash__unass'),
            assTile = document.querySelector('#dash__ass'),
            awaitTile = document.querySelector('#dash__await'),
            completeTile = document.querySelector('#dash__complete'),
            ownersTile = document.querySelector('#dash__owners'),
            certTile = document.querySelector('#dash__cert'),
            rejTile = document.querySelector('#dash__rej'),
            viewNursNav = document.querySelector('#dash_7'),
            assignNav = document.querySelector('#dash_2'),
            viewAppNav = document.querySelector('#dash_3'),
            viewInspNav = document.querySelector('#dash_4'),
            viewOwnersNav = document.querySelector('#dash_5'),
            appBtns = [totalTile, assTile, awaitTile, completeTile, certTile, rejTile];


        unass.textContent = data[1][0];
        total.textContent = data[1][1];
        awaiting.textContent = data[1][2];
        assigned.textContent = data[1][3];
        pending.textContent = data[1][4];
        complete.textContent = data[1][5];
        registered.textContent = data[1][6];
        certified.textContent = data[1][7];
        declined.textContent = data[1][8];


        // add event listeners
        listen(regTile, () => {
            runCallBack('registeredNurs');
        });

        listen(unassTile, () => {
            runCallBack('assign');
        });

        listen(ownersTile, () => {
            runCallBack('owners');
        });

        appBtns.forEach(btn => {
            listen(btn, () => {
                if (btn == assTile) {
                    global_assigned_admin = 1;
                } else if (btn == awaitTile) {
                    global_uninspected_admin = 1;
                } else if (btn == completeTile) {
                    global_inspected_admin = 1;
                } else if (btn == certTile) {
                    global_certified_admin = 1;
                } else if (btn == rejTile) {
                    global_rejected_admin = 1;
                }
                runCallBack('viewApps');
               
            });
        });

        // listener functions
        function listen(btn, callback) {
            btn.addEventListener('click', callback);
        }

        function runCallBack(string) {
            if (string == 'registeredNurs') {
                viewNursNav.click(); 
            } else if (string == 'assign') {
                assignNav.click();
            } else if (string == 'owners') {
                viewOwnersNav.click();
            } else {
                viewAppNav.click();
            }
        }

    }

    xhr.send();
}