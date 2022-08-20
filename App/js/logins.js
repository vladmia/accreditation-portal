const headerP = document.querySelector(".login__header p"),
    selectLogin = document.querySelector("#log_in"),
    errorMsg = document.querySelector("div.errors"),
    dataForm = document.querySelector(".login__form"),
    pass = document.querySelectorAll("input[type=password]"), // continue from here
    wrap = document.querySelector('.confirm-wrapper');

if (checkNull(selectLogin)) {
    selectLogin.addEventListener("change", () => {
        let value = selectLogin.value;
        headerP.textContent = value + ' Login';
    });
}
// check if null
function checkNull(obj) {
    return obj != null;
}

function postName(data, action) {
    if (action == 'reg') {
        data['reg'] = true;
    } else if (action == 'login') {
        data['login'] = true;
    } else {
        data['admin_login'] = true;
    }

    let error = document.querySelector('div.errors');

    const url = '../config/apis/server_ajax.php';

    let params = Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        const res = JSON.parse(this.responseText);
        // console.log(res[0]);
        if (res[0]) {
            //console.log('yeey logged in');
            wrap.classList.add('show');
            let t = setTimeout(() => {
                window.location = res[1];
            }, 1500);
        } else {
            error.innerHTML = "";
            // let errors = res[1].split(',');
            console.log(res[1]);
            // error.innerHTML = errors.map(err => {
            //     return `<p>&middot; ${err} </p>`;
            // });
            res[1].forEach(err => {
                error.innerHTML += '<p>&middot;' + err + '</p>';
            });
            error.classList.toggle('hide');

            let t = setTimeout(() => {
                error.classList.toggle('hide');
            }, 4000);
        }
    }
    xhr.send(params);
}

// password toggles 
let eyes = document.querySelectorAll('.input-icon.toggler');

eyes.forEach(eye => {
    eye.addEventListener('click', () => {
        eyeSlash(eye);
     });
});

function eyeSlash(el) {
    if (!el.classList.contains('fa-eye')) {
        el.parentNode.firstElementChild.setAttribute('type', 'password');
        el.classList.remove('fa-eye-slash');
        el.classList.add('fa-eye');
    } else {
        el.parentNode.firstElementChild.setAttribute('type', 'text');
        el.classList.remove('fa-eye');
        el.classList.add('fa-eye-slash');
        console.log('clicked first');
    }
}





