
const form = document.querySelector(".formMessage"),
chatContainer = document.querySelector('div.chatContainer'),
btnSendMessage = form.querySelector('.sendMessage'),
textareatMessage = document.querySelector('textarea.message');


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
   fetch('insertChat.php',{
    method: 'POST',
    body: new FormData(form)
   })
   .then(response => {
        if (response.ok) {
            textareatMessage.value = "";    
            scrollToBottom();
        }
   });
   return false;
}

chatContainer.onmouseenter = ()=>{
    chatContainer.classList.add("active");
}

chatContainer.onmouseleave = ()=>{
    chatContainer.classList.remove("active");
}

setInterval(() => {
    fetch('getMessage.php', {
      method: 'POST',
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      }
    })
    .then(response => response.text())
    .then(responseText => {
      chatContainer.innerHTML = responseText;
      if(!chatContainer.classList.contains("active")){
        scrollToBottom();
      }
    });
  }, 500);


function scrollToBottom() {
    chatContainer.scrollTop = chatContainer.scrollHeight;    
}