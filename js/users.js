const userSearhInput = document.getElementById('user-search-input');
const userSearchButton = document.getElementById('user-search-button');

const userList = document.getElementById('user-list');
const logoutBtn = document.getElementById('logout_btn');


userSearchButton.addEventListener('click', () => {
    userSearhInput.classList.toggle('active');
    userSearchButton.classList.toggle('active');
    userSearhInput.focus();
    userSearhInput.value = '';
    // console.log('search - working-fine');
});


logoutBtn.addEventListener('click', () => {
    console.log('logout-click');

});

userSearhInput.addEventListener('keyup', (e) => {
    let searchTerm = userSearhInput.value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
                userList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
});


setInterval(() => {
    
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
                if (!userSearhInput.classList.contains('active')) {
                    userList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
}, 500);
