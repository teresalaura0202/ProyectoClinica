<?php
session_start();
include './admin/conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);

    if (!empty($usuario) && !empty($contrasena)) {
        $sql = "SELECT contrasena, rol, nombre FROM usuarios WHERE usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();

            if (password_verify($contrasena, $fila['contrasena'])) {
                $_SESSION['rol'] = $fila['rol'];
                $_SESSION['nombre'] = $fila['nombre'];

                if ($fila['rol'] === 'recepcionista') {
                    header("Location: ./admin/dasboard.php");
                } elseif ($fila['rol'] === 'doctor') {
                    header("Location: ./admin/dasbordmedico.php");
                }
                exit;
            } else {
                $mensaje = '<div class="alert alert-danger"><i class="fas fa-times-circle"></i> Usuario o contraseña incorrectos.</div>';
            }
        } else {
            $mensaje = '<div class="alert alert-danger"><i class="fas fa-times-circle"></i> Usuario o contraseña incorrectos.</div>';
        }
    } else {
        $mensaje = '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Usuario y contraseña son obligatorios.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .login-container {
            margin-top: 50px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-radius: 20px;
            border: none;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        h2 {
            color: #007bff;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .input-group-text {
            background-color: #007bff;
            color: white;
            border-radius: 20px 0 0 20px;
            border: none;
        }
        .alert {
            border-radius: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <h2><i class="fas fa-user-lock"></i> Iniciar Sesión</h2>
        <?php echo $mensaje; ?>
        <form method="POST" action="">
            <!-- Usuario -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
            </div>

            <!-- Contraseña -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>
            </div>

            <!-- Botón de inicio de sesión -->
            <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
        </form>

        <p class="mt-3 text-center">¿No tienes una cuenta? <a href="./admin/registro.php">Regístrate aquí</a></p>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
