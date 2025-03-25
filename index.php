<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teresa</title>
    
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6Q7R3uQ9bA8yJY2qf63pW9jDoCak2S6Fw5hfch5g5kdIXQwP+z9jVlm2Tt" crossorigin="anonymous">
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


<h1 class="dos">Casos Exitosos Y Testimonios.</h1>


<section id="testimonios" class="bg-light py-5">
    <div class="container">
    
        <div class="row mb-4">
            <div class="col-md-6">
                <h5 class="mb-3">Tratamiento para el Acné</h5>
                <p  class="uno"><strong>Paciente: Evangelina</strong></p>
                <p  class="uno">"Gracias a los tratamientos de la Clínica Dermatológica,
                     pude combatir mi acné severo. Los resultados fueron increíbles y 
                     ahora me siento más seguro de mi piel."</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <img src="./image/6.avif" class="img-fluid rounded" alt="Antes del tratamiento">
                        <p class="text-center">Antes</p>
                    </div>
                    <div class="col-6">
                        <img src="./image/5.avif" class="img-fluid rounded" alt="Después del tratamiento">
                        <p class="text-center">Después</p>
                    </div>
                </div>
            </div>
        </div>

      
       
        <div class="row mb-4">
            <div class="col-md-6">
                <h5 class="mb-3">Tratamiento para Manchas en la Piel</h5>
                <p class="uno"><strong>Paciente: Oscarina</strong></p>
                <p  class="uno">"Las manchas que tenía en la piel fueron completamente eliminadas con este tratamiento.
                     ¡Me siento renovado y mucho más confiado!"</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <img src="./image/4.avif" class="img-fluid rounded" alt="Antes del tratamiento">
                        <p class="text-center">Antes</p>
                    </div>
                    <div class="col-6">
                        <img src="./image/5.avif" class="img-fluid rounded" alt="Después del tratamiento">
                        <p class="text-center">Después</p>
                    </div>
                </div>
            </div>
        </div>
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
</body>
</html>