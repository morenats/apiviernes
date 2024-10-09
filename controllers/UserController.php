<?php
// app/controllers/UserController.php

include_once '../models/User.php';
include_once '../core/Database.php';

class UserController {
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
    public function getById($userId) {
        $user = $this->user->getById($userId);
        return json_encode($user);
    }

     // Crear un nuevo usuario
    public function create($data) {
        $this->user->username = $data->username;
        $this->user->mail = $data->mail;
        $this->user->password = $data->password;
        if ($this->user->create()) {
            return json_encode(["message" => "OK"]);
        }
        return json_encode(["message" => "Error al crear usuario"]);
    }

    // Actualizar un usuario
    public function update($userId, $data) {
        $this->user->username = $data->username;
        $this->user->mail = $data->mail;
        $this->user->password = $data->password;
        if ($this->user->update($userId)) {
            return json_encode(["message" => "OK"]);
        }
        return json_encode(["message" => "Error al actualizar usuario"]);
    }

    // Eliminar un usuario
    public function delete($userId) {
        if ($this->user->delete($userId)) {
            return json_encode(["message" => "OK"]);
        }
        return json_encode(["message" => "Error al eliminar usuario"]);
    }

}
?>