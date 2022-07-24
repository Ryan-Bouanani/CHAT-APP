
const inputsPassword = document.querySelectorAll('.formRight .password input[type="password"]');
const eyesIcons = document.querySelectorAll('.formRight .password i');
console.log(eyesIcons);
const errorDiv = document.querySelector('.container .errorDiv');
console.log(errorDiv);
const btnSubmit = document.querySelector('.container .formRight form input[type="submit"]');
console.log(errorDiv);

// hide password
    eyesIcons[0].addEventListener('click', () => {
            if (inputsPassword[0].type === 'password') {
                inputsPassword[0].type = 'text';
            } else {
                inputsPassword[0].type = 'password';   
            }
    });

    eyesIcons[1].addEventListener('click', () => {
            if (inputsPassword[1].type === 'password') {
                inputsPassword[1].type = 'text';
            } else {
                inputsPassword[1].type = 'password';   
            }
    });

    let errorP = document.createElement('p');
    errorP.className = 'errorMessage';
    errorP.textContent = 'Les mots de passe sont différents';
// password differents
    inputsPassword[1].addEventListener("keyup", () => {
        if (inputsPassword[0].value !== inputsPassword[1].value) {
            errorDiv.append(errorP);
            btnSubmit.disabled = true;
        } else {
            errorP.remove();
            btnSubmit.disabled = false;
        }
    })




