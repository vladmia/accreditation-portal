function app_fetch() {
    const profileText = document.querySelector('.profile_text');

    const url = '../config/apis/fetch_app_admin_ajax.php';

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
        if (data[1].includes('<tr class=\"data ')) {
            tbody.innerHTML = data[1];
            if (app.classList.contains('hide')) {
                app.classList.remove('hide');
                zeroCont.classList.add('hide');
            }

            activateFeedBack();
            
            profileText.textContent = "All Applications";


            //run auto-filter
            autoFilter(global_assigned_admin, 'date__ass', 'ass');
            autoFilter(global_inspected_admin, 'date__inspected', 'insp');
            autoFilter_2(global_uninspected_admin, 'date__ass', 'date__inspected', 'awaitInsp');
            autoFilter(global_certified_admin, 'status', 'cert');
            autoFilter(global_rejected_admin, 'status', 'rej');

            
          
            print.addEventListener('click', () => {
                showReports();
            });

            

        } else {
            app.classList.add('hide');
            zeroCont.classList.remove('hide');
        }

       
        
    }

    xhr.send();
}






