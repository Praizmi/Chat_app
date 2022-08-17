const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) =>{
    e.preventDefault(); //Preventing form from submitting
}

sendBtn.onclick = ()=>{
        // let's start Ajax
        let xhr = new XMLHttpRequest(); //creating XML object
        xhr.open("POST", "inc/insert-chat.php", true);
        xhr.onload = ()=>{
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = ""; //once inserted into the database it blanks the value if the textbox
                    scrollToBottom();
                }
            }
        }
        //sending the form data through ajax to php
        let formData = new FormData(form); //creating new formData object
        xhr.send(formData); //sending the form data to php
    }

    chatBox.onmouseenter = ()=>{
        chatBox.classList.add("active");
    }

    chatBox.onmouseleave = ()=>{
        chatBox.classList.remove("active");
    }

    setInterval(()=>{
        // let's start Ajax
        let xhr = new XMLHttpRequest(); //creating XML object
        xhr.open("POST", "inc/get-chat.php", true);
        xhr.onload = ()=>{
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    if(!chatBox.classList.contains("active")){
                        scrollToBottom();
                    }
                }
            }
        }
        //sending the form data through ajax to php
        let formData = new FormData(form); //creating new formData object
        xhr.send(formData); //sending the form data to php
    }, 500); // this function will run frequently after 50ms

    function scrollToBottom(){
        chatBox.scrollTop = chatBox.scrollHeight;
    }