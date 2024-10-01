<?php
// app/controllers/ProductController.php

include_once '../models/User.php';
include_once '../core/Database.php';

class ProductController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    // Obtener todos los usuarios
    public function getAll() {
        $stmt = $this->user->getAll();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($users);
    }

     // Obtener un usuario por ID
    public function getById($IdUsuarios) {
        $user = $this->user->getById($IdUsuarios);
        return json_encode($user);
    }

     // Crear un nuevo usuario
    public function create($data) {
        $this->user->NombreUsuario = $data->NombreUsuario;
        $this->user->Mail = $data->Mail;
        $this->user->Clave = $data->Clave;
        if ($this->user->create()) {
            return json_encode(["message" => "Usuario creado con éxito"]);
        }
        return json_encode(["message" => "Error al crear usuario"]);
    }

    // Actualizar un usuario
    public function update($IdUsuarios, $data) {
        $this->user->NombreUsuario = $data->NombreUsuario;
        $this->user->Mail = $data->Mail;
        $this->user->Clave = $data->Clave;
        if ($this->user->update($IdUsuarios)) {
            return json_encode(["message" => "Usuario actualizado con éxito"]);
        }
        return json_encode(["message" => "Error al actualizar usuario"]);
    }

    // Eliminar un usuario
    public function delete($IdUsuarios) {
        if ($this->user->delete($IdUsuarios)) {
            return json_encode(["message" => "Usuario eliminado con éxito"]);
        }
        return json_encode(["message" => "Error al eliminar usuario"]);
    }

}
?>