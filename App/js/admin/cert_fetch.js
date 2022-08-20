function cert_fetch() {
    const url = '../config/apis/certified_cert.php';

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

            

            // activateFeedBack();
            function showDetails() {
                let allRows = document.querySelectorAll('tr.data'),
                    viewReg = document.querySelector('.cert__content .reg .cont'),
                    viewName = document.querySelector('.cert__content .name .cont'),
                    viewCat = document.querySelector('.cert__content .category .cont'),
                    viewRate = document.querySelectorAll('.cert__content .rating .cont i'),
                    viewCert = document.querySelector('Button.view__certificate'),
                    certMask = document.querySelector('.cert__mask'),
                    badge = document.querySelector('.view__cert .badge'),
                    iframe = document.querySelector('.app__iframe__container.certificate iframe');


                allRows.forEach(row => {
                    row.addEventListener('click', () => {
                       let reg = row.querySelector('td.column1').textContent,
                           name = row.querySelector('td.column2').textContent,
                           class_ = row.querySelector('td.column5').textContent,
                           rating = (row.querySelector('td.column4').textContent).split("-")[0];
                        viewReg.textContent = reg;
                        viewName.textContent = name;
                        viewCat.textContent = class_;
                        // viewRate.textContent = rating;
                        console.log(viewCat);
                        for (let i = 0; i < parseInt(rating); i++) {
                            viewRate[i].classList.add('active');
                        }

                        if (class_ == "1") {
                            badge.setAttribute('class', "badge");
                            badge.classList.add('class__1');
                        } else if (class_ == "2") {
                            badge.setAttribute('class', "badge");
                            badge.classList.add('class__2');
                        } else if (class_ == "3") {
                            badge.setAttribute('class', "badge");
                            badge.classList.add('class__3');
                        } else {
                            null;
                        }
                        if (!certMask.classList.contains('hide')) {
                            certMask.classList.add('hide');
                        }
                        resetRows(allRows);
                        row.classList.toggle('selected');
                        iframe.src = iframe.src;
                    });
                });

                viewCert.addEventListener('click', () => {
                   showReports();
              
                });

              
    


            }

            function resetRows(someArr) {
                someArr.forEach(el => {
                    if (el.classList.contains('selected')) {
                        el.classList.remove('selected');
                    }
                });
            }

            showDetails();

        } else {
            app.classList.add('hide');
            zeroCont.classList.remove('hide');
        }

       
        
    }

    xhr.send();
}






