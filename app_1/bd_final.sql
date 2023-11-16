CREATE TABLE `db_final`.`role_tbl`
(
    `id`         INT          NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(150) NOT NULL,
    `status`     BOOLEAN      NOT NULL DEFAULT TRUE,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
