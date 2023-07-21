<?php


$pp = $_POST['principal'];
$di = $_POST['dieta'];
$ta = $_POST['tarta'];
$pi = $_POST['pizza'];
$sa = $_POST['sandwich'];
$ve = $_POST['vegetariano'];


function db_connect() {
  //conecta con la base de datos
  $dbh = new PDO("mysql:host=192.168.0.253;dbname=entregas;charset=utf8", "intranet", "1n7r4n37#", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  return ($dbh);
}

// Esto devuelve la fecha de los dias de la semana 
// dia[indice]= fecha
// indice = 0:martes 1:miercoles...4:lunes
function dia_fs_semana($semana){
  try {
    $db = db_connect();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $db->prepare('SELECT DISTINCT dia
                      FROM menues
                      WHERE nro_semana = :sem
                      ORDER BY nro_semana ASC;');
    $q->bindParam('sem',$semana);
    $q->execute();
    //$salida = $q->fetch(PDO::FETCH_ASSOC);
    $i = 0;
    while ($row = $q->fetch()){
        $salida[$i]=$row['dia'];
        $i++;
    }
    return $salida;
  } catch (PDOException $e) {
    echo($e->getMessage());  
  }
}



// detectamos los dias de la semana y ponemos opcion sin menu

function sin_menu(){
          $db = db_connect();
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $codigo_ausente = -20;
          $dias = dia_fs_semana($semana_actual);
          for ($i=0 ; $i < 5 ; $i++ ) { 
                  try {
                  $day = date("Y-m-d H:i:s", strtotime($dias[$i]));
                  $p = $db->prepare("INSERT INTO menues (nro_semana, dia, plato_id, name, descripcion, calorias) 
                              VALUES (:nro_semana, :dia, :plato_id, 'Sin Menu', 'Ausente, Feriado, Vacaciones o Viaje', 0);");
                  $p->bindParam(':nro_semana', $semana_actual);
                  $p->bindParam(':dia', $day);
                  $p->bindParam(':plato_id', $codigo_ausente);
                  $p->execute();
              } catch (PDOException $e) {
                  echo ($e->getMessage());
              }
          }

}




for ($i=0; $i<=4; $i++)
{ 
  if ($pp[$i] == '' ){
   
    $mensaje = $_POST;
 //   'la posicion '.$i. ' esta vacia';
    break; 
}else{
     $mensaje = 'todos los campos estan completos';
  }

}

echo json_encode ($mensaje);



?>