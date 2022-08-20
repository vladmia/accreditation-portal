function activateFilters(thisModule, view) {
    const selectFilter = document.querySelector('.app__filter'),
        selectAll = document.querySelector('.select__all'),
        selectDateRange = document.querySelector('.select__date.range'),
        selectDateSpec = document.querySelector('.select__date.spec'),
        selectStatus = document.querySelector('.select__status'),
        filterBtn = document.querySelector('.apply__filter'),
        searchBar = document.querySelector('.app__controls .search input'),
        searchBtn = document.querySelector('.app__controls .search span');


    let selectsArray = [];
    selectsArray.push(selectAll, selectDateRange, selectDateSpec, selectStatus);

    // listen to selectChange
    if (selectFilter) {
        selectFilter.addEventListener('change', () => {
            let val = selectFilter.value;
            selectsArray.forEach(container => {
                if (container !== null)
                    if (!container.classList.contains('hide')) {
                        container.classList.add('hide');
                    }
            });

            if (val == "all") {
                selectAll.classList.remove('hide');
            } else if (val == "dateSpec") {
                selectDateSpec.classList.remove('hide');
            } else if (val == "dateRange") {
                selectDateRange.classList.remove('hide');
            } else {
                selectStatus.classList.remove('hide');
            }

        });
    }

    // listen to apply filter button click
    if (filterBtn) {

        filterBtn.addEventListener('click', () => {
            const allRows = document.querySelectorAll('.app__table tr.data'),
                dateRangeInputs = selectDateRange.querySelectorAll('input'),
                dateSpecInput = selectDateSpec.querySelector('input');

            // reset tr display
            resetRows(allRows);
            // refresh iframe
            refreshIframe();

            if (thisModule == 'owner') {
                let val = selectFilter.value;
                if (view == 'myApp') {
                    if (val == 'all') {
                        document.querySelector('#dash_4').click();
                    } else {
                        filter(val, 'date__applied');
                    }
                } else if (view == 'myNurs') {
                    if (val == 'all') {
                        document.querySelector('#dash_5').click();
                    } else {
                        filter(val, 'date__reg');
                    }
                } else if (view == 'getCert') {
                    if (val == 'all') {
                        document.querySelector('#dash_3').click();
                    } else {
                        filter(val, 'date__reg');
                    }
                }
            } else if (thisModule == 'inspector') {
                let val = selectFilter.value;
                if (view == 'penInsp') {
                    if (val == 'all') {
                        document.querySelector('#dash_2').click();
                    } else {
                        filter(val, 'date__ass');
                    }
                } else if (view == 'insp') {
                    if (val == 'all') {
                        document.querySelector('#dash_3').click();
                    } else {
                        filter(val, 'date__ins');
                    }
                } else if (view == 'total') {
                    if (val == 'all') {
                        document.querySelector('#dash_4').click();
                    } else {
                        filter(val, 'date__ass');
                    }
                }
            } else if (thisModule == 'admin') {
                let val = selectFilter.value;
                if (view == 'assign') {
                    if (val == 'all') {
                        document.querySelector('#dash_2').click();
                    } else {
                        filter(val, 'date__reg');
                    }
                } else if (view == 'apps') {
                    if (val == 'all') {
                        document.querySelector('#dash_3').click();
                    } else {
                        filter(val, 'date__applied');
                    }
                } else {

                }
            }



            //check for every click if there is data left in the table

            if (!tableData(allRows)) {
                noDataToShow(1);
            }

            function filter(val, dateColumnClass) {
                const countPop = document.querySelector('.profile__nav__link .count');
                if (val == 'dateSpec') {
                    if (!dateSpecInput.value) {
                        dateSpecInput.focus();
                    } else {
                        allRows.forEach(row => {
                            let dateApplied = row.querySelector(`.${dateColumnClass}`).textContent;
                            // console.log(dateApplied == dateSpecInput.value);
                            if (!(dateApplied == dateSpecInput.value)) {
                                row.classList.add('hide');
                            }
                        });
                    }
                } else if (val == 'dateRange') {
                    let dateValMin = dateRangeInputs[0].value,
                        dateValMax = dateRangeInputs[1].value;

                    if (!dateValMin) {
                        dateRangeInputs[0].focus();
                    } else if (!dateValMax) {
                        dateRangeInputs[1].focus();
                    } else {
                        allRows.forEach(row => {
                            let dateColumnVal = row.querySelector(`.${dateColumnClass}`).textContent;
                            if (!(dateColumnVal >= dateValMin && dateColumnVal <= dateValMax)) {
                                row.classList.add('hide');
                            }
                        });
                    }
                } else if (val == 'status') {
                    let status = selectStatus.querySelector('select'),
                        statusVal = status.value;
                    if (statusVal == 'all') {
                        resetRows(allRows);
                    } else {
                        let profileText = document.querySelector('.profile_text');
                        allRows.forEach(row => {
                            let statusColumnVal = row.querySelector('.column4').textContent.toLowerCase();

                            if (!(statusColumnVal == statusVal)) {
                                row.classList.add('hide');
                            }
                        });


                        if (statusVal == "certified") {
                            profileText.textContent = 'Certified Applications';
                        } else if (statusVal == "pending") {
                            profileText.textContent = 'Awaiting Inspection';
                        } else  if (statusVal == "declined") {
                            profileText.textContent = 'Declined Applications';
                        }
                    }
                }

                if (countPop) {
                    countPop.querySelector('p').textContent = tableData(allRows);
                    countPop.classList.add('frame');
                    let t = setTimeout(() => {
                        countPop.classList.remove('frame');
                    }, 1000);
                }
            }

        });
    }

    function noDataToShow(toggle) {
        let appEmpty = document.querySelector('.app__table tr.app__empty');
        if (toggle) {
            if (appEmpty.classList.contains('d_none')) {
                appEmpty.classList.remove('d_none');
            }
        } else {
            if (!appEmpty.classList.contains('d_none')) {
                appEmpty.classList.add('d_none');
            }
        }
    }

    function resetRows(allRows) {
        allRows.forEach(row => {
            if (row.classList.contains('hide')) {
                row.classList.remove('hide');
            }

            row.querySelectorAll('td').forEach(cell => {
                if (cell.innerHTML.includes('<mark>')) {
                    cell.innerHTML = cell.textContent;
                }
            })
        });

        noDataToShow(0);
    }

    function tableData(allRows) {
        let count = 0;
        allRows.forEach(row => {
            if (!row.classList.contains('hide')) {
                count++;
            }
        });

        return count;
    }

    // search bar
    searchBtn.addEventListener('click', () => {
        activateSearch();
    });

    searchBar.addEventListener('keyup', () => {
        activateSearch();
        refreshIframe();
    });

    function activateSearch() {
        const allRows = document.querySelectorAll('.app__table tr.data'),
            searchText = searchBar.value.toLowerCase();

        // console.log(searchText);

        resetRows(allRows);
        if (!searchBar.value) {
            searchBar.focus();
        } else {
            for (let i = 0; i < allRows.length; i++) {
                let matchFound = false;
                let cells = allRows[i].querySelectorAll('td');
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().includes(searchText)) {
                        matchFound = true;
                        if (!cells[j].innerHTML.includes('<button')) {
                            cells[j].innerHTML = `<mark>${cells[j].textContent}</mark>`;
                        }
                        // console.log('match found', cells[j].textContent);
                        if (matchFound) {
                            if (cells[j].parentElement.classList.contains('hide')) {
                                cells[j].parentElement.classList.remove('hide');
                            }
                            // break;
                        }

                    } else {
                        if (!matchFound) {
                            if (!cells[j].parentElement.classList.contains('hide')) {
                                cells[j].parentElement.classList.add('hide');
                            }
                        }
                        // console.log('skipped');
                    }

                }
            }
        }

        if (!tableData(allRows)) {
            noDataToShow(1);
        }
    }

    searchBar.addEventListener('focus', () => {
        searchBar.parentElement.style.boxShadow = "0px 0px 3px green";
    });
    searchBar.addEventListener('focusout', () => {
        searchBar.parentElement.style.boxShadow = "none";
    });

    function refreshIframe() {
        if (document.querySelector('iframe')) {
            document.querySelector('iframe').src = document.querySelector('iframe').src;
        }
    }

}

