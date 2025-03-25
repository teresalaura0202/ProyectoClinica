<?php
session_start();
include 'conexion.php'; // Asegúrate de que este archivo contenga la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol']; 

    // Verificar si el usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        echo '<div class="alert alert-danger">El usuario ya existe. Por favor, elige otro nombre de usuario.</div>';
    } else {
        // Insertar el nuevo usuario
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT); 
        $sql = "INSERT INTO usuarios (usuario, contrasena, rol, nombre) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $usuario, $contrasena_hash, $rol, $nombre);
        mysqli_stmt_execute($stmt);
        
        echo '<div class="alert alert-success">Cuenta creada exitosamente. Puedes iniciar sesión ahora.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 d-flex align-items-center justify-content-center">
        <div class="card shadow" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Crear Cuenta</h2>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="contrasena" required>
                    </div>
                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select class="form-select" name="rol" required>
                            <option value="recepcionista">Recepcionista</option>
                            <option value="doctor">Doctor</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Crear Cuenta</button>
                </form>
                <p class="mt-3 text-center">¿Ya tienes una cuenta? <a href="../login.php.php" class="link-primary">Inicia sesión aquí</a>.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 