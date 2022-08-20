<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="../images/favicon.svg"
      />
    <link rel="stylesheet" href="../../dist/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <!-- <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css"> -->

    <title>Tree Nursery Accreditation</title>
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>

    <style>
      .header {
        height: 300px;
      }
    </style>

</head>

  <body>
    <header class="header">
    <div class="header__overlay">
    <div class="header__links">
    <a href="../../">Home</a>
            <a href="./about_us.php">About Us</a>
            <a href="./nurseries.php">Certified Nurseries</a>
            <a href="./contact_us.php">Contact Us</a>
          <a href="#footer" class="buyer header__cta button hide-for-desktop">View Certified Nurseries</a>
    </div>
    </div>
      <div class="header__mask flex-col-jcaic">
        <nav class="header__nav flex-sb-aic">
        <a href="./" class="logo"><h2 class="header__logo flex-jc-aic"><span class="header__logo__img"></span> OTNA</h2></a>
          <div class="header__menu hide-for-desktop">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <div class="header__links hide-for-mobile">
            <a href="../../">Home</a>
            <a href="./about_us.php">About Us</a>
            <a href="./nurseries.php" class="active">Certified Nurseries</a>
            <a href="./contact_us.php">Contact Us</a>
          </div>
          <a href="#nurseries" class="buyer header__cta button hide-for-mobile">View Certified Nurseries</a>
        </nav>

        <p class="header__title">Certified Tree Nurseries</p>
        <p class="header__slogan">
          Fostering Seedling Quality for a Green Future!
        </p>
      </div>
    </header>

    <section class="info flex-col-jcaic">
      <p class="info__title">List of Certified Tree Nurseries</p>
      <hr class="info__line" />
      <p class="info__text t-center"  id="nurseries">
        Shown below is a list of government certified tree nurseries. These nurseries
        have been inspected by authorized personnel in order to ensure they offer
        the most quality tree seedlings to buyers.
      </p>

    <div class="app certified__nurseries">
    <div class="app__controls cert__nurseries flex-sb-aic">
    <div class="set__filter flex-sb-aic small__hide">
      <div class="filter__cont">
        <label>Filter by: </label>
        <select class="app__filter" id="">
          <option value="all">All</option>
          <option value="county">County</option>
          <option value="subcounty">Sub-County</option>
        </select>
      </div>
      <div class="select__county hide">
        <input type="text" placeholder="county"/>
      </div>
      <div class="select__subcounty hide">
        <input type="text" placeholder="subcounty"/>
      </div>

      <div class="select__all">
        <input type="text" value="No filter" disabled />
      </div>


      <button class="button apply__filter">Filter</button>
    </div>

    <div class="search__container flex-jc-aic">
      <p class="search__title">Search</p>
      <div class="search flex-jc-aic">
        <span class="flex-jc-aic"><i class="fa fa-search"></i></span>
        <input type="text" />
      </div>
    </div>
  </div>
    <div class="app__header flex-sb-aic">
        <p class="flex count">#</p>
        <p class="flex">Nursery Name</p>
        <p class="flex">County</p>
        <p class="flex">Sub-county</p>
        <p class="flex">Manager</p>
        <p class="flex">Manager's Contact</p>
        <p class="btn flex">Species</p>
    </div>
    <div class="app__content">
        <table class="app__table">
        <tbody id="tbody">
        </tbody>
        </table>
    </div>
    </div>
    </section>



    <footer class="footer flex-jc-aic" id="footer">
      <span>&copy; Copyright 2022, Ericke inc.</span>
    </footer>
    <script src="../js/script.js"></script>
    <script>
    drawMobNav();
    const hamburger = document.querySelector('.header__menu'),
          buyer = document.querySelector('a.buyer.header__cta');
    buyer.addEventListener('click', () => {
      hamburger.click();
    });


    fetchData();
    activateFilters();
    function fetchData() {

    const url = '../config/apis/certified_fetch_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        //console.log(JSON.parse(this.responseText));
        const data = JSON.parse(this.responseText),
            tbody = document.querySelector('#tbody');
        if (data[0]) {
          if (data[1].includes('<tr class=\"data')) {
            tbody.innerHTML = data[1];
          }


        let allRows = document.querySelectorAll('tr.data');
          allRows.forEach(row => {
          let eye = row.querySelector('i.show'),
              eye_id = eye.getAttribute('id'),
              specCont = document.querySelector(`.${eye_id}`);


          eye.addEventListener('click', () => {
            row.classList.toggle('selected');
            // console.log(eye_id);
            specCont.classList.toggle('hide');
            document.querySelector('.app__content').scrollTop = 100;
          });
        })
        }
    }

    xhr.send();
}

function activateFilters() {
    const selectFilter = document.querySelector('.app__filter'),
        selectAll = document.querySelector('.select__all'),
        selectCounty = document.querySelector('.select__county'),
        selectSub = document.querySelector('.select__subcounty'),
        filterBtn = document.querySelector('.apply__filter'),
        searchBar = document.querySelector('.app__controls .search input'),
        searchBtn = document.querySelector('.app__controls .search span'),
        allSpecConts = document.querySelectorAll('.app__table .species__cont');


    let selectsArray = [];
    selectsArray.push(selectAll, selectCounty, selectSub);

    // listen to selectChange
    if (selectFilter) {
      console.log('selectFilter true');
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
            } else if (val == "county") {
                selectCounty.classList.remove('hide');
            } else if (val == "subcounty") {
                selectSub.classList.remove('hide');
            } else {

            }

        });
    }

    // listen to apply filter button click
    if (filterBtn) {

        filterBtn.addEventListener('click', () => {
            const allRows = document.querySelectorAll('.app__table tr.data')

            // reset tr display
            resetRows(allRows);

                let val = selectFilter.value;
                console.log(val);
                    if (val == 'all') {
                      resetRows(allRows);
                    } else {
                      filter(val);
                    }

            //check for every click if there is data left in the table

            if (!tableData(allRows)) {
                noDataToShow(1);
            }

            function filter(val) {
                if (val == 'county') {
                  // console.log('checking county');
                    let countyInput = selectCounty.querySelector('input'),
                        countyVal = countyInput.value;

                    if (!countyVal) {
                      countyInput.focus();
                    } else {
                        allRows.forEach(row => {
                            let countyColumnVal = row.querySelector('td.county .cell_info').textContent.toLowerCase();

                            if (!(countyColumnVal == countyVal)) {
                                row.classList.add('hide');
                            }
                        });
                      }
                } else if (val == 'subcounty') {
                    let subCountyInput = selectSub.querySelector('input'),
                        subCountyVal = subCountyInput.value;
                        if (!subCountyVal) {
                      subCountyInput.focus();
                    } else {
                        allRows.forEach(row => {
                            let countyColumnVal = row.querySelector('.subcounty .cell_info').textContent.toLowerCase();

                            if (!(countyColumnVal == subCountyVal)) {
                                row.classList.add('hide');
                            }
                        });
                      }
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

            if (row.classList.contains('selected')) {
                  row.classList.remove('selected');
            }

            row.querySelectorAll('td').forEach(cell => {
                if (cell.querySelector('.cell_info').innerHTML.includes('<mark>')) {
                  cell.querySelector('.cell_info').innerHTML = cell.querySelector('.cell_info').textContent;
                }
            });
        });

        noDataToShow(0);
    }

    function resetSpecs(allRows) {
        allRows.forEach(row => {
            if (!row.classList.contains('hide')) {
                row.classList.add('hide');
            }
        });
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

    });

    function activateSearch() {
        let allRows = document.querySelectorAll('.app__table tr.data'),
            searchText = searchBar.value.toLowerCase(),
            allSpecConts = document.querySelectorAll('.app__table .species__cont'),
            countySel = document.querySelector('.select__county input'),
            subCountySel = document.querySelector('.select__subcounty input'),
            filteredRows = [],
            filteredSpecs = [];

        // console.log(searchText);
        if (countySel.value || subCountySel.value) {

              allRows.forEach(row => {
                if (!row.classList.contains('hide')) {
                  filteredRows.push(row);
                  let eye = row.querySelector('td.btn i'),
                      eye_id = eye.getAttribute('id');
                  allSpecConts.forEach(specRow => {
                    if (specRow.classList.contains(eye_id)) {
                      filteredSpecs.push(specRow);
                    }
                  });
                }
              });


              allRows = filteredRows;
              allSpecConts = filteredSpecs;

            } else {
              resetRows(allRows);
              resetSpecs(allSpecConts);
            }



        if (!searchBar.value) {
            searchBar.focus();
            resetRows(filteredRows);
            resetSpecs(filteredSpecs);
        } else {
            for (let i = 0; i < allRows.length; i++) {
                let matchFound = false,
                    cells = allRows[i].querySelectorAll('td'),
                    eye = allRows[i].querySelector('td.btn i'),
                    eye_id = eye.getAttribute('id'),
                    attachedSpecCont;
                    allSpecConts.forEach(spec => {
                      if (spec.classList.contains(eye_id)) {
                        attachedSpecCont = spec;
                      }
                    });



                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].querySelector('.cell_info').textContent.toLowerCase().includes(searchText)) {
                        matchFound = true;
                        if (!cells[j].querySelector('.cell_info').innerHTML.includes('<button')) {
                            cells[j].querySelector('.cell_info').innerHTML = `<mark>${cells[j].querySelector('.cell_info').textContent}</mark>`;
                        }
                        if (matchFound) {
                            if (cells[j].parentElement.classList.contains('hide')) {
                                cells[j].parentElement.classList.remove('hide');
                            }
                        }

                    } else {
                        if (!matchFound) {
                          if (attachedSpecCont.classList.contains('hide')) {
                            if (!cells[j].parentElement.classList.contains('hide')) {
                                cells[j].parentElement.classList.add('hide');
                            }
                          }
                        }
                    }

                }
            }

            for (let i = 0; i < allSpecConts.length; i++) {
                let matchFound = false;
                let cells = allSpecConts[i].querySelectorAll('p.species'),
                    contClass = allSpecConts[i].getAttribute('class').split(' ')[1],
                    attachedTr;

                    allRows.forEach(row => {
                      let btnTarget = row.querySelector('td.btn i');
                      if (btnTarget.getAttribute('id') == contClass) {
                        attachedTr = row;
                      }
                    });

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().includes(searchText)) {
                        matchFound = true;
                        // console.log('match found', cells[j].textContent);
                        if (matchFound) {
                            if (cells[j].parentElement.parentElement.classList.contains('hide')) {
                                cells[j].parentElement.parentElement.classList.remove('hide');

                                if (attachedTr.classList.contains('hide')) {
                                  attachedTr.classList.remove('hide');
                                  if (!(attachedTr.classList.contains('selected'))) {
                                    attachedTr.classList.add('selected');
                                  }
                                }
                            }
                        }

                    } else {
                        if (!matchFound) {
                            if (!cells[j].parentElement.classList.contains('hide')) {
                                cells[j].parentElement.classList.add('hide');
                            }
                        }
                    }
                }
            }
        }

        if (!tableData(allSpecConts) && !tableData(allRows)) {
            noDataToShow(1);
        }
    }

    searchBar.addEventListener('focus', () => {
        searchBar.parentElement.style.boxShadow = "0px 0px 3px green";
    });
    searchBar.addEventListener('focusout', () => {
        searchBar.parentElement.style.boxShadow = "none";
    });

}



    </script>
  </body>
</html>
