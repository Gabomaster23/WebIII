document.addEventListener("DOMContentLoaded", function () {
    const precioInput = document.getElementById("precio");
    const engancheInput = document.getElementById("enganche");
    const plazoRadios = document.getElementsByName("plazo");
    const calcularBtn = document.querySelector("button");
    const errorMessage = document.createElement("p");
    
    errorMessage.style.color = "red";
    errorMessage.style.backgroundColor = "#f8d7da";
    errorMessage.style.padding = "10px";
    errorMessage.style.borderRadius = "5px";
    errorMessage.style.textAlign = "center";
    errorMessage.style.marginBottom = "10px";
    errorMessage.style.display = "none";
    
    const calculatorDiv = document.querySelector(".calculator");
    calculatorDiv.prepend(errorMessage);

    function validateInputs() {
        let isValid = true;
        let errorText = "";
        
        // Validar precio
        if (precioInput.value.trim() === "" || parseFloat(precioInput.value) <= 0) {
            precioInput.style.border = "2px solid red";
            errorText = "Ingresa un precio válido mayor que 0.";
            isValid = false;
        } else {
            precioInput.style.border = "2px solid green";
        }
        
        // Validar enganche
        if (engancheInput.value.trim() === "") {
            engancheInput.style.border = "2px solid red";
            isValid = false;
        } else {
            engancheInput.style.border = "2px solid green";
        }
        
        // Validar que se seleccione un plazo
        let plazoSeleccionado = false;
        plazoRadios.forEach(radio => {
            if (radio.checked) {
                plazoSeleccionado = true;
            }
        });
        
        if (!plazoSeleccionado) {
            isValid = false;
        }
        
        // Mostrar mensaje de error si hay problemas
        if (!isValid) {
            if (errorText === "") {
                errorText = "Ingresa campos válidos.";
            }
            errorMessage.textContent = errorText;
            errorMessage.style.display = "block";
        } else {
            errorMessage.style.display = "none";
        }
        
        return isValid;
    }
    
    precioInput.addEventListener("input", validateInputs);
    engancheInput.addEventListener("input", validateInputs);
    plazoRadios.forEach(radio => radio.addEventListener("change", validateInputs));
    
    calcularBtn.addEventListener("click", function (event) {
        if (!validateInputs()) {
            event.preventDefault();
        }
    });
});