async function generarReporte() {
    const inicio = document.getElementById("fecha_inicio").value;
    const fin = document.getElementById("fecha_fin").value;

    if (!inicio || !fin) {
        alert("Por favor selecciona ambas fechas.");
        return;
    }

    const response = await fetch(`../Admin/obtener_ventas.php?inicio=${inicio}&fin=${fin}`);
    const datos = await response.json();

    let totalVentas = 0;
    let numeroVentas = datos.length;
    const ventasPorFecha = {};
    const ventasPorTipo = {};

    datos.forEach(({ fecha, monto, tipo_propiedad }) => {
        monto = parseFloat(monto);
        totalVentas += monto;

        // Agrupar por fecha
        ventasPorFecha[fecha] = (ventasPorFecha[fecha] || 0) + monto;

        // Agrupar por tipo de propiedad
        ventasPorTipo[tipo_propiedad] = (ventasPorTipo[tipo_propiedad] || 0) + monto;
    });

    // Mostrar totales
    document.getElementById("ventasTotales").textContent = `$${totalVentas.toFixed(2)}`;
    document.getElementById("numeroVentas").textContent = numeroVentas;

    // Llenar ventas por sección
    const contenedorSeccion = document.getElementById("ventasPorSeccion");
    contenedorSeccion.innerHTML = "";
    for (const tipo in ventasPorTipo) {
        const div = document.createElement("div");
        div.innerHTML = `<p>${tipo}: <strong>$${ventasPorTipo[tipo].toFixed(2)}</strong></p>`;
        contenedorSeccion.appendChild(div);
    }

    // Graficar
    const ctx = document.getElementById("graficaVentas").getContext("2d");
    if (window.miGrafica) window.miGrafica.destroy(); // Evitar duplicados

    window.miGrafica = new Chart(ctx, {
        type: "bar",
        data: {
            labels: Object.keys(ventasPorFecha),
            datasets: [{
                label: "Monto de ventas por día",
                data: Object.values(ventasPorFecha),
                backgroundColor: "#4caf50"
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
