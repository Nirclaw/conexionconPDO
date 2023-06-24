<?php

require '../vendor/autoload.php';

$router=new \Bramus\Router\Router();

$router->get("/camper", function(){
    $cox = new \App\connect();
    $res = $cox->con->prepare("SELECT * FROM tb_camper");
    $res -> execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res,true);
});

$router->put("/camper", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $cox = new \App\connect();
    $res = $cox->con->prepare("UPDATE tb_camper SET nombre = :NOMBRE, edad= :EDAD WHERE id =:CEDULA");
    $res-> bindValue("NOMBRE", $_DATA['nom']);
    $res-> bindValue("EDAD", $_DATA['edad']); //para editar se debe escribir la sentencia dentro del $_DATA["nom"] es decir { nom: Wilfer, id: 1}
    $res-> bindValue("CEDULA", $_DATA['id']);
    $res -> execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router -> delete("/camper", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $cox = new \App\connect();
    $res = $cox->con->prepare("DELETE FROM tb_camper WHERE id =:CEDULA");
    $res->bindValue("ID", $_DATA["id"]);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->post("/camper", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $cox = new \App\connect();
    $res = $cox->con->prepare("INSERT INTO tb_camper (nombre, edad) VALUES (:NOMBRE, :CEDULA");
    $res-> bindValue("nombre", $_DATA['nom']); //para editar se debe escribir la sentencia dentro del $_DATA["nom"] es decir { nom: Wilfer, id: 1}
    $res-> bindValue("edad", $_DATA['edad']); 
    $res -> execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

/* 
"nombre": "Wilfer 5",
"edad": 28 */
/**
 * !preparar
 * !enviar
 * !esperar
 * !ejecutar
 */


$router->run();
