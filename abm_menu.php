<?php include_once 'include_menu.php';

if (!isset($_SESSION['leg'])){	  
    header ("location: login_sur.php"); 
   }


   if ($_POST){
    $fe = $_POST['fecha'];
    $pp = $_POST['principal'];
    $di = $_POST['dieta'];
    $ta = $_POST['tarta'];
    $pi = $_POST['pizza'];
    $sa = $_POST['sandwich'];
    $ve = $_POST['vegetariano'];
  
    // si estoy cargando un jueves (se valida en el js que sea un jueves) y estoy cargando una semana la fideferencia maxima deberia ser 11, evito carga doble 
    $diferencia = fecha_dif();
    //$diferencia = 11; 
  
    if ($diferencia == 11 )
         
    {
        $semana_actual = semana_actual();
        $semana_nueva = $semana_actual + 1 ;
  
        $db = db_connect();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        for ($i=0; $i<=4; $i++){
                                                 
                                if($pp[$i]<>'none'){
                                  $q = $db->prepare("INSERT INTO menues (nro_semana, dia, plato_id, name, descripcion, calorias) 
                                  VALUES ('".$semana_nueva."', '".$fe[$i]."', '7', 'Plato Principal', '".$pp[$i]."', '800-900');");
                                  $q->execute();
                                 }
                                
                                 if($di[$i]<>'none'){
                                $q = $db->prepare("INSERT INTO menues (nro_semana, dia, plato_id, name, descripcion, calorias) 
                                            VALUES ('".$semana_nueva."','" .$fe[$i]. "', '15', 'Dieta','" .$di[$i]. "', '450-550');");
                                
                                $q->execute();
                                 }
                                
  
                                if($ta[$i]<>'none'){  
                                $q = $db->prepare("INSERT INTO menues (nro_semana, dia, plato_id, name, descripcion, calorias) 
                                            VALUES ('".$semana_nueva."','".$fe[$i]. "',  '10', 'Tarta','" .$ta[$i]."', '350-450');");
                                
                                $q->execute();
                                }
                                if($pi[$i]<>'none'){
                                $q = $db->prepare("INSERT INTO menues (nro_semana, dia, plato_id, name, descripcion, calorias) 
                                            VALUES ('".$semana_nueva."','" .$fe[$i]. "',  '16', 'Pizza','" .$pi[$i]. "', '500-600');");
                                
                                $q->execute();
                                }
  
                                if($sa[$i]<>'none'){
                                $q = $db->prepare("INSERT INTO menues (nro_semana, dia, plato_id, name, descripcion, calorias) 
                                            VALUES ('".$semana_nueva."','" .$fe[$i]. "',  '11', 'Sandwich', '".$sa[$i]."', '600-700');");
                                
                                $q->execute();
                                }
                                
                                if($ve[$i]<>'none'){
                                $q = $db->prepare("INSERT INTO menues (nro_semana, dia, plato_id, name, descripcion, calorias) 
                                            VALUES ('".$semana_nueva."','" .$fe[$i]. "',  '7', 'Vegetariano', '".$ve[$i]."', '650-750');");
                               
                                $q->execute();
                                }
                                
                                
                                $p = $db->prepare("INSERT INTO menues (nro_semana, dia, plato_id, name, descripcion, calorias) 
                                VALUES ('".$semana_nueva."','" .$fe[$i]. "',  '-20', 'Sin Menu', 'Ausente, Feriado, Vacaciones o Viaje', '0');");
                               
                                $p->execute();
                              
                                $proceso = true;
     
  
  
       
  
  }
  
  }
  
  unset($_SESSION['leg']);

  echo json_encode ($proceso);

  
  
  
  
  }








 ?>  