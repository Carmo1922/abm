<?php include_once 'include_menu.php';

if (!isset($_SESSION['leg'])) {
    header("location: login_sur.php");
}


$martes = dia_siguientex('P1D');
$miercoles = dia_siguientex('P2D');
$jueves = dia_siguientex('P3D');
$viernes = dia_siguientex('P4D');
$lunes = dia_siguientex('P7D');

$diferencia = fecha_dif();

$diferencia = 11;

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <title>Cargar menú</title>
</head>

<body>
    <header>
        <img src="sur2.png" alt="" class="logo_sur">
        <span id="dia_label">DIA</span>
        <img src="k.jpg" alt="" class="logo_klonal">

    </header>
    <main>
        <div class="select_day">
            <button id="anterior">◀</button>
            <p class="fechaH">Fecha</p>
            
            <button id="siguiente">▶</button>
        </div>

        <form id="formulario">

            <fieldset id="martes">
                <label for="fecha">
                    <input type="date" name="fecha[]" id="fecha" readonly="true" value=<?php echo $martes; ?>></input>
                </label>
                <label for="sin_martes" class="sin_servicio">
                    <p>Sin Servicio</p>
                    <input type="checkbox" name="sin_servicio" id="sin_martes" onchange="toggleFieldsets(event)">

                </label>
                <label for="principal">
                    <p>Plato Principal</p>
                    <input type="text" name="principal[]" id="" placeholder="Principal"></input>
                </label>
                <label for="dieta">
                    <p>Dieta</p>
                    <input type="text" name="dieta[]" id="" placeholder="Dieta"></input>
                </label>
                <label for="tarta">
                    <p>Tarta</p>
                    <input type="text" name="tarta[]" id="" placeholder="Tarta"></input>
                </label>
                <label for="pizza">
                    <p>Pizza</p>
                    <input type="text" name="pizza[]" id="" placeholder="Pizza"></input>
                </label>
                <label for="sandwich">
                    <p>Sandwich</p>
                    <input type="text" name="sandwich[]" id="" placeholder="Sandwich"></input>
                </label>
                <label for="vegetariano">
                    <p>Vegetariano</p>
                    <input type="text" name="vegetariano[]" id="" placeholder="Vegetariano"></input>
                </label>
            </fieldset>

            <fieldset id="miercoles">

                <label for="fecha">
                    <input type="date" name="fecha[]" id="fecha" readonly="true" value=<?php echo $miercoles; ?>></input>
                </label>
                <label for="sin_miercoles" class="sin_servicio">
                    <p>Sin Servicio</p>
                    <input type="checkbox" name="sin_servicio" id="sin_miercoles" onchange="toggleFieldsets(event)">
                </label>
                <label for="principal">
                    <p>Plato Principal</p>
                    <input type="text" name="principal[]" id="" placeholder="Principal"></input>
                </label>
                <label for="dieta">
                    <p>Dieta</p>
                    <input type="text" name="dieta[]" id="" placeholder="Dieta"></input>
                </label>
                <label for="tarta">
                    <p>Tarta</p>
                    <input type="text" name="tarta[]" id="" placeholder="Tarta"></input>
                </label>
                <label for="pizza">
                    <p>Pizza</p>
                    <input type="text" name="pizza[]" id="" placeholder="Pizza"></input>
                </label>
                <label for="sandwich">
                    <p>Sandwich</p>
                    <input type="text" name="sandwich[]" id="" placeholder="Sandwich"></input>
                </label>
                <label for="vegetariano">
                    <p>Vegetariano</p>
                    <input type="text" name="vegetariano[]" id="" placeholder="Vegetariano"></input>
                </label>
            </fieldset>

            <fieldset id="jueves">

                <label for="fecha">
                    <input type="date" name="fecha[]" id="fecha" readonly="true" value=<?php echo $jueves; ?>></input>
                </label>
                <label for="sin_jueves" class="sin_servicio">
                    <p>Sin Servicio</p>
                    <input type="checkbox" name="sin_servicio" id="sin_jueves" onchange="toggleFieldsets(event)">
                </label>
                <label for="principal">
                    <p>Plato Principal</p>
                    <input type="text" name="principal[]" id="" placeholder="Principal"></input>
                </label>
                <label for="dieta">
                    <p>Dieta</p>
                    <input type="text" name="dieta[]" id="" placeholder="Dieta"></input>
                </label>
                <label for="tarta">
                    <p>Tarta</p>
                    <input type="text" name="tarta[]" id="" placeholder="Tarta"></input>
                </label>
                <label for="pizza">
                    <p>Pizza</p>
                    <input type="text" name="pizza[]" id="" placeholder="Pizza"></input>
                </label>
                <label for="sandwich">
                    <p>Sandwich</p>
                    <input type="text" name="sandwich[]" id="" placeholder="Sandwich"></input>
                </label>
                <label for="vegetariano">
                    <p>Vegetariano</p>
                    <input type="text" name="vegetariano[]" id="" placeholder="Vegetariano"></input>
                </label>
            </fieldset>

            <fieldset id="viernes">

                <label for="fecha">
                    <input type="date" name="fecha[]" id="fecha" readonly="true" value=<?php echo $viernes; ?>></input>
                </label>
                <label for="sin_viernes" class="sin_servicio">
                    <p>Sin Servicio</p>
                    <input type="checkbox" name="sin_servicio" id="sin_viernes" onchange="toggleFieldsets(event)">
                </label>
                <label for="principal">
                    <p>Plato Principal</p>
                    <input type="text" name="principal[]" id="" placeholder="Principal"></input>
                </label>
                <label for="dieta">
                    <p>Dieta</p>
                    <input type="text" name="dieta[]" id="" placeholder="Dieta"></input>
                </label>
                <label for="tarta">
                    <p>Tarta</p>
                    <input type="text" name="tarta[]" id="" placeholder="Tarta"></input>
                </label>
                <label for="pizza">
                    <p>Pizza</p>
                    <input type="text" name="pizza[]" id="" placeholder="Pizza"></input>
                </label>
                <label for="sandwich">
                    <p>Sandwich</p>
                    <input type="text" name="sandwich[]" id="" placeholder="Sandwich"></input>
                </label>
                <label for="vegetariano">
                    <p>Vegetariano</p>
                    <input type="text" name="vegetariano[]" id="" placeholder="Vegetariano"></input>
                </label>
            </fieldset>

            <fieldset id="lunes">

                <label for="fecha">
                    <input type="date" name="fecha[]" id="fecha" readonly="true" value=<?php echo $lunes; ?>></input>
                </label>
                <label for="sin_lunes" class="sin_servicio">
                    <p>Sin Servicio</p>
                    <input type="checkbox" name="sin_servicio" id="sin_lunes" onchange="toggleFieldsets(event)">
                </label>
                <label for="principal">
                    <p>Plato Principal</p>
                    <input type="text" name="principal[]" id="" placeholder="Principal"></input>
                </label>
                <label for="dieta">
                    <p>Dieta</p>
                    <input type="text" name="dieta[]" id="" placeholder="Dieta"></input>
                </label>
                <label for="tarta">
                    <p>Tarta</p>
                    <input type="text" name="tarta[]" id="" placeholder="Tarta"></input>
                </label>
                <label for="pizza">
                    <p>Pizza</p>
                    <input type="text" name="pizza[]" id="" placeholder="Pizza"></input>
                </label>
                <label for="sandwich">
                    <p>Sandwich</p>
                    <input type="text" name="sandwich[]" id="" placeholder="Sandwich"></input>
                </label>
                <label for="vegetariano">
                    <p>Vegetariano</p>
                    <input type="text" name="vegetariano[]" id="" placeholder="Vegetariano"></input>
                </label>
            </fieldset>


            <div class="enviar_editar">
                <?php if ($diferencia == 11) {
                    echo "<input type='submit' value='Enviar' id='enviar'>";
                } else {
                    echo "<p>Solo puede cargar el menu los dias Jueves!</p>";
                }; ?>

            </div>

        </form>

    </main>

    <footer></footer>

    <script src="index.js"></script>
</body>

</html>