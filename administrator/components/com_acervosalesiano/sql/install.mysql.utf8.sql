CREATE TABLE IF NOT EXISTS `#__acervosalesiano` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`state` TINYINT(1)  NULL  DEFAULT 1,
`ordering` INT(11)  NULL  DEFAULT 0,
`checked_out` INT(11)  UNSIGNED,
`checked_out_time` DATETIME NULL  DEFAULT NULL ,
`created_by` INT(11)  NULL  DEFAULT 0,
`modified_by` INT(11)  NULL  DEFAULT 0,
`title` VARCHAR(255)  NOT NULL ,
`type` VARCHAR(255)  NULL  DEFAULT "",
`imagem` TEXT NULL ,
`data_nascimento` DATE NULL  DEFAULT NULL,
`data_beatificacao` DATE NULL  DEFAULT NULL,
`data_canonizacao` DATE NULL  DEFAULT NULL,
`data_celebracao` DATE NULL  DEFAULT NULL,
`etapa_canonizacao` VARCHAR(255)  NULL  DEFAULT "",
`categoria` TEXT NULL ,
`alias` VARCHAR(255) COLLATE utf8_bin NOT NULL ,
`arquivo` TEXT NULL ,
PRIMARY KEY (`id`)
,KEY `idx_state` (`state`)
,KEY `idx_checked_out` (`checked_out`)
,KEY `idx_created_by` (`created_by`)
,KEY `idx_modified_by` (`modified_by`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE INDEX `#__acervosalesiano_data_nascimento` ON `#__acervosalesiano`(`data_nascimento`);

CREATE INDEX `#__acervosalesiano_data_beatificacao` ON `#__acervosalesiano`(`data_beatificacao`);

CREATE INDEX `#__acervosalesiano_data_canonizacao` ON `#__acervosalesiano`(`data_canonizacao`);

CREATE INDEX `#__acervosalesiano_data_celebracao` ON `#__acervosalesiano`(`data_celebracao`);


INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `rules`, `field_mappings`, `content_history_options`)
SELECT * FROM ( SELECT 'Ítem','com_acervosalesiano.item','{"special":{"dbtable":"#__acervosalesiano","key":"id","type":"ItemTable","prefix":"Joomla\\\\Component\\\\Acervosalesian\\\\Administrator\\\\Table\\\\"}}', CASE 
                                    WHEN 'rules' is null THEN ''
                                    ELSE ''
                                    END as rules, CASE 
                                    WHEN 'field_mappings' is null THEN ''
                                    ELSE ''
                                    END as field_mappings, '{"formFile":"administrator\/components\/com_acervosalesiano\/forms\/item.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_acervosalesiano.item')
) LIMIT 1;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `rules`, `field_mappings`, `router`, `content_history_options`)
SELECT * FROM ( SELECT 'Ítem Category','com_acervosalesiano.items.category','{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":   {"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '','{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'Acervo SalesianoRouter::getCategoryRoute', '{"formFile":"administrator\/components\/com_categories\/models\/forms\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}') AS tmp WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_acervosalesiano.category')
) LIMIT 1;
