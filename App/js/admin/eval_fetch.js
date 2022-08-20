function eval_fetch() {

    const url = '../config/apis/fetch_inspectors_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        //console.log(JSON.parse(this.responseText));
        const data = JSON.parse(this.responseText),
            tbody = document.querySelector('#tbody'),
            app = document.querySelector('.app'),
            zeroCont = document.querySelector('.zero__content'),
            print = document.querySelector('.printMe');
        console.log(data[1].length);

        // check data[1].length > 0? 
        if (data[1].includes('<tr class=\"data ')) {
            tbody.innerHTML = data[1];
            if (app.classList.contains('hide')) {
                app.classList.remove('hide');
                zeroCont.classList.add('hide');
            }
            print.addEventListener('click', () => {
                showReports();
            });

            function setStatus() {
                let switches = document.querySelectorAll('.switch input[type=checkbox]');
                switches.forEach(checkbox => {
                    checkbox.addEventListener('change', () => {
                        let parentRow = checkbox.parentElement.parentElement.parentElement,
                            parentSwitch = checkbox.parentElement,
                            checkID = checkbox.getAttribute('id');
                        parentRow.classList.toggle('active');
                        parentRow.classList.toggle('inactive');
                        parentSwitch.classList.toggle('activated');
                        console.log(checkbox.checked);
                        actualSet(checkID);
                    });
                });

                function actualSet(id) {
                    const url = `../config/apis/eval_set_status.php?evID=${id}`;

                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', url, true);

                    xhr.onload = function () {
                        const data = JSON.parse(this.responseText);
                        console.log(data);
                    }

                    xhr.send();
                }

            }

            setStatus();

        } else {
            app.classList.add('hide');
            zeroCont.classList.remove('hide');
        }

    }

    xhr.send();
}



