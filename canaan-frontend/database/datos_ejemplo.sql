-- Datos de ejemplo para Canaán Central


-- Datos de ejemplo para tabla "Administradores"
INSERT INTO `administradores` (`username`, `password`, `nombre`, `rol`, `role`) VALUES
('admin1', '$2y$10$WH/5lutjaf.Oj8rGRW0y6.m22rzxWL7hOO4cb.JiSwxDU9J0FBTua', 'Administrador Principal', 'superadmin', 'admin');

INSERT INTO `eventos` (`titulo`, `descripcion`, `fecha`, `hora`, `lugar`, `imagen`) VALUES
('Aniversario', 'Aniversario', '2025-05-31', '04:00:00', 'Canaán', 'evento_6829a82586a4e.png'),
('Bautismo', 'No faltes', '2025-05-28', '07:00:00', 'Canaán', 'evento_6829aa27ae100.png');

-- Datos de ejemplo para tabla "pastores"
INSERT INTO `pastores` (`id`, `nombre_completo`, `fecha_nacimiento`, `tiempo_pastorado`, `descripcion`, `imagen`, `creado_en`) VALUES
(1, 'Mario Granados JR', '1987-05-08', '12 años', 'Actual pastor general de Iglesia Canaán', 'pastor_1747602028.jpg', '2025-05-18 21:00:28'),
(3, 'Mario Granados ', '1972-03-03', '25 años', 'Pastor', 'pastor_1747604705.png', '2025-05-18 21:45:05');

-- Ajustar el valor AUTO_INCREMENT para continuar con el ID 4 en adelante
ALTER TABLE `pastores`
  AUTO_INCREMENT = 4;

  -- Datos de ejemplo para tabla "ministerios"
INSERT INTO `ministerios` (`nombre`, `descripcion`, `imagen_url`) VALUES
('Alabanzas', 'Ministerio de adoración y alabanza durante los servicios.', '682bb36857b94_alabanza.jpg'),
('Cuantico', 'Ministerio enfocado en tecnología, multimedia y sonido.', '682bb37f76e82_cuanti.png');

  