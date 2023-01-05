// homeChat
const inputSearch = document.querySelector('.container .formRight input.searchInput'),
iconSearch = document.querySelector('.container .formRight .top i.searchIcon'),
usersList = document.querySelector("div.usersList");


iconSearch.addEventListener('click', () => {

    if ( inputSearch.style.display !== 'block') {

        inputSearch.style.display = 'block'; 
        iconSearch.classList.remove('fas', 'fa-search');
        iconSearch.classList.add('fa-solid', 'fa-xmark');

    } else {
        
        inputSearch.value = "";
        inputSearch.classList.remove("active");
        inputSearch.style.display = 'none';
        iconSearch.classList.remove('fa-solid', 'fa-xmark');
        iconSearch.classList.add('fas', 'fa-search');
    }
});


inputSearch.onkeyup = () => {
  let searchUser = inputSearch.value;
  if (inputSearch.value != "") {
    inputSearch.classList.add("active");
  } else {
    inputSearch.classList.remove("active");
  }
  fetch('searchUser.php', {
    method: 'POST',
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `searchUser=${searchUser}`
  })
  .then(response => response.text())
  .then(responseText => {
    usersList.innerHTML = responseText;
  });
}

setInterval(() => {
    fetch('usersList.php', {
        method: 'POST'
    })
    .then(response => response.text())
    .then(responseText => {
        if (!inputSearch.classList.contains('active')) {
        usersList.innerHTML = responseText;
        }
    });
}, 500);


  