function fetchUninspected() {

    const url = '../config/apis/fetch_uninspected_ajax.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        const data = JSON.parse(this.responseText),
            tbody = document.querySelector('#tbody'),
            app = document.querySelector('.app'),
            zeroCont = document.querySelector('.zero__content');
        console.log(data[1].length);

        // check data[1].length > 0? 
        if (data[1].includes('<tr class=\"data ')) {
            tbody.innerHTML = data[1];
            if (app.classList.contains('hide')) {
                app.classList.remove('hide');
                zeroCont.classList.add('hide');
            }
            appPost();
            openInspection();
            renderQuiz();

        } else {
            app.classList.add('hide');
            zeroCont.classList.remove('hide');
        }


    }

    xhr.send();
}

function openInspection() {
    const inspectBtn = document.querySelectorAll('.inspectBtn');
    let btnClickedId = null,
        regNumber = null;

    inspectBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            btnClickedId = btn.getAttribute('id');
            regNumber = btn.parentNode.parentNode.querySelector('.column1').textContent;
            runInspection(btnClickedId, regNumber);
        });
    });


    function runInspection(btnID, reg) {
            document.querySelector('.inspection').classList.add('show');
            const closeInspection = document.querySelector('.content__close');
            document.querySelector('.content__body').scrollTop = 0;
            let inspForm = document.querySelector('#inspectionForm');
                // reg_num = btn.parentNode.parentNode.querySelector('.column1').textContent, // hotspot for bugs if table design is affected
                // btId = btn.getAttribute('id');
            
            inspForm.querySelector('#regNum').textContent = reg;
            inspForm.querySelector('#assId').textContent = btnID;
            let inputs = document.querySelectorAll('.form-data'),
                submitBtn = document.querySelector('.complete__inspection');

            inputs[inputs.length - 1].classList.add('lastSelect');

            document.querySelector('.lastSelect').addEventListener('change', () => {
                if (has_data_loop(inputs)) {
                    submitBtn.classList.remove('disabled');
                }
            });

            inspForm.addEventListener('submit', e => {
                e.stopImmediatePropagation();
                e.preventDefault();
                
                postInspection(btnID, reg);
            });


            closeInspection.addEventListener('click', () => {
                let insp = document.querySelector('.profile__nav__link#dash_2');
                document.querySelector('.inspection').classList.remove('show');
                insp.click();
            });
    }
}


async function getQuiz() {
    let url = "../config/questions.json";
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

async function renderQuiz() {
    let quiz = await getQuiz(),
        outer = ``,
        lapsed = false;

    quiz.test.forEach(section => {
        let key = Object.keys(section);
        let values = Object.values(section);

        outer += `<div class="section flex-col-sbaic">
        <div class="section__header"><p>${key[0]}</p></div>
        <div class="section__content">`;

        section[key].forEach(questions => {
            outer += `<div class="content ${lapsed ? 'noscope' : 'active'} flex-col">
            <p class="question">
              Q <span>${questions.question_id}</span>.  <span class="checked fas fa-check"></span><button class="corrective ${lapsed ? 'numb' : 'active'}" type="button" ${lapsed ? 'disabled' : ''}><span class="flex-jc-aic hasInfo hide"></span><span class="comment__icon fa fa-comment"></span></button><br>
              <span>${questions.question}</span>
            </p>
            <select name="marks" class="form-data">
              <option value="" selected disabled hidden>--.--</option>`;

            questions.marks.forEach(mark => {
                outer += `<option value="${mark}">${mark}</option>`;
            });

            outer += `</select>
            <div class="comments hide flex-jc-aic">
            <div class="insertions flex-jcaic">
              <div class="insertion__cont flex-col-seaic">
                <label class="subject__title">${key[0]}</label>
                <input
                  type="text"
                  class="subject"
                  name="subject"
                  placeholder="Observation"
                  maxlength="255"
                />
                <textarea
                  type="text"
                  class="remarks"
                  name="remarks"
                  placeholder="Corrective Action"
                  maxlength="255"
                ></textarea>
              </div>
            </div>

            <div class="controls flex-col-seaic">
              <button class="minimize" type="button">&times;</button>

              <!-- <button class="add" type="button">+ New</button>
              <div class="peek flex-sb-aic">
                <button class="prev" type="button"><<</button>
                <button class="next" type="button">>></button>
              </div> -->
            </div>
          </div>
            </div>`;
            lapsed = true;
        });
        outer += `</div></div>`;
    });

    document.querySelector('.content__body').innerHTML = outer + ` <div class="complete__container flex-jc-aic hide">
    <div class="content__complete flex-col-sbaic">
      <p class="complete__text">
         Nursery inspection complete
        <span class="fa fa-check"></span>
      </p>
      <p class="complete__verd">
        Nursery <span class="reg"></span>
        <span class="verd"></span> for a certificate
      </p>
      <p class="score">Score <i class="fa fa-hand-o-right"></i> <span id="score">97%</span></p>
      <p class="rating">
        <span id="rate">Rating <i class="fa fa-hand-o-right"></i></span> 
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
       
      </p>

      <button type="button" class="exit__complete button">Submit</button>
    </div>
  </div>`;
    //disable selectboxes
    document.querySelectorAll('.content.noscope').forEach(cont => {
        cont.querySelector('select.form-data').disabled = true;
    });






    //add change eventlistener to any select that has parentnode of class active
    const allSelects = document.querySelectorAll('.content select'),
        last_index = allSelects.length - 1,
        qNum = document.querySelector('.progress p #qNum'),
        qTotal = document.querySelector('.progress p #qTotal'),
        prog = document.querySelector('.progress__cont #prog');

    prog.max = last_index + 1;

    qNum.textContent = 1;
    qTotal.textContent = last_index + 1;
    prog.value = 1;

    let selIndex = 0;

    allSelects.forEach(select => {
        select.addEventListener('change', () => {
            if (!select.parentElement.classList.contains('visited')) {
                if (selIndex < last_index) {
                    updateProgress();
                }
                select.parentElement.classList.remove('active');
                select.parentElement.classList.add('visited');
                if (select.parentElement.nextElementSibling !== null) {
                    autoScroll_1();
                    select.parentElement.nextElementSibling.classList.add('active');
                    select.parentElement.nextElementSibling.classList.remove('noscope');
                    select.parentElement.nextElementSibling.querySelector('select').disabled = false;
                    select.parentElement.nextElementSibling.querySelector('select').focus();
                    select.parentElement.nextElementSibling.querySelector('.corrective').removeAttribute('disabled');

                    if (!select.parentElement.classList.contains('active')) {
                        selIndex++;
                    }
                } else {
                    if (selIndex !== last_index) {
                        selIndex++;
                        autoScroll_2();
                        select.parentElement.parentElement.parentElement.nextElementSibling.querySelector('.content').classList.add('active');
                        select.parentElement.parentElement.parentElement.nextElementSibling.querySelector('.content').classList.remove('noscope');
                        select.parentElement.parentElement.parentElement.nextElementSibling.querySelector('.content').querySelector('select').disabled = false;
                        select.parentElement.parentElement.parentElement.nextElementSibling.querySelector('.content').querySelector('select').focus();
                        select.parentElement.parentElement.parentElement.nextElementSibling.querySelector('.corrective').removeAttribute('disabled');
                    }
                }

                function autoScroll_1() {
                    let nextSelect = select.parentElement.nextElementSibling.querySelector('select'),
                        mainWindow = document.querySelector('.content__body'),
                        nowTargetTop = select.parentElement.getBoundingClientRect().top,
                        nextTargetTop = nextSelect.parentElement.getBoundingClientRect().top,
                        nextTargetH = nextSelect.parentElement.getBoundingClientRect().height;

                    if (nowTargetTop < nextTargetTop) {
                        mainWindow.scrollTop += nextTargetH;
                    }
                }

                function autoScroll_2() {
                    let nextSelectOut = select.parentElement.parentElement.parentElement.nextElementSibling.querySelector('.content').querySelector('select'),
                        mainWindow = document.querySelector('.content__body'),
                        nowTargetTop = select.parentElement.getBoundingClientRect().top,
                        nextTargetTopOut = nextSelectOut.parentElement.getBoundingClientRect().top,
                        nextTargetHOut = nextSelectOut.parentElement.getBoundingClientRect().height;

                    if (nowTargetTop < nextTargetTopOut) {
                        mainWindow.scrollTop += nextTargetHOut + nextTargetHOut / 1.5;
                    }
                }
            }

            function updateProgress() {
                qNum.textContent = parseInt(qNum.textContent) + 1;
                qTotal.textContent = last_index + 1;
                prog.value = parseInt(prog.value) + 1;
            }

        });
    });

    handleCorrective();
    function handleCorrective() {
        const q_contents = document.querySelectorAll(
            ".section__content .content"
        );
        q_contents.forEach(cont => {
            let corrective = cont.querySelector("button.corrective"),
                corrModal = cont.querySelector("div.comments"),
                closeCorr = cont.querySelector("div.comments .controls .minimize"),
                addNew = cont.querySelector("div.comments .controls .add"),
                insertion = cont.querySelector("div.comments .insertions"),
                prev = cont.querySelector("div.comments .controls .prev"),
                next = cont.querySelector("div.comments .controls .next"),
                hasInfo = cont.querySelector('span.hasInfo');

            corrective.addEventListener("click", () => {
                corrModal.classList.remove("hide");
            });
            closeCorr.addEventListener("click", () => {
                if (!checkFilled().one) {
                    insertion.querySelector('textarea').classList.add('no__data');
                    const v = setTimeout(() => {
                        insertion.querySelector('textarea').classList.remove('no__data');
                    }, 300);
                } else {
                    corrModal.classList.add("hide");

                    if (checkFilled().value) {
                        hasInfo.classList.remove('hide');
                        hasInfo.textContent = 'C';
                    } else {
                        if (!hasInfo.classList.contains('hide')) {
                            hasInfo.classList.add('hide');
                        }
                    }
                }
            });

            function checkFilled() {
                if (!insertion.querySelector('input').value) {
                    if (insertion.querySelector('textarea').value) {
                        return { one: true, value: true };
                    } else {
                        return { one: true, value: false };
                    }
                } else {
                    if (insertion.querySelector('textarea').value) {
                        return { one: true, value: true };
                    } else {
                        return { one: false, value: false };
                    }
                }
            }
        });
    }


}
/* post form data */

function postInspection(btId, reg_num) {
    // console.log('called postInspection - 1');
    let inputs = document.querySelectorAll('.form-data'),
        errorShow = document.querySelector('.error__mask'),
        okBtn = document.querySelector('.error__btn'),
        sections = document.querySelectorAll('.section__content'),
        correctiveArr = [];


    // read input data
    sections.forEach(section => {
        section.childNodes.forEach(child => {
            let title = section.previousElementSibling.textContent,
                obs = child.children[2].querySelector('.subject'),
                remarks = child.children[2].querySelector('.remarks');
            if (remarks.value) {
                correctiveArr.push([title + '†', obs.value + '†', remarks.value + '†'] + 'ππ');
            }
        });
    });

    okBtn.addEventListener('click', () => {
        if (!errorShow.getAttribute('class').includes('hide')) {
            errorShow.classList.add('hide');
        }
    });

    if (!has_data_loop(inputs)) {
        if (errorShow.getAttribute('class').includes('hide')) {
            errorShow.classList.remove('hide');
        }
    } else {
        //console.log(compute(inputs)); //post data
        sendData();

        function sendData() {
            console.log('sent data to award_ajax - 2');

            let data = {};
            data['award'] = true;
            data['score'] = compute(inputs).score;
            data['rating'] = compute(inputs).rating;
            data['verdict'] = compute(inputs).verdict;
            data['ass_id'] = btId;
            data['corrective'] = correctiveArr;


            const url = '../config/apis/award_ajax.php';

            let params = Object.keys(data).map(function (k) {
                return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
            }).join('&');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                const res = JSON.parse(this.responseText);
                console.log('done awarding', res);
                if (res[0]) {
                    fillCompleteModal(res[1][0], res[1][1], res[1][2]);
                    showComplete();
                    document.querySelector('.exit__complete').addEventListener('click', () => {
                        document.querySelectorAll('p.rating .fa-star').forEach(star => {
                            if (star.classList.contains('active'))
                                star.classList.remove('active');
                        });
                        document.querySelector('.inspection').classList.remove('show');
                        document.querySelector('.complete__inspection').disabled = false;
                    });
                }
            }

            xhr.send(params);

            function showComplete() {
                document.querySelector('.complete__container').classList.remove('hide');
                document.querySelectorAll('form .section').forEach(sec => {
                    sec.innerHTML = '';
                });
                document.querySelector('.complete__inspection').disabled = true;
                document.querySelector('.complete__inspection').classList.add('disabled');
            }

            function fillCompleteModal(score, rate, verd) {
                document.querySelector('.complete__verd .reg').textContent = reg_num;
                let verdict = document.querySelector('.complete__verd');

                if (verdict.classList.contains('fail')) {
                    verdict.classList.remove('fail');
                }
                if (rate < 3) {
                    verdict.classList.add('fail');
                }
                document.querySelector('.complete__verd .verd').textContent = verd;

                document.querySelector('p.score #score').textContent = score + '%';
                let stars = document.querySelectorAll('p.rating .fa-star');
                for (let i = 0; i < rate; i++) {
                    stars[i].classList.add('active');
                    console.log(`star ${i} activated`);
                }
            }
        }
    }
}

function has_data_loop(inputs) {
    let has_data = true;

    inputs.forEach(input => {
        if (!input.value) {
            has_data = false;
        }
    });

    return has_data;
}


function compute(inputs) {
    let score = 0,
        maxScore = 0,
        toPercentage = 0,
        rating = 0,
        verdict = '';

    inputs.forEach(select => {
        maxScore += parseInt(select.lastChild.value);
        score += parseInt(select.value);
    });

    toPercentage = Math.round((score / maxScore) * 100);


    toPercentage >= 90 ? setRate(5) : toPercentage >= 80 ? setRate(4) : toPercentage >= 60 ? setRate(3) : toPercentage >= 40 ? setRate(2) : toPercentage < 40 ? setRate(1) : null;

    function setRate(rate) {
        rating = rate;
        rate >= 3 ? verdict = 'qualifies' : verdict = 'does not qualify';
    }

    return {
        score: toPercentage,
        rating: rating,
        verdict: verdict
    };
}

