document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const descripcion = form.querySelector("[name='descripcion']");
    const precio = form.querySelector("[name='precio']");
    const ubicacion = form.querySelector("[name='ubicacion']");
    const ancho = form.querySelector("[name='ancho']");
    const largo = form.querySelector("[name='largo']");
    const area = form.querySelector("[name='area']");
    const habitaciones = form.querySelector("[name='num_habitaciones']");
    const banos = form.querySelector("[name='num_banos']");
    const estacionamiento = form.querySelector("[name='estacionamiento']");
    const estado = form.querySelector("[name='estado']");
    const imagenes = form.querySelector("[name='imagenes[]']");

    const errorMessage = document.createElement("p");
    errorMessage.textContent = "Por favor, completa todos los campos correctamente.";
    errorMessage.style.color = "red";
    errorMessage.style.backgroundColor = "#f8d7da";
    errorMessage.style.padding = "10px";
    errorMessage.style.borderRadius = "5px";
    errorMessage.style.textAlign = "center";
    errorMessage.style.marginBottom = "10px";
    errorMessage.style.display = "none";
    form.prepend(errorMessage);

    function validateText(input, minLength = 5) {
        const valid = input.value.trim().length >= minLength;
        input.style.border = valid ? "2px solid green" : "2px solid red";
        return valid;
    }

    function validateNumber(input) {
        const value = parseFloat(input.value);
        const valid = !isNaN(value) && value > 0;
        input.style.border = valid ? "2px solid green" : "2px solid red";
        return valid;
    }

    function validateSelect(select) {
        const valid = select.value !== "";
        select.style.border = valid ? "2px solid green" : "2px solid red";
        return valid;
    }

    function validateFiles(input) {
        const valid = input.files.length > 0;
        input.style.border = valid ? "2px solid green" : "2px solid red";
        return valid;
    }

    form.addEventListener("submit", function (event) {
        let isValid = true;
        isValid &= validateText(descripcion, 10);
        isValid &= validateNumber(precio);
        isValid &= validateText(ubicacion);
        isValid &= validateNumber(ancho);
        isValid &= validateNumber(largo);
        isValid &= validateNumber(area);
        isValid &= validateNumber(habitaciones);
        isValid &= validateNumber(banos);
        isValid &= validateNumber(estacionamiento);
        isValid &= validateSelect(estado);
        isValid &= validateFiles(imagenes);

        if (!isValid) {
            errorMessage.style.display = "block";
            event.preventDefault(); // Previene el envio si hay errores
        } else {
            errorMessage.style.display = "none";
        }
    });
});
