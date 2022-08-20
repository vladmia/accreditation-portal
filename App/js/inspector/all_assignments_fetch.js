function fetchAll() {
    const url = '../config/apis/fetch_assignments_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        const data = JSON.parse(this.responseText),
            tbody = document.querySelector('#tbody'),
            app = document.querySelector('.app'),
            zeroCont = document.querySelector('.zero__content'),
            print = document.querySelector('.printMe'); 
            // console.log(data[1].length);          

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
            // activate feedback
            activateFeedBack();
        } else {
            app.classList.add('hide');
            zeroCont.classList.remove('hide');
        }
       
    }

    xhr.send();
}