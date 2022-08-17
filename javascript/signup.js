const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-txt");

form.onsubmit = (e) =>{
    e.preventDefault(); //Preventing form from submitting
}

continueBtn.onclick = ()=>{
    errorText.textContent =""
    // let's start Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "inc/signup.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if(data == "success"){
                    location.href = "users";
                    // alert("BOOM!")
                }
                else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    //sending the form data through ajax to php
    let formData = new FormData(form); //creating new formData object
    xhr.send(formData); //sending the form data to php
}

