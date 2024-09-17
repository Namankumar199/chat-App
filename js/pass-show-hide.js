const passInput = document.getElementById('password');
const passImg = document.getElementById('password-img');

passImg.addEventListener('click', () => {
    if (passInput.type === "password") {
        passInput.type = "text";
        passImg.src = "./images/eye-open.png";
    } else {
        passInput.type = "password";
        passImg.src = "./images/eye-close.png";

    }
});