
<?php
include './admin/conexion.php';
$mensaje = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    
    $sql = "INSERT INTO pacientes (nombre, apellido, fecha_nacimiento, genero, email, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssssss", $nombre, $apellido , $fecha_nacimiento, $genero, $email, $telefono, $direcion);
    
    if(mysqli_stmt_execute($stmt)) {
        $id_paciente = mysqli_insert_id($conexion);
        
        $sql = "INSERT INTO citas (id_paciente) VALUES (?)";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_paciente);
        
        if(mysqli_stmt_execute($stmt)) {
            $mensaje = [
                'tipo' => 'success',
                'titulo' => '¡Éxito!',
                'texto' => 'Su solicitud de cita ha sido enviada correctamente'
            ];
        }
    } else {
        $mensaje = [
            'tipo' => 'error',
            'titulo' => 'Error',
            'texto' => 'Hubo un problema al procesar su solicitud'
        ];
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teresa</title>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <style>
        
        .top-bar {
            background-color: forestgreen;
            color: white;
            padding: 5px 0;
        }
        
        .top-bar a {
            color: white;
            text-decoration: none;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 50px;
        }

       
        .hero-section {
            background-color: #f8f9fa;
            padding: 50px 0;
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.795), rgba(13, 109, 253, 0.322)),
                        url('./image/1.jpg');
                        height: 60vh;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            color: #474e58;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .service-icons {
            text-align: center;
            margin-top: 30px;
        }

        .service-icon {
            display: inline-block;
            margin: 0 20px;
            text-align: center;
        }

        .service-icon img {
            width: 60px;
            margin-bottom: 10px;
        }

        

       

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
            color:  #00bcd4;

        }

        .hero-text {
            color: #ffffff;
            margin-bottom: 2rem;
            font-size: 1.1rem;
            font-weight: bold;
        }
        
        .btn-learn-more {
            background-color: #000000;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-learn-more:hover {
            background-color: forestgreen;
            transform: translateY(-2px);
        }

        .open-badge {
            display: inline-block;
            padding: 8px 20px;
            background-color: #f8f9fa00;
            border-radius: 20px;
            margin-left: 20px;
            color: #ffffff;
            font-weight: bold;
        }

        .features-list {
            margin-top: 3rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: #ffffff;
            font-weight: bold;
        }

        .feature-item i {
        background-color: forestgreen;;
            margin-right: 10px;
        }

        .hero-image {
            position: relative;
        }
        .floating-element {
            position: absolute;
            width: 40px;
            height: 40px;
            background-color: forestgreen;
            border-radius: 8px;
            animation: float 3s infinite ease-in-out;
        }

        .floating-element.plus {
            top: 20%;
            left: 10%;
        }

        .floating-element.pill {
            bottom: 20%;
            right: 10%;
        }

        .highlight {
            background-color: #ffeb3b;
            padding: 0 5px;
            transform: rotate(-2deg);
            display: inline-block;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .footer {
        color: #000000;
    }

    .footer h4, .footer h5 {
        font-weight: 600;
    }

    .footer a:hover {
        color: forestgreen;
    }

    .footer .btn-primary {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        padding: 0;
        transition: all 0.3s ease;
    }

    .footer .btn-primary:hover {
        transform: translateY(-3px);
    }

    .footer .list-unstyled li a {
        transition: all 0.3s ease;
    }

    .footer .list-unstyled li a:hover {
        padding-left: 10px;
    }
    h1{
        text-align: center;
        font-family: cambria;
        font-weight: bold;
    
    
        
    }
    </style>
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">TERESA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./servicios.php">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./nosotros.php">Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./farmacos.php">Farmacos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./contacto.php">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">
                    Servicios de Salud Integral para tu Bienestar<br>
                  
                </h1>
                <p class="hero-text">
                    "En nuestra clínica, nos comprometemos a brindarte atención de calidad, con un equipo profesional y cálido, para que tu bienestar y salud siempre estén en las mejores manos."
                </p>
               
              
            </div>
           
        </div>
    </div>
</section>

<h1>Ofrecemos!!</h1>
<div class="container">

<div class="container my-4">
    <div class="card border-0 shadow-sm">
        <div class="row g-0 align-items-center">
          
            <div class="col-md-4">
                <img src="./image/den.jpg" 
                     class="img-fluid rounded-start" 
                     alt="Gerente del Hotel"
                     style="object-fit: cover; height: 100%;">
            </div>
            
        
            <div class="col-md-8">
                <div class="card-body p-4">
                    <h2 class="card-title fw-bold text-success mb-3">Cuidado De La Piel </h2>
                    <p class="card-text text-muted">
                        "En nuestra clínica, ofrecemos servicios de cirugía con los más altos estándares de calidad y seguridad. Contamos con un equipo de cirujanos altamente calificados y tecnología
                         de vanguardia para garantizar procedimientos precisos y efectivos. Nos enfocamos en tu bienestar, brindándote un cuidado personalizado antes, durante y después de la cirugía, para asegurar una pronta recuperación y los mejores resultados.
                         Confía en nosotros para cuidar tu salud con la atención que mereces."
                    </p>
                    
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Solitar
    </button>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellido:</label>
                <input type="text" class="form-control" name="apellido" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha_nacimiento:</label>
                <input type="date" class="form-control" name="fecha_nacimiento" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Genero:</label>
                <input type="text" class="form-control" name="genero" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telefono:</label>
                <input type="text" class="form-control" name="telefono" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Direccion:</label>
                <input type="text" class="form-control" name="direccion" required>
            </div>
            <button type="submit" class="btn btn-primary">Solicitar Cita</button>
        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="contactForm" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>






</div>




<footer class="footer bg-dark text-white pt-5">
   
    <div class="container abajo">
        <div class="row">
            
            <div class="col-lg-4 mb-4 abajo">
                <h4 class="text-success mb-4">Clinica Teresa</h4>
                <p class="mb-3">
                    Brindamos atención médica de calidad con los más altos estándares y tecnología de vanguardia para el cuidado de su salud.
                </p>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-phone-alt text-success me-3"></i>
                    <div>
                        <p class="mb-0">Emergencias 24/7</p>
                        <h5 class="mb-0">+240 222844484</h5>
                    </div>
                </div>
               
            </div>

           ]
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="text-success mb-4">Enlaces Rápidos</h5>
                <ul class="list-unstyled">
                    <li class="mb-2 enlaces">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-chevron-right text-success me-2"></i>Inicio
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-chevron-right text-success me-2"></i>Sobre Nosotros
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-chevron-right text-success me-2"></i>Servicios
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-chevron-right text-success me-2"></i>Especialistas
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-chevron-right text-success me-2"></i>Contacto
                        </a>
                    </li>
                </ul>
            </div>

           
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-success mb-4">Nuestros Servicios</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-chevron-right text-success me-2"></i>Medicina General
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-chevron-right text-success me-2"></i>Cardiología
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-chevron-right text-success me-2"></i>Pediatría
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-chevron-right text-success me-2"></i>Laboratorio
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-chevron-right text-success me-2"></i>Emergencias
                        </a>
                    </li>
                </ul>
            </div>

           
            <div class="col-lg-3 mb-4">
                <h5 class="text-success mb-4">Horarios de Atención</h5>
                <div class="d-flex border-bottom pb-2 mb-2">
                    <span>Lunes - Viernes</span>
                    <span class="ms-auto">8:00 - 20:00</span>
                </div>
                <div class="d-flex border-bottom pb-2 mb-2">
                    <span>Sábado</span>
                    <span class="ms-auto">8:00 - 17:00</span>
                </div>
                <div class="d-flex border-bottom pb-2 mb-2">
                    <span>Domingo</span>
                    <span class="ms-auto">Solo Emergencias</span>
                </div>
                
            </div>
        </div>
    </div>
</footer>

<?php if ($mensaje): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '<?php echo $mensaje['tipo']; ?>',
                title: '<?php echo $mensaje['titulo']; ?>',
                text: '<?php echo $mensaje['texto']; ?>',
                confirmButtonColor: '#3085d6'
            });
        });
    </script>
    <?php endif; ?>


<script src="./js/all.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./js/bootstrap.js"></script>
</body>
</html>