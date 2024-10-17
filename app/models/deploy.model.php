<?php
    require_once "config.php";

class Model {
    protected $db;

    public function __construct() {
        //conexion al servidor sin especificar base db
        $this->db = new PDO("mysql:host=".MYSQL_HOST ,MYSQL_USER, MYSQL_PASS);
        //crear la db si no existe
        $this->db->exec("CREATE DATABASE IF NOT EXISTS `" . MYSQL_DB . "` CHARACTER SET utf8 COLLATE utf8_general_ci");
        //nos conectamos a la db
        $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);

        $this->deploy();
    }

    private function deploy() {
        //chequea si hay tablas
        $query = $this->db->query('SHOW TABLES');
        $password='$2y$10$hdlTS53P7drcjWdaK362VuYmkHzAu9D5UF6UP2L1fwwukw7MXXgai';
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql = <<<END
            /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!40101 SET NAMES utf8mb4 */;

            --
            -- Base de datos: `sistema_clubes`
            --

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `club`
            --

            CREATE TABLE `club` (
            `id_club` int(11) NOT NULL,
            `club` varchar(50) NOT NULL,
            `fundacion` date NOT NULL,
            `localidad` varchar(60) NOT NULL,
            `sede` varchar(150) NOT NULL,
            `contacto` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `club`
            --

            INSERT INTO `club` (`id_club`, `club`, `fundacion`, `localidad`, `sede`, `contacto`) VALUES
            (1, 'Atletico Independiente', '1984-07-12', 'Tandil', 'Avenida Avellaneda 700', 29836474),
            (2, 'Ferrocarril Sud', '1995-09-22', 'Tandil', 'Avenida Del Valle 157', 24942883),
            (3, 'Santamarina ', '2024-09-03', 'Tandil', 'Avenida Rivadavia 450', 283999887);

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `disciplina`
            --

            CREATE TABLE `disciplina` (
            `id_disciplina` int(11) NOT NULL,
            `deporte` varchar(80) NOT NULL,
            `direccion` varchar(100) NOT NULL,
            `contacto` int(11) NOT NULL,
            `id_club` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `disciplina`
            --

            INSERT INTO `disciplina` (`id_disciplina`, `deporte`, `direccion`, `contacto`, `id_club`) VALUES
            (2, 'Calistenia', 'Avellaneda 500', 2414324, 1),
            (4, 'Basquet', 'Avellaneda 500', 2414324, 1);

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `socios`
            --

            CREATE TABLE `socios` (
            `id_socio` int(11) NOT NULL,
            `nombre` varchar(80) NOT NULL,
            `apellido` varchar(80) NOT NULL,
            `dni` int(11) NOT NULL,
            `id_club` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `socios`
            --

            INSERT INTO `socios` (`id_socio`, `nombre`, `apellido`, `dni`, `id_club`) VALUES
            (3, 'Tobias', 'Vittor', 343424, 1),
            (4, 'Agustin', 'Van Waarde', 46901171, 1),
            (10, 'tito', 'en bloque', 412412, 2);

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `usuario`
            --

            CREATE TABLE `usuario` (
            `id` int(11) NOT NULL,
            `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `usuario`
            --

            INSERT INTO `usuario` (`id`, `email`, `password`) VALUES
            (1, 'webadmin', '$password');

            --
            -- Índices para tablas volcadas
            --

            --
            -- Indices de la tabla `club`
            --
            ALTER TABLE `club`
            ADD PRIMARY KEY (`id_club`);

            --
            -- Indices de la tabla `disciplina`
            --
            ALTER TABLE `disciplina`
            ADD PRIMARY KEY (`id_disciplina`),
            ADD KEY `vincularClub` (`id_club`);

            --
            -- Indices de la tabla `socios`
            --
            ALTER TABLE `socios`
            ADD PRIMARY KEY (`id_socio`),
            ADD KEY `idClub` (`id_club`) USING BTREE;

            --
            -- Indices de la tabla `usuario`
            --
            ALTER TABLE `usuario`
            ADD PRIMARY KEY (`id`),
            ADD UNIQUE KEY `email` (`email`) USING BTREE;

            --
            -- AUTO_INCREMENT de las tablas volcadas
            --

            --
            -- AUTO_INCREMENT de la tabla `club`
            --
            ALTER TABLE `club`
            MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

            --
            -- AUTO_INCREMENT de la tabla `disciplina`
            --
            ALTER TABLE `disciplina`
            MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

            --
            -- AUTO_INCREMENT de la tabla `socios`
            --
            ALTER TABLE `socios`
            MODIFY `id_socio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

            --
            -- AUTO_INCREMENT de la tabla `usuario`
            --
            ALTER TABLE `usuario`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

            --
            -- Restricciones para tablas volcadas
            --

            --
            -- Filtros para la tabla `disciplina`
            --
            ALTER TABLE `disciplina`
            ADD CONSTRAINT `vincularClub` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`) ON DELETE CASCADE;

            --
            -- Filtros para la tabla `socios`
            --
            ALTER TABLE `socios`
            ADD CONSTRAINT `idClub` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`) ON DELETE CASCADE;
            COMMIT;

            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
            END;

            $this->db->query($sql);
        }
    }
}
