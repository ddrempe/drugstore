-- MySQL Script generated by MySQL Workbench
-- 06/16/16 17:17:25
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema WebDiP2015x019
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema WebDiP2015x019
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `WebDiP2015x019` DEFAULT CHARACTER SET utf8 ;
USE `WebDiP2015x019` ;

-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`korisnik` (
  `idkorisnik` INT NOT NULL AUTO_INCREMENT,
  `uloga` INT NULL,
  `ime` VARCHAR(45) NULL,
  `prezime` VARCHAR(45) NULL,
  `godina` INT NULL,
  `email` VARCHAR(45) NULL,
  `korime` VARCHAR(45) NULL,
  `lozinka` VARCHAR(45) NULL,
  `aktiviran` INT NULL,
  `zakljucan` INT NULL,
  `neuspjesne_prijave` INT NULL,
  PRIMARY KEY (`idkorisnik`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`kod`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`kod` (
  `idkod` INT NOT NULL AUTO_INCREMENT,
  `vrijednost` VARCHAR(200) NULL,
  `vrijeme` TIMESTAMP NULL,
  `iskoristenost` INT NULL,
  `idkorisnik` INT NULL,
  PRIMARY KEY (`idkod`),
  INDEX `fk_kod_korisnik_idx` (`idkorisnik` ASC),
  CONSTRAINT `fk_kod_korisnik`
    FOREIGN KEY (`idkorisnik`)
    REFERENCES `WebDiP2015x019`.`korisnik` (`idkorisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`kategorija`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`kategorija` (
  `idkategorija` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NULL,
  `opis` VARCHAR(45) NULL,
  PRIMARY KEY (`idkategorija`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`lijek`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`lijek` (
  `idlijek` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NULL,
  `cijena` DOUBLE NULL,
  `proizvodac` VARCHAR(45) NULL,
  `tezina` DOUBLE NULL,
  `bez_recepta` INT NULL,
  `idkategorija` INT NULL,
  PRIMARY KEY (`idlijek`),
  INDEX `fk_lijek_kategorija1_idx` (`idkategorija` ASC),
  CONSTRAINT `fk_lijek_kategorija1`
    FOREIGN KEY (`idkategorija`)
    REFERENCES `WebDiP2015x019`.`kategorija` (`idkategorija`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`dnevnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`dnevnik` (
  `iddnevnik` INT NOT NULL AUTO_INCREMENT,
  `tip_zapisa` VARCHAR(45) NULL,
  `zapis` TEXT NULL,
  `vrijeme` TIMESTAMP NULL,
  `idkorisnik` INT NULL,
  PRIMARY KEY (`iddnevnik`),
  INDEX `fk_dnevnik_korisnik1_idx` (`idkorisnik` ASC),
  CONSTRAINT `fk_dnevnik_korisnik1`
    FOREIGN KEY (`idkorisnik`)
    REFERENCES `WebDiP2015x019`.`korisnik` (`idkorisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`poslovnica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`poslovnica` (
  `idposlovnica` INT NOT NULL AUTO_INCREMENT,
  `drzava` VARCHAR(45) NULL,
  `grad` VARCHAR(45) NULL,
  `ulica` VARCHAR(45) NULL,
  `broj` VARCHAR(45) NULL,
  `radno_vrijeme` TEXT NULL,
  `lokacija` VARCHAR(45) NULL,
  `idkorisnik` INT NULL,
  PRIMARY KEY (`idposlovnica`),
  INDEX `fk_poslovnica_korisnik1_idx` (`idkorisnik` ASC),
  CONSTRAINT `fk_poslovnica_korisnik1`
    FOREIGN KEY (`idkorisnik`)
    REFERENCES `WebDiP2015x019`.`korisnik` (`idkorisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`slika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`slika` (
  `idslika` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NULL,
  `idkorisnik` INT NULL,
  PRIMARY KEY (`idslika`),
  INDEX `fk_slika_korisnik1_idx` (`idkorisnik` ASC),
  CONSTRAINT `fk_slika_korisnik1`
    FOREIGN KEY (`idkorisnik`)
    REFERENCES `WebDiP2015x019`.`korisnik` (`idkorisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`akcija`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`akcija` (
  `idakcija` INT NOT NULL AUTO_INCREMENT,
  `postotak` INT NULL,
  `od_datum` DATE NULL,
  `do_datum` DATE NULL,
  PRIMARY KEY (`idakcija`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`moderira`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`moderira` (
  `idkorisnik` INT NOT NULL,
  `idkategorija` INT NOT NULL,
  PRIMARY KEY (`idkorisnik`, `idkategorija`),
  INDEX `fk_korisnik_has_kategorija_kategorija1_idx` (`idkategorija` ASC),
  INDEX `fk_korisnik_has_kategorija_korisnik1_idx` (`idkorisnik` ASC),
  CONSTRAINT `fk_korisnik_has_kategorija_korisnik1`
    FOREIGN KEY (`idkorisnik`)
    REFERENCES `WebDiP2015x019`.`korisnik` (`idkorisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_korisnik_has_kategorija_kategorija1`
    FOREIGN KEY (`idkategorija`)
    REFERENCES `WebDiP2015x019`.`kategorija` (`idkategorija`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`na_akciji`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`na_akciji` (
  `lijek_idlijek` INT NOT NULL,
  `akcija_idakcija` INT NOT NULL,
  PRIMARY KEY (`lijek_idlijek`, `akcija_idakcija`),
  INDEX `fk_lijek_has_akcija_akcija1_idx` (`akcija_idakcija` ASC),
  INDEX `fk_lijek_has_akcija_lijek1_idx` (`lijek_idlijek` ASC),
  CONSTRAINT `fk_lijek_has_akcija_lijek1`
    FOREIGN KEY (`lijek_idlijek`)
    REFERENCES `WebDiP2015x019`.`lijek` (`idlijek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lijek_has_akcija_akcija1`
    FOREIGN KEY (`akcija_idakcija`)
    REFERENCES `WebDiP2015x019`.`akcija` (`idakcija`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`racun`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`racun` (
  `idracun` INT NOT NULL AUTO_INCREMENT,
  `vrijeme` TIMESTAMP NULL,
  `lijek` VARCHAR(45) NULL,
  `kolicina` INT NULL,
  `cijena` DOUBLE NULL,
  `djelatnik` VARCHAR(45) NULL,
  `idkorisnik` INT NULL,
  PRIMARY KEY (`idracun`),
  INDEX `fk_racun_korisnik1_idx` (`idkorisnik` ASC),
  CONSTRAINT `fk_racun_korisnik1`
    FOREIGN KEY (`idkorisnik`)
    REFERENCES `WebDiP2015x019`.`korisnik` (`idkorisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`kliknuo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`kliknuo` (
  `idkliknuo` INT NOT NULL AUTO_INCREMENT,
  `idkorisnik` INT NOT NULL,
  `idlijek` INT NULL,
  `idkategorija` INT NULL,
  `vrijeme` TIMESTAMP NULL,
  PRIMARY KEY (`idkliknuo`),
  INDEX `fk_kliknuo_korisnik1_idx` (`idkorisnik` ASC),
  INDEX `fk_kliknuo_lijek1_idx` (`idlijek` ASC),
  INDEX `fk_kliknuo_kategorija1_idx` (`idkategorija` ASC),
  CONSTRAINT `fk_kliknuo_korisnik1`
    FOREIGN KEY (`idkorisnik`)
    REFERENCES `WebDiP2015x019`.`korisnik` (`idkorisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kliknuo_lijek1`
    FOREIGN KEY (`idlijek`)
    REFERENCES `WebDiP2015x019`.`lijek` (`idlijek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kliknuo_kategorija1`
    FOREIGN KEY (`idkategorija`)
    REFERENCES `WebDiP2015x019`.`kategorija` (`idkategorija`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`vvrijeme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`vvrijeme` (
  `idvvrijeme` INT NOT NULL AUTO_INCREMENT,
  `pomak` INT NULL,
  `trenutno` TIMESTAMP NULL,
  PRIMARY KEY (`idvvrijeme`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`oznacio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`oznacio` (
  `idoznacio` INT NOT NULL AUTO_INCREMENT,
  `oznaka` VARCHAR(45) NULL,
  `idslika` INT NOT NULL,
  PRIMARY KEY (`idoznacio`),
  INDEX `fk_oznacio_slika1_idx` (`idslika` ASC),
  CONSTRAINT `fk_oznacio_slika1`
    FOREIGN KEY (`idslika`)
    REFERENCES `WebDiP2015x019`.`slika` (`idslika`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2015x019`.`rezervira`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2015x019`.`rezervira` (
  `idrezervira` INT NOT NULL AUTO_INCREMENT,
  `idkorisnik` INT NOT NULL,
  `idlijek` INT NOT NULL,
  `kolicina` INT NULL,
  `datum` DATE NULL,
  `potvrdeno` INT NULL,
  PRIMARY KEY (`idrezervira`),
  INDEX `fk_rezervira_korisnik1_idx` (`idkorisnik` ASC),
  INDEX `fk_rezervira_lijek1_idx` (`idlijek` ASC),
  CONSTRAINT `fk_rezervira_korisnik1`
    FOREIGN KEY (`idkorisnik`)
    REFERENCES `WebDiP2015x019`.`korisnik` (`idkorisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rezervira_lijek1`
    FOREIGN KEY (`idlijek`)
    REFERENCES `WebDiP2015x019`.`lijek` (`idlijek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
