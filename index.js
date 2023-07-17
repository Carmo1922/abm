document.addEventListener("DOMContentLoaded", function () {
    const anteriorBtn = document.getElementById("anterior");
    const siguienteBtn = document.getElementById("siguiente");
    const diaLabel = document.getElementById("dia_label");
    const fieldsets = document.querySelectorAll("fieldset");
    let currentFieldsetIndex = 0;

    // Oculta el botón "anterior" inicialmente
    anteriorBtn.style.display = "none";

    // Obtiene el día correspondiente al ID del fieldset
    function getDayFromFieldsetID(fieldsetID) {
        const days = ["martes", "miercoles", "jueves", "viernes", "lunes"];
        const index = days.indexOf(fieldsetID.toLowerCase());
        if (index !== -1) {
            return days[index];
        }
        return "";
    }

    // Muestra el fieldset siguiente
    function mostrarSiguienteFieldset() {
        if (currentFieldsetIndex < fieldsets.length - 1) {
            fieldsets[currentFieldsetIndex].style.display = "none";
            currentFieldsetIndex++;
            fieldsets[currentFieldsetIndex].style.display = "block";
            updateDiaLabel();
        }

        if (currentFieldsetIndex === fieldsets.length - 1) {
            siguienteBtn.textContent = "Mostrar";
        } else {
            siguienteBtn.textContent = "▶";
        }

        // Muestra el botón "anterior" cuando se avanza a un fieldset diferente del primero
        if (currentFieldsetIndex > 0) {
            anteriorBtn.style.display = "block";
        }
    }

    // Muestra el fieldset anterior
    function mostrarFieldsetAnterior() {
        if (currentFieldsetIndex > 0) {
            fieldsets[currentFieldsetIndex].style.display = "none";
            currentFieldsetIndex--;
            fieldsets[currentFieldsetIndex].style.display = "block";
            updateDiaLabel();
        }

        // Oculta el botón "anterior" cuando se muestra el primer fieldset
        if (currentFieldsetIndex === 0) {
            anteriorBtn.style.display = "none";
        }

        if (currentFieldsetIndex < fieldsets.length - 1) {
            siguienteBtn.textContent = "▶";
        }
    }

    // Actualiza el texto del span con el día correspondiente
    function updateDiaLabel() {
        const currentFieldset = fieldsets[currentFieldsetIndex];
        const currentFieldsetID = currentFieldset.id;
        const currentDay = getDayFromFieldsetID(currentFieldsetID);
        diaLabel.textContent = currentDay;
    }

    // Oculta todos los fieldsets excepto el primero
    for (let i = 1; i < fieldsets.length; i++) {
        fieldsets[i].style.display = "none";
    }

    

    // Agrega eventos a los botones
    anteriorBtn.addEventListener("click", mostrarFieldsetAnterior);
    siguienteBtn.addEventListener("click", mostrarSiguienteFieldset);

    // Establece el texto inicial del span
    updateDiaLabel();
});

function toggleFieldsets(event) {
    const checkbox = event.target;
    const fieldset = checkbox.closest('fieldset');
    const elementosOcultos = fieldset.querySelectorAll('label:not(.sin_servicio)');

    if (checkbox.checked) {
        elementosOcultos.forEach(elemento => {
            elemento.classList.add('oculto');
        });
    } else {
        elementosOcultos.forEach(elemento => {
            elemento.classList.remove('oculto');
        });
    }
}
