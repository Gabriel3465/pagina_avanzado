<?php
include "connectionController.php";

$conn = new ConnectionController();
$db = $conn->connect();

if ($db && !$db->connect_error) {
    echo "✅ Conexión exitosa a la base de datos";
} else {
    echo "❌ Error de conexión: " . $db->connect_error;
}
?>
