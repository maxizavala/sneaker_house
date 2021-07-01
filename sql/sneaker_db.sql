-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema sneaker_house
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `sneaker_house` ;

-- -----------------------------------------------------
-- Schema sneaker_house
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sneaker_house` DEFAULT CHARACTER SET utf8 ;
USE `sneaker_house` ;

-- -----------------------------------------------------
-- Table `categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categoria` ;

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `producto` ;

CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` INT NOT NULL,
  `modelo` VARCHAR(15) NOT NULL,
  `marca` VARCHAR(15) NOT NULL,
  `precio` DOUBLE(7,2) NOT NULL,
  `categoria` INT NOT NULL,
  `descripcion` VARCHAR(125) NOT NULL,
  PRIMARY KEY (`id_producto`),
  CONSTRAINT `fk_producto_categoria`
    FOREIGN KEY (`categoria`)
    REFERENCES `categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `localidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `localidad` ;

CREATE TABLE IF NOT EXISTS `localidad` (
  `id_localidad` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_localidad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tipo_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipo_usuario` ;

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `tipo` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`tipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuario` ;

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(15) NOT NULL,
  `user` VARCHAR(15) NOT NULL,
  `pass` VARCHAR(15) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(25) NOT NULL,
  `nombre` VARCHAR(15) NOT NULL,
  `fec_nacimiento` DATE NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `localidad` INT NOT NULL,
  `cp` INT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `fk_usuario_ciudad1`
    FOREIGN KEY (`localidad`)
    REFERENCES `localidad` (`id_localidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipo_usuario1`
    FOREIGN KEY (`tipo`)
    REFERENCES `tipo_usuario` (`tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `likes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `likes` ;

CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` INT NOT NULL AUTO_INCREMENT,
  `producto` INT NOT NULL,
  `usuario` INT NOT NULL,
  PRIMARY KEY (`id_like`),
  CONSTRAINT `fk_like_usuario1`
    FOREIGN KEY (`usuario`)
    REFERENCES `usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_like_producto1`
    FOREIGN KEY (`producto`)
    REFERENCES `producto` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sitio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sitio` ;

CREATE TABLE IF NOT EXISTS `sitio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `subtitulo` VARCHAR(45) NULL,
  `facebook` VARCHAR(45) NULL,
  `instagram` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `horario` VARCHAR(45) NULL,
  `email_contacto` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `carrito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `carrito` ;

CREATE TABLE IF NOT EXISTS `carrito` (
  `id_carrito` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `usuario` INT NOT NULL,
  `producto` INT NOT NULL,
  `talle` INT NOT NULL,
  `cantidad` INT NOT NULL,
  PRIMARY KEY (`id_carrito`),
  CONSTRAINT `fk_carrito_usuario1`
    FOREIGN KEY (`usuario`)
    REFERENCES `usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrito_producto1`
    FOREIGN KEY (`producto`)
    REFERENCES `producto` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

GRANT ALL ON `sneaker_house`.* TO 'admin';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `categoria`
-- -----------------------------------------------------
START TRANSACTION;
USE `sneaker_house`;
INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES (DEFAULT, 'Hombre');
INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES (DEFAULT, 'Mujer');
INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES (DEFAULT, 'Kid');

-- -----------------------------------------------------
-- Data for table `producto`
-- -----------------------------------------------------
START TRANSACTION;
USE `sneaker_house`;
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (1, 'Legacy', 'DC', 7000, 2, 'Zapatilla multicolor. Posee una base de goma resistente ideal para hacer deporte.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (2, 'Air Max Be', 'Nike', 8000, 2, 'Estas zapatillas están diseñadas en un color beige con blanco, con cámara de aire.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (3, 'NMD R1', 'Adidas', 6000, 2, 'Estas zapatillas están fabricadas con una tela resistente y fresca ideal para practicar deportes.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (4, 'Air Force Pi', 'Nike', 7500, 2, 'Estas zapatillas están diseñadas en gamuza, con combinación de colores rosa y blanco.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (5, 'Air Max R', 'Nike', 8000, 1, 'Estas zapatillas están diseñadas combinando los colores blanco, rojo y gris, con cámara de aire.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (6, 'Air Max Y', 'Nike', 8000, 1, 'Estas zapatillas están diseñadas combinando los colores amarillo, negro, blanco y gris, con cámara de aire.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (7, 'Air Max B', 'Nike', 8000, 1, 'Zapatilla multicolor. Posee una base de goma resistente ideal para hacer deporte.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (8, 'Air Max G', 'Nike', 8000, 1, 'Estas zapatillas están diseñadas combinando los colores blanco y negro, con cámara de aire.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (9, 'Disruptor', 'Fila', 7500, 3, 'Las Fila Disruptor son ideales para los niños, super resistentes, duraderas, y coloridas.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (10, 'Pure Black', 'DC', 6000, 3, 'Zapatillas clásicas de la marca DC, puramente fabricadas en color negro.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (11, 'Old School', 'Vans', 5500, 2, 'Las Vans Old School son las zapatillas clásicas de Vans, que nunca pasarán de moda.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (12, 'Function', 'Adidas', 6500, 1, 'Zapatillas ideales para la rutina diaria, sumada a la práctica de deportes.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (13, 'Dunk B', 'Nike', 7500, 3, 'Flameantes Nike Dunk B, contruidas en gamuza negra, con la pipa de Nike en un naranja llamativo.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (14, 'SB Bold', 'Nike', 8000, 3, 'Estas zapatillas est\u00e1n diseñada con los colores turquesa, azul y blanco.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (15, 'Gray', 'Adidas', 6500, 1, 'Zapatillas urbanas, diseñadas para el día a día. Diseñadas en gris y blanco.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (16, 'Dunk W', 'Nike', 7000, 1, 'Las Nike Dunk W están diseñadas con la combinación de colores blanco con azul, y la suela en marrón.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (17, 'SB B', 'Nike', 7000, 1, 'Las Nike SB B están diseñadas con la combinación de colores negro con blanco, y la suela en marrón.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (18, 'Classic', 'Adidas', 6500, 1, 'Como su nombre lo indica, son las clásicas zapatillas de Adidas, fabricadas en cuerina blanca.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (19, 'Nice Dark', 'DC', 7500, 3, 'Zapatillas construidas con una combinación de cuerina brillosa con gamuza, en color negro.');
INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `precio`, `categoria`, `descripcion`) VALUES (20, 'Curve', 'Fila', 7500, 2, 'Este modelo cuenta con un extravagante y original diseño. Fabricada en color blanco, con detalle en negro y rojo.');

-- -----------------------------------------------------
-- Data for table `localidad`
-- -----------------------------------------------------
START TRANSACTION;
USE `sneaker_house`;
INSERT INTO `localidad` (`nombre`) VALUES ('CABA');
INSERT INTO `localidad` (`nombre`) VALUES ('Rosario');
INSERT INTO `localidad` (`nombre`) VALUES ('Paraná');
INSERT INTO `localidad` (`nombre`) VALUES ('Ciudad de Cordoba');


-- -----------------------------------------------------
-- Data for table `tipo_usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `sneaker_house`;
INSERT INTO `tipo_usuario` (`tipo`) VALUES ('admin');
INSERT INTO `tipo_usuario` (`tipo`) VALUES ('comun');

-- -----------------------------------------------------
-- Data for table `usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `sneaker_house`;
INSERT INTO `usuario` (`tipo`, `user`, `pass`, `email`, `telefono`, `nombre`, `fec_nacimiento`, `direccion`, `localidad`, `cp`) 
VALUES ('admin', 'zeta', 'dv01', 'maximiliano.zavala@davinci.edu.ar', '1122334455', 'Maxi', '1986-05-12', 'Av Rivadavia 67890 3A', 1, 1345);
INSERT INTO `usuario` (`tipo`, `user`, `pass`, `email`, `telefono`, `nombre`, `fec_nacimiento`, `direccion`, `localidad`, `cp`) 
VALUES ('comun', 'pepe', 'dv01', 'beto@gmail.com', '1133445533', 'Jose', '1990-06-15', 'Uruguay 6325', 2, 2020);
INSERT INTO `usuario` (`tipo`, `user`, `pass`, `email`, `telefono`, `nombre`, `fec_nacimiento`, `direccion`, `localidad`, `cp`) 
VALUES ('comun', 'sandra', 'dv01', 'sandrita@gmail.com', '1188776622', 'Sandra', '1995-02-25', 'Asuncion 345 1A', 3, 2133);

-- -----------------------------------------------------
-- Data for table `sitio`
-- -----------------------------------------------------
START TRANSACTION;
USE `sneaker_house`;
INSERT INTO `sitio` (`subtitulo`, `facebook`, `instagram`, `telefono`, `direccion`, `horario`, `email_contacto`) 
VALUES ('Venta de Zapatillas', 'www.facebook.com', 'www.instagram.com', '0800 999 6565', 'Malabia 1345 - Palermo - CABA', 'Lunes a Sábados - de 10 a 21hs', 'sneaker.house@gmail.com');

-- -----------------------------------------------------
-- Data for table `like`
-- -----------------------------------------------------
START TRANSACTION;
USE `sneaker_house`;
INSERT INTO `likes` (`producto`, `usuario`) VALUES (2, 1);
INSERT INTO `likes` (`producto`, `usuario`) VALUES (4, 1);
INSERT INTO `likes` (`producto`, `usuario`) VALUES (6, 1);
INSERT INTO `likes` (`producto`, `usuario`) VALUES (8, 1);
INSERT INTO `likes` (`producto`, `usuario`) VALUES (12, 1);
INSERT INTO `likes` (`producto`, `usuario`) VALUES (14, 1);
INSERT INTO `likes` (`producto`, `usuario`) VALUES (15, 1);
INSERT INTO `likes` (`producto`, `usuario`) VALUES (18, 1);
INSERT INTO `likes` (`producto`, `usuario`) VALUES (19, 1);
INSERT INTO `likes` (`producto`, `usuario`) VALUES (20, 1);


SET SQL_SAFE_UPDATES = 0;

SELECT * FROM usuario WHERE user = 'pepe';

COMMIT;

