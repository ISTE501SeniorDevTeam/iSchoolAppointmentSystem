
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- reason
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `reason`;

CREATE TABLE `reason`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `is_grad` TINYINT(1) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- modality
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `modality`;

CREATE TABLE `modality`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- visit
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `visit`;

CREATE TABLE `visit`
(
    `id` CHAR(36) NOT NULL,
    `advisor_id` CHAR(7) NOT NULL,
    `student_id` CHAR(7) NOT NULL,
    `reason_id` INTEGER NOT NULL,
    `modality_id` INTEGER NOT NULL,
    `created_at` DATETIME NOT NULL,
    `invited_at` DATETIME,
    `complete_at` DATETIME,
    `position` INTEGER,
    `custom_reason` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `visit_fi_d9901a` (`student_id`),
    INDEX `visit_fi_17b25f` (`advisor_id`),
    INDEX `visit_fi_b1c508` (`reason_id`),
    INDEX `visit_fi_dde03a` (`modality_id`),
    CONSTRAINT `visit_fk_d9901a`
        FOREIGN KEY (`student_id`)
        REFERENCES `student` (`uid`),
    CONSTRAINT `visit_fk_17b25f`
        FOREIGN KEY (`advisor_id`)
        REFERENCES `employee` (`uid`),
    CONSTRAINT `visit_fk_b1c508`
        FOREIGN KEY (`reason_id`)
        REFERENCES `reason` (`id`),
    CONSTRAINT `visit_fk_dde03a`
        FOREIGN KEY (`modality_id`)
        REFERENCES `modality` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- student
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student`
(
    `uid` CHAR(7) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `major_id` INTEGER,
    `advisor_id` CHAR(7),
    `ritid` CHAR(9),
    PRIMARY KEY (`uid`),
    INDEX `student_fi_45d593` (`major_id`),
    INDEX `student_fi_17b25f` (`advisor_id`),
    CONSTRAINT `student_fk_45d593`
        FOREIGN KEY (`major_id`)
        REFERENCES `major` (`id`),
    CONSTRAINT `student_fk_17b25f`
        FOREIGN KEY (`advisor_id`)
        REFERENCES `employee` (`uid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employee
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee`
(
    `uid` CHAR(7) NOT NULL,
    `hash` CHAR(60),
    `name` VARCHAR(255) NOT NULL,
    `role_id` INTEGER NOT NULL,
    `picture_url` VARCHAR(255),
    `is_grad_advisor` TINYINT(1),
    `first_letter` CHAR(4),
    `last_letter` CHAR(4),
    PRIMARY KEY (`uid`),
    INDEX `employee_fi_1ff99e` (`role_id`),
    CONSTRAINT `employee_fk_1ff99e`
        FOREIGN KEY (`role_id`)
        REFERENCES `role` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- token
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `token`;

CREATE TABLE `token`
(
    `employeeId` CHAR(7) NOT NULL,
    `token` VARCHAR(704) NOT NULL,
    PRIMARY KEY (`employeeId`,`token`),
    CONSTRAINT `token_fk_49426d`
        FOREIGN KEY (`employeeId`)
        REFERENCES `employee` (`uid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image`
(
    `name` VARCHAR(255) NOT NULL,
    `data` MEDIUMBLOB NOT NULL,
    PRIMARY KEY (`name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- role
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role`
(
    `id` INTEGER NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- major
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `major`;

CREATE TABLE `major`
(
    `id` INTEGER NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `grad` TINYINT(1) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- walkin_hour
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `walkin_hour`;

CREATE TABLE `walkin_hour`
(
    `advisor_id` CHAR(7) NOT NULL,
    `starts_at` DATETIME NOT NULL,
    `ends_at` DATETIME NOT NULL,
    PRIMARY KEY (`advisor_id`,`starts_at`,`ends_at`),
    CONSTRAINT `walkin_hour_fk_17b25f`
        FOREIGN KEY (`advisor_id`)
        REFERENCES `employee` (`uid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ad
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ad`;

CREATE TABLE `ad`
(
    `id` CHAR(36) NOT NULL,
    `url` VARCHAR(255) NOT NULL,
    `starts_at` DATETIME,
    `ends_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- hour
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `hour`;

CREATE TABLE `hour`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `advisor_id` CHAR(7) NOT NULL,
    `date` DATETIME,
    `start_recurrence` DATETIME,
    `end_recurrence` DATETIME,
    `start_time` DATETIME,
    `end_time` DATETIME,
    `day_of_week` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `hour_fi_17b25f` (`advisor_id`),
    CONSTRAINT `hour_fk_17b25f`
        FOREIGN KEY (`advisor_id`)
        REFERENCES `employee` (`uid`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
