ALTER TABLE `type` ADD `label` VARCHAR(25) NOT NULL AFTER `name`;

UPDATE `type` SET `label` = 'tente' WHERE `type`.`id_type` = 1;
UPDATE `type` SET `label` = 'sac de couchage' WHERE `type`.`id_type` = 2;
UPDATE `type` SET `label` = 'chaise' WHERE `type`.`id_type` = 3;
UPDATE `type` SET `label` = 'matelas' WHERE `type`.`id_type` = 4;