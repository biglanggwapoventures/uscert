ALTER TABLE `uscert`.`incident_reports` 
ADD COLUMN `organization_id` INT UNSIGNED NULL COMMENT '' AFTER `id`,
ADD INDEX `incident_organization_id_foreign_idx` (`organization_id` ASC)  COMMENT '';
ALTER TABLE `uscert`.`incident_reports` 
ADD CONSTRAINT `incident_organization_id_foreign`
  FOREIGN KEY (`organization_id`)
  REFERENCES `uscert`.`organizations` (`id`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;

ALTER TABLE `uscert`.`incident_reports` 
ADD COLUMN `tagged_users` TEXT NULL COMMENT '' AFTER `vehicles_used`;

ALTER TABLE `uscert`.`incident_reports` 
ADD COLUMN `reject_reason` TEXT NULL COMMENT '' AFTER `rejected_at`;



UPDATE incident_reports AS r JOIN users AS u ON u.id = r.created_by SET r.organization_id = u.organization_id;


