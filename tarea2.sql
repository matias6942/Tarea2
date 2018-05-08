SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `tarea2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `tarea2` ;

-- -----------------------------------------------------
-- Table `tarea2`.`region`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea2`.`region` ;

CREATE TABLE IF NOT EXISTS `tarea2`.`region` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea2`.`comuna`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea2`.`comuna` ;

CREATE TABLE IF NOT EXISTS `tarea2`.`comuna` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NOT NULL,
  `region_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comuna_region_idx` (`region_id` ASC),
  CONSTRAINT `fk_comuna_region`
    FOREIGN KEY (`region_id`)
    REFERENCES `tarea2`.`region` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea2`.`articulo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea2`.`articulo` ;

CREATE TABLE IF NOT EXISTS `tarea2`.`articulo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(80) NOT NULL,
  `descripcion` VARCHAR(1000) NULL,
  `fecha_ingreso` DATETIME NOT NULL,
  `calle_numero` VARCHAR(150) NOT NULL,
  `nombre_contacto` VARCHAR(200) NOT NULL,
  `email_contacto` VARCHAR(100) NOT NULL,
  `fono_contacto` VARCHAR(20) NULL,
  `comuna_id` INT NOT NULL,
  PRIMARY KEY (`id`, `comuna_id`),
  INDEX `fk_articulo_comuna1_idx` (`comuna_id` ASC),
  CONSTRAINT `fk_articulo_comuna1`
    FOREIGN KEY (`comuna_id`)
    REFERENCES `tarea2`.`comuna` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea2`.`fotografia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea2`.`fotografia` ;

CREATE TABLE IF NOT EXISTS `tarea2`.`fotografia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ruta_archivo` VARCHAR(300) NOT NULL,
  `nombre_archivo` VARCHAR(300) NOT NULL,
  `articulo_id` INT NOT NULL,
  PRIMARY KEY (`id`, `articulo_id`),
  INDEX `fk_fotografia_articulo1_idx` (`articulo_id` ASC),
  CONSTRAINT `fk_fotografia_articulo1`
    FOREIGN KEY (`articulo_id`)
    REFERENCES `tarea2`.`articulo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea2`.`comentario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea2`.`comentario` ;

CREATE TABLE IF NOT EXISTS `tarea2`.`comentario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comentario` VARCHAR(500) NOT NULL,
  `nombre_comentarista` VARCHAR(200) NULL,
  `fecha` DATETIME NULL,
  `articulo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comentario_articulo1_idx` (`articulo_id` ASC),
  CONSTRAINT `fk_comentario_articulo1`
    FOREIGN KEY (`articulo_id`)
    REFERENCES `tarea2`.`articulo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
