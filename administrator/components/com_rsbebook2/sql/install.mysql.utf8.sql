CREATE TABLE IF NOT EXISTS `#__rsbebook` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`state` TINYINT(1)  NULL  DEFAULT 1,
`ordering` INT(11)  NULL  DEFAULT 0,
`checked_out` INT(11)  UNSIGNED,
`checked_out_time` DATETIME NULL  DEFAULT NULL ,
`created_by` INT(11)  NULL  DEFAULT 0,
`modified_by` INT(11)  NULL  DEFAULT 0,
`data` DATETIME NULL  DEFAULT NULL ,
`title` VARCHAR(255)  NOT NULL ,
`alias` VARCHAR(255) COLLATE utf8_bin NOT NULL ,
`capa` TEXT NOT NULL ,
`descricao` TEXT NOT NULL ,
`arquivo` TEXT NULL ,
PRIMARY KEY (`id`)
,KEY `idx_state` (`state`)
,KEY `idx_checked_out` (`checked_out`)
,KEY `idx_created_by` (`created_by`)
,KEY `idx_modified_by` (`modified_by`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;


INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `rules`, `field_mappings`, `content_history_options`)
SELECT * FROM ( SELECT 'E-book','com_rsbebook.ebook','{"special":{"dbtable":"#__rsbebook","key":"id","type":"EbookTable","prefix":"Joomla\\\\Component\\\\Rsbebook\\\\Administrator\\\\Table\\\\"}}', CASE 
                                    WHEN 'rules' is null THEN ''
                                    ELSE ''
                                    END as rules, CASE 
                                    WHEN 'field_mappings' is null THEN ''
                                    ELSE ''
                                    END as field_mappings, '{"formFile":"administrator\/components\/com_rsbebook\/forms\/ebook.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"descricao"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_rsbebook.ebook')
) LIMIT 1;


CREATE TABLE IF NOT EXISTS `#__rsbebook_download` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`state` TINYINT(1)  NULL  DEFAULT 1,
`ordering` INT(11)  NULL  DEFAULT 0,
`checked_out` INT(11)  UNSIGNED,
`checked_out_time` DATETIME NULL  DEFAULT NULL ,
`created_by` INT(11)  NULL  DEFAULT 0,
`modified_by` INT(11)  NULL  DEFAULT 0,
`nome` VARCHAR(255)  NULL  DEFAULT "",
`email` VARCHAR(255)  NULL  DEFAULT "",
`ebook_id` TEXT NULL ,
`termo_licenca_uso` TINYINT(1)  NULL  DEFAULT 0,
`termo_consentimento_uso` TINYINT(1)  NULL  DEFAULT 0,
`data` DATETIME NULL  DEFAULT NULL ,
PRIMARY KEY (`id`)
,KEY `idx_state` (`state`)
,KEY `idx_checked_out` (`checked_out`)
,KEY `idx_created_by` (`created_by`)
,KEY `idx_modified_by` (`modified_by`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE INDEX `#__rsbebook_download_data` ON `#__rsbebook_download`(`data`);