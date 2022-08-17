
const form = document.querySelector(".formMessage"),
chatContainer = document.querySelector('div.chatContainer'),
btnSendMessage = form.querySelector('.sendMessage'),
textareatMessage = document.querySelector('textarea.message');
console.log(textareatMessage);
// console.log(idReceiver);


form.onsubmit = (e)=>{
    e.preventDefault();
}
textareatMessage.focus();
textareatMessage.onkeyup = ()=>{
    if(textareatMessage.value != ""){
        btnSendMessage.classList.add("active");
    }else{
        btnSendMessage.classList.remove("active");
    }
}

btnSendMessage.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'insertChat.php', true);
    
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {  
            if (xhr.status === 200) {
                console.log(textareatMessage.value);
                textareatMessage.value = "";    
                scrollToBottom();
            } 
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatContainer.onmouseenter = ()=>{
    chatContainer.classList.add("active");
}

chatContainer.onmouseleave = ()=>{
    chatContainer.classList.remove("active");
}

// setInterval(() => {  
   let xhr = new XMLHttpRequest();
   xhr.open('POST', 'getMessage.php', true);
   xhr.onload = () => {

       if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            chatContainer.innerHTML = xhr.response;
            if(!chatContainer.classList.contains("active")){
                scrollToBottom();
              }
       };
   };
   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhr.send();
// },500);


function scrollToBottom() {
    chatContainer.scrollTop = chatContainer.scrollHeight;    
}