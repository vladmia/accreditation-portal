function fetchInspected() {
    const profileText = document.querySelector('.profile_text');
    const url = '../config/apis/fetch_inspected_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        const data = JSON.parse(this.responseText),
            tbody = document.querySelector('#tbody'),
            app = document.querySelector('.app'),
            zeroCont = document.querySelector('.zero__content'),
            print = document.querySelector('.printMe');
        // console.log(data[1]);          

        // check data[1].length > 0? 
        if (data[1].includes('<tr class=\"data ')) {
            tbody.innerHTML = data[1];
            if (app.classList.contains('hide')) {
                app.classList.remove('hide');
                zeroCont.classList.add('hide');
            }

            profileText.textContent = "Inspected Nurseries"; // prevent textcontent change glitch

            autoFilter(global_cert_inspec, 'status', 'cert');
            autoFilter(global_rej_inspec, 'status', 'rej');

            print.addEventListener('click', () => {
                showReports();
            });
            // activate feedback
            activateFeedBack();
        } else {
            app.classList.add('hide');
            zeroCont.classList.remove('hide');
        }

    }

    xhr.send();
}