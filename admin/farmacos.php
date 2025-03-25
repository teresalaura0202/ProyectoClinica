<?php
include 'conexion.php';

session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

/
$sqlCitas = "SELECT COUNT(*) as total FROM citas WHERE estado = 'programada'";
$resultadoCitas = mysqli_query($conexion, $sqlCitas);
$citasProgramadas = mysqli_fetch_assoc($resultadoCitas)['total'];

$sqlPacientes = "SELECT COUNT(*) as total FROM pacientes"; 
$resultadoPacientes = mysqli_query($conexion, $sqlPacientes);
$pacientesRegistrados = mysqli_fetch_assoc($resultadoPacientes)['total'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accion'])) {
        if ($_POST['accion'] == 'agregar') {
            
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $cantidad = $_POST['cantidad'];
            $foto = '';

            if ($_FILES['foto']['name']) {
                $foto = 'img/' . basename($_FILES['foto']['name']);
                move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
            }

            $sql = "INSERT INTO farmacos (nombre, descripcion, cantidad, foto) 
                    VALUES ('$nombre', '$descripcion', $cantidad, '$foto')";
            mysqli_query($conexion, $sql);
        } elseif ($_POST['accion'] == 'editar') {
          
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $cantidad = $_POST['cantidad'];
            $foto = $_POST['foto_actual'];

            if ($_FILES['foto']['name']) {
                $foto = 'img/' . basename($_FILES['foto']['name']);
                move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
            }

            $sql = "UPDATE farmacos SET nombre = '$nombre', descripcion = '$descripcion', 
                    cantidad = $cantidad, foto = '$foto' WHERE id = $id";
            mysqli_query($conexion, $sql);
        } elseif ($_POST['accion'] == 'eliminar') {
         
            $id = $_POST['id'];
            $sql = "DELETE FROM farmacos WHERE id = $id";
            mysqli_query($conexion, $sql);
        } elseif ($_POST['accion'] == 'comprar') {
            $id = $_POST['id'];
            $cantidadCompra = $_POST['cantidad_compra'];

            
            $sql = "SELECT cantidad FROM farmacos WHERE id = $id";
            $resultado = mysqli_query($conexion, $sql);
            $farmaco = mysqli_fetch_assoc($resultado);

            if ($farmaco && $farmaco['cantidad'] >= $cantidadCompra) {
                
                $nuevaCantidad = $farmaco['cantidad'] - $cantidadCompra;
                $sql = "UPDATE farmacos SET cantidad = $nuevaCantidad WHERE id = $id";
                mysqli_query($conexion, $sql);
                echo '<script>alert("Compra realizada con éxito.");</script>';
            } else {
                echo '<script>alert("No hay suficiente cantidad disponible.");</script>';
            }
        }
    }
}


$sql = "SELECT * FROM farmacos";
$resultado = mysqli_query($conexion, $sql);
$farmacos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
$totalFarmacos = count($farmacos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #2E7D32;
            --secondary-color: #4CAF50;
            --hover-color: #1B5E20;
            --bg-light: #F5F5F5;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            font-size: 1rem;
        }

        aside {
            width: 280px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .sidebar-header {
            padding: 20px 0;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h4 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        aside a {
            position: relative;
            display: flex;
            align-items: center;
            color: white;
            margin: 10px 0;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        aside a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        aside a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        main {
            flex: 1;
            padding: 30px;
            background-color: var(--bg-light);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .page-title {
            margin-bottom: 30px;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 2rem;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            max-width: 300px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-body {
            padding: 25px;
            text-align: center;
        }

        .card-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .card h5 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
            margin: 0;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            border: none;
        }

        .table tbody tr:hover {
            background-color: rgba(46, 125, 50, 0.05);
        }

        @media (max-width: 768px) {
            aside {
                width: 70px;
            }

            aside a span {
                display: none;
            }

            aside a i {
                margin: 0;
                font-size: 1.3rem;
            }

            .cards-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }
        <style>
        .filtros-estados {
            margin-bottom: 20px;
        }
        .filtro-btn {
            margin-right: 10px;
            transition: transform 0.2s;
        }
        .filtro-btn:hover {
            transform: scale(1.05);
        }
        .filtro-btn.activo {
            background-color: #0d6efd;
            color: white; 
        }
        .tabla-citas {
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }
        .tabla-citas.loading {
            opacity: 0.5;
        }
        tr {
            transition: all 0.4s ease-out;
            animation: slideIn 0.5s ease-out forwards;
            opacity: 0;
            transform: translateX(-20px);
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }
        
        .fade-out {
            opacity: 0;
            transform: translateX(20px);
        }
        
       
        .filtro-btn {
            animation: popIn 0.3s ease-out forwards;
            opacity: 0;
            transform: scale(0.8);
        }
        
        @keyframes popIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        
        .filtro-btn:nth-child(1) { animation-delay: 0.1s; }
        .filtro-btn:nth-child(2) { animation-delay: 0.2s; }
        .filtro-btn:nth-child(3) { animation-delay: 0.3s; }
        .filtro-btn:nth-child(4) { animation-delay: 0.4s; }
        .filtro-btn:nth-child(5) { animation-delay: 0.5s; }
    </style>
</head>
<body>
<aside>
    <div class="sidebar-header">
        <h4>Dashboard Clínica</h4>
    </div>
    <nav>
        <a href="../admin/dasbordmedico.php">
            <i class="fas fa-user-nurse"></i>
            <span>Medico</span>
        </a>
        <a href="../admin/dasboard.php">
            <i class="fas fa-user-nurse"></i>
            <span>Recepcionista</span>
        </a>
        <a href="../admin/farmacos.php">
            <i class="fas fa-pills"></i>
            <span>Fármacos</span>
        </a>
        <a href="../admin/pacientestabla.php">
            <i class="fas fa-users"></i>
            <span>Pacientes</span>
        </a>
        <a href="../login.php.php">
            <i class="fas fa-notes-medical"></i>
            <span>Cerrar Seccion</span>
        </a>
        </nav>
</aside>

<main>
    <section id="inicio">
        <h2 class="page-title">Panel de Control</h2>
        <div class="cards-container">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-calendar-check card-icon"></i>
                    <h5>Citas Programadas</h5>
                    <p><?php echo $citasProgramadas; ?></p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-capsules card-icon"></i>
                    <h5>Fármacos Disponibles</h5>
                    <p><?php echo $totalFarmacos; ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-hospital-user card-icon"></i>
                    <h5>Pacientes Registrados</h5>
                    <p><?php echo $pacientesRegistrados; ?></p>
                </div>
            </div>
        </div>
    </section>

<div class="container mt-5">
    <h2>Gestión de Fármacos</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalFarmaco">Agregar Fármaco</button>

    <table class="table">
    <thead class="table-success">
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Foto</th>
        <th>Acciones</th>
    </tr>
</thead>
        <tbody>
            <?php foreach ($farmacos as $farmaco): ?>
                <tr>
                    <td><?php echo $farmaco['nombre']; ?></td>
                    <td><?php echo $farmaco['descripcion']; ?></td>
                    <td><?php echo $farmaco['cantidad']; ?></td>
                    <td>
                        <?php if ($farmaco['foto']): ?>
                            <img src="<?php echo $farmaco['foto']; ?>" alt="Foto" style="width: 100px;">
                        <?php else: ?>
                            No disponible
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFarmaco" 
                                data-id="<?php echo $farmaco['id']; ?>" 
                                data-nombre="<?php echo $farmaco['nombre']; ?>" 
                                data-descripcion="<?php echo $farmaco['descripcion']; ?>" 
                                data-cantidad="<?php echo $farmaco['cantidad']; ?>" 
                                data-foto="<?php echo $farmaco['foto']; ?>">Editar</button>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?php echo $farmaco['id']; ?>">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para agregar,editar fármaco -->
<div class="modal fade" id="modalFarmaco" tabindex="-1" aria-labelledby="modalFarmacoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFarmacoLabel">Agregar Fármaco</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="accion" id="accion">
                    <input type="hidden" name="id" id="farmaco_id">
                    <input type="hidden" name="foto_actual" id="foto_actual">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var modalFarmaco = document.getElementById('modalFarmaco');
    modalFarmaco.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var descripcion = button.getAttribute('data-descripcion');
        var cantidad = button.getAttribute('data-cantidad');
        var foto = button.getAttribute('data-foto');

        if (id) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('farmaco_id').value = id;
            document.getElementById('foto_actual').value = foto;
            document.getElementById('nombre').value = nombre;
            document.getElementById('descripcion').value = descripcion;
            document.getElementById('cantidad').value = cantidad;
        } else {
            document.getElementById('accion').value = 'agregar';
            document.getElementById('farmaco_id').value = '';
            document.getElementById('foto_actual').value = '';
            document.getElementById('nombre').value = '';
            document.getElementById('descripcion').value = '';
            document.getElementById('cantidad').value = '';
        }
    });
</script>
</body>
</html>





