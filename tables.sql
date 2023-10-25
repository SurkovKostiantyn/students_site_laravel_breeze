-- MySQL Script generated by MySQL Workbench
-- Wed Oct 25 11:27:57 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

use students_site;

-- -----------------------------------------------------
-- Table `students_site`.`admins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students_site`.`admins` ;

CREATE TABLE IF NOT EXISTS `students_site`.`admins` (
  `admin_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `profile_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE INDEX `admin_id_UNIQUE` (`admin_id` ASC) VISIBLE,
  UNIQUE INDEX `profile_id_UNIQUE` (`profile_id` ASC) VISIBLE,
  CONSTRAINT `fk_admin_profile_id`
    FOREIGN KEY (`profile_id`)
    REFERENCES `students_site`.`user_profiles` (`profile_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `students_site`.`curators`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students_site`.`curators` ;

CREATE TABLE IF NOT EXISTS `students_site`.`curators` (
  `curator_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher_id` INT UNSIGNED NOT NULL,
  `group_id` INT UNSIGNED NULL,
  PRIMARY KEY (`curator_id`),
  UNIQUE INDEX `curator_id_UNIQUE` (`curator_id` ASC) VISIBLE,
  UNIQUE INDEX `group_id_UNIQUE` (`group_id` ASC) VISIBLE,
  INDEX `fk_curator_teacher_id_idx` (`teacher_id` ASC) VISIBLE,
  CONSTRAINT `fk_curator_teacher_id`
    FOREIGN KEY (`teacher_id`)
    REFERENCES `students_site`.`teachers` (`teacher_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curator_group_id`
    FOREIGN KEY (`group_id`)
    REFERENCES `students_site`.`groups` (`group_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- 3. Table `students_site`.`departments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students_site`.`departments` ;

CREATE TABLE IF NOT EXISTS `students_site`.`departments` (
  `depart_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `depart_name` VARCHAR(128) NULL,
  `info` TEXT NULL,
  PRIMARY KEY (`depart_id`),
  UNIQUE INDEX `depart_id_UNIQUE` (`depart_id` ASC) VISIBLE,
  UNIQUE INDEX `depart_name_UNIQUE` (`depart_name` ASC) VISIBLE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- 4. Table `students_site`.`groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students_site`.`groups` ;

CREATE TABLE IF NOT EXISTS `students_site`.`groups` (
  `group_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_name` VARCHAR(128) NULL,
  `info` TEXT NULL,
  `depart_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`group_id`),
  UNIQUE INDEX `group_id_UNIQUE` (`group_id` ASC) VISIBLE,
  UNIQUE INDEX `depart_name_UNIQUE` (`group_name` ASC) VISIBLE,
  UNIQUE INDEX `depart_id_UNIQUE` (`depart_id` ASC) VISIBLE,
  CONSTRAINT `fk_group_depart_id`
    FOREIGN KEY (`depart_id`)
    REFERENCES `students_site`.`departments` (`depart_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `students_site`.`headmans`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students_site`.`headmans` ;

CREATE TABLE IF NOT EXISTS `students_site`.`headmans` (
  `headman_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` INT UNSIGNED NOT NULL,
  `group_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`headman_id`),
  UNIQUE INDEX `admin_id_UNIQUE` (`headman_id` ASC) VISIBLE,
  UNIQUE INDEX `profile_id_UNIQUE` (`student_id` ASC) VISIBLE,
  UNIQUE INDEX `depart_id_UNIQUE` (`group_id` ASC) VISIBLE,
  CONSTRAINT `fk_headman_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `students_site`.`students` (`student_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_headman_group_id`
    FOREIGN KEY (`group_id`)
    REFERENCES `students_site`.`groups` (`group_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- 2. Table `students_site`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students_site`.`roles` ;

CREATE TABLE IF NOT EXISTS `students_site`.`roles` (
  `role_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE INDEX `role_id_UNIQUE` (`role_id` ASC) VISIBLE,
  UNIQUE INDEX `role_name_UNIQUE` (`role_name` ASC) VISIBLE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `students_site`.`students`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students_site`.`students` ;

CREATE TABLE IF NOT EXISTS `students_site`.`students` (
  `student_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `profile_id` INT UNSIGNED NOT NULL,
  `group_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE INDEX `admin_id_UNIQUE` (`student_id` ASC) VISIBLE,
  UNIQUE INDEX `profile_id_UNIQUE` (`profile_id` ASC) VISIBLE,
  UNIQUE INDEX `depart_id_UNIQUE` (`group_id` ASC) VISIBLE,
  CONSTRAINT `fk_student_profile_id`
    FOREIGN KEY (`profile_id`)
    REFERENCES `students_site`.`user_profiles` (`profile_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_student_group_id`
    FOREIGN KEY (`group_id`)
    REFERENCES `students_site`.`groups` (`group_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `students_site`.`teachers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students_site`.`teachers` ;

CREATE TABLE IF NOT EXISTS `students_site`.`teachers` (
  `teacher_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `profile_id` INT UNSIGNED NOT NULL,
  `depart_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`teacher_id`),
  UNIQUE INDEX `admin_id_UNIQUE` (`teacher_id` ASC) VISIBLE,
  UNIQUE INDEX `profile_id_UNIQUE` (`profile_id` ASC) VISIBLE,
  UNIQUE INDEX `depart_id_UNIQUE` (`depart_id` ASC) VISIBLE,
  CONSTRAINT `fk_teacher_profile_id`
    FOREIGN KEY (`profile_id`)
    REFERENCES `students_site`.`user_profiles` (`profile_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teacher_depart_id`
    FOREIGN KEY (`depart_id`)
    REFERENCES `students_site`.`departments` (`depart_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `students_site`.`user_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students_site`.`user_profiles` ;

CREATE TABLE IF NOT EXISTS `students_site`.`user_profiles` (
  `profile_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `first_name` VARCHAR(128) NULL,
  `last_name` VARCHAR(128) NULL,
  `group_id` INT UNSIGNED NOT NULL,
  `depart_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`profile_id`),
  UNIQUE INDEX `profile_id_UNIQUE` (`profile_id` ASC) VISIBLE,
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) VISIBLE,
  UNIQUE INDEX `group_id_UNIQUE` (`group_id` ASC) VISIBLE,
  UNIQUE INDEX `depart_id_UNIQUE` (`depart_id` ASC) VISIBLE,
  CONSTRAINT `fk_profiles_users_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `students_site`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_profile_group_id`
    FOREIGN KEY (`group_id`)
    REFERENCES `students_site`.`groups` (`group_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_profile_depart_id`
    FOREIGN KEY (`depart_id`)
    REFERENCES `students_site`.`departments` (`depart_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `students_site`.`user_roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students_site`.`user_roles` ;

CREATE TABLE IF NOT EXISTS `students_site`.`user_roles` (
  `user_role_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `role_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`user_role_id`),
  UNIQUE INDEX `user_role_id_UNIQUE` (`user_role_id` ASC) VISIBLE,
  INDEX `fk_role_profile_id_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_user_role_role_id_idx` (`role_id` ASC) VISIBLE,
  CONSTRAINT `fk_role_profile_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `students_site`.`user_profiles` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role_role_id`
    FOREIGN KEY (`role_id`)
    REFERENCES `students_site`.`roles` (`role_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
