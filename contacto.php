<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $asunto = htmlspecialchars($_POST['asunto']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

  
    $to = "juanmariaesono@gmail.com"; 
    $subject = "Nuevo mensaje de contacto: $asunto";

    $body = "
    <html>
    <head>
        <title>Nuevo mensaje de contacto</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                padding: 20px;
            }
            .container {
                background-color: #ffffff;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #2E7D32;
            }
            p {
                line-height: 1.6;
            }
            .footer {
                margin-top: 20px;
                font-size: 0.9em;
                color: #666;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Nuevo mensaje de contacto</h2>
            <p><strong>Nombre:</strong> $nombre</p>
            <p><strong>Correo Electrónico:</strong> $email</p>
            <p><strong>Asunto:</strong> $asunto</p>
            <p><strong>Mensaje:</strong></p>
            <p>$mensaje</p>
        </div>
        <div class='footer'>
            <p>Este mensaje fue enviado desde el formulario de contacto de tu sitio web.</p>
        </div>
    </body>
    </html>
    ";

    // Cabeceras del correo
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Enviar el correo
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>
                swal({
                    title: '¡Éxito!',
                    text: '¡Tu mensaje ha sido enviado con éxito!',
                    type: 'success',
                    confirmButtonText: 'Aceptar'
                });
              </script>";
    } else {
        echo "<script>
                swal({
                    title: 'Error',
                    text: 'Error al enviar el mensaje.',
                    type: 'error',
                    confirmButtonText: 'Aceptar'
                });
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
        /* Estilos para el formulario de contacto */
        .contact-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .contact-container h2 {
            color: #2E7D32;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .contact-form label {
            font-weight: bold;
        }
        .contact-form input, .contact-form textarea {
            border-radius: 4px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            font-size: 1rem;
        }
        .contact-form button {
            background-color: #2E7D32;
            border-color: #2E7D32;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            border: none;
            font-weight: 500;
            width: 100%;
        }
        .contact-form button:hover {
            background-color: #1B5E20;
            border-color: #1B5E20;
        }
        .alert-success {
            margin-top: 20px;
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
        }
       
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
            background: linear-gradient(rgba(54, 54, 54, 0.8), rgba(13, 109, 253, 0.322)),url('./image/1.jpg');
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
            color: forestgreen;
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

        h4{
        font-family: cambria;
        font-weight: bold;
      
    }

        .service-icon img {
            width: 60px;
            margin-bottom: 10px;
        }

        .info-bar {
            background-color: forestgreen;
            color: white;
            padding: 20px 0;
        }

        .info-section {
            padding: 15px;
            border-right: 1px solid rgba(255,255,255,0.2);
        }

        .info-section:last-child {
            border-right: none;
        }

        .welcome-section {
            padding: 50px 0;
            background-color: white;
        }

        .feature-box {
            text-align: center;
            margin: 20px 0;
        }

        .feature-icon {
            width: 80px;
            margin-bottom: 15px;
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
            color: forestgreen;
            margin-right: 10px;
        }

        .hero-image {
            position: relative;
        }
        .floating-element {
            position: absolute;
            width: 40px;
            height: 40px;
            background-color:forestgreen;
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
        color: #666;
        background-color: #000000;
    }

   

    .footer h4, .footer h5 {
        font-weight: 600;
    }

    .footer a:hover {
        color:forestgreen !important;
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
    h1{
        font-family: cambria;
        font-weight: bold;
    }
    .uno{
        font-family:cambria;
        font-weight:bold;
        text-align:justify;
    }
    

    .footer .btn-primary:hover {
        transform: translateY(-3px);
    }

    .footer .list-unstyled li a {
        color: white;
        transition: all 0.3s ease;
    }

    .footer .list-unstyled li a:hover {
        padding-left: 10px;
    }
    a img{
        transform: scale(1);
    }

    .services-section {
    background-color: #f8f9fa; 
    padding: 40px 0; 
    border-radius: 8px; 
}

.services-section h2 {
    color: #343a40; 
    font-size: 2.5rem; 
}

.services-section p {
    font-size: 1.1rem; 
    line-height: 1.6; 
}
.dos{
    text-align:center;
    font-family:cambria;
    font-weight:bold;
}
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">TERESA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="./index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="./servicios.php">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="./nosotros.php">Sobre Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="./farmacos.php">Farmacos</a></li>
                <li class="nav-item"><a class="nav-link" href="./contacto.php">Contacto</a></li>
            </ul>
        </div>
    </div>
</nav>


<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">
                    TU CUIDADO DE PIEL<br>
                   NUESTRA PRIORIDAD
                </h1>
                <p class="hero-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.
                </p>
                <div class="d-flex align-items-center">
                  
                    <span class="open-badge">
                        <i class="far fa-clock"></i> 24/24 abiertos..
                    </span>
                </div>
              
            </div>
           
        </div>
    </div>
</section>


<div class="info-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-3 info-section">
                <h4>Horarios de Atención</h4>
                <p>Lunes - Viernes: 8:00 - 22:00</p>
                <p>Sábado: 8:00 - 17:00</p>
            </div>
            <div class="col-md-3 info-section">
                <h4>Especialidades</h4>
                <p>Medicina Dermatologica</p>
                
            </div>
            <div class="col-md-3 info-section">
                <h4>Reserve su hora</h4>
                <p>Reserve su hora aquí</p>
            
            </div>
            <div class="col-md-3 info-section">
                <h4>Contáctenos</h4>
                <p>222 - 89-27-81</p>
                <p>laura@gmail.com</p>
            </div>
        </div>
    </div>
</div>


<h1 class="dos">Contactanos.</h1>


<section class="contact-container">
    <h2>Ingresa Tus Credenciales:</h2>
    <form action="contacto.php" method="POST" class="contact-form">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="asunto" class="form-label">Asunto:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-comment-dots"></i></span>
                <input type="text" id="asunto" name="asunto" class="form-control" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                <textarea id="mensaje" name="mensaje" class="form-control" rows="5" required></textarea>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    
    <div class="alert alert-success" role="alert" style="display:none;">
        ¡Tu mensaje ha sido enviado con éxito!
    </div>
</section>
  


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



<script src="./js/all.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>