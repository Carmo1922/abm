<?php

session_start();

function db_connect() {
  //conecta con la base de datos
  $dbh = new PDO("mysql:host=localhost;dbname=entregas;charset=utf8", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  // $dbh = new PDO("mysql:host=192.168.0.253;dbname=entregas;charset=utf8", "intranet", "1n7r4n37#", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  return ($dbh);
}


function dia_siguiente(){

  $db = db_connect();
  $q = $db->prepare('SELECT MAX( dia ) as mayor FROM menues');
  $q->execute();
  $row = $q->fetch(PDO::FETCH_ASSOC);
  if ($row) {
    $fecha = new DateTime($row['mayor']);
    $fecha->add(new DateInterval('P1D'));
    $date = date_format($fecha,"Y-m-d");
    
     return $date;
     
     }
  else {
     return "NOK";} 
     $db = null;   
   }  
  
   

function dia_siguientex($sumo){

  // sumo = 'P1D';
 
  $db = db_connect();
  $q = $db->prepare('SELECT MAX( dia ) as mayor FROM menues');
  $q->execute();
  $row = $q->fetch(PDO::FETCH_ASSOC);
    
  if ($row) {
    $fecha = new DateTime($row['mayor']);
    $fecha->add(new DateInterval($sumo));
    $date = date_format($fecha,"Y-m-d");
    
     return $date;
     
     }
  else {
     return "NOK";} 
     $db = null;   
   }  
    
  
function fecha_dif(){


  $db = db_connect();
  $q = $db->prepare('SELECT MAX( dia ) as mayor FROM menues');
  $q->execute();
  $row = $q->fetch(PDO::FETCH_ASSOC);
  if ($row) {

    $datetime1 = new DateTime($row['mayor']);
    $fechaActual = date('Y-m-d'); 
    $datetime2 = date_create($fechaActual);
    $contador = date_diff($datetime1, $datetime2);
    $differenceFormat = '%a';
    $contador->format($differenceFormat);
    $diff =$contador->days;
     return $diff;
     
     }
  else {
     return "NOK";} 
     $db = null;   

  
  // $fechaActual = date('Y-m-d'); 
  // $datetime1 = date_create($fechaEnvio);
  // $datetime2 = date_create($fechaActual);
  // $contador = date_diff($datetime1, $datetime2);
  // $differenceFormat = '%a';
  // echo $contador->format($differenceFormat);
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


function semana_actual(){

      $db = db_connect();
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //consultamos en la tabla el ultimo numero de semana guardado
      try {
          $q = $db->prepare("SELECT nro_semana FROM menues
                          ORDER BY nro_semana DESC
                          LIMIT 1");
          $q->execute();
          $resultado = $q->fetch();
      } catch (PDOException $e) {
          echo ($e->getMessage());
      }
      $semana_act = intval($resultado["nro_semana"]);
      
      return ($semana_act);

}


function check_us($legajo, $password) {
  
  $db = db_connect();
  $q = $db->prepare("SELECT * FROM dbo_leg WHERE leg_numero =:usuario");
  $q->bindParam(':usuario', $legajo);
  $q->execute();
  $row = $q->fetch(PDO::FETCH_ASSOC);
  if ($row['leg_passw'] == $password) {
      //$db=null;
      $_SESSION['leg'] = $legajo;
      return true;
  } else {
      $_SESSION['leg'] = '';
      //$db=null;
      return false;
  }
}



?>