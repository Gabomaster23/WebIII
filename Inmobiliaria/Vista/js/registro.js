document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const nombreInput = document.getElementById("nombre");
    const apellidoInput = document.getElementById("apellido");
    const emailInput = document.getElementById("email");
    const telefonoInput = document.getElementById("telefono"); // Nuevo input
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm-password");
    const eyeIcons = document.querySelectorAll(".eye-icon");
    
    const errorMessage = document.createElement("p");
    errorMessage.style.color = "red";
    errorMessage.style.backgroundColor = "#f8d7da";
    errorMessage.style.padding = "10px";
    errorMessage.style.borderRadius = "5px";
    errorMessage.style.textAlign = "center";
    errorMessage.style.marginBottom = "10px";
    errorMessage.style.display = "none";
    form.prepend(errorMessage);

    function validateInput(input, regex) {
        if (!regex.test(input.value.trim())) {
            input.style.border = "2px solid red";
            return false;
        } else {
            input.style.border = "2px solid green";
            return true;
        }
    }

    function validatePasswordMatch() {
        let valid = true;
        if (passwordInput.value !== confirmPasswordInput.value) {
            passwordInput.style.border = "2px solid red";
            confirmPasswordInput.style.border = "2px solid red";
            errorMessage.textContent = "Confirma que tus contraseñas sean iguales.";
            valid = false;
        } else {
            passwordInput.style.border = "2px solid green";
            confirmPasswordInput.style.border = "2px solid green";
        }
        return valid;
    }

    function checkFormValidity() {
        if (
            validateInput(nombreInput, nameRegex) &&
            validateInput(apellidoInput, nameRegex) &&
            validateInput(emailInput, emailRegex) &&
            validateInput(telefonoInput, phoneRegex) &&
            validateInput(passwordInput, passwordRegex)
        ) {
            errorMessage.style.display = "none";
        } else {
            errorMessage.style.display = "block";
            errorMessage.textContent = "Ingresa campos válidos.";
        }
    }

    const nameRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,16}$/;
    const phoneRegex = /^[0-9]{10}$/; // Teléfono de 10 dígitos

    nombreInput.addEventListener("input", () => {
        validateInput(nombreInput, nameRegex);
        checkFormValidity();
    });
    apellidoInput.addEventListener("input", () => {
        validateInput(apellidoInput, nameRegex);
        checkFormValidity();
    });
    emailInput.addEventListener("input", () => {
        validateInput(emailInput, emailRegex);
        checkFormValidity();
    });
    telefonoInput.addEventListener("input", () => {
        validateInput(telefonoInput, phoneRegex);
        checkFormValidity();
    });
    passwordInput.addEventListener("input", () => {
        validateInput(passwordInput, passwordRegex);
        checkFormValidity();
    });

    confirmPasswordInput.addEventListener("input", () => {
        if (confirmPasswordInput.value.trim() !== "") {
            confirmPasswordInput.style.border = "2px solid green";
        }
    });

    eyeIcons.forEach(icon => {
        icon.addEventListener("click", function () {
            let input = this.previousElementSibling;
            if (input.type === "password") {
                input.type = "text";
                this.textContent = "👁️‍🗨️";
            } else {
                input.type = "password";
                this.textContent = "👁️";
            }
        });
    });

    form.addEventListener("submit", function (event) {
        let isValid = true;
        if (!validateInput(nombreInput, nameRegex)) isValid = false;
        if (!validateInput(apellidoInput, nameRegex)) isValid = false;
        if (!validateInput(emailInput, emailRegex)) isValid = false;
        if (!validateInput(telefonoInput, phoneRegex)) isValid = false; // Nueva validación
        if (!validateInput(passwordInput, passwordRegex)) isValid = false;
        if (!validatePasswordMatch()) isValid = false;

        if (!isValid) {
            errorMessage.style.display = "block";
            event.preventDefault();
        } else {
            errorMessage.style.display = "none";
        }
    });
});
