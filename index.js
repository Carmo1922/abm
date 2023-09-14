async function es_feriado(f, dia_sm, fs) {
  let fecha = new Date(f);
  let d = fecha.getDate();
  let m = fecha.getMonth();
  d = d + 1;
  m = m + 1;
  let y = fecha.getFullYear();

  const fieldset = fs;
  const elementosOcultos = fieldset.querySelectorAll(
    'label:not(.sin_servicio) input[type="text"]'
  );

  const response = await fetch(
    "https://nolaborables.com.ar/api/v2/feriados/" + y
  );
  let data = await response.json();

  for (const feriado of data) {
    if (feriado.dia == d && feriado.mes == m) {
      document.getElementById(dia_sm).checked = true;
      elementosOcultos.forEach((elemento) => {
        elemento.value = "none";
        elemento.classList.add("oculto");
      });
    }
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const anteriorBtn = document.getElementById("anterior");
  const siguienteBtn = document.getElementById("siguiente");
  const diaLabel = document.getElementById("dia_label");
  const fieldsets = document.querySelectorAll("fieldset");
  const enviarBtn = document.querySelector('input[type="submit"]'); // Selecciona el botón "Enviar"
  //const enviar_realBtn = document.getElementById("enviar");
  let currentFieldsetIndex = 0;

  //ocuto el boten enviar si no es jueves

  // let fecha = new Date();
  // let dia_semana = fecha.getDay();
  // //si no es Jueves (4) no mostramos enviar

  // if (dia_semana != 4) {
  //    enviar_realBtn.style.display="none";
  //  }

  //recorro los fieldset y verifico si es feriado
  for (const set of fieldsets) {
    fecha = set.firstElementChild.lastElementChild.value;
    dia_f = set.id;
    dia_sm = "sin_" + dia_f;
    es_feriado(fecha, dia_sm, set);
  }

  // Oculta el botón "anterior" inicialmente
  anteriorBtn.style.display = "none";
  enviarBtn.style.display = "none";

  // Obtiene el día correspondiente al ID del fieldset
  function getDayFromFieldsetID(fieldsetID) {
    const days = ["martes", "miercoles", "jueves", "viernes", "lunes"];
    const index = days.indexOf(fieldsetID.toLowerCase());
    if (index !== -1) {
      return days[index];
    }
    return "";
  }

  // Función para actualizar la visibilidad del botón "Enviar" según el día

  // Muestra el fieldset siguiente
  function mostrarSiguienteFieldset() {
    if (currentFieldsetIndex < fieldsets.length - 1) {
      fieldsets[currentFieldsetIndex].style.display = "none";
      currentFieldsetIndex++;
      fieldsets[currentFieldsetIndex].style.display = "block";
      updateDiaLabel();
    }

    if (currentFieldsetIndex === fieldsets.length - 1) {
      siguienteBtn.style.display = "none";
      enviarBtn.style.display = "block";
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
      siguienteBtn.style.display = "block";
      siguienteBtn.textContent = "▶";
      enviarBtn.style.display = "none";
    }

    actualizarVisibilidadEnviarBtn();
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
  const fieldset = checkbox.closest("fieldset");
  const elementosOcultos = fieldset.querySelectorAll(
    'label:not(.sin_servicio) input[type="text"]'
  );

  if (checkbox.checked) {
    elementosOcultos.forEach((elemento) => {
      elemento.value = "none";
      elemento.classList.add("oculto");
    });
  } else {
    elementosOcultos.forEach((elemento) => {
      elemento.value = ""; // Restablecer el valor a vacío
      elemento.classList.remove("oculto");
    });
  }
}

formulario.addEventListener("submit", (evento) => {
  evento.preventDefault();

  // Validar campos vacíos antes de enviar el formulario
  const fieldsets = document.querySelectorAll("fieldset");
  let hayCamposVacios = false;

  fieldsets.forEach((fieldset) => {
    const inputs = fieldset.querySelectorAll('input[type="text"]');
    inputs.forEach((input) => {
      if (input.value.trim() === "") {
        hayCamposVacios = true;
        return;
      }
    });
  });

  if (hayCamposVacios) {
    alert(
      "Error! Falta completar algunos campos. Por favor llenar las entradas del menu faltantes"
    );
    return;
  }

  // Si no hay campos vacíos, enviar los datos
  let datos = new FormData(formulario);

  fetch("abm_menu.php", {
    method: "POST",
    body: datos,
  })
    .then((res) => res.json())
    .then((respuesta) => {
      console.log(respuesta);
      if (respuesta) {
        alert("Menu cargado correctamente");

        window.location.href = "login_sur.php";
      }
    });
});
