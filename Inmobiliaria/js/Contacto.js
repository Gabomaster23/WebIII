document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const nombreInput = document.getElementById("nombre");
    const apellidoInput = document.getElementById("apellido");
    const emailInput = document.getElementById("email");
    const telefonoInput = document.getElementById("telefono");
    const mensajeInput = document.getElementById("mensaje");

    const errorMessage = document.createElement("p");
    errorMessage.textContent = "Por favor, completa todos los campos correctamente.";
    errorMessage.style.color = "red";
    errorMessage.style.backgroundColor = "#f8d7da";
    errorMessage.style.padding = "10px";
    errorMessage.style.borderRadius = "5px";
    errorMessage.style.textAlign = "center";
    errorMessage.style.marginBottom = "10px";
    errorMessage.style.display = "none";  // Inicialmente oculto
    form.prepend(errorMessage);  // Añadimos el mensaje de error en la parte superior

    // Expresiones regulares para validaciones
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^[0-9]{10}$/;  // 10 dígitos numéricos

    // Función de validación de campo
    function validateField(input, regex = null) {
        if (input.value.trim() === "") {
            input.style.border = "2px solid red"; // Si está vacío, lo marcamos en rojo
            return false;
        } else if (regex && !regex.test(input.value.trim())) {
            input.style.border = "2px solid red"; // Si no coincide con el formato, lo marcamos en rojo
            return false;
        } else {
            input.style.border = "2px solid green"; // Si es válido, lo marcamos en verde
            return true;
        }
    }

    // Validación en tiempo real mientras el usuario escribe
    nombreInput.addEventListener("input", () => {
        validateField(nombreInput);
        checkFormValidity();
    });
    apellidoInput.addEventListener("input", () => {
        validateField(apellidoInput);
        checkFormValidity();
    });
    emailInput.addEventListener("input", () => {
        validateField(emailInput, emailRegex);
        checkFormValidity();
    });
    telefonoInput.addEventListener("input", () => {
        validateField(telefonoInput, phoneRegex);
        checkFormValidity();
    });
    mensajeInput.addEventListener("input", () => {
        validateField(mensajeInput);
        checkFormValidity();
    });

    // Verificar si todos los campos son válidos
    function checkFormValidity() {
        const isFormValid = (
            validateField(nombreInput) &&
            validateField(apellidoInput) &&
            validateField(emailInput, emailRegex) &&
            validateField(telefonoInput, phoneRegex) &&
            validateField(mensajeInput)
        );

        if (isFormValid) {
            errorMessage.style.display = "none"; // Ocultar el mensaje de error si todo está bien
        } else {
            errorMessage.style.display = "block"; // Mostrar el mensaje de error si hay campos inválidos
        }
    }

    // Validación al hacer submit
    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Validamos cada campo al enviar el formulario
        if (!validateField(nombreInput)) isValid = false;
        if (!validateField(apellidoInput)) isValid = false;
        if (!validateField(emailInput, emailRegex)) isValid = false;
        if (!validateField(telefonoInput, phoneRegex)) isValid = false;
        if (!validateField(mensajeInput)) isValid = false;

        // Si la validación falla, mostramos el mensaje de error y evitamos el envío del formulario
        if (!isValid) {
            errorMessage.style.display = "block";
            event.preventDefault();  // Evita que el formulario se envíe
        }
    });
});
