<?php
    class Model {
        protected $db;

        function __construct() {
            $this->db = new PDO('mysql:host='. 'localhost' .';dbname='. 'liquidadora_stros' .';charset=utf8', 'root', '');
            $this->deploy();
        }

        function deploy() {
            // Chequear si hay tablas
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            if(count($tables)==0) {
                // Si no hay crearlas
                $sql =<<<END
                --
                  -- Estructura de tabla para la tabla `cias`
                  --

                  CREATE TABLE `cias` (
                    `id_Cia` int(20) NOT NULL,
                    `nombre_cia` varchar(30) NOT NULL,
                    `direccion_cia` varchar(40) NOT NULL,
                    `contacto` int(30) NOT NULL,
                    `email` varchar(40) NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                  --
                  -- Volcado de datos para la tabla `cias`
                  --

                  INSERT INTO `cias` (`id_Cia`, `nombre_cia`, `direccion_cia`, `contacto`, `email`) VALUES
                  (1, 'Holando', 'Belgrano 999', 154778877, 'holando@cia.com'),
                  (2, 'Zurich', 'Estrada 50', 1548877555, 'zurich@cia.com'),
                  (3, 'El Loco', 'Locura 666', 15995115, 'elloco@cia.com');

                  -- --------------------------------------------------------

                  --
                  -- Estructura de tabla para la tabla `inspectores`
                  --

                  CREATE TABLE `inspectores` (
                    `id_inspector` int(20) NOT NULL,
                    `nombre` varchar(30) NOT NULL,
                    `apellido` varchar(30) NOT NULL,
                    `contacto` int(30) NOT NULL,
                    `email` varchar(40) NOT NULL,
                    `localidad` varchar(30) NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                  --
                  -- Volcado de datos para la tabla `inspectores`
                  --

                  INSERT INTO `inspectores` (`id_inspector`, `nombre`, `apellido`, `contacto`, `email`, `localidad`) VALUES
                  (1, 'Pedro', 'Grando', 154445544, 'pedro@insp.com', 'Tandil'),
                  (4, 'Bueno', 'Denoche', 558855, 'buenoD@insp.com', 'Azul'),
                  (5, 'Malo', 'Dedia', 5544, 'maloD@insp.com', 'Bahia Blanco');

                  -- --------------------------------------------------------

                  --
                  -- Estructura de tabla para la tabla `liquidadores`
                  --

                  CREATE TABLE `liquidadores` (
                    `id_liquidador` int(20) NOT NULL,
                    `nombre` varchar(30) NOT NULL,
                    `apellido` varchar(30) NOT NULL,
                    `contacto` int(20) NOT NULL,
                    `email` varchar(40) NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                  --
                  -- Volcado de datos para la tabla `liquidadores`
                  --

                  INSERT INTO `liquidadores` (`id_liquidador`, `nombre`, `apellido`, `contacto`, `email`) VALUES
                  (0, 'Celeste Cid', 'Grando', 12587, 'celeste@liqui.com'),
                  (1, 'Franco', 'Procopio', 154345738, 'francoP@liqui.com'),
                  (2, 'Juan', 'Perez', 112255, 'juanperez@liqui.com'),
                  (3, 'Laura', 'Ara', 154885522, 'lauraA@liqui.com');

                  -- --------------------------------------------------------

                  --
                  -- Estructura de tabla para la tabla `siniestros`
                  --

                  CREATE TABLE `siniestros` (
                    `id_Stro` int(8) NOT NULL,
                    `id_Cia` int(8) NOT NULL,
                    `tipo_Stro` varchar(30) NOT NULL,
                    `nombre_Asegurado` varchar(30) NOT NULL,
                    `apellido_Asegurado` varchar(30) NOT NULL,
                    `fecha_Stro` date NOT NULL,
                    `direccion_Aseg` varchar(40) NOT NULL,
                    `localidad` varchar(30) NOT NULL,
                    `contacto_Asegurado` int(20) NOT NULL,
                    `id_liquidador` int(20) NOT NULL,
                    `id_inspector` int(20) NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                  --
                  -- Volcado de datos para la tabla `siniestros`
                  --

                  INSERT INTO `siniestros` (`id_Stro`, `id_Cia`, `tipo_Stro`, `nombre_Asegurado`, `apellido_Asegurado`, `fecha_Stro`, `direccion_Aseg`, `localidad`, `contacto_Asegurado`, `id_liquidador`, `id_inspector`) VALUES
                  (1, 1, 'Incendio', 'Hector', 'Garcia', '2023-10-01', 'Iraola 135', 'Tandil', 154669988, 1, 1),
                  (2, 1, 'Robo', 'Santiago', 'Lopez', '2023-10-02', 'Iraola 135', 'Tandil', 114777, 3, 1),
                  (3, 2, 'Vendaval', 'Karlitos', 'Conk', '2023-09-03', 'Lejos 555', 'Azul', 14741, 1, 4),
                  (4, 3, 'Incendio', 'Olaf', 'Fariza', '2023-10-15', 'Porahi 58', 'Bahia Blanca', 44788, 3, 5),
                  (5, 1, 'Incendio', 'Pedro', 'Perez', '2023-11-01', 'Estrada', '99', 154333666, 2, 5);

                  --
                  -- Índices para tablas volcadas
                  --

                  --
                  -- Indices de la tabla `cias`
                  --
                  ALTER TABLE `cias`
                    ADD PRIMARY KEY (`id_Cia`);

                  --
                  -- Indices de la tabla `inspectores`
                  --
                  ALTER TABLE `inspectores`
                    ADD PRIMARY KEY (`id_inspector`);

                  --
                  -- Indices de la tabla `liquidadores`
                  --
                  ALTER TABLE `liquidadores`
                    ADD PRIMARY KEY (`id_liquidador`);

                  --
                  -- Indices de la tabla `siniestros`
                  --
                  ALTER TABLE `siniestros`
                    ADD PRIMARY KEY (`id_Stro`),
                    ADD KEY `fk_id_liquidador` (`id_liquidador`),
                    ADD KEY `fk_id_inspector` (`id_inspector`),
                    ADD KEY `fk_id_cia` (`id_Cia`);

                  --
                  -- AUTO_INCREMENT de las tablas volcadas
                  --

                  --
                  -- AUTO_INCREMENT de la tabla `siniestros`
                  --
                  ALTER TABLE `siniestros`
                    MODIFY `id_Stro` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

                  --
                  -- Restricciones para tablas volcadas
                  --

                  --
                  -- Filtros para la tabla `siniestros`
                  --
                  ALTER TABLE `siniestros`
                    ADD CONSTRAINT `fk_id_cia` FOREIGN KEY (`id_Cia`) REFERENCES `cias` (`id_Cia`),
                    ADD CONSTRAINT `fk_id_inspector` FOREIGN KEY (`id_inspector`) REFERENCES `inspectores` (`id_inspector`),
                    ADD CONSTRAINT `fk_id_liquidador` FOREIGN KEY (`id_liquidador`) REFERENCES `liquidadores` (`id_liquidador`);
                  COMMIT;

                  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
                END;
                $this->db->query($sql);
            }
            
        }
    }