create database ProyectoFinal;
use ProyectoFinal;

create table usuario(
	id_usuario int auto_increment primary key,
    nombre varchar(255),
    pass varchar(255),
    tipo_usuario tinyint,
	telefono varchar(255),
	email varchar(255),
    direccion varchar(255),
    nombre_r varchar(20),
    tarjeta varchar(19),/*tinyint,*/
    cuenta_banco varchar(28),
	comprador_vendedor BIT DEFAULT 0
);
    
insert into usuario(nombre, pass, tipo_usuario) values('admin', '$2y$10$vu62qV9qCtib7RYJ6XaFAerQpdpbrP9V.1u4YCo1o0eg9d8m7rG4a', 0);
-- insert into usuario(nombre, pass, tipo_usuario) values('12', '$2y$10$vu62qV9qCtib7RYJ6XaFAerQpdpbrP9V.1u4YCo1o0eg9d8m7rG4a', 1, NULL, NULL, NULL, 'Gustavo Lopez');
-- Usuario 'admin'. Password 'linkia'

-- Estructura de tabla para la tabla `categoria`

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL PRIMARY KEY,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Volcado de datos para la tabla `categoria`

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(1, 'Lácteos'),
(2, 'Carnes'),
(3, 'Frutas'),
(4, 'Verduras');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) primary key NOT NULL auto_increment,
  `nombre` varchar(50) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `resenia` varchar(250) DEFAULT NULL,
  `vendedor` varchar(150) DEFAULT NULL,
  `imagen` BLOB DEFAULT NULL,
      constraint fk_categoria_producto foreign key (`id_categoria`) references `categoria`(`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--
INSERT INTO `producto` (`id_producto`, `nombre`, `id_categoria`, `precio`, `descripcion`, `resenia`, `vendedor`/*, `id_usuario`*/) VALUES
(9, 'Leche', 1, 0.9, 'Leche entera', 'Leche de muy buena calidad.', 'Granja Carlos'      /*,1*/),
(11, 'Tomate', 4, 1.8,'Tomate de granja', 'Tomates exquisitos', 'Corporativa tomatera'        /*,1*/),
(12, 'Salmón', 2, 9,'Salmón de mar', 'Están muy frescos', 'AQUANARIA SL'        /*,1*/);

--
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `compras`
--
CREATE TABLE compras (
  id_compra int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id_usuario int(11) NOT NULL,
  fecha date DEFAULT CURRENT_DATE, -- TIMESTAMP DEFAULT CURRENT_TIMESTAMP,-- date DEFAULT CURRENT_DATE,
  hora varchar(10) NOT NULL,
  CONSTRAINT fk_compras_usuario FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE productos_comprados (
  id_compra int(11) NOT NULL,
  id_producto  int(11) NOT NULL,
  -- fecha date NOT NULL DEFAULT CURRENT_DATE,
  precio_cantidad decimal(10,2) NOT NULL,
  cantidad tinyint NOT NULL,
  vendedor varchar(150),
  CONSTRAINT fk_prodComprado_compras FOREIGN KEY (id_compra) REFERENCES compras (id_compra),
  CONSTRAINT fk_prodComprado_producto FOREIGN KEY (id_producto) REFERENCES producto (id_producto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 	Tabla de reseñas.
--
CREATE TABLE resenia(
id_resenia int(11) PRIMARY KEY AUTO_INCREMENT,
id_compra int(11),
id_usuario int,
resenia varchar(200),
CONSTRAINT fk_resenia_producto FOREIGN KEY (id_compra) REFERENCES compras (id_compra), 
CONSTRAINT fk_resenia_usuario FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `detalle_compra`
--
/*
CREATE TABLE `detalle_compra` (
  `id_detalle` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`),
  FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
*/
COMMIT;
