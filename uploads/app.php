<?php

require '../vendor/autoload.php';

$router = new \Bramus\Router\Router();
$dotenv = Dotenv\Dotenv::createImmutable("../")->load();
$databasename = "contact_info";


$router->get("/camper", function () {
    global $databasename;
    $cox = new \App\connect();
    $res = $cox->con->prepare("SELECT * FROM $databasename");
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res, true);
});

$router->put("/camper", function () {
    global $databasename;
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $cox = new \App\connect();
    $res = $cox->con->prepare("UPDATE $databasename SET id_staff = :id_staff, whatsapp= :whatsapp, instagram= :instagram, email= :email, address= :address,cel_number= :cel_number WHERE id =:id");
    $res->bindValue("id_staff", $_DATA['id_staff']);
    $res->bindValue("whatsapp", $_DATA['whatsapp']);
    $res->bindValue("instagram", $_DATA['instagram']);
    $res->bindValue("email", $_DATA['email']);
    $res->bindValue("address", $_DATA['address']);
    $res->bindValue("cel_number", $_DATA['cel_number']);
    $res->bindValue("instagram", $_DATA['instagram']);
    $res->bindValue("id", $_DATA['id']);

    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->delete("/camper", function () {
    global $databasename;
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $cox = new \App\connect();
    $res = $cox->con->prepare("DELETE FROM $databasename WHERE id =:ID");
    $res->bindValue("ID", $_DATA["id"]);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router->post("/camper", function () {
    global $databasename;
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $cox = new \App\connect();
    $res = $cox->con->prepare("INSERT INTO $databasename (nombre, edad) VALUES (:NOMBRE, :EDAD)");
    $res->bindValue("NOMBRE", $_DATA['nom']); //para editar se debe escribir la sentencia dentro del $_DATA["nom"] es decir { nom: Wilfer, id: 1}
    $res->bindValue("EDAD", $_DATA['edad']);
    $res->execute();
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
