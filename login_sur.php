<?php
	
	include_once 'include_menu.php';
    

    $diferencia = fecha_dif();
    $diferencia = 11;
				
	if($_POST){
		
		
		$usuario = stripslashes($_POST['usuario']);
		$usuario = strip_tags($usuario);
		
		$clave = stripslashes($_POST['clave']);
		$clave = strip_tags($clave);
		$resultado = strip_tags(stripslashes (check_us($usuario, $clave)));
        if ($diferencia == 11){
				
		if (($resultado && $usuario == 90001) || ($resultado && $usuario == 90002 )) {
               header("location:sur.php");}}
    }
echo "




<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='login.css'>
    <title>Login menú</title>
</head>

<body>
    <main>
    <div class='login'>
        <h1>Servicio comedor Klonal</h1>
        <form method='post' action='login_sur.php'>
        ";
        if ($diferencia <> 11)
        {echo "<h5 style='color:#FF0000' class='text-center font-weight-light my-4'>Solo puede cargar el menu los dias jueves</h5>";}
        else{
		if ($_POST){
		
		if ( !$resultado ) echo "<h5 style='color:#FF0000' class='text-center font-weight-light my-4'>usuario/contraseña invalido</h5>" ; 
		}}
		echo "        
            <input type='text' name='usuario' placeholder='Legajo' required='required' />
            <input type='password' name='clave' placeholder='Contraseña' required='required' />
            <button type='submit' class='btn btn-primary btn-block btn-large'>Iniciar sesión</button>
        </form>
    </div>
    </main>
</body>

</html>";

?>