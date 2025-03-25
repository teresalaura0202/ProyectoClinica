
CREATE DATABASE dermatologo2;

USE dermatologo2;


CREATE TABLE Pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    fecha_nacimiento DATE,
    genero ENUM('Masculino', 'Femenino') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(15),
    direccion VARCHAR(255)
 
);

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('recepcionista','doctor') NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;




CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `fecha_solicitud` datetime DEFAULT current_timestamp(),
  `fecha_cita` datetime DEFAULT NULL,
  `hora_cita` time DEFAULT NULL,
  `estado` enum('pendiente','aprobada','rechazada','atendida') DEFAULT 'pendiente',
  `motivo_rechazo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_paciente` (`id_paciente`);

ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);
COMMIT;

select * from recetas ;

CREATE TABLE `recetas` (
  `id_receta` int(11) NOT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `diagnostico` text DEFAULT NULL,
  `medicamentos` text DEFAULT NULL,
  `indicaciones` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `proxima_cita` date DEFAULT NULL,
  `hora_proxima_cita` time DEFAULT NULL,
  `prescripcion` text DEFAULT NULL,
  `fecha_emision` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_cita` (`id_cita`);

ALTER TABLE `recetas`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `recetas`
  ADD CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id_cita`);
COMMIT;

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_cita` date DEFAULT NULL,
  `estado` enum('no_leida','leida') DEFAULT 'no_leida',
  PRIMARY KEY (`id_notificacion`),
  FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

drop table farmacos;
CREATE TABLE `farmacos` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` TEXT,
  `cantidad` INT NOT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  `stock` INT NOT NULL DEFAULT 0  
);

create table contacto(
    id int not null auto_increment primary key,
    nombre varchar(100) not null,
    email varchar(100) not null,
    asunto varchar(100)not null,
    mensaje text not null
);
