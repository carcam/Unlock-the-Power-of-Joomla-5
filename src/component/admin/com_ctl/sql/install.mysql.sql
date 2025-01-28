CREATE TABLE IF NOT EXISTS `#__awco_ctl_tasks` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NULL,
    `state` TINYINT(1) NOT NULL DEFAULT 0,
    `description` TEXT NOT NULL DEFAULT "",
    `deadline` DATETIME NULL,
    `created` DATETIME NULL,
    `created_by` INT(11) NULL,
    PRIMARY KEY (`id`)
    ) DEFAULT COLLATE=utf8mb4_unicode_ci
