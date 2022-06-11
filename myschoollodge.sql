-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema myschoollodge
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema myschoollodge
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `myschoollodge` DEFAULT CHARACTER SET utf8 ;
USE `myschoollodge` ;

-- -----------------------------------------------------
-- Table `myschoollodge`.`rating`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`rating` (
  `rating_id` INT NOT NULL AUTO_INCREMENT,
  `total_rating` INT NOT NULL DEFAULT 0,
  `no_of_rating` INT NOT NULL DEFAULT 0,
  `avg_rating` DECIMAL(4,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`rating_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`agent`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`agent` (
  `agent_id` INT NOT NULL AUTO_INCREMENT,
  `agent_title` VARCHAR(45) NOT NULL,
  `agent_username` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(12) NOT NULL,
  `image` VARCHAR(100) NULL,
  `status` VARCHAR(45) NULL DEFAULT 0,
  `agent_rating_id` INT NULL,
  PRIMARY KEY (`agent_id`),
  UNIQUE INDEX `username_UNIQUE` (`agent_username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `phone_UNIQUE` (`phone` ASC),
  INDEX `fk_agent_rating1_idx` (`agent_rating_id` ASC),
  CONSTRAINT `fk_agent_rating1`
    FOREIGN KEY (`agent_rating_id`)
    REFERENCES `myschoollodge`.`rating` (`rating_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`location` (
  `location_id` INT NOT NULL AUTO_INCREMENT,
  `address_line` VARCHAR(200) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `state` VARCHAR(45) NOT NULL,
  `area` VARCHAR(45) NULL,
  `nearest_bustop` VARCHAR(45) NULL,
  PRIMARY KEY (`location_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`agency`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`agency` (
  `agency_id` INT NOT NULL AUTO_INCREMENT,
  `agency_name` VARCHAR(45) NOT NULL,
  `agency_phone` VARCHAR(12) NOT NULL,
  `agency_email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `status` INT(2) NOT NULL DEFAULT 0,
  `location_id` INT NOT NULL,
  `rating_id` INT NULL,
  PRIMARY KEY (`agency_id`),
  UNIQUE INDEX `name_UNIQUE` (`agency_name` ASC),
  INDEX `fk_agency_prop_location1_idx` (`location_id` ASC),
  INDEX `fk_agency_rating1_idx` (`rating_id` ASC),
  CONSTRAINT `fk_agency_prop_location1`
    FOREIGN KEY (`location_id`)
    REFERENCES `myschoollodge`.`location` (`location_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_agency_rating1`
    FOREIGN KEY (`rating_id`)
    REFERENCES `myschoollodge`.`rating` (`rating_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`agency_has_agent`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`agency_has_agent` (
  `agency_id` INT NOT NULL,
  `agent_id` INT NOT NULL,
  `date_added` VARCHAR(45) NULL,
  PRIMARY KEY (`agency_id`),
  INDEX `fk_agency_has_agent_agent1_idx` (`agent_id` ASC),
  INDEX `fk_agency_has_agent_agency_idx` (`agency_id` ASC),
  CONSTRAINT `fk_agency_has_agent_agency`
    FOREIGN KEY (`agency_id`)
    REFERENCES `myschoollodge`.`agency` (`agency_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_agency_has_agent_agent1`
    FOREIGN KEY (`agent_id`)
    REFERENCES `myschoollodge`.`agent` (`agent_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`property`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`property` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `agent_id` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `type` VARCHAR(15) NOT NULL,
  `code` VARCHAR(45) NULL,
  `date_added` DATETIME NOT NULL,
  `date_sold` DATETIME NULL,
  `status` INT NOT NULL DEFAULT 1,
  `location_id` INT NOT NULL,
  PRIMARY KEY (`id`, `agent_id`),
  INDEX `fk_property_agent1_idx` (`agent_id` ASC),
  INDEX `fk_property_prop_location1_idx` (`location_id` ASC),
  CONSTRAINT `fk_property_agent1`
    FOREIGN KEY (`agent_id`)
    REFERENCES `myschoollodge`.`agent` (`agent_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_property_prop_location1`
    FOREIGN KEY (`location_id`)
    REFERENCES `myschoollodge`.`location` (`location_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`prop_facility`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`prop_facility` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `property_id` INT NOT NULL,
  `facility_title` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`, `property_id`),
  INDEX `fk_prop_facility_property1_idx` (`property_id` ASC),
  CONSTRAINT `fk_prop_facility_property1`
    FOREIGN KEY (`property_id`)
    REFERENCES `myschoollodge`.`property` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`agent_social`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`agent_social` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `agent_id` INT NOT NULL,
  `social_title` VARCHAR(45) NOT NULL,
  `social_link` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_agent_social_agent1_idx` (`agent_id` ASC),
  CONSTRAINT `fk_agent_social_agent1`
    FOREIGN KEY (`agent_id`)
    REFERENCES `myschoollodge`.`agent` (`agent_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`customer` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `other_name` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `message` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`customer_request`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`customer_request` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `customer_id` INT NOT NULL,
  `property_id` INT NOT NULL,
  `agent_id` INT NOT NULL,
  `request_date` DATETIME NOT NULL,
  `status` INT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_customer_request_customer1_idx` (`customer_id` ASC),
  INDEX `fk_customer_request_property1_idx` (`property_id` ASC),
  INDEX `fk_customer_request_agent1_idx` (`agent_id` ASC),
  CONSTRAINT `fk_customer_request_customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `myschoollodge`.`customer` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_customer_request_property1`
    FOREIGN KEY (`property_id`)
    REFERENCES `myschoollodge`.`property` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_customer_request_agent1`
    FOREIGN KEY (`agent_id`)
    REFERENCES `myschoollodge`.`agent` (`agent_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`property_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`property_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `property_id` INT NOT NULL,
  `description` VARCHAR(200) NULL,
  `time_to_get_to_school` VARCHAR(45) NULL,
  `prop_state` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_property_details_property1_idx` (`property_id` ASC),
  CONSTRAINT `fk_property_details_property1`
    FOREIGN KEY (`property_id`)
    REFERENCES `myschoollodge`.`property` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`agent_auth_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`agent_auth_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `agent_id_no` VARCHAR(45) NULL,
  `agent_id_type` VARCHAR(45) NOT NULL,
  `agent_id_image` VARCHAR(45) NOT NULL,
  `agent_agent_id` INT NOT NULL,
  PRIMARY KEY (`id`, `agent_agent_id`),
  INDEX `fk_agent_auth_details_agent1_idx` (`agent_agent_id` ASC),
  CONSTRAINT `fk_agent_auth_details_agent1`
    FOREIGN KEY (`agent_agent_id`)
    REFERENCES `myschoollodge`.`agent` (`agent_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`agency_other_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`agency_other_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `agency_id` INT NOT NULL,
  `agency_desc` VARCHAR(100) NULL,
  `agency_spec` VARCHAR(45) NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_agency_other_details_agency1_idx` (`agency_id` ASC),
  CONSTRAINT `fk_agency_other_details_agency1`
    FOREIGN KEY (`agency_id`)
    REFERENCES `myschoollodge`.`agency` (`agency_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`certification_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`certification_details` (
  `id` INT NOT NULL,
  `agency_id` INT NOT NULL,
  `c_firm` VARCHAR(45) NOT NULL,
  `c_no` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_certification_details_agency1_idx` (`agency_id` ASC),
  CONSTRAINT `fk_certification_details_agency1`
    FOREIGN KEY (`agency_id`)
    REFERENCES `myschoollodge`.`agency` (`agency_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`images` (
  `image_id` INT NOT NULL AUTO_INCREMENT,
  `id` VARCHAR(45) NOT NULL,
  `imageURL` VARCHAR(200) NOT NULL,
  `image_type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`image_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myschoollodge`.`login_attempt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myschoollodge`.`login_attempt` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `login_time` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
