function countFetch() {

    const url = '../config/apis/fetch_count_inspector_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        const data = JSON.parse(this.responseText),
            unins = document.querySelector('span#uninspected'),
            ins = document.querySelector('span#inspected'),
            total = document.querySelector('span#total'),
            cert = document.querySelector('span#cert'),
            dec = document.querySelector('span#rej'),
            uninsTile = document.querySelector('#dash__unins'), //pick
            inspTile = document.querySelector('#dash__insp'),
            totalTile = document.querySelector('#dash__total'),
            certTile = document.querySelector('#dash__cert'),
            rejTile = document.querySelector('#dash__rej'),
            penNav = document.querySelector('#dash_2'),
            inspNav = document.querySelector('#dash_3'),
            totalNav = document.querySelector('#dash_4'),
            appBtns = [inspTile, certTile, rejTile];



        // fill dashboard tiles

        unins.textContent = data[1][0];
        ins.textContent = data[1][1];
        total.textContent = data[1][2];
        cert.textContent = data[1][3];
        dec.textContent = data[1][4];

        // add event listeners
        listen(uninsTile, () => {
            runCallBack('unins');
        });

        listen(totalTile, () => {
            runCallBack('total');
        });

        appBtns.forEach(btn => {
            listen(btn, () => {
                if (btn == certTile) {
                    global_cert_inspec = 1;
                } else if (btn == rejTile) {
                    global_rej_inspec = 1;
                } 
                runCallBack('insp');
            });
        });

        // listener functions
        function listen(btn, callback) {
            btn.addEventListener('click', callback);
        }

        function runCallBack(string) {
            if (string == 'unins') {
                penNav.click();
            } else if (string == 'total') {
                totalNav.click();
            } else {
                inspNav.click();
            }
        }

    }

    xhr.send();
}