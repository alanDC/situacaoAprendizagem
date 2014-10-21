SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `idade` INT NOT NULL ,
  `foto` VARCHAR(45) NULL ,
  `senha` VARCHAR(45) NULL ,
  PRIMARY KEY (`idusuario`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`artigo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`artigo` (
  `idartigo` INT NOT NULL AUTO_INCREMENT ,
  `titulo` VARCHAR(45) NOT NULL ,
  `conteudo` TEXT NOT NULL ,
  `data` DATETIME NULL ,
  `usuario_idusuario` INT NOT NULL ,
  PRIMARY KEY (`idartigo`) ,
  UNIQUE INDEX `titulo_UNIQUE` (`titulo` ASC) ,
  INDEX `fk_artigo_usuario1` (`usuario_idusuario` ASC) ,
  CONSTRAINT `fk_artigo_usuario1`
    FOREIGN KEY (`usuario_idusuario` )
    REFERENCES `mydb`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`fotos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`fotos` (
  `idfotos` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  `artigo_idartigo` INT NOT NULL ,
  PRIMARY KEY (`idfotos`) ,
  INDEX `fk_fotos_artigo1` (`artigo_idartigo` ASC) ,
  CONSTRAINT `fk_fotos_artigo1`
    FOREIGN KEY (`artigo_idartigo` )
    REFERENCES `mydb`.`artigo` (`idartigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`categoria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT ,
  `tema` VARCHAR(45) NOT NULL ,
  `descricao` VARCHAR(100) NULL ,
  PRIMARY KEY (`idcategoria`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`categoria_has_artigo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`categoria_has_artigo` (
  `categoria_idcategoria` INT NOT NULL ,
  `artigo_idartigo` INT NOT NULL ,
  PRIMARY KEY (`categoria_idcategoria`, `artigo_idartigo`) ,
  INDEX `fk_categoria_has_artigo_artigo1` (`artigo_idartigo` ASC) ,
  INDEX `fk_categoria_has_artigo_categoria1` (`categoria_idcategoria` ASC) ,
  CONSTRAINT `fk_categoria_has_artigo_categoria1`
    FOREIGN KEY (`categoria_idcategoria` )
    REFERENCES `mydb`.`categoria` (`idcategoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categoria_has_artigo_artigo1`
    FOREIGN KEY (`artigo_idartigo` )
    REFERENCES `mydb`.`artigo` (`idartigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`comentario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`comentario` (
  `usuario_idusuario` INT NOT NULL ,
  `artigo_idartigo` INT NOT NULL ,
  `corpo` TEXT NULL ,
  `data` DATETIME NULL ,
  INDEX `fk_usuario_has_artigo_artigo1` (`artigo_idartigo` ASC) ,
  INDEX `fk_usuario_has_artigo_usuario1` (`usuario_idusuario` ASC) ,
  CONSTRAINT `fk_usuario_has_artigo_usuario1`
    FOREIGN KEY (`usuario_idusuario` )
    REFERENCES `mydb`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_artigo_artigo1`
    FOREIGN KEY (`artigo_idartigo` )
    REFERENCES `mydb`.`artigo` (`idartigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
