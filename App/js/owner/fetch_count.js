function countFetch() {

    const url = '../config/apis/fetch_count_owner_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        const data = JSON.parse(this.responseText),
            reg = document.querySelector('span#registered'),
            app = document.querySelector('span#applied'),
            unApp = document.querySelector('span#unapplied'),
            awaiting = document.querySelector('span#awaiting'),
            cert = document.querySelector('span#certified'),
            dec = document.querySelector('span#declined'),
            count = document.querySelector('.profile__nav__link .count p'),
            regTile = document.querySelector('#dash__reg'),
            appTile = document.querySelector('#dash__app'),
            unAppTile = document.querySelector('#dash__unapp'),
            awaitTile = document.querySelector('#dash__await'),
            certTile = document.querySelector('#dash__cert'),
            decTile = document.querySelector('#dash__dec'),
            myAppNav = document.querySelector('#dash_4'),
            myNursNav = document.querySelector('#dash_5'),
            getCertNav = document.querySelector('#dash_3'),
            appBtns = [appTile, awaitTile, certTile, decTile];


        reg.textContent = data[1][0];
        app.textContent = data[1][1];
        unApp.textContent = data[1][2];
        count.textContent = data[1][1];
        awaiting.textContent = data[1][3];
        cert.textContent = data[1][4];
        dec.textContent = data[1][5];

        // add event listeners
        listen(regTile, () => {
            runCallBack('myNurs');
        });

        listen(unAppTile, () => {
            runCallBack('getCert');
        });




        appBtns.forEach(btn => {
            listen(btn, () => {
                if (btn == awaitTile) {
                    global_awaiting_insp_owner = 1;
                } else if (btn == certTile) {
                    global_certified_owner = 1;
                } else if (btn == decTile) {
                    global_rejected_owner = 1;
                }
                runCallBack('myApp');
            });
        });

        // listener functions
        function listen(btn, callback) {
            btn.addEventListener('click', callback);
        }

        function runCallBack(string) {
            if (string == 'myApp') {
                myAppNav.click();
            } else if (string == 'getCert') {
                getCertNav.click();
            } else {
                myNursNav.click();
            }
        }
    }

    xhr.send();
}