function fetch_unass() {

    function assign() {

        const nurseryRows = document.querySelectorAll('tr.data'),
            assignForm = document.querySelector('#assignForm');

        assignForm.addEventListener('submit', (e) => {
            e.preventDefault();
            postData(getData());
            nurseryRows.forEach(row => {
                if (row.querySelector('select').value) {
                    row.classList.add('assigned');
                    row.textContent = '';
                }
            });
        });

        function getData() {
            // data to capture: regNum & evalId
            let reg = [],
                eval = [],
                hasData = false;
                console.log(nurseryRows);
            nurseryRows.forEach(row => {
                if (row.querySelector('select').value) {
                    hasData = true;
                    reg.push(row.querySelector('td.reg').textContent);
                    eval.push(row.querySelector('select').value);
                }
            });
            if (hasData) {
                return data = {
                    reg: reg,
                    eval: eval
                };
            } else {
                return data = false;
            }
        }

        function postData(data) {
            if (data) {
                data['assignEval'] = true;

                const url = '../config/apis/assign_inspector_activate_ajax.php';

                let params = Object.keys(data).map(function (k) {
                    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
                }).join('&');

                var xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onload = function () {
                    const res = JSON.parse(this.responseText);
                    let t = setTimeout(() => {
                        document.querySelector('#dash_2').click();
                    }, 3000);
                    console.log(res);
                }

                xhr.send(params);
            } else {
                console.log('no evaluator assigned');
            }
        }
    }


    const url = '../config/apis/assign_inspector_layout_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        const data = JSON.parse(this.responseText),
            unass = document.querySelector('#tbody'),
            app = document.querySelector('.app'),
            zeroCont = document.querySelector('.zero__content');

        // check data[1].length > 0? 
        if (data[1].includes('<tr class=\"data ')) {
            unass.innerHTML = data[1];
            if (app.classList.contains('hide')) {
                app.classList.remove('hide');
                zeroCont.classList.add('hide');
            }
            appPost();
        } else {
            app.classList.add('hide');
            zeroCont.classList.remove('hide');
        }

        //console.log('got some data');

        assign();
    }

    xhr.send();
}

