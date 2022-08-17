const searchBar = document.querySelector(".users .search input");
searchBtn = document.querySelector(".users .search button");
usersList = document.querySelector(".users .user-list");

searchBtn.onclick = ()=>{
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");
    }
    else{
        searchBar.classList.remove("active");
    }
     // let's start Ajax
     let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "https://127.0.0.1/chat_org/chatting_app/inc/search.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
    }

setInterval(()=>{
    // let's start Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("GET", "inc/users.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){
                    usersList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
}, 500); // this function will run frequently after 50ms