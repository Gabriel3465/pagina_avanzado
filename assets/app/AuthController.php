<?php

include "connectionController.php";

$auth = new AuthController();

$action = $_POST['action'];

if ($action == "login") {

    $email = $_POST['email'];
    $password = $_POST['Password'];

    $auth->login($email, $password);
}

if ($action == "register") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $numero = $_POST['numero'];
    $genero = $_POST['genero'];
    $biografia = $_POST['biografia'];

    $auth->register($nombre, $apellido, $email, $numero, $genero, $biografia, $password);
}

class AuthController
{
    private $connection;

    public function __construct()
    {
        $this->connection = new ConnectionController();
    }

    function login($username, $password)
    {

        $conn = $this->connection->connect();
        if ($conn && !$conn->connect_error) {
            $query = "select * from users where email = ? and password = ?";

            $prepared_query = $conn->prepare($query);

            $prepared_query->bind_param('ss', $username, $password);

            $prepared_query->execute();

            $results = $prepared_query->get_result();
            $users = $results->fetch_all(MYSQLI_ASSOC);

            if (count($users) > 0) {
                header('Location: ../../user.php');
                exit;
            } else
                header('Location: ../../user.php');
            exit;
        } else
            header('Location: ../../login.html');
        exit;

    }

    public function register($nombre, $apellido, $email, $numero, $genero, $biografia, $password)
    {
        $conn = $this->connection->connect();

        if (!$conn->connect_error) {

            $query = "INSERT INTO users (nombre, apellido, email, numero, genero, biografia, password) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";

            $prepared_query = $conn->prepare($query);
            $prepared_query->bind_param('sssssss', $nombre, $apellido, $email, $numero, $genero, $biografia, $password);

            if ($prepared_query->execute()) {
                header('Location: ../../login.html');
                exit;
            } else {
                echo "Error al registrar el usuario.";
            }
        } else {
            echo "Error de conexión con la base de datos.";
        }
    }

}

?>