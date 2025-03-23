document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const nombreInput = document.getElementById("nombre");
    const apellidoInput = document.getElementById("apellido");
    const emailInput = document.getElementById("email");
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

    // Validación de campos generales
    function validateInput(input, regex) {
        if (!regex.test(input.value.trim())) {
            input.style.border = "2px solid red";
            return false;
        } else {
            input.style.border = "2px solid green";
            return true;
        }
    }

    // Validación de contraseñas coincidentes solo al hacer submit
    function validatePasswordMatch() {
        let valid = true;
        if (passwordInput.value !== confirmPasswordInput.value) {
            passwordInput.style.border = "2px solid red";  // Poner el campo de contraseña en rojo
            confirmPasswordInput.style.border = "2px solid red";  // Poner el campo de confirmación en rojo
            errorMessage.textContent = "Confirma que tus contraseñas sean iguales."; // Mensaje de error
            valid = false;
        } else {
            passwordInput.style.border = "2px solid green";  // Poner el campo de contraseña en verde
            confirmPasswordInput.style.border = "2px solid green";  // Poner el campo de confirmación en verde
        }
        return valid;
    }

    // Función para revisar la validez de todos los campos
    function checkFormValidity() {
        if (
            validateInput(nombreInput, nameRegex) &&
            validateInput(apellidoInput, nameRegex) &&
            validateInput(emailInput, emailRegex) &&
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

    // Event listeners para los inputs
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
    passwordInput.addEventListener("input", () => {
        validateInput(passwordInput, passwordRegex);
        checkFormValidity();
    });

    // La validación de contraseñas solo se hace al hacer submit
    confirmPasswordInput.addEventListener("input", () => {
        // Solo se verifica si las contraseñas coinciden al hacer submit, no durante la escritura
        if (confirmPasswordInput.value.trim() !== "") {
            confirmPasswordInput.style.border = "2px solid green"; // Si tiene algún valor, solo se marca como válido
        }
    });

    // Mostrar u ocultar la contraseña
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

    // Validación final del formulario
    form.addEventListener("submit", function (event) {
        let isValid = true;
        if (!validateInput(nombreInput, nameRegex)) isValid = false;
        if (!validateInput(apellidoInput, nameRegex)) isValid = false;
        if (!validateInput(emailInput, emailRegex)) isValid = false;
        if (!validateInput(passwordInput, passwordRegex)) isValid = false;

        // Verificación de contraseñas coincidentes
        if (!validatePasswordMatch()) isValid = false;

        // Si hay algún error, mostrar el mensaje
        if (!isValid) {
            errorMessage.style.display = "block";
            event.preventDefault();
        } else {
            errorMessage.style.display = "none";
        }
    });
});
