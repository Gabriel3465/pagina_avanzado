<?php

include "connectionController.php";

class UsersController {

    private $conn;

    public function __construct()
    {
        $db = new ConnectionController();
        $this->conn = $db->connect();
    }


    public function getAll(){
        $query = "SELECT * FROM users";
        $res = $this->conn->query($query);
        return $res->fetch_all(MYSQLI_ASSOC);
    }


    public function create($name, $email, $password){
        $query = "INSERT INTO users(nombre, email, password) VALUES(?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $password);

        if($stmt->execute()){
            header("Location: ../../user.php");
        } else {
            echo "Error al guardar usuario";
        }
    }

    public function delete($id){
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if($stmt->execute()){
            header("Location: ../../user.php");
        } else {
            echo "Error al eliminar usuario";
        }
    }

    public function update($id, $name, $email, $password){
        $query = "UPDATE users SET nombre=?, email=?, password=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $name, $email, $password, $id);

        if($stmt->execute()){
            header("Location: ../../user.php");
        } else {
            echo "Error al actualizar usuario";
        }
    }

}

if (isset($_POST['action'])) {

    $controller = new UsersController();

    if ($_POST['action'] == "create_user"){
        $controller->create($_POST['name'], $_POST['email'], $_POST['password']);
    }

    if ($_POST['action'] == "delete_user"){
        $controller->delete($_POST['id']);
    }

    if ($_POST['action'] == "update_user"){
        $controller->update($_POST['id'], $_POST['name'], $_POST['email'], $_POST['password']);
    }
}

?>
