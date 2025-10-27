<?php

if ($_POST['Username'] === 'admin' && $_POST['Password'] === 'admin') {
    header('Location: /pagina_avanzado/formulario.html');
    exit;
} else {
    echo "Credenciales incorrectas.";
}

?>
