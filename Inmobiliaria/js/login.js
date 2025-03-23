document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.querySelector(".eye-icon");
    const form = document.querySelector("form");
    const errorMessage = document.createElement("p");
    errorMessage.textContent = "Ingresa campos válidos.";
    errorMessage.style.color = "red";
    errorMessage.style.backgroundColor = "#f8d7da";
    errorMessage.style.padding = "10px";
    errorMessage.style.borderRadius = "5px";
    errorMessage.style.textAlign = "center";
    errorMessage.style.marginBottom = "10px";
    errorMessage.style.display = "none";
    form.prepend(errorMessage);

    // Toggle de visibilidad de la contraseña
    eyeIcon.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.textContent = "👁️‍🗨️";
        } else {
            passwordInput.type = "password";
            eyeIcon.textContent = "👁️";
        }
    });

    // Validación de campos
    function validateInput(input, minLength, maxLength) {
        if (input.value.trim().length < minLength || input.value.trim().length > maxLength) {
            input.style.border = "2px solid red";
            return false;
        } else {
            input.style.border = "2px solid green";
            return true;
        }
    }

    emailInput.addEventListener("input", function () {
        validateInput(emailInput, 5, 10);
        checkFormValidity();
    });

    passwordInput.addEventListener("input", function () {
        validateInput(passwordInput, 8, 16);
        checkFormValidity();
    });

    function checkFormValidity() {
        if (
            validateInput(emailInput, 5, 10) &&
            validateInput(passwordInput, 8, 16)
        ) {
            errorMessage.style.display = "none";
        } else {
            errorMessage.style.display = "block";
        }
    }

    form.addEventListener("submit", function (event) {
        let isValid = true;
        
        if (!validateInput(emailInput, 5, 10)) {
            isValid = false;
        }
        
        if (!validateInput(passwordInput, 8, 16)) {
            isValid = false;
        }
        
        if (!isValid) {
            errorMessage.style.display = "block";
            event.preventDefault(); // Evita que el formulario se envíe si hay errores
        }
    });
});