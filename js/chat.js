const form = document.getElementById('message-send-form'),
    messageInput = document.getElementById('message-input'),
    messageButton = document.getElementById('message-button'),
    chatList = document.getElementById('message-list');

;


form.onsubmit = (e) => {
    e.preventDefault();
}


messageButton.addEventListener('click', () => {

    console.log('msg send..');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
                messageInput.value = "";
                scrollToBottom();
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
    // xhr.send();
});

// scrollToBottom  function hold on user scrolling chats
chatList.onmouseenter = () => {
    chatList.classList.add('active');
};
// scrollToBottom function start on user focusing for send messages
messageInput.onfocus = () => {
    chatList.classList.remove('active');
};

setInterval(() => {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
              
                chatList.innerHTML = data;

                if (!chatList.classList.contains('active')) {
                    scrollToBottom();
                }

            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}, 500);


function scrollToBottom() {
    console.log(' scrollTop:', chatList.scrollTop);
    console.log('scrollHeight:', chatList.scrollHeight);
    chatList.scrollTop = chatList.scrollHeight;
}


// on window load chat will scroll automatically
window.onload = () => {
    chatList.classList.remove('active');

}