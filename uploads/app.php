<?php

require '../vendor/autoload.php';

$router=new \Bramus\Router\Router();

$router->get('/camper',function(){
    $cox = new \App\connect();
   $res=$cox->con->prepare("SELECT * FROM tb_camper");
   $res->execute();
   $res=$res->fetchAll(\PDO::FETCH_ASSOC);
   echo json_encode($res);
});

$router->put('/camper',function(){
    $_DATA = json_decode(file_get_contents("php://input"),true);
    $cox = new \App\connect();
    $res=$cox->con->prepare('UPDATE  tb_camper SET nombre = :NOMBRE,edad=EDAD WHERE id=:id;');
    $res->bindValue("NOMBRE",$_DATA['nom']);
    $res->bindValue("id",$_DATA['id']);
    $res->execute();
    $res= $res->rowCount();
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