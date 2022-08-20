function register(populate, remove) {
    /* event listeners */
    const countySelect = document.querySelector('select[name=county]'),
        nurseryRegForm = document.querySelector('#nurseryReg'),
        nurseryUpForm = document.querySelector('#nurseryUp'),
        selects = document.querySelectorAll('select');

    //change select color
    selects.forEach(select => {
        select.addEventListener('change', () => {
            select.style.color = "#6E6E6E";
        });
    });
if (countySelect) {
    countySelect.addEventListener('change', () => {
        let countyVal = document.querySelector('select[name=county]').value;
        postCounty(countyVal);
    });
}
   

    if (checkNull(nurseryRegForm))
        nurseryRegForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // console.log('vlad\'s nursery');
            postNurseryData(getData());
        });
    if (checkNull(nurseryUpForm))
        nurseryUpForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // console.log('vlad\'s nursery');
            upNurseryData(getUpData());
        });




    /* handle nursery posts */

    function postNurseryData(data) {
        data['regNursery'] = true;

        // let error = document.querySelector('div.errors');

        const url = '../config/apis/reg_nursery_ajax.php';

        let params = Object.keys(data).map(function (k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }).join('&');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            const res = JSON.parse(this.responseText);
            console.log(res);
            if (res[0]) {
                document.querySelector('.confirm-wrap').classList.remove('hide');
                document.querySelector('form').reset();
                let t = setTimeout(() => {
                    document.querySelector('#dash_3').click();
                }, 2000);
            }

        }
        xhr.send(params);
    }

    /* handle nursery ups */

    function upNurseryData(data) {
        data['upNursery'] = true;

        // let error = document.querySelector('div.errors');

        const url = '../config/apis/up_nursery_ajax.php';

        let params = Object.keys(data).map(function (k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }).join('&');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            const res = JSON.parse(this.responseText);
            console.log(res);

            if (res[0]) {
                document.querySelector('.confirm-wrap p').textContent = res[1][0];


                let x = setInterval(() => {
                    document.querySelector('.confirm-wrap').classList.remove('hide');
                    clearInterval(x);
                }, 20);

                let t = setTimeout(() => {
                    document.querySelector('#dash_5').click();
                }, 3000);
            }

        }
        xhr.send(params);
    }

    function getData() {
        let man = document.querySelector('input[name=manager]').value,
            manPhone = document.querySelector('input[name=manager_phone]').value,
            nursery = document.querySelector('input[name=nurseryname]').value,
            category = document.querySelector('select[name=nursery_category]').value,
            subCat = document.querySelector('input[name=sub_category]').value,
            yoe = document.querySelector('input[name=YoE]').value,
            area = document.querySelector('input[name=area]').value,
            purpose = document.querySelector('select[name=purpose]').value,
            capacity = document.querySelector('select[name=capacity]').value,
            county = document.querySelector('select[name=county]').value,
            subCounty = document.querySelector('select[name=subcounty]').value,
            town = document.querySelector('input[name=town]').value,
            gps = document.querySelector('input[name=gps]').value,
            kfs = document.querySelector('select[name=kfs_registered]').value,
            speciesCat = document.querySelectorAll('select.speciesCat'),
            speciesName = document.querySelectorAll('select.species'),
            quantity = document.querySelectorAll('input.quantity-input'),
            source = document.querySelectorAll('input.seedsource-input'),
            specArr = [],
            specNameArr = [],
            quantArr = [],
            sourceArr = [];

        speciesCat.forEach(cat => specArr.push(cat.value));
        speciesName.forEach(name => specNameArr.push(name.value));
        quantity.forEach(quant => quantArr.push(quant.value));
        source.forEach(source => sourceArr.push(source.value));


        return data = {
            manager: man,
            manager_phone: manPhone,
            nurseryname: nursery,
            nursery_category: category,
            sub_category: subCat,
            YoE: yoe,
            area: area,
            purpose: purpose,
            capacity: capacity,
            county: county,
            subcounty: subCounty,
            town: town,
            gps: gps,
            kfs_registered: kfs,
            speciesCat: specArr,
            speciesName: specNameArr,
            quantity: quantArr,
            source: sourceArr
        };
    }

    function getUpData() {
        let man = document.querySelector('input[name=manager]').value,
            manPhone = document.querySelector('input[name=manager_phone]').value,
            area = document.querySelector('input[name=area]').value,
            purpose = document.querySelector('select[name=purpose]').value,
            capacity = document.querySelector('select[name=capacity]').value,
            reg = document.querySelector('label#regNum').textContent,
            //kfs = document.querySelector('select[name=kfs_registered]').value,

            speciesCat = document.querySelectorAll('select.speciesCat'),
            speciesName = document.querySelectorAll('select.species'),
            quantity = document.querySelectorAll('input.quantity-input'),
            source = document.querySelectorAll('input.seedsource-input'),

            specArr = [],
            specNameArr = [],
            quantArr = [],
            sourceArr = [];

        speciesCat.forEach(cat => specArr.push(cat.value));
        speciesName.forEach(name => specNameArr.push(name.value));
        quantity.forEach(quant => quantArr.push(quant.value));
        source.forEach(source => sourceArr.push(source.value));


        return data = {
            manager: man,
            manager_phone: manPhone,
            area: area,
            purpose: purpose,
            capacity: capacity,
            reg_num: reg,
            // kfs_registered: kfs,
            speciesCat: specArr,
            speciesName: specNameArr,
            quantity: quantArr,
            source: sourceArr
        };
    }


    function postCounty(countyData) {
        let data = {
            county: countyData
        }

        data['activated'] = true;

        const url = '../config/apis/sub_counties.php';

        let params = Object.keys(data).map(function (k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }).join('&');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            const res = JSON.parse(this.responseText);
            document.querySelector('select[name=subcounty]').innerHTML = res[1];
        }
        xhr.send(params);
    }

}


// check if null
function checkNull(obj) {
    return obj != null;
}

function setLabel() {
    const categoryName = document.querySelector('select#categoryname'),
        subLabel = document.querySelector('.subLabel');
    activateLabel();

    categoryName.addEventListener('change', () => {
        activateLabel();
    });
    function activateLabel() {
        switch (categoryName.value) {
            case "1":
                subLabel.innerText = "Institution name";
                break;
            case "2":
                subLabel.innerText = "Name of NGO";
                break;
            case "3":
                subLabel.innerText = "CFA Name";
                break;
            case "4":
                subLabel.innerText = "Name of TMA";
                break;
            case "5":
                subLabel.innerText = "Specify";
                break;
            case "6":
                subLabel.innerText = "Full Name(as appears on ID)";
                break;
            case "7":
                subLabel.innerText = "Women & Youth Name";
                break;
            case "8":
                subLabel.innerText = "Company Name";
                break;
            case "9":
                subLabel.innerText = "Institution Name";
                break;
            case "10":
                subLabel.innerText = "TGA Name";
                break;
            case "11":
                subLabel.innerText = "FBO Name";
                break;
            case "12":
                subLabel.innerText = "CBO Name";
                break;
        }
    }
}

function validateFormInput() {
    document.querySelector('.reg__input__group.btn a.button').addEventListener('click', showSpecies);


    function scrollContainer(direction) {
        const container = document.querySelector('.reg__container');
        if (direction == 'up') {
            container.scrollTop = 0;
        } else {
            container.scrollTop = container.clientHeight;
        }
    }
    function showSpecies() {
        if (inputValidation()) {
            document.querySelector('div.errors').classList.remove('hide');
            scrollContainer('up');
        } else {
            let dateNow = new Date(),
                mixedDate = dateNow.toLocaleString(),
                dateString = mixedDate.split(',')[0],
                dateArray = dateString.split('/'),
                dateInputString = dateInput.value,
                dateInputArray = dateInputString.split('-'),
                dateIrregularityCheck = false,
                yearDiff = dateArray[2] - dateInputArray[0],
                monthDiff = dateArray[1] - dateInputArray[1],
                dayDiff = dateArray[0] - dateInputArray[2];
            /*subtract both date arrays to check for irregularity */

            if (yearDiff < 0) {
                dateIrregularityCheck = true;
            } else if (yearDiff == 0) {
                if (monthDiff < 0) {
                    dateIrregularityCheck = true;
                } else if (monthDiff == 0) {
                    if (dayDiff < 0) {
                        dateIrregularityCheck = true;
                    }
                }
            }

            if (dateIrregularityCheck) {
                document.querySelector('div.errors p').textContent = 'There is an irregularity in the date entered';
                document.querySelector('div.errors').classList.remove('hide');
                scrollContainer('up');
            } else if (!checkPhone()) {
                document.querySelector('div.errors p').textContent = 'Invalid phone number format';
                document.querySelector('div.errors').classList.remove('hide');
            } else if (!checkArea()) {
                document.querySelector('div.errors p').textContent = 'Cannot accept the area value entered';
                document.querySelector('div.errors').classList.remove('hide');
            } else {
                console.log('accepted to move on');
                const regCont = document.querySelector('.reg__container');

                if (checkNull(regCont))
                    regCont.style.overflowY = 'scroll';

                scrollContainer('down');
            }
        }

        if (validationDisplay) {
            let x = setTimeout(() => {
                document.querySelector('div.errors').classList.add('hide');
            }, 4000);
        } else {
            console.log("");
        }
    }

    function checkPhone() {
        let reg = new RegExp("^[0-9]+[0-9]*$");
        const phone = document.querySelector('input[name=manager_phone]').value;
        if (reg.test(phone)) {
            return true;
        } else {
            return false;
        }
    }

    function checkArea() {
        let reg = new RegExp("^(0*[1-9][0-9]*(\.[0-9]+)?|0+\.[0-9]*[1-9][0-9]*)$");
        const area = document.querySelector('input[name=area]').value;
        if (reg.test(area)) {
            return true;
        } else {
            return false;
        }
    }




    const allInputs = document.querySelectorAll('.reg__input__group input'),
        allSelects = document.querySelectorAll('.reg__input__group select'),
        validationDisplay = document.querySelector('div.errors'),
        dateInput = document.querySelector('.reg__input__group.yoe input');

    allInputs.forEach((input) => {
        if (!input.classList.contains("gps")) {
            input.onblur = () => {
                if (input.value) {
                    input.style.border = "1px solid rgba(107, 49, 49, 0.5)";
                    if (input.parentElement.classList.contains('write')) {
                        input.style.border = "1px solid #7ac142";
                        input.style.boxShadow = "0px 0px 4px #7ac142";
                    }
                } else {
                    input.style.border = "2px solid red";
                    input.parentElement.querySelector('label span').style.display = 'flex';
                }

            }
        }

    });

    allSelects.forEach((select) => {
        select.onblur = () => {
            if (select.value) {
                select.style.border = "1px solid rgba(107, 49, 49, 0.5)";
                if (select.parentElement.classList.contains('write')) {
                    select.style.border = "1px solid #7ac142";
                }
            }
            else {
                select.style.border = "2px solid red";
                select.parentElement.querySelector('label span').style.display = 'flex';
            }
        }
    });

    function inputValidation() {
        let inputReturn = true,
            selectReturn = true;
        allInputs.forEach(input => {
            if (!input.classList.contains("gps")) {
                if (!input.value) {
                    inputReturn = false;
                    input.style.border = "2px solid rgba(255, 0, 0, 0.5)";
                    if (input.parentElement.classList.contains('write')) {
                        input.style.boxShadow = "0px 0px 4px rgba(255, 0, 0, 0.5)";
                    }
                    input.parentElement.querySelector('label span').style.display = 'flex';
                }
            }
        });
        allSelects.forEach(select => {
            if (!select.value) {
                selectReturn = false;
                select.style.border = "2px solid rgba(255, 0, 0, 0.5)";
                select.parentElement.querySelector('label span').style.display = 'flex';
            }
        });

        if (!selectReturn || !inputReturn) {
            return true;
        } else {
            return false;
        }
    }

}

