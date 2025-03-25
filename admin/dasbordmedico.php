<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cita = $_POST['id_cita'];
    $diagnostico = $_POST['diagnostico'];
    $medicamentos = $_POST['medicamentos'];
    $indicaciones = $_POST['indicaciones'];
    $observaciones = $_POST['observaciones'];
    $proxima_cita = $_POST['proxima_cita'];
    $hora_proxima_cita = $_POST['hora_proxima_cita'];
    
    
    $sql = "SELECT id_paciente FROM citas WHERE id_cita = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_cita);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $cita_actual = mysqli_fetch_assoc($resultado);
    
    
    if (!empty($proxima_cita) && !empty($hora_proxima_cita)) {
        $sql_proxima_cita = "INSERT INTO citas (id_paciente, fecha_cita, hora_cita, estado) VALUES (?, ?, ?, 'programada')";
        $stmt = mysqli_prepare($conexion, $sql_proxima_cita);
        mysqli_stmt_bind_param($stmt, "iss", $cita_actual['id_paciente'], $proxima_cita, $hora_proxima_cita);
        mysqli_stmt_execute($stmt);
        
        
       
    }

    $prescripcion = "diagnostico:\n" . $diagnostico . "\n\n" .
                    "MEDICAMENTOS:\n" . $medicamentos . "\n\n" .
                    "INDICACIONES:\n" . $indicaciones . "\n\n" .
                    "OBSERVACIONES:\n" . $observaciones . "\n\n" .
                    ($proxima_cita ? "PRÓXIMA CITA: " . $proxima_cita . " a las " . $hora_proxima_cita : "");
    
    $sql = "INSERT INTO recetas (id_cita, prescripcion) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "is", $id_cita, $prescripcion);
    mysqli_stmt_execute($stmt);
    
    
    $sql = "UPDATE citas SET estado = 'atendida' WHERE id_cita = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_cita);
    mysqli_stmt_execute($stmt);
      
}

$sql = "SELECT c.*, p.nombre, p.email FROM citas c 
        INNER JOIN pacientes p ON c.id_paciente = p.id_paciente 
        WHERE c.estado = 'aprobada'";
$resultado = mysqli_query($conexion, $sql);





$sql_recetas = "SELECT r.*, c.fecha_cita, p.nombre as nombre_paciente 
                FROM recetas r
                INNER JOIN citas c ON r.id_cita = c.id_cita 
                INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
                WHERE c.estado = 'atendida'
                ORDER BY c.fecha_cita DESC";
$resultado_recetas = mysqli_query($conexion, $sql_recetas);
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
            font-size: 1rem;
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
        .next-appointment {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .next-appointment label {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .date-time-inputs {
            display: flex;
            gap: 10px;
        }
        
        .date-time-inputs input {
            flex: 1;
        }
            
        .table-responsive {
            margin-top: 20px;
        }
        
        .table {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        
        .table td {
            vertical-align: middle;
        }
        .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        text-decoration: none;
    }
    
    .btn-primary:hover {
        background-color: #0056b3;
    }
        
    .modal-content {
        border: none;
        border-radius: 15px;
    }
    
    .modal-header {
        border-radius: 15px 15px 0 0;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }
    
    .patient-info {
        background-color: rgba(46, 125, 50, 0.1);
        border-left: 4px solid var(--primary-color);
    }
    
    .next-appointment {
        background-color: rgba(46, 125, 50, 0.1);
        border-radius: 10px;
    }
    
    .form-control {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 10px;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.25);
    }
    
    textarea.form-control {
        resize: none;
    }
    
    .modal .btn {
        padding: 8px 20px;
        border-radius: 8px;
    }
    
    .modal-title {
        font-weight: 600;
    }
    
    .patient-info p {
        color: #666;
        margin-bottom: 5px;
    }
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
        <h2 class="page-title">Panel de Control</h2>
        <div class="cards-container">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-calendar-check card-icon"></i>
                    <h5>Citas Programadas</h5>
                    <p>12</p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-capsules card-icon"></i>
                    <h5>Fármacos Disponibles</h5>
                    <p>3</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-hospital-user card-icon"></i>
                    <h5>Pacientes Registrados</h5>
                    <p>8</p>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <h2 class="page-title">Citas Aprobadas</h2>
        <div class="row">
            <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
            <div class="col-md-6 mb-4">
                <div class="card" style="max-width: 300px;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user-circle me-2"></i><?php echo $fila['nombre']; ?></h5>
                        <p class="">
                            <i class="fas fa-envelope me-2"></i><?php echo $fila['email']; ?><br>
                            <i class="fas fa-calendar-alt me-2"></i><?php echo $fila['fecha_cita']; ?>
                        </p>
                        <button class="btn btn-success w-100" 
                                onclick="abrirModalReceta(<?php echo $fila['id_cita']; ?>, '<?php echo $fila['nombre']; ?>', '<?php echo $fila['fecha_cita']; ?>')" >
                         Crear Receta
                        </button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Modal de Receta Médica -->
    <div class="modal fade" id="modalReceta" tabindex="-1" aria-labelledby="modalRecetaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalRecetaLabel">
                        <i class="fas fa-file-medical me-2"></i>Nueva Receta Médica
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formReceta" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="id_cita" id="id_cita">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="patient-info p-3 bg-light rounded">
                                    <h6 class="text-primary"><i class="fas fa-user me-2"></i>Información del Paciente</h6>
                                    <p class="mb-1" id="nombrePaciente"></p>
                                    <p class="mb-0" id="fechaCita"></p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-stethoscope me-2"></i>Diagnóstico
                            </label>
                            <textarea name="diagnostico" class="form-control" rows="3" required 
                                placeholder="Ingrese el diagnóstico detallado del paciente"></textarea>
                            <div class="invalid-feedback">Por favor ingrese el diagnóstico</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-pills me-2"></i>Medicamentos
                            </label>
                            <textarea name="medicamentos" class="form-control" rows="3" required 
                                placeholder="Especifique nombre del medicamento, dosis y frecuencia"></textarea>
                            <div class="invalid-feedback">Por favor ingrese los medicamentos</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-list-ul me-2"></i>Indicaciones
                            </label>
                            <textarea name="indicaciones" class="form-control" rows="3" required 
                                placeholder="Detalle las instrucciones específicas de administración"></textarea>
                            <div class="invalid-feedback">Por favor ingrese las indicaciones</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-comment-medical me-2"></i>Observaciones
                            </label>
                            <textarea name="observaciones" class="form-control" rows="2" 
                                placeholder="Incluya recomendaciones adicionales"></textarea>
                        </div>

                        <div class="next-appointment p-3 bg-light rounded">
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-calendar-plus me-2"></i>Programar Próxima Cita
                            </h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fecha</label>
                                    <input type="date" name="proxima_cita" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hora</label>
                                    <input type="time" name="hora_proxima_cita" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" form="formReceta" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar Receta
                    </button>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Paciente</th>
            <th>Prescripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($receta = mysqli_fetch_assoc($resultado_recetas)): ?>
        <tr>
            <td><?php echo $receta['fecha_cita']; ?></td>
            <td><?php echo $receta['nombre_paciente']; ?></td>
            <td style="white-space: pre-line;">
                <?php 
                $prescripcion = $receta['prescripcion'];
                echo (strlen($prescripcion) > 10) ? substr($prescripcion, 0, 10) . '...' : $prescripcion; 
                ?>
            </td>
            <td>
    <a href="reportecita.php?id_receta=<?php echo $receta['id_receta']; ?>" 
       class="btn btn-success btn-sm">
        <i class="fas fa-file-pdf"></i> Imprimir en PDF
    </a>
</td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

    <script>
        
        flatpickr("input[type=date]", {
            minDate: "today",
            dateFormat: "Y-m-d"
        });
    </script>
   
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
let modalReceta;

document.addEventListener('DOMContentLoaded', function() {
    modalReceta = new bootstrap.Modal(document.getElementById('modalReceta'));
    
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});

function abrirModalReceta(idCita, nombrePaciente, fechaCita) {
    document.getElementById('id_cita').value = idCita;
    document.getElementById('nombrePaciente').innerHTML = `<strong>Paciente:</strong> ${nombrePaciente}`;
    document.getElementById('fechaCita').innerHTML = `<strong>Fecha de Cita:</strong> ${fechaCita}`;
    modalReceta.show();
}


const inputFecha = document.querySelector('input[name="proxima_cita"]');
if (inputFecha) {
    inputFecha.min = new Date().toISOString().split('T')[0];
}
</script>
</body>
</html>
