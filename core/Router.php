<?php
// app/core/Router.php

include_once '../controllers/UserController.php';
include_once '../views/View.php';

$controller = new ProductController();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['IdUsuarios'])) {
            $result = $controller->getById($_GET['IdUsuarios']);
        } else {
            $result = $controller->getAll();
        }
        View::render($result);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $result = $controller->create($data);
        View::render($result);
        break;

    case 'PUT':
        if (isset($_GET['IdUsuarios'])) {
            $data = json_decode(file_get_contents("php://input"));
            $result = $controller->update($_GET['IdUsuarios'], $data);
            View::render($result);
        }
        break;

    case 'DELETE':
        if (isset($_GET['IdUsuarios'])) {
            $result = $controller->delete($_GET['IdUsuarios']);
            View::render($result);
        }
        break;

    default:
        View::render(json_encode(["message" => "Método no permitido"]));
        break;
}
?>