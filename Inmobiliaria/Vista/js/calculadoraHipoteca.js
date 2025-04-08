document.addEventListener("DOMContentLoaded", function () {
    const precioInput = document.getElementById("precio");
    const engancheInput = document.getElementById("enganche");
    const plazoRadios = document.getElementsByName("plazo");
    const calcularBtn = document.querySelector("button");
    const resultadoDiv = document.getElementById("resultado");

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

        if (precioInput.value.trim() === "" || parseFloat(precioInput.value) <= 0) {
            precioInput.style.border = "2px solid red";
            errorText = "Ingresa un precio válido mayor que 0.";
            isValid = false;
        } else {
            precioInput.style.border = "2px solid green";
        }

        if (engancheInput.value.trim() === "" || parseFloat(engancheInput.value) < 0) {
            engancheInput.style.border = "2px solid red";
            if (!errorText) errorText = "Ingresa un enganche válido.";
            isValid = false;
        } else {
            engancheInput.style.border = "2px solid green";
        }

        let plazoSeleccionado = false;
        plazoRadios.forEach(radio => {
            if (radio.checked) {
                plazoSeleccionado = true;
            }
        });

        if (!plazoSeleccionado) {
            if (!errorText) errorText = "Selecciona un plazo.";
            isValid = false;
        }

        if (!isValid) {
            errorMessage.textContent = errorText;
            errorMessage.style.display = "block";
        } else {
            errorMessage.style.display = "none";
        }

        return isValid;
    }

    calcularBtn.addEventListener("click", function (event) {
        event.preventDefault();
        if (!validateInputs()) return;

        const precio = parseFloat(precioInput.value);
        const enganche = parseFloat(engancheInput.value);
        const plazoAnios = parseInt([...plazoRadios].find(r => r.checked).value);

        const tasaAnual = 0.116; // 11.60% anual
        const tasaMensual = tasaAnual / 12;
        const plazoMeses = plazoAnios * 12;
        const montoPrestamo = precio - enganche;

        const pagoMensual = montoPrestamo * (tasaMensual * Math.pow(1 + tasaMensual, plazoMeses)) /
                            (Math.pow(1 + tasaMensual, plazoMeses) - 1);

        resultadoDiv.innerHTML = `
            <p>🏠 <strong>Préstamo solicitado:</strong> $${montoPrestamo.toFixed(2)}</p>
            <p>📅 <strong>Plazo:</strong> ${plazoAnios} años (${plazoMeses} meses)</p>
            <p>📈 <strong>Tasa de interés aplicada:</strong> 11.60% anual</p>
            <p>💰 <strong>Pago mensual estimado:</strong>$${pagoMensual.toFixed(2)}</p>
            <p style="font-size: 0.9em; color: #555;">* Este cálculo es aproximado y puede variar según condiciones del banco y perfil del solicitante.</p>
        `;
        resultadoDiv.style.display = "block";
    });
});
