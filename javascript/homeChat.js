// homeChat
const iconSearch = document.querySelector('.container .formRight .top i.searchIcon');
const inputSearch = document.querySelector('.container .formRight input.searchInput');
console.log(iconSearch);
console.log(inputSearch);


    iconSearch.addEventListener('click', () => {

        if ( inputSearch.style.display !== 'block') {

            inputSearch.style.display = 'block'; 
            iconSearch.classList.remove('fas', 'fa-search');
            iconSearch.classList.add('fa-solid', 'fa-xmark');

        } else {
            
            inputSearch.style.display = 'none';
            iconSearch.classList.remove('fa-solid', 'fa-xmark');
            iconSearch.classList.add('fas', 'fa-search');
        }
    })