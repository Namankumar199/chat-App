const form = document.querySelector('#form');
const submit = document.querySelector('#submit');
const errorMsg = document.querySelector('.error-msg');


form.onsubmit = (e) => {
    e.preventDefault();
}

function showMessage(val, data) {


    if (val) {
        form.reset();
        window.location.href = 'users.php';
        errorMsg.textContent = "SignUp Done Successfully!";
    } else {
        errorMsg.textContent = data;
    }

    errorMsg.classList.add('error-msg-active');
    setTimeout(() => {
        errorMsg.classList.remove('error-msg-active');
    }, 2000);
}

submit.onclick = () => {
    submit.textContent = 'Loading...';

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                data == "Success" ? showMessage(1, data) : showMessage(0, data);
            }
            submit.textContent = 'Continue to Chat';
        }
    }


    let formData = new FormData(form);
    xhr.send(formData);
}
