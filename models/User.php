<?php

class User{
    private $conn;
    private $table = "usuarios";

    public $IdUsuarios;
    public $NombreUsuario;
    public $Mail;
    public $Clave;

    public function __construct($db) {
        $this->conn = $db;
    }

     // Obtener todos los usuarios
     public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un solo producto por ID
    public function getById($IdUsuarios) {
        $query = "SELECT * FROM " . $this->table . " WHERE IdUsuarios = :IdUsuarios";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":IdUsuarios", $IdUsuarios);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     // Crear un nuevo usuario
     public function create() {
        $query = "INSERT INTO " . $this->table . " (NombreUsuario, Mail, Clave) VALUES (:NombreUsuario, :Mail, :Clave)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':NombreUsuario', $this->NombreUsuario);
        $stmt->bindParam(':Mail', $this->Mail);
        $stmt->bindParam(':Clave', $this->Clave);
        return $stmt->execute();
    }

    // Actualizar un producto
    public function update($id) {
        $query = "UPDATE " . $this->table . " SET NombreUsuario = :NombreUsuario, Mail = :Mail, Clave = :Clave WHERE IdUsuarios = :IdUsuarios";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':NombreUsuario', $this->NombreUsuario);
        $stmt->bindParam(':Mail', $this->Mail);
        $stmt->bindParam(':Clave', $this->Clave);
        return $stmt->execute();
    }

    // Eliminar un producto
    public function delete($IdUsuarios) {
        $query = "DELETE FROM " . $this->table . " WHERE  = :IdUsuarios";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':IdUsuarios', $IdUsuarios);
        return $stmt->execute();
    }

}
?>