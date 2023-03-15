<?php
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: GET");


include_once 'Database.php';
include_once 'Alumn.php';


$database = new Database();
$instancia = $database->getConnection();

$item = new Alumnos($instancia);

$resp = $item->GetAlumns();


if($resp->rowCount()>0)
{
   $alumarray = array();
   while($fila = $resp->fetch(PDO::FETCH_ASSOC) ){
    extract($fila);
    $e=array("id" => $id,
             "nombres" => $nombres,
             "apellidos" => $apellidos,
             "fechanac" => $fechanac,
             "foto" => $foto);

             array_push($alumarray,$e);
   }
   echo json_encode($alumarray);

}else{
    
    echo json_encode(array("message" => "No hay datos"));
}




?>