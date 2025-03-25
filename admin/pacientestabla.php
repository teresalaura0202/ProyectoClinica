
<?php
include 'conexion.php';

$query = "SELECT * FROM pacientes";
$result = mysqli_query($conexion, $query);

if ($result) {
    
    $pacientes = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
   
    $pacientes = [];
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
        
        /* Retraso en la animación de los botones */
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
      
        </nav>
</aside>

<main>
    <section id="inicio">
        
        <div class="cards-container">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-calendar-check card-icon"></i>
                    <h5>Citas Programadas</h5>
                    <p>12</p>
                </div>
            </div>
            <div class="card">
                
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

    <main>
    <section id="pacientes">
        <div class="container mt-5">
            <h2>Pacientes Registrados</h2>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pacientes as $paciente): ?>
                            <tr>
                                <td><?php echo $paciente['id_paciente']; ?></td>
                                <td><?php echo $paciente['nombre']; ?></td>
                                <td><?php echo $paciente['email']; ?></td>
                                <td><?php echo $paciente['telefono']; ?></td>
                               
                               
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

    </main>
</body>
</html>