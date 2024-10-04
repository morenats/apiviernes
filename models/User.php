<?php

class User
{
    private $conn;
    private $table = "usuarios";

    public $userId;
    public $username;
    public $mail;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los usuarios
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un solo producto por ID
    public function getById($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo usuario
    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (username, mail, password) VALUES (:username, :mail, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':password', $this->password);
        return $stmt->execute();
    }

    // Actualizar un usuario
    public function update($userId)
    {
        $query = "UPDATE " . $this->table . " SET username = :username, mail = :mail, password = :password WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':password', $this->password);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function delete($userId)
    {
        $query = "DELETE FROM " . $this->table . " WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        return $stmt->execute();
    }
}
