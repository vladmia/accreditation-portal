function unApp_fetch() {

    const url = '../config/apis/fetch_unapplied_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        //console.log(JSON.parse(this.responseText));
        const data = JSON.parse(this.responseText),
            tbody = document.querySelector('#tbody'),
            app = document.querySelector('.app'),
            zeroCont = document.querySelector('.zero__content');
          
        // console.log(data[1].length);

        // check data[1].length > 0? 
        if (data[1].includes('<tr class=\"data ')) {
            tbody.innerHTML = data[1];
            if (app.classList.contains('hide')) {
                app.classList.remove('hide');
                zeroCont.classList.add('hide');
            }
            
        } else {
            app.classList.add('hide');
            zeroCont.classList.remove('hide');

            let regButton = document.querySelector('.registerNursery'),
                regNursery = document.querySelector('.profile__nav__link.main#dash_2');
            if(regButton) {
                regButton.addEventListener('click', () => {
                    regNursery.click();
                });
            }
        }

        
        appPost();
      
    }

    xhr.send();

    function appPost() {
        console.log('called apppost');
        const applyBtn = document.querySelectorAll('.button.apply_button'),
            countPop = document.querySelector('.profile__nav__link .count'),
            countText = countPop.querySelector('p'),
            dashButtons = document.querySelectorAll('.profile__nav__link.main');
        let butId = "";
    
        applyBtn.forEach(btn => {
            btn.addEventListener('click', () => {
                butId = btn.getAttribute('id');
                const btnRow = btn.parentNode.parentNode;
    
                // console.log(butId);
                countPop.classList.remove('hide');
                countPop.classList.add('frame');
                countText.textContent = parseInt(countText.textContent) + 1;
                btnRow.classList.add('applied');
    
                btnRow.textContent = '';
                const t = setTimeout(() => {
                    countPop.classList.remove('frame');
                }, 1000);
                postNurseryData(getData(butId));
            });
        });
    
        //remove popup
        dashButtons.forEach(btn => {
            if (!btn.getAttribute('class').includes('active') && btn.getAttribute('id') != 'dash_4') {
                btn.addEventListener('click', () => {
                    countPop.classList.add('hide');
                });
            }
        });
    
        function getData(butId) {
            return data = {
                reg_num: butId
            };
        }
    
        function postNurseryData(data) {
            data['applyNursery'] = true;
    
            const url = '../config/apis/apply_nursery_ajax.php';
    
            let params = Object.keys(data).map(function (k) {
                return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
            }).join('&');
    
            var xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
            xhr.onload = function () {
                const res = JSON.parse(this.responseText);
                console.log(res);
                // console.log(res);
                let apply_dash = document.querySelector('div#dash_3');
                if (apply_dash !== null) {
                    const x = setTimeout(() => {
                        apply_dash.click();
                    }, 3000);
                } else {
                    console.log('couldn\'t find the button');
                }
            }
    
            xhr.send(params);
        }
    
    
    }

}




