<?php 
ini_set('display_errors', 1); 
error_reporting(E_ALL);

include __DIR__ . "/assets/app/UserController.php";
$usersC = new UsersController();
$all_users = $usersC->getAll();

$editUser = null;

if (isset($_GET['edit'])) {
    foreach ($all_users as $u) {
        if ($u["id"] == $_GET['edit']) {
            $editUser = $u;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Usuarios</title>
</head>
<body>

<h2>Lista de Usuarios</h2>

<table border="1" cellpadding="10">
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Email</th>
		<th>Contraseña</th>
		<th>Acciones</th>
	</tr>

	<?php foreach ($all_users as $user): ?>
	<tr>
		<td><?= $user['id'] ?></td>
		<td><?= $user['nombre'] ?></td>
		<td><?= $user['email'] ?></td>
		<td><?= $user['password'] ?></td>
		<td>
			<a href="user.php?edit=<?= $user['id'] ?>">Editar</a>
			
			<form method="post" action="./assets/app/UserController.php" style="display:inline;">
				<input type="hidden" name="id" value="<?= $user['id'] ?>">
				<input type="hidden" name="action" value="delete_user">
				<button type="submit">Eliminar</button>
			</form>

		</td>
	</tr>
	<?php endforeach; ?>

</table>

<hr>

<h2><?= $editUser ? "Editar Usuario" : "Crear Usuario" ?></h2>

<form method="post" action="./assets/app/UserController.php">

	<input type="hidden" name="id" value="<?= $editUser['id'] ?? '' ?>">

    <div>
        <label>Nombre</label>
        <input type="text" name="name" 
               value="<?= $editUser['nombre'] ?? '' ?>" required>
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email"
               value="<?= $editUser['email'] ?? '' ?>" required>
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password"
               value="<?= $editUser['password'] ?? '' ?>" required>
    </div>

    <button type="submit">
		<?= $editUser ? "Actualizar" : "Guardar" ?>
	</button>

	<input type="hidden" name="action" 
		   value="<?= $editUser ? 'update_user' : 'create_user' ?>">

</form>

</body>
</html>
