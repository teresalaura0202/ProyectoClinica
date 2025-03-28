<?php
include 'conexion.php';


session_start();
if (!isset($_SESSION['rol'])) {
  
    echo '<div class="container mt-5">';
    echo '<h2>Iniciar Sesión</h2>';
    echo '<form method="POST" action="login.php">';
    echo '<div class="mb-3">';
    echo '<label for="usuario" class="form-label">Usuario</label>';
    echo '<input type="text" class="form-control" name="usuario" required>';
    echo '</div>';
    echo '<div class="mb-3">';
    echo '<label for="contrasena" class="form-label">Contraseña</label>';
    echo '<input type="password" class="form-control" name="contrasena" required>';
    echo '</div>';
    echo '<button type="submit" class="btn btn-primary">Iniciar Sesión</button>';
    echo '</form>';
    echo '</div>';
    exit;
}


if ($_SESSION['rol'] === 'recepcionista') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['accion'])) {
            $id_cita = $_POST['id_cita'];
            
            if ($_POST['accion'] === 'aprobar') {
                $fecha_cita = $_POST['fecha_cita'];
                
                $sql = "UPDATE citas SET fecha_cita = ?, estado = 'aprobada' WHERE id_cita = ?";
                $stmt = mysqli_prepare($conexion, $sql);
                mysqli_stmt_bind_param($stmt, "si", $fecha_cita, $id_cita);
                mysqli_stmt_execute($stmt);
                
                
                $sql = "SELECT p.email, p.nombre FROM pacientes p 
                        INNER JOIN citas c ON p.id_paciente = c.id_paciente 
                        WHERE c.id_cita = ?";
                $stmt = mysqli_prepare($conexion, $sql);
                mysqli_stmt_bind_param($stmt, "i", $id_cita);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                $paciente = mysqli_fetch_assoc($resultado);
                
                mail($paciente['email'], 
                     "Cita Médica Aprobada", 
                     "Su cita ha sido aprobada para el día " . $fecha_cita);
            } 
            elseif ($_POST['accion'] === 'rechazar') {
                $motivo_rechazo = $_POST['motivo_rechazo'];
                
                $sql = "UPDATE citas SET estado = 'rechazada', motivo_rechazo = ? WHERE id_cita = ?";
                $stmt = mysqli_prepare($conexion, $sql);
                mysqli_stmt_bind_param($stmt, "si", $motivo_rechazo, $id_cita);
                mysqli_stmt_execute($stmt);
                
                
                $sql = "SELECT p.email, p.nombre FROM pacientes p 
                        INNER JOIN citas c ON p.id_paciente = c.id_paciente 
                        WHERE c.id_cita = ?";
                $stmt = mysqli_prepare($conexion, $sql);
                mysqli_stmt_bind_param($stmt, "i", $id_cita);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                $paciente = mysqli_fetch_assoc($resultado);
                
                mail($paciente['email'], 
                     "Cita Médica Rechazada", 
                     "Lo sentimos, su cita ha sido rechazada. Motivo: " . $motivo_rechazo);
            }
        }
    }

   
    $sql = "SELECT DISTINCT estado FROM citas";
    $resultado = mysqli_query($conexion, $sql);
    $estados = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $estados[] = $fila['estado'];
    }

   
    $sqlCitas = "SELECT COUNT(*) as total FROM citas WHERE estado = 'aprobada'";
    $resultadoCitas = mysqli_query($conexion, $sqlCitas);
    $citasProgramadas = mysqli_fetch_assoc($resultadoCitas)['total'];


    $sqlFarmacos = "SELECT COUNT(*) as total FROM farmacos";
    $resultadoFarmacos = mysqli_query($conexion, $sqlFarmacos);
    $farmacosDisponibles = mysqli_fetch_assoc($resultadoFarmacos)['total'];

    $sqlPacientes = "SELECT COUNT(*) as total FROM pacientes"; 
    $resultadoPacientes = mysqli_query($conexion, $sqlPacientes);
    $pacientesRegistrados = mysqli_fetch_assoc($resultadoPacientes)['total'];
} elseif ($_SESSION['rol'] === 'doctor') {
    header("Location: medico.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Dermatológica</title>
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
    </style>
</head>
<body>
<aside>
    <div class="sidebar-header">
        <h4>Dashboard Clínica</h4>
    </div>
    <nav>
        <a href="./dasbordmedico.php">
            <i class="fas fa-user-nurse"></i>
            <span>Medico</span>
        </a>
        <a href="./dasboard.php">
            <i class="fas fa-user-nurse"></i>
            <span>Recepcionista</span>
        </a>
        <a href="./farmacos.php">
            <i class="fas fa-pills"></i>
            <span>Fármacos</span>
        </a>
        <a href="./pacientestabla.php">
            <i class="fas fa-users"></i>
            <span>Pacientes</span>
        </a>
        <a href="../login.php.php">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar Seccion</span>
        </a>
        </nav>
</aside>

<main>
    <section id="inicio">
        
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
                    <p><?php echo $farmacosDisponibles; ?></p>
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
        <h2>Gestión de Citas</h2>
        
        <div class="filtros-estados">
            <button class="btn btn-outline-primary filtro-btn activo" data-estado="todos">Todas</button>
            <?php foreach ($estados as $estado): ?>
            <button class="btn btn-outline-primary filtro-btn" data-estado="<?php echo $estado; ?>">
                <?php echo ucfirst($estado); ?>
            </button>
            <?php endforeach; ?>
        </div>

        <div class="tabla-citas">
            <table class="table">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Email</th>
                        <th>Fecha Solicitud</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="tabla-citas-body">
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalRechazo" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rechazar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" id="formRechazo">
                    <div class="modal-body">
                        <input type="hidden" name="id_cita" id="rechazo_id_cita">
                        <input type="hidden" name="accion" value="rechazar">
                        <div class="mb-3">
                            <label for="motivo_rechazo" class="form-label">Motivo del rechazo</label>
                            <textarea class="form-control" name="motivo_rechazo" id="motivo_rechazo" 
                                    required rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Confirmar Rechazo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       function cargarCitas(estado) {
    const tablaBody = document.getElementById('tabla-citas-body');
    const tablaCitas = document.querySelector('.tabla-citas');

    tablaCitas.classList.add('loading');

   
    const filasExistentes = tablaBody.querySelectorAll('tr');
    filasExistentes.forEach((fila, index) => {
        setTimeout(() => {
            fila.classList.add('fade-out');
        }, index * 50);
    });

  
    setTimeout(() => {
        fetch(`obCitas.php?estado=${estado}`)
            .then(response => {
                if (!response.ok) throw new Error('Error al cargar las citas');
                return response.json();
            })
            .then(citas => {
                let html = '';

                citas.forEach((cita, index) => {
                    html += `
                        <tr class="animate-row" style="animation-delay: ${index * 0.1}s">
                            <td>${cita.nombre}</td>
                            <td>${cita.email}</td>
                            <td>${cita.fecha_solicitud}</td>
                            <td>
                                <span class="badge bg-${getBadgeColor(cita.estado)}">
                                    ${cita.estado}
                                </span>
                            </td>
                            <td>
                                ${cita.estado === 'pendiente' ? getBotonesAccion(cita) : getMotivoRechazo(cita)}
                            </td>
                        </tr>
                    `;
                });

                tablaBody.innerHTML = html;
                tablaCitas.classList.remove('loading');
            })
            .catch(error => console.error('Error:', error));
    }, 300);
}

function getBotonesAccion(cita) {
    return `
        <div class="btn-group">
            <form method="POST" class="d-inline me-2">
                <input type="hidden" name="id_cita" value="${cita.id_cita}">
                <input type="hidden" name="accion" value="aprobar">
                <input type="datetime-local" name="fecha_cita" required 
                       class="form-control form-control-sm d-inline me-2" 
                       style="width: auto; border-radius: 4px;">
                <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 4px;">
                    Aprobar
                </button>
            </form>
            <button type="button" class="btn btn-danger btn-sm" 
                    onclick="mostrarModalRechazo(${cita.id_cita})"
                    style="border-radius: 4px;">
                Rechazar
            </button>
        </div>
    `;
}

function getMotivoRechazo(cita) {
    if (cita.estado === 'rechazada') {
        return `<small class="text-danger fw-bold">Motivo: ${cita.motivo_rechazo || 'No especificado'}</small>`;
    }
    return '';
}

        function getBadgeColor(estado) {
    estado = estado.toLowerCase();
    
    if (estado === 'pendiente') {
        return 'secondary';
    } else if (estado === 'aprobada') {
        return 'primary';
    } else if (estado === 'cancelada') {
        return 'warning';
    } else if (estado === 'completada') {
        return 'primary';
    } else {
        return 'success';
    }
}


        
        document.querySelectorAll('.filtro-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filtro-btn').forEach(b => b.classList.remove('activo'));
                this.classList.add('activo');
                cargarCitas(this.dataset.estado);
            });
        });

     
        cargarCitas('todos');

        let modalRechazo;
        
        document.addEventListener('DOMContentLoaded', function() {
            modalRechazo = new bootstrap.Modal(document.getElementById('modalRechazo'));
        });

        function mostrarModalRechazo(idCita) {
            document.getElementById('rechazo_id_cita').value = idCita;
            modalRechazo.show();
        }
    </script>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
