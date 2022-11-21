DROP DATABASE IF EXISTS ventas;
CREATE DATABASE IF NOT EXISTS ventas;
USE ventas;
CREATE TABLE productos(
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	codigo VARCHAR(255) NOT NULL,
	descripcion VARCHAR(255) NOT NULL,
	precioVenta DECIMAL(5, 2) NOT NULL,
	precioCompra DECIMAL(5, 2) NOT NULL,
	existencia DECIMAL(5, 2) NOT NULL,
	PRIMARY KEY(id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

-- Adicional Juansis99
CREATE TABLE clientes(
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	nombres VARCHAR(255) NOT NULL,
	apellidos VARCHAR(255) NOT NULL,
	fecha_nacimiento DATE NOT NULL,
	edad INT,
	correo VARCHAR(255) NOT NULL,
	ciudad VARCHAR(255) NOT NULL,
	PRIMARY KEY(id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;
-- Fin adicional Juansis99

CREATE TABLE ventas(
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	fecha DATETIME NOT NULL,
	total DECIMAL(7,2),
	-- Adicional Juansis99
	id_cliente BIGINT UNSIGNED NOT NULL,
	estado VARCHAR(10) NOT NULL DEFAULT 'Activa',
	-- Fin adiconal Juansis99
	PRIMARY KEY(id),
	-- Adicional Juansis99
	FOREIGN KEY(id_cliente) REFERENCES clientes(id) ON DELETE CASCADE
	-- Fin adiconal Juansis99
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE productos_vendidos(
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_producto BIGINT UNSIGNED NOT NULL,
	cantidad BIGINT UNSIGNED NOT NULL,
	id_venta BIGINT UNSIGNED NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_producto) REFERENCES productos(id) ON DELETE CASCADE,
	FOREIGN KEY(id_venta) REFERENCES ventas(id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

INSERT INTO productos(id, codigo, descripcion, precioVenta, precioCompra, existencia) 
VALUES
(1, '1', 'Galletas chokis', 15, 10, 100),
(2, '2', 'Mermelada de fresa', 80, 65, 100),
(3, '3', 'Aceite', 20, 18, 100),
(4, '4', 'Palomitas de maíz', 15, 12, 100),
(5, '5', 'Doritos', 8, 5, 100);

-- Adicional Juansis99
INSERT INTO clientes(id, nombres, apellidos, fecha_nacimiento, correo, ciudad) 
VALUES
(1, 'Juan', 'Rojas', '1984-08-24', 'juan@hotmail.com', 'Cali'),
(2, 'Andre', 'Perez', '1992-05-30', 'andres@hotmail.com', 'Manizales'),
(3, 'Camilo', 'Ramirez', '1960-08-23', 'camilo@hotmail.com', 'Manizales'),
(4, 'Margarita', 'Fernandez', '1963-09-07', 'marga@hotmail.com', 'Bogota'),
(5, 'Maria', 'Molardo', '1992-02-10', 'maria@hotmail.com', 'Bogota'),
(6, 'Pepito', 'Perez', '2000-07-18', 'pepito@hotmail.com', 'Pereira'),
(7, 'Clara', 'Martinez', '1950-03-19', 'clara@hotmail.com', 'Pereira');

INSERT INTO ventas(id, fecha, total, id_cliente) 
VALUES
(1, "2022-11-16 20:37:02", 5000, 1),
(2, "2022-11-16 20:37:02", 5000, 1),
(3, "2022-11-16 20:37:02", 5000, 1),
(4, "2022-11-16 20:37:02", 5000, 2),
(5, "2022-11-16 20:37:02", 5000, 2),
(6, "2022-11-16 20:37:02", 5000, 2),
(7, "2022-11-16 20:37:02", 5000, 3),
(8, "2022-11-16 20:37:02", 5000, 3),
(9, "2022-11-16 20:37:02", 5000, 3),
(10, "2022-11-16 20:37:02", 5000, 4),
(11, "2022-11-16 20:37:02", 5000, 4),
(12, "2022-11-16 20:37:02", 5000, 4),
(13, "2022-11-16 20:37:02", 5000, 5),
(14, "2022-11-16 20:37:02", 5000, 5),
(15, "2022-11-16 20:37:02", 5000, 5),
(16, "2022-11-16 20:37:02", 5000, 6),
(17, "2022-11-16 20:37:02", 5000, 6),
(18, "2022-11-16 20:37:02", 5000, 6),
(19, "2022-11-16 20:37:02", 5000, 7),
(20, "2022-11-16 20:37:02", 5000, 7),
(21, "2022-11-16 20:37:02", 5000, 7),
(22, "2022-11-16 20:37:02", 5000, 2),
(23, "2022-11-16 20:37:02", 5000, 5),
(24, "2022-11-16 20:37:02", 5000, 7);

INSERT INTO productos_vendidos(id, id_producto, cantidad, id_venta) 
VALUES
(1, 5, 1, 1), 
(2, 1, 2, 1),
(3, 2, 3, 1),
(4, 3, 4, 1),
(5, 4, 5, 2), 
(6, 5, 1, 2),
(7, 1, 2, 2),
(8, 2, 3, 2),
(9, 3, 4, 3),
(10, 4, 5, 3),
(11, 5, 1, 4),
(12, 1, 2, 4),
(13, 2, 3, 5),
(14, 3, 4, 6),
(15, 4, 5, 6),
(16, 5, 1, 6),
(17, 1, 2, 7),
(18, 2, 3, 7),
(19, 3, 4, 8),
(20, 4, 5, 9),
(21, 5, 1, 10),
(22, 1, 2, 10),
(23, 2, 3, 10),
(24, 3, 4, 10),
(25, 4, 5, 11),
(26, 5, 1, 11),
(27, 1, 2, 12),
(28, 2, 3, 13),
(29, 3, 4, 14),
(30, 4, 5, 15),
(31, 5, 1, 16),
(32, 1, 2, 16),
(33, 2, 3, 16),
(34, 3, 4, 17),
(35, 4, 5, 18),
(36, 5, 1, 18),
(37, 1, 2, 18),
(38, 2, 3, 19),
(39, 3, 4, 19),
(40, 4, 5, 20),
(41, 5, 1, 20),
(42, 1, 2, 21),
(43, 2, 3, 21),
(44, 3, 5, 21),
(45, 4, 1, 22),
(46, 5, 2, 23),
(47, 1, 3, 24);