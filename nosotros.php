<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teresa</title>
   <link rel="stylesheet" href="./css/all.css">
   <link rel="stylesheet" href="./css/all.min.css">
   <link rel="stylesheet" href="./css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background: linear-gradient(rgba(0, 0, 0, 0.795), rgba(13, 109, 253, 0.322)),url('./image/1.jpg');
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
    h5{

        font-family: cambria;
        font-weight: bold;
        font-size: 30px;
        text-align: center;
        margin-bottom: 70px;
    }

    h2{

        font-family: cambria;
        font-weight: bold;
        font-size: 15px;
        text-align: justify;
    }
    p.teresa{
        font-family: cambria;
        font-weight: normal;
        font-size: 20px;
        text-align: justify;
    }
    h4{
        font-family: cambria;
        font-weight: bold;
        text-align: justify;
      
    }
    .lead{
        font-family: cambria;
        font-weight: normal;
        text-align: justify;
       
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
                    <a class="nav-link" href="./servicios.php
                    ">Servicios</a>
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
                    tu salud<br>
                   nuestra prioridad
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
                <p>Medicina general</p>
                <p>Psicología</p>
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

<h5>NUESTRA HISTORIA</h5>

<div class="container mt-5">
    <div class="row">
      <div class="col-lg-6">
        <h2 class="display-4">Sobre Nosotros</h2>
        <p class="lead">Somos una empresa dedicada a proporcionar soluciones innovadoras y servicios de alta calidad para nuestros clientes. Nuestro equipo de profesionales altamente capacitados está comprometido con la excelencia y la mejora continua.</p>
        <p class="teresa">Desde nuestra fundación, hemos trabajado incansablemente para brindar productos y servicios que marquen una diferencia significativa. Creemos en el trabajo en equipo y en el poder de la colaboración para alcanzar grandes metas.</p>
        <h4>Nuestro Objetivo</h4>
        <p class="teresa">Ser líderes en la seccion de enfermeria, ofreciendo productos y servicios que transformen las expectativas de nuestros clientes y contribuyan al desarrollo sostenible.</p>
      </div>
      <div class="col-lg-6">
        <img src="./image/front-view-female-doctor-white-medical-suit-wearing-mask-due-coronavirus-white-wall-pandemic-disease-virus-isolation.jpg" class="img-fluid rounded" alt="Imagen de la empresa">
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>