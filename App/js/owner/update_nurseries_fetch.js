function toUpdateFetch() {

    const url = '../config/apis/fetch_owner_nurseries.php';

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

            print.addEventListener('click', () => {
                showReports();
            });
            updatePost();
            appPost();
            // checkFunctionReach();
        } else {
            app.classList.add('hide');
            zeroCont.classList.remove('hide');

            let regButton = document.querySelector('.registerNursery'),
                regNursery = document.querySelector('.profile__nav__link.main#dash_2');
            if (regButton) {
                regButton.addEventListener('click', () => {
                    regNursery.click();
                });
            }
        }

    }

    xhr.send();

}

// to be used to fetch nursery data for view nurseries modal
function appPost() {
    const showBtn = document.querySelectorAll('.app__table .view__button');
    // countPop = document.querySelector('.profile__nav__link .count'),
    // countText = countPop.querySelector('p'),
    // dashButtons = document.querySelectorAll('.profile__nav__link.main');
    let butId = "";

    showBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            butId = btn.getAttribute('id');
            // console.log('cliced show button');
            let name = btn.parentElement.parentElement.querySelector('.column2').textContent;

            // const btnRow = btn.parentNode.parentNode;

            expandNurseryData(getData(butId), name);
        });
    });

    //remove popup
    // dashButtons.forEach(btn => {
    //     if (!btn.getAttribute('class').includes('active') && btn.getAttribute('id') != 'dash_4') {
    //         btn.addEventListener('click', () => {
    //             countPop.classList.add('hide');
    //         });
    //     }
    // });

    function getData(butId) {
        return data = {
            reg_num: butId
        };
    }

}



function updatePost() {
    const updateBtn = document.querySelectorAll('.update__button'),
        //  viewBtn = document.querySelectorAll('.button.view__button'),
        addNew = document.querySelector('.add__new');
    let butId = "";

    updateBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            butId = btn.getAttribute('id');
            showContent(butId);
            // console.log(butId);
        });
    });


    addNew.addEventListener('click', () => {
        document.querySelector('#dash_2').click();
    });


    function showContent(butId) {
        let updateForm = document.querySelector('.reg__container.update'),
            app = document.querySelector('.app.update'),
            close = document.querySelector('.closeForm');

        app.classList.add('hide');
        updateForm.classList.remove('hide');
        close.addEventListener('click', () => {
            app.classList.remove('hide');
            updateForm.classList.add('hide');
            document.querySelector('div#dash_5').click();
        });

        fetchNurseryData(getData(butId));

    }

    function getData(butId) {
        return data = {
            reg_num: butId
        };
    }

    function fetchNurseryData(data) {
        data['updateNursery'] = true;

        const url = '../config/apis/fetch_update_data.php';

        let params = Object.keys(data).map(function (k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }).join('&');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            // console.log('posted successfully');
            const res = JSON.parse(this.responseText),
                inputGroups = document.querySelectorAll('.reg__input__group'),
                reg = document.querySelector('label#regNum'),
                formInputs = [];
            // console.log(res[1][0][0]);

            inputGroups.forEach(node => {
                formInputs.push(node.children[1]);
            });

            function setValue(index, value) {
                formInputs[index].value = value;
                // console.log(formInputs[index].getAttribute('name'));
            }




            // console.log((res[1][1]));
            reg.textContent = regRes(0);

            setValue(0, regRes(1));
            setValue(1, regRes(2));
            setValue(2, regRes(3));
            setValue(3, regRes(4));
            setValue(4, regRes(5));
            setValue(5, regRes(6));
            setValue(6, regRes(7));
            setValue(7, regRes(8));
            setValue(8, regRes(9));
            setValue(9, regRes(10));
            setValue(10, regRes(11));
            setValue(11, regRes(12));
            setValue(12, regRes(13));
            setValue(13, regRes(14));

            function regRes(index) {
                console.log(res[1][0][index]);
                return res[1][0][index];

            }

            //console.log(res[1][1].length);
            //populate species
            writeSpecies();

            function writeSpecies() {
                const end_index = res[1][1].length - 1,
                    group = document.querySelector('.group');
                /* get the 4 species populate input fields */

                function target() {
                    let species = group.querySelectorAll('.species-group'),
                        lastSpecies = species[species.length - 1],
                        addBtn = lastSpecies.querySelector('button.add'),
                        targetInputs = [];


                    lastSpecies.childNodes.forEach(child => {
                        if (child.hasAttribute('name')) {
                            targetInputs.push(child);
                        }
                    });
                    return {
                        add: addBtn,
                        targets: targetInputs,
                        last: lastSpecies
                    }
                }

                res[1][1].forEach(speciesRow => {
                    target();
                    setSpecies(target().targets, 0, 'category');
                    setSpecies(target().targets, 1, 'species');
                    setSpecies(target().targets, 2, 'seed_source');
                    setSpecies(target().targets, 3, 'quantity');

                    // speciesRow.querySelectorAll('select').forEach(select => {
                    //     if (select.classList.contains('write')) {
                    //         select.classList.remove('write');
                    //         select.classList.add('read');
                    //     }
                    // });
                    // console.log(speciesRow);

                    res[1][1].indexOf(speciesRow) !== end_index ? target().add.click() : null;


                    const container = document.querySelector('.reg__container');
                    container.scrollTop = 0;

                    function setSpecies(target, index, value) {
                        target[index].value = speciesRow[value];
                        if (target[index].classList.contains('write')) {
                            target[index].classList.remove('write');
                            target[index].classList.add('read');
                        }
                    }
                });


            }



        }

        xhr.send(params);
    }


}


