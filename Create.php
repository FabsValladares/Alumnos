<?php
header("Access-Control-Allow-Origin: *"); 

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: POST");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//permitir solo el meto http post

include_once 'Database.php';
include_once 'Alumn.php';

$database = new Database();
$instancia = $database->getConnection();

$item = new Alumnos($instancia);
$data = json_decode(file_get_contents("php://input"));



if(isset($data)){
$item->nombres = $data->nombres;
$item->apellidos = $data->apellidos;
$item->fechanac = $data->fechanac;
$item->foto =base64_decode( $data->foto);


if($item->createAlumn()){
    echo json_encode(array("message" => "creado"));
}
else{
    echo json_encode(array("message" => "No creado"));
}
}else{
    echo json_encode(array("message" => "No hay datos"));
}


?>
