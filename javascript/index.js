
// login & signup
const inputsPassword = document.querySelectorAll('.formRight .password input[type="password"]');
const eyesIcons = document.querySelectorAll('.formRight .password i');


const errorDiv = document.querySelector('.container .errorDiv');
const btnSubmit = document.querySelector('.container .formRight form input[type="submit"]');

// hide password
eyesIcons.forEach((eyesIcons, index) => {

    eyesIcons.addEventListener('click', () => {
            if (inputsPassword[index].type === 'password') {
                console.log(index);
                eyesIcons.classList.replace('fa-eye-slash', 'fa-eye');
                inputsPassword[index].type = 'text';
            } else {
                inputsPassword[index].type = 'password';   
                eyesIcons.classList.replace('fa-eye', 'fa-eye-slash');
            }
    });
});



    // password differents
    let errorP = document.createElement('p');
    errorP.className = 'errorMessage';
    errorP.textContent = 'Les mots de passe sont différents';
    
    inputsPassword[1].addEventListener("keyup", () => {
        if (inputsPassword[0].value !== inputsPassword[1].value) {
            errorDiv.append(errorP);
            btnSubmit.disabled = true;
        } else {
            errorP.remove();
            btnSubmit.disabled = false;
        }
    })






